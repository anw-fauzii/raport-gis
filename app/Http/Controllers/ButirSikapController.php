<?php

namespace App\Http\Controllers;

use App\Imports\ButirSikapImport;
use App\Models\ButirSikap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Excel;
use Illuminate\Support\Facades\Auth;

class ButirSikapController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','revalidate']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $title = 'Butir-Butir Sikap';
            $data_sikap = ButirSikap::orderBy('kategori_butir_id', 'ASC')->get();
            return view('admin.butir-sikap.index', compact('title', 'data_sikap'));
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('admin')){
            $file = public_path() . "/format_excel/format_import_sikap.xlsx";
            $headers = array(
                'Content-Type: application/xlsx',
            );
            return Response::download($file, 'format_import_sikap ' . date('Y-m-d H_i_s') . '.xlsx', $headers);
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'kategori_butir_id' => 'required',
                'kode' => 'required|min:2|max:10|unique:butir_sikap',
                'butir_sikap' => 'required|min:4|max:255',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            } else {
                $sikap = new ButirSikap([
                    'kategori_butir_id' => $request->jenis_kompetensi,
                    'kode' => $request->kode,
                    'butir_sikap' => $request->butir_sikap,
                ]);
                $sikap->save();
                return back()->with('success', 'Butir sikap berhasil ditambahkan');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ButirSikap  $butirSikap
     * @return \Illuminate\Http\Response
     */
    public function show(ButirSikap $butirSikap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ButirSikap  $butirSikap
     * @return \Illuminate\Http\Response
     */
    public function edit(ButirSikap $butirSikap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ButirSikap  $butirSikap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'kode' => 'required|min:2|max:10|unique:butir_sikap' . ($id ? ",id,$id" : ''),
                'butir_sikap' => 'required|min:4|max:255',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            } else {
                try {
                    $sikap = ButirSikap::findorfail($id);
                    $data_sikap = [
                        'kode' => $request->kode,
                        'butir_sikap' => $request->butir_sikap,
                    ];
                    $sikap->update($data_sikap);
                    return back()->with('success', 'Butir sikap berhasil diedit');
                } catch (\Exception $e) {
                    return back()->with('error', 'kode sudah ada sebelumnya');
                }
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ButirSikap  $butirSikap
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasRole('admin')){
            $sikap = ButirSikap::findorfail($id);
            $sikap->delete();
            return back()->with('success', 'Sukses! Tahun Pelajaran Dihapus');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    public function import(Request $request)
    {
        if(Auth::user()->hasRole('admin')){
            try {
                Excel::import(new ButirSikapImport, $request->file('file_import'));
                return back()->with('success', 'Data butir sikap berhasil diimport');
            } catch (\Exception $e) {
                return back()->with('error', 'Maaf, format data tidak sesuai');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }
}