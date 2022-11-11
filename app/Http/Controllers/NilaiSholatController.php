<?php

namespace App\Http\Controllers;

use App\Models\NilaiSholat;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Kelas;
use Carbon\Carbon;
use App\Models\AnggotaT2Q;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiSholatController extends Controller
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
            $title = 'Nilai Sholat';
            $tapel = Tapel::findorfail(5);     
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $data_rencana_penilaian = AnggotaT2Q::where('guru_id', $guru->id)->where('tapel', $tapel->tahun_pelajaran)->groupBy('tingkat')->get();
            $cek_nilai = NilaiSholat::join('anggota_t2q','nilai_sholat.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
            ->where('guru_id', $guru->id)->get();
            return view('t2q.penilaian-sholat.index', compact('title', 'data_rencana_penilaian','guru','cek_nilai'));
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
                if($request->praktik_wudhu[$cound_siswa] < 75){
                    $deskripsi_praktik_wudhu = "Ananda kurang dalam mempraktekkan dan memahami tata cara wudhu serta menyebutkan do'a setelah wudhu";
                }else if($request->praktik_wudhu[$cound_siswa] < 84){
                    $deskripsi_praktik_wudhu = "Ananda cukup dalam mempraktekkan dan memahami tata cara wudhu serta menyebutkan do'a setelah wudhu";
                }else if($request->praktik_wudhu[$cound_siswa] < 93){
                    $deskripsi_praktik_wudhu = "Ananda baik dalam mempraktekkan dan memahami tata cara wudhu serta menyebutkan do'a setelah wudhu";
                }else if($request->praktik_wudhu[$cound_siswa] < 100){
                    $deskripsi_praktik_wudhu = "Ananda sangat baik dalam mempraktekkan dan memahami tata cara wudhu serta menyebutkan do'a setelah wudhu";
                }
                
                if($request->bacaan_sholat[$cound_siswa] < 75){
                    $deskripsi_bacaan_sholat = "Ananda kurang dalam mempraktekkan dan menyebutkan bacaan gerakan shalat";
                }else if($request->bacaan_sholat[$cound_siswa] < 84){
                    $deskripsi_bacaan_sholat = "Ananda cukup dalam mempraktekkan dan menyebutkan bacaan gerakan shalat";
                }else if($request->bacaan_sholat[$cound_siswa] < 93){
                    $deskripsi_bacaan_sholat = "Ananda baik dalam mempraktekkan dan menyebutkan bacaan gerakan shalat";
                }else if($request->bacaan_sholat[$cound_siswa] < 100){
                    $deskripsi_bacaan_sholat = "Ananda sangat baik dalam mempraktekkan dan menyebutkan bacaan gerakan shalat";
                }

                if($request->gerakan_sholat[$cound_siswa]<75){
                    $deskripsi_gerakan_sholat = "Ananda kurang dalam mempraktekkan dan memahami tata cara gerakan shalat";
                }else if($request->gerakan_sholat[$cound_siswa] < 84){
                    $deskripsi_gerakan_sholat = "Ananda cukup dalam mempraktekkan dan memahami tata cara gerakan shalat";
                }else if($request->gerakan_sholat[$cound_siswa] < 93){
                    $deskripsi_gerakan_sholat = "Ananda baik dalam mempraktekkan dan memahami tata cara gerakan shalat";
                }else if($request->gerakan_sholat[$cound_siswa] < 100){
                    $deskripsi_gerakan_sholat = "Ananda sangat baik dalam mempraktekkan dan memahami tata cara gerakan shalat";
                }

                if($request->dzikir[$cound_siswa]<75){
                    $deskripsi_dzikir = "Ananda kurang dalam melafalkan bacaan dzikir ba'da shalat";
                }else if($request->dzikir[$cound_siswa] < 84){
                    $deskripsi_dzikir = "Ananda cukup dalam melafalkan bacaan dzikir ba'da shalat";
                }else if($request->dzikir[$cound_siswa] < 93){
                    $deskripsi_dzikir = "Ananda baik dalam melafalkan bacaan dzikir ba'da shalat";
                }else if($request->dzikir[$cound_siswa] < 100){
                    $deskripsi_dzikir = "Ananda sangat baik dalam melafalkan bacaan dzikir ba'da shalat";
                }
                
                $data_nilai = array(
                    'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                    'praktik_wudhu'  => $request->praktik_wudhu[$cound_siswa],
                    'bacaan_sholat'  => $request->bacaan_sholat[$cound_siswa],
                    'gerakan_sholat'  => $request->gerakan_sholat[$cound_siswa],
                    'dzikir'  => $request->dzikir[$cound_siswa],
                    'deskripsi_praktik_wudhu'  => $deskripsi_praktik_wudhu,
                    'deskripsi_bacaan_sholat'  => $deskripsi_bacaan_sholat,
                    'deskripsi_gerakan_sholat'  => $deskripsi_gerakan_sholat,
                    'deskripsi_dzikir'  => $deskripsi_dzikir,
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                NilaiSholat::insert($data_nilai);  
            }
            return redirect('penilaian-sholat')->with('success', 'Data nilai pelajaran shalat berhasil disimpan.');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
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
        return response()->view('errors.404', [abort(404), 404]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiSholat  $nilaiSholat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasRole('t2q')){
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $data_anggota_kelas = AnggotaT2Q::where('guru_id', $guru->id)->where('tingkat',$id)->get();
            $cek_nilai = NilaiSholat::join('anggota_t2q','nilai_sholat.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
            ->where('guru_id', $guru->id)->where('anggota_t2q.tingkat',$id)->get();
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
        }else{
            return response()->view('errors.403', [abort(403), 403]);
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
        if(Auth::user()->hasRole('t2q')){
            for ($cound_siswa = 1; $cound_siswa <= $request->jumlah; $cound_siswa++) {
                $nilai = NilaiSholat::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->first();
                if($request->praktik_wudhu[$cound_siswa] < 75){
                    $deskripsi_praktik_wudhu = "Ananda kurang dalam mempraktekkan dan memahami tata cara wudhu serta menyebutkan do'a setelah wudhu";
                }else if($request->praktik_wudhu[$cound_siswa] < 84){
                    $deskripsi_praktik_wudhu = "Ananda cukup dalam mempraktekkan dan memahami tata cara wudhu serta menyebutkan do'a setelah wudhu";
                }else if($request->praktik_wudhu[$cound_siswa] < 93){
                    $deskripsi_praktik_wudhu = "Ananda baik dalam mempraktekkan dan memahami tata cara wudhu serta menyebutkan do'a setelah wudhu";
                }else if($request->praktik_wudhu[$cound_siswa] < 100){
                    $deskripsi_praktik_wudhu = "Ananda sangat baik dalam mempraktekkan dan memahami tata cara wudhu serta menyebutkan do'a setelah wudhu";
                }
                
                if($request->bacaan_sholat[$cound_siswa] < 75){
                    $deskripsi_bacaan_sholat = "Ananda kurang dalam mempraktekkan dan menyebutkan bacaan gerakan shalat";
                }else if($request->bacaan_sholat[$cound_siswa] < 84){
                    $deskripsi_bacaan_sholat = "Ananda cukup dalam mempraktekkan dan menyebutkan bacaan gerakan shalat";
                }else if($request->bacaan_sholat[$cound_siswa] < 93){
                    $deskripsi_bacaan_sholat = "Ananda baik dalam mempraktekkan dan menyebutkan bacaan gerakan shalat";
                }else if($request->bacaan_sholat[$cound_siswa] < 100){
                    $deskripsi_bacaan_sholat = "Ananda sangat baik dalam mempraktekkan dan menyebutkan bacaan gerakan shalat";
                }

                if($request->gerakan_sholat[$cound_siswa] < 75){
                    $deskripsi_gerakan_sholat = "Ananda kurang dalam mempraktekkan dan memahami tata cara gerakan shalat";
                }else if($request->gerakan_sholat[$cound_siswa] < 84){
                    $deskripsi_gerakan_sholat = "Ananda cukup dalam mempraktekkan dan memahami tata cara gerakan shalat";
                }else if($request->gerakan_sholat[$cound_siswa] < 93){
                    $deskripsi_gerakan_sholat = "Ananda baik dalam mempraktekkan dan memahami tata cara gerakan shalat";
                }else if($request->gerakan_sholat[$cound_siswa] < 100){
                    $deskripsi_gerakan_sholat = "Ananda sangat baik dalam mempraktekkan dan memahami tata cara gerakan shalat";
                }

                if($request->dzikir[$cound_siswa] < 75){
                    $deskripsi_dzikir = "Ananda kurang dalam melafalkan bacaan dzikir ba'da shalat";
                }else if($request->dzikir[$cound_siswa] < 84){
                    $deskripsi_dzikir = "Ananda cukup dalam melafalkan bacaan dzikir ba'da shalat";
                }else if($request->dzikir[$cound_siswa] < 93){
                    $deskripsi_dzikir = "Ananda baik dalam melafalkan bacaan dzikir ba'da shalat";
                }else if($request->dzikir[$cound_siswa] < 100){
                    $deskripsi_dzikir = "Ananda sangat baik dalam melafalkan bacaan dzikir ba'da shalat";
                }
                $data_nilai = array(
                    'praktik_wudhu'  => $request->praktik_wudhu[$cound_siswa],
                    'bacaan_sholat'  => $request->bacaan_sholat[$cound_siswa],
                    'gerakan_sholat'  => $request->gerakan_sholat[$cound_siswa],
                    'dzikir'  => $request->dzikir[$cound_siswa],
                    'deskripsi_praktik_wudhu'  => $deskripsi_praktik_wudhu,
                    'deskripsi_bacaan_sholat'  => $deskripsi_bacaan_sholat,
                    'deskripsi_gerakan_sholat'  => $deskripsi_gerakan_sholat,
                    'deskripsi_dzikir'  => $deskripsi_dzikir,
                    'updated_at'  => Carbon::now(),
                );
                $nilai->update($data_nilai);  
            }
            return redirect('penilaian-sholat')->with('success', 'Data nilai pelajaran shalat berhasil diupdate.');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiSholat  $nilaiSholat
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiSholat $nilaiSholat)
    {
        return response()->view('errors.404', [abort(404), 404]);
    }
}
