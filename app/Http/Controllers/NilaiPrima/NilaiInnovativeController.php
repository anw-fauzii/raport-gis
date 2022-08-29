<?php

namespace App\Http\Controllers\NilaiPrima;

use App\Http\Controllers\Controller;
use App\Models\NilaiPrima\NilaiInnovative;
use App\Models\RencanaPrima\RencanaInnovative;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Kelas;
use Carbon\Carbon;
use App\Models\AnggotaKelas;
use Illuminate\Http\Request;

class NilaiInnovativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::where('user_id', 4)->first();
        $kelas = Kelas::where('guru_id', $guru->id)->first();
        $data_anggota_kelas = AnggotaKelas::where('kelas_id', $kelas->id)->get();
        
        $id_data_rencana_penilaian = RencanaInnovative::where('kelas_id', $kelas->id)->orderBy('butir_sikap_id', 'ASC')->get('id');
        $data_kd_nilai = NilaiInnovative::whereIn('rencana_innovative_id', $id_data_rencana_penilaian)->groupBy('rencana_innovative_id')->get();
    
        $count_kd_nilai = count($data_kd_nilai);

        if ($count_kd_nilai == 0) {
            $data_rencana_penilaian = RencanaInnovative::where('kelas_id', $kelas->id)->orderBy('butir_sikap_id', 'ASC')->get();
            $count_kd = count($data_rencana_penilaian);
            $title = 'Input Nilai Innovative';
            return view('walikelas.prima.penilaian-innovative.create', compact('title', 'data_anggota_kelas', 'data_rencana_penilaian', 'count_kd'));
        } else {
            foreach ($data_anggota_kelas as $anggota_kelas) {
                $data_nilai = NilaiInnovative::whereIn('rencana_innovative_id', $id_data_rencana_penilaian)->where('anggota_kelas_id', $anggota_kelas->id)->get();
                $anggota_kelas->data_nilai = $data_nilai;
            }
            $title = 'Edit Nilai Innovative';
            return view('walikelas.prima.penilaian-innovative.edit', compact('title', 'data_anggota_kelas', 'count_kd_nilai', 'data_kd_nilai','kelas'));
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
                for ($count_penilaian = 0; $count_penilaian < count($request->rencana_innovative_id); $count_penilaian++) {
                    $data_nilai = array(
                        'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                        'rencana_innovative_id' => $request->rencana_innovative_id[$count_penilaian],
                        'nilai'  => ltrim($request->nilai[$count_penilaian][$cound_siswa]),
                        'created_at'  => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    );
                    $data_penilaian_siswa[] = $data_nilai;
                }
                $store_data_penilaian = $data_penilaian_siswa;
            }
            NilaiInnovative::insert($store_data_penilaian);
            return redirect()->back()->with('success', 'Data Nilai Innovative berhasil disimpan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiPrima\NilaiInnovative  $nilaiInnovative
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiInnovative $nilaiInnovative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiPrima\NilaiInnovative  $nilaiInnovative
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiInnovative $nilaiInnovative)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiPrima\NilaiInnovative  $nilaiInnovative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
            for ($count_penilaian = 0; $count_penilaian < count($request->rencana_innovative_id); $count_penilaian++) {
                $nilai = NilaiInnovative::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->where('rencana_innovative_id', $request->rencana_innovative_id[$count_penilaian])->first();
                $data_nilai = [
                    'nilai'  => ltrim($request->nilai[$count_penilaian][$cound_siswa]),
                    'updated_at'  => Carbon::now(),
                ];
                $nilai->update($data_nilai);
            }
        }
        return redirect()->back()->with('success', 'Data Nilai Innovative berhasil edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiPrima\NilaiInnovative  $nilaiInnovative
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiInnovative $nilaiInnovative)
    {
        //
    }
}
