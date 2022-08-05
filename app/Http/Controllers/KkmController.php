<?php

namespace App\Http\Controllers;

use App\Models\Kkm;
use App\Models\Tapel;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use Illuminate\Http\Request;

class KkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'KKM Mata Pelajaran';
        $tapel = Tapel::findorfail(5);
        $data_mapel = Mapel::where('tapel', $tapel->tahun_pelajaran)->orderBy('nama_mapel', 'ASC')->get();
        $id_mapel = Mapel::where('tapel', $tapel->tahun_pelajaran)->get('id');

        $cek_pembelajaran = Pembelajaran::whereIn('mapel_id', $id_mapel)->whereNotNull('guru_id')->where('status', 1)->get();
        if (count($cek_pembelajaran) == 0) {
            return redirect('pembelajaran')->with('warning', 'Mohon isikan data pembelajaran');
        } else {
            $data_kkm = Kkm::whereIn('mapel_id', $id_mapel)->get();
            return view('admin.kkm.index', compact('title', 'data_mapel', 'data_kkm'));
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kkm  $kkm
     * @return \Illuminate\Http\Response
     */
    public function show(Kkm $kkm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kkm  $kkm
     * @return \Illuminate\Http\Response
     */
    public function edit(Kkm $kkm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kkm  $kkm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kkm $kkm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kkm  $kkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kkm $kkm)
    {
        //
    }
}
