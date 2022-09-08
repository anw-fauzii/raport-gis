<?php

namespace App\Http\Controllers;

use App\Models\NilaiT2Q;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Kelas;
use Carbon\Carbon;
use App\Models\AnggotaT2Q;
use Illuminate\Http\Request;

class NilaiT2QController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Nilai Tahsin Tahfidz';
        $tapel = Tapel::findorfail(5);     
        $guru = Guru::where('user_id', 2)->first();
        $data_rencana_penilaian = AnggotaT2Q::where('guru_id', $guru->id)->where('tapel', $tapel->tahun_pelajaran)->groupBy('tingkat')->get();
        $cek_nilai = NilaiT2Q::join('anggota_t2q','nilai_t2q.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
        ->where('guru_id', $guru->id)->get();
        return view('t2q.penilaian-t2q.index', compact('title', 'data_rencana_penilaian','guru','cek_nilai'));
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
                    'tahsin_jilid'  => $request->tahsin_jilid[$cound_siswa],
                    'tahsin_halaman'  => $request->tahsin_halaman[$cound_siswa],
                    'tahsin_kekurangan'  => $request->tahsin_kekurangan[$cound_siswa],
                    'tahsin_kelebihan'  => $request->tahsin_kelebihan[$cound_siswa],
                    'tahsin_nilai'  => $request->tahsin_nilai[$cound_siswa],
                    'tahfidz_surah'  => $request->tahfidz_surah[$cound_siswa],
                    'tahfidz_ayat'  => $request->tahfidz_ayat[$cound_siswa],
                    'tahfidz_nilai'  => $request->tahfidz_nilai[$cound_siswa],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                NilaiT2Q::insert($data_nilai);  
        }
        return redirect('penilaian-t2q')->with('success', 'Data nilai sosial berhasil disimpan.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiT2Q  $nilaiT2Q
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiT2Q $nilaiT2Q)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiT2Q  $nilaiT2Q
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::where('user_id', 2)->first();
        $data_anggota_kelas = AnggotaT2Q::where('guru_id', $guru->id)->where('tingkat',$id)->get();
        $cek_nilai = NilaiT2Q::join('anggota_t2q','nilai_t2q.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
        ->where('guru_id', $guru->id)->get();
        $count_kd_nilai = count($cek_nilai);

        if ($count_kd_nilai == 0) {
            $title = 'Input Nilai t2q';
            return view('t2q.penilaian-t2q.create', compact('title', 'data_anggota_kelas'));
        } else {
            foreach ($data_anggota_kelas as $anggota_kelas) {
                $data_nilai = NilaiT2Q::where('anggota_kelas_id', $anggota_kelas->anggota_kelas_id)->get();
                $anggota_kelas->data_nilai = $data_nilai;
            }
            $title = 'Edit Nilai Pengetahuan';
            return view('t2q.penilaian-t2q.edit', compact('title', 'data_anggota_kelas'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiT2Q  $nilaiT2Q
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        for ($cound_siswa = 1; $cound_siswa <= $request->jumlah; $cound_siswa++) {
            $nilai = NilaiT2Q::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->first();
            $data_nilai = array(
                'tahsin_jilid'  => $request->tahsin_jilid[$cound_siswa],
                'tahsin_halaman'  => $request->tahsin_halaman[$cound_siswa],
                'tahsin_kekurangan'  => $request->tahsin_kekurangan[$cound_siswa],
                'tahsin_kelebihan'  => $request->tahsin_kelebihan[$cound_siswa],
                'tahsin_nilai'  => $request->tahsin_nilai[$cound_siswa],
                'tahfidz_surah'  => $request->tahfidz_surah[$cound_siswa],
                'tahfidz_ayat'  => $request->tahfidz_ayat[$cound_siswa],
                'tahfidz_nilai'  => $request->tahfidz_nilai[$cound_siswa],
                'updated_at'  => Carbon::now(),
            );
            $nilai->update($data_nilai);  
        }
        return redirect('penilaian-t2q')->with('success', 'Data nilai sosial berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiT2Q  $nilaiT2Q
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiT2Q $nilaiT2Q)
    {
        //
    }
}
