<?php

namespace App\Http\Controllers;

use App\Models\NilaiHafalan;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Kelas;
use Carbon\Carbon;
use App\Models\AnggotaT2Q;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiHafalanController extends Controller
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
        if(Auth::user()->hasRole('t2q')){
            $title = 'Nilai Hafalan';
            $tapel = Tapel::findorfail(5);     
            $guru = Guru::where('user_id', 2)->first();
            $data_rencana_penilaian = AnggotaT2Q::where('guru_id', $guru->id)->where('tapel', $tapel->tahun_pelajaran)->groupBy('tingkat')->get();
            $cek_nilai = NilaiHafalan::join('anggota_t2q','nilai_hafalan.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
            ->where('guru_id', $guru->id)->get();
            return view('t2q.penilaian-hafalan.index', compact('title', 'data_rencana_penilaian','guru','cek_nilai'));
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
        return response()->view('errors.404', [abort(404), 404]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('t2q')){
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
            return redirect('penilaian-hafalan')->with('success', 'Data nilai hafalan berhasil disimpan.');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiHafalan  $nilaiHafalan
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiHafalan $nilaiHafalan)
    {
        return response()->view('errors.404', [abort(404), 404]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiHafalan  $nilaiHafalan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasRole('t2q')){
            $guru = Guru::where('user_id', 2)->first();
            $data_anggota_kelas = AnggotaT2Q::where('guru_id', $guru->id)->where('tingkat',$id)->get();
            $cek_nilai = NilaiHafalan::join('anggota_t2q','nilai_hafalan.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
            ->where('guru_id', $guru->id)->where('anggota_t2q.tingkat',$id)->get();
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
        }else{
            return response()->view('errors.403', [abort(403), 403]);
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
        if(Auth::user()->hasRole('t2q')){
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
            return redirect('penilaian-hafalan')->with('success', 'Data nilai hafalan berhasil diupdate.');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiHafalan  $nilaiHafalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiHafalan $nilaiHafalan)
    {
        return response()->view('errors.404', [abort(404), 404]);
    }
}
