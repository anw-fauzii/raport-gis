<?php

namespace App\Http\Controllers;

use App\Models\NilaiHafalan;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Kelas;
use Carbon\Carbon;
use App\Models\AnggotaT2Q;
use Illuminate\Http\Request;

class NilaiHafalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Nilai Hafalan';
        $tapel = Tapel::findorfail(5);     
        $guru = Guru::where('user_id', 2)->first();
        $data_rencana_penilaian = AnggotaT2Q::where('guru_id', $guru->id)->where('tapel', $tapel->tahun_pelajaran)->groupBy('tingkat')->get();
        $cek_nilai = NilaiHafalan::join('anggota_t2q','nilai_hafalan.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
        ->where('guru_id', $guru->id)->get();
        return view('t2q.penilaian-hafalan.index', compact('title', 'data_rencana_penilaian','guru','cek_nilai'));
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
        for ($cound_siswa = 1; $cound_siswa <= $request->jumlah; $cound_siswa++) {
                $data_nilai = array(
                    'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                    'hadis'  => $request->hadis[$cound_siswa],
                    'doa'  => $request->doa[$cound_siswa],
                    'hikmah'  => $request->hikmah[$cound_siswa],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                NilaiHafalan::insert($data_nilai);  
        }
        return redirect('penilaian-hafalan')->with('success', 'Data nilai sosial berhasil disimpan.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiHafalan  $nilaiHafalan
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiHafalan $nilaiHafalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiHafalan  $nilaiHafalan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::where('user_id', 2)->first();
        $data_anggota_kelas = AnggotaT2Q::where('guru_id', $guru->id)->where('tingkat',$id)->get();
        $cek_nilai = NilaiHafalan::join('anggota_t2q','nilai_hafalan.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
        ->where('guru_id', $guru->id)->get();
        $count_kd_nilai = count($cek_nilai);

        if ($count_kd_nilai == 0) {
            $title = 'Input Nilai hafalan';
            return view('t2q.penilaian-hafalan.create', compact('title', 'data_anggota_kelas'));
        } else {
            foreach ($data_anggota_kelas as $anggota_kelas) {
                $data_nilai = NilaiHafalan::where('anggota_kelas_id', $anggota_kelas->anggota_kelas_id)->get();
                $anggota_kelas->data_nilai = $data_nilai;
            }
            $title = 'Edit Nilai Pengetahuan';
            return view('t2q.penilaian-hafalan.edit', compact('title', 'data_anggota_kelas'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiHafalan  $nilaiHafalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        for ($cound_siswa = 1; $cound_siswa <= $request->jumlah; $cound_siswa++) {
            $nilai = NilaiHafalan::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->first();
            $data_nilai = array(
                'hadis'  => $request->hadis[$cound_siswa],
                'doa'  => $request->doa[$cound_siswa],
                'hikmah'  => $request->hikmah[$cound_siswa],
                'updated_at'  => Carbon::now(),
            );
            $nilai->update($data_nilai);  
        }
        return redirect('penilaian-hafalan')->with('success', 'Data nilai sosial berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiHafalan  $nilaiHafalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiHafalan $nilaiHafalan)
    {
        //
    }
}
