<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use DataTables;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','revalidate']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->hasRole('admin')){
            if ($request->ajax()) {
                $data = User::all();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn ='<a href="javascript:void(0)" data-toggle="tooltip" title="Reset" data-id="'.$row->id.'" data-original-title="Reset" class="btn btn-info btn-sm resetAkun"><i class="metismenu-icon pe-7s-repeat"></i></a>';
                        $btn = $btn. '<a href="javascript:void(0)" data-toggle="tooltip" title="Reset" data-id="'.$row->id.'" data-original-title="Reset" class="btn btn-info btn-sm resetAkun"><i class="metismenu-icon pe-7s-repeat"></i></a>';
                        return $btn;
                    })
                    ->addColumn('status', function($data){
                        if (Cache::has('is_online'.$data->id)){
                            $status = '<div class="badge badge-success">Online</div>';
                           return $status;
                        }
                        else{
                            $status = '<div class="badge badge-danger">Offline</div>';
                            return $status;
                        }
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
                }
            return view('user.index');
        }else{
            return response()->view('errors.403', [abort(403)], 403);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('errors.403', [abort(403)], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->view('errors.403', [abort(403)], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->view('errors.403', [abort(403)], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasAnyRole('admin|siswa|guru|wali')){
            $user = User::find(Auth::user()->id);
            return view('admin.user.edit', compact('user'));
        }
        else{
            return response()->view('errors.403', [abort(403)], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->hasAnyRole('admin|siswa|guru|wali|t2q')){
            $validator = Validator::make($request->all(), [
                'old_password' => ['required', new MatchOldPassword],
                'new_password' => ['required'],
                'confirm_password' => ['same:new_password']
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            }else{
                $login_user = User::findOrFail(Auth::user()->id);
                $login_user->password = Hash::make($request->new_password);
                $login_user->save();
                Auth::login($login_user);
                return redirect()->route('home')->with('success', 'Sukses! Password berhasil diganti');
            }
        }
        else{
            return response()->view('errors.403', [abort(403)], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return response()->view('errors.404', [abort(403)], 404);
    }

    public function reset(Request $request, $id)
    {
        if (Auth::user()->hasRole('admin')){
            $user = User::findOrFail($id);
            $user->update(['password' => Hash::make("12345678")]);
            return response()->json($user);
        }
        else {
            return response()->view('errors.403', [abort(403)], 403);
        } 
    }

    public function aktivasi(Request $request, $id)
    {
        if (Auth::user()->hasRole('admin')){
            $user = User::findOrFail($id);
            if($user->status = 1){
                $user->update(['status' => 0]);
            }else{
                $user->update(['status' => 1]);
            }
            
            return response()->json($user);
        }
        else {
            return response()->view('errors.403', [abort(403)], 403);
        } 
    }
}
