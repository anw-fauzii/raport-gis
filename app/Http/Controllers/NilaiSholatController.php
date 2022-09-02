<?php

namespace App\Http\Controllers;

use App\Models\NilaiSholat;
use App\Models\RencanaPelajaranSholat;
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
        $guru = Guru::where('user_id', 4)->first();
        $data_anggota_kelas = AnggotaT2Q::where('guru_id', $guru->id)->get();
        
        $id_data_rencana_penilaian = RencanaPelajaranSholat::where('kelas_id', $kelas->id)->orderBy('butir_sikap_id', 'ASC')->get('id');
        $data_kd_nilai = NilaiSholat::whereIn('rencana_nilai_sholat_id', $id_data_rencana_penilaian)->groupBy('rencana_nilai_sholat_id')->get();
    
        $count_kd_nilai = count($data_kd_nilai);

        if ($count_kd_nilai == 0) {
            $data_rencana_penilaian = RencanaPelajaranSholat::where('kelas_id', $kelas->id)->orderBy('butir_sikap_id', 'ASC')->get();
            $count_kd = count($data_rencana_penilaian);
            $title = 'Input Nilai Sosial';
            return view('t2q.penilaian-sholat.create', compact('title', 'data_anggota_kelas', 'data_rencana_penilaian', 'count_kd'));
        } else {
            foreach ($data_anggota_kelas as $anggota_kelas) {
                $data_nilai = NilaiSholat::whereIn('rencana_nilai_sholat_id', $id_data_rencana_penilaian)->where('anggota_kelas_id', $anggota_kelas->id)->get();
                $anggota_kelas->data_nilai = $data_nilai;
            }
            $title = 'Edit Nilai Sosial';
            return view('t2q.penilaian-sholat.edit', compact('title', 'data_anggota_kelas', 'count_kd_nilai', 'data_kd_nilai','kelas'));
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
        if (is_null($request->anggota_kelas_id)) {
            return back()->with('error', 'Data siswa tidak ditemukan');
        } else {
            for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                for ($count_penilaian = 0; $count_penilaian < count($request->rencana_nilai_sholat_id); $count_penilaian++) {
                    $data_nilai = array(
                        'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                        'rencana_nilai_sholat_id' => $request->rencana_nilai_sholat_id[$count_penilaian],
                        'nilai'  => ltrim($request->nilai[$count_penilaian][$cound_siswa]),
                        'created_at'  => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    );
                    $data_penilaian_siswa[] = $data_nilai;
                }
                $store_data_penilaian = $data_penilaian_siswa;
            }
            NilaiSholat::insert($store_data_penilaian);
            return redirect()->back()->with('success', 'Data nilai sosial berhasil disimpan.');
        }
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
    public function edit(NilaiSholat $nilaiSholat)
    {
        //
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
        for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
            for ($count_penilaian = 0; $count_penilaian < count($request->rencana_nilai_sholat_id); $count_penilaian++) {
                $nilai = NilaiSholat::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->where('rencana_nilai_sholat_id', $request->rencana_nilai_sholat_id[$count_penilaian])->first();
                $data_nilai = [
                    'nilai'  => ltrim($request->nilai[$count_penilaian][$cound_siswa]),
                    'updated_at'  => Carbon::now(),
                ];
                $nilai->update($data_nilai);
            }
        }
        return redirect()->back()->with('success', 'Data nilai sosial berhasil edit.');
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
