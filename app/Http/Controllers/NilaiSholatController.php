<?php

namespace App\Http\Controllers;

use App\Models\NilaiSholat;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Kelas;
use Carbon\Carbon;
use App\Models\AnggotaT2Q;
use Illuminate\Http\Request;

class NilaiSholatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Nilai Sholat';
        $tapel = Tapel::findorfail(5);     
        $guru = Guru::where('user_id', 2)->first();
        $data_rencana_penilaian = AnggotaT2Q::where('guru_id', $guru->id)->where('tapel', $tapel->tahun_pelajaran)->groupBy('tingkat')->get();
        $cek_nilai = NilaiSholat::join('anggota_t2q','nilai_sholat.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
        ->where('guru_id', $guru->id)->get();
        return view('t2q.penilaian-sholat.index', compact('title', 'data_rencana_penilaian','guru','cek_nilai'));
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
                    'praktik_wudhu'  => $request->praktik_wudhu[$cound_siswa],
                    'bacaan_sholat'  => $request->bacaan_sholat[$cound_siswa],
                    'gerakan_sholat'  => $request->gerakan_sholat[$cound_siswa],
                    'dzikir'  => $request->dzikir[$cound_siswa],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                NilaiSholat::insert($data_nilai);  
        }
        return redirect('penilaian-sholat')->with('success', 'Data nilai sosial berhasil disimpan.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiSholat  $nilaiSholat
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiSholat $nilaiSholat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiSholat  $nilaiSholat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::where('user_id', 2)->first();
        $data_anggota_kelas = AnggotaT2Q::where('guru_id', $guru->id)->where('tingkat',$id)->get();
        $cek_nilai = NilaiSholat::join('anggota_t2q','nilai_sholat.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
        ->where('guru_id', $guru->id)->get();
        $count_kd_nilai = count($cek_nilai);

        if ($count_kd_nilai == 0) {
            $title = 'Input Nilai Sholat';
            return view('t2q.penilaian-sholat.create', compact('title', 'data_anggota_kelas'));
        } else {
            foreach ($data_anggota_kelas as $anggota_kelas) {
                $data_nilai = NilaiSholat::where('anggota_kelas_id', $anggota_kelas->anggota_kelas_id)->get();
                $anggota_kelas->data_nilai = $data_nilai;
            }
            $title = 'Edit Nilai Pengetahuan';
            return view('t2q.penilaian-sholat.edit', compact('title', 'data_anggota_kelas'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiSholat  $nilaiSholat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        for ($cound_siswa = 1; $cound_siswa <= $request->jumlah; $cound_siswa++) {
            $nilai = NilaiSholat::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->first();
            $data_nilai = array(
                'praktik_wudhu'  => $request->praktik_wudhu[$cound_siswa],
                'bacaan_sholat'  => $request->bacaan_sholat[$cound_siswa],
                'gerakan_sholat'  => $request->gerakan_sholat[$cound_siswa],
                'dzikir'  => $request->dzikir[$cound_siswa],
                'updated_at'  => Carbon::now(),
            );
            $nilai->update($data_nilai);  
        }
        return redirect('penilaian-sholat')->with('success', 'Data nilai sosial berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiSholat  $nilaiSholat
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiSholat $nilaiSholat)
    {
        //
    }
}
