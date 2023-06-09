<?php

namespace App\Http\Controllers\p5;

use App\Http\Controllers\Controller;
use App\Models\p5\P5;
use App\Models\p5\P5Deskripsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class P5DeskripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('wali')){
            $validator = Validator::make($request->all(), [
                'judul.*' => 'required|min:2',
                'deskripsi.*' => 'required|min:10',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            } else {
                for ($count = 0; $count < count($request->judul); $count++) {
                    $data_kd = array(
                        'dimensi'=> $request->dimensi,
                        'p5_id'  => $request->p5_id,
                        'judul'  => $request->judul[$count],
                        'deskripsi'  => $request->deskripsi[$count],
                        'created_at'  => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    );
                    $store_data_kd[] = $data_kd;
                }
                P5Deskripsi::insert($store_data_kd);
                return redirect('projek-p5')->with('success', 'Projek P5 berhasil ditambahkan');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\P5Deskripsi  $p5Deskripsi
     * @return \Illuminate\Http\Response
     */
    public function show(P5Deskripsi $p5Deskripsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\P5Deskripsi  $p5Deskripsi
     * @return \Illuminate\Http\Response
     */
    public function edit(P5Deskripsi $p5Deskripsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\P5Deskripsi  $p5Deskripsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, P5Deskripsi $p5Deskripsi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\P5Deskripsi  $p5Deskripsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(P5Deskripsi $p5Deskripsi)
    {
        //
    }
}
