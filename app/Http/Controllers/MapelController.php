<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Tapel;
use App\Models\KategoriMapel;
use App\Imports\MapelImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Excel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Mata Pelajaran';
        $tapel = Tapel::findorfail(5);
        $kategori_mapel = KategoriMapel::all();
        $data_mapel = Mapel::where('tapel', $tapel->tahun_pelajaran)->orderBy('nama_mapel', 'ASC')->get();
        return view('admin.mapel.index', compact('title', 'data_mapel', 'tapel','kategori_mapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $file = public_path() . "/format_excel/format_import_mapel.xlsx";
        $headers = array(
            'Content-Type: application/xlsx',
        );
        return Response::download($file, 'format_import_mapel ' . date('Y-m-d H_i_s') . '.xlsx', $headers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
                'tapel' => $tapel->tahun_pelajaran,
                'nama_mapel' => $request->nama_mapel,
                'ringkasan_mapel' => $request->ringkasan_mapel,
                'kategori_mapel_id' => $request->kategori_mapel_id,
            ]);
            $mapel->save();
            return back()->with('success', 'Mata Pelajaran berhasil ditambahkan');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $mapel = Mapel::findorfail($id);
        try {
            $mapel->delete();
            return back()->with('success', 'Mata Pelajaran berhasil dihapus');
        } catch (Exception $e) {
            return back()->with('warning', 'Data Mata Pelajaran tidak dapat dihapus');
        }
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new MapelImport, $request->file('file_import'));
            return back()->with('success', 'Data mata pelajaran berhasil diimport');
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, format data tidak sesuai');
        }
    }
}
