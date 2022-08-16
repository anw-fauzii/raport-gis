<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\KdMapel;
use App\Models\RencanaNilaiK3;
use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\Tapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RencanaNilaiK3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Rencana Nilai Pengetahuan';
        $tapel = Tapel::findorfail(5);
        $data_kd_mapel = KdMapel::where('tapel_id', $tapel->id)->get();
        $guru = Guru::where('user_id', 4)->first();
        $id_kelas = Kelas::where('tapel_id', $tapel->id)->get('id');

        $data_rencana_penilaian = Pembelajaran::where('guru_id', $guru->id)->whereIn('kelas_id', $id_kelas)->where('status', 1)->orderBy('mapel_id', 'ASC')->orderBy('kelas_id', 'ASC')->get();
        foreach ($data_rencana_penilaian as $penilaian) {
            $rencana_penilaian = RencanaNilaiK3::where('pembelajaran_id', $penilaian->id)->get();
            $penilaian->jumlah_rencana_penilaian = count($rencana_penilaian);
        }

        return view('guru.rencana-k3.index', compact('title', 'data_rencana_penilaian','data_kd_mapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
     * @param  \App\Models\RencanaNilaiK3  $rencanaNilaiK3
     * @return \Illuminate\Http\Response
     */
    public function show(RencanaNilaiK3 $rencanaNilaiK3)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RencanaNilaiK3  $rencanaNilaiK3
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaNilaiK3 $rencanaNilaiK3)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RencanaNilaiK3  $rencanaNilaiK3
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RencanaNilaiK3 $rencanaNilaiK3)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RencanaNilaiK3  $rencanaNilaiK3
     * @return \Illuminate\Http\Response
     */
    public function destroy(RencanaNilaiK3 $rencanaNilaiK3)
    {
        //
    }
}
