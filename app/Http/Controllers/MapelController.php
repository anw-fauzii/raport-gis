<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Tapel;
use App\Models\KategoriMapel;
use App\Imports\MapelImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Excel;

class MapelController extends Controller
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
            $title = 'Mata Pelajaran';
            $tapel = Tapel::latest()->first();
            $kategori_mapel = KategoriMapel::all();
            $data_mapel = Mapel::where('tapel_id', $tapel->id)->orderBy('nama_mapel', 'ASC')->get();
            return view('admin.mapel.index', compact('title', 'data_mapel', 'tapel','kategori_mapel'));
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
            $file = public_path() . "/format_excel/format_import_mapel.xlsx";
            $headers = array(
                'Content-Type: application/xlsx',
            );
            return Response::download($file, 'format_import_mapel ' . date('Y-m-d H_i_s') . '.xlsx', $headers);
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
                'nama_mapel' => 'required|min:3|max:255',
                'ringkasan_mapel' => 'required|min:2|max:50',
                'kategori_mapel_id' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            } else {
                $tapel = Tapel::latest()->first();
                $mapel = new Mapel([
                    'tapel_id' => $tapel->id,
                    'nama_mapel' => $request->nama_mapel,
                    'ringkasan_mapel' => $request->ringkasan_mapel,
                    'kategori_mapel_id' => $request->kategori_mapel_id,
                ]);
                $mapel->save();
                return back()->with('success', 'Mata Pelajaran berhasil ditambahkan');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'nama_mapel' => 'required|min:3|max:255',
                'ringkasan_mapel' => 'nullable|min:2|max:255',
                'kategori_mapel_id' =>'required',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            } else {
                $mapel = Mapel::findorfail($id);
                $data_mapel = [
                    'ringkasan_mapel' => $request->ringkasan_mapel,
                    'kategori_mapel_id' => $request->kategori,
                ];
                $mapel->update($data_mapel);
                return back()->with('success', 'Mata Pelajaran berhasil diedit');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        if(Auth::user()->hasRole('admin')){
            $mapel = Mapel::findorfail($id);
            try {
                $mapel->delete();
                return back()->with('success', 'Mata Pelajaran berhasil dihapus');
            } catch (Exception $e) {
                return back()->with('warning', 'Mata Pelajaran tidak dapat dihapus');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    public function import(Request $request)
    {
        if(Auth::user()->hasRole('admin')){
            try {
                Excel::import(new MapelImport, $request->file('file_import'));
                return back()->with('success', 'mata pelajaran berhasil diimport');
            } catch (\Throwable $th) {
                return back()->with('error', 'Maaf, format data tidak sesuai');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }
}
