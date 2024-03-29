<?php

namespace App\Http\Controllers;

use App\Models\NilaiHafalan;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Kelas;
use Carbon\Carbon;
use App\Models\AnggotaT2Q;
use App\Models\AnggotaKelas;
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
            $tapel = Tapel::latest()->first();     
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $data_rencana_penilaian = AnggotaT2Q::where('guru_id', $guru->id)->where('tapel_id', $tapel->id)->groupBy('tingkat')->get();
            $cek_nilai = NilaiHafalan::join('anggota_t2q','nilai_hafalan.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
            ->where('guru_id', $guru->id)->where('tapel_id', $tapel->id)->get();
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
                $anggota = AnggotaKelas::find($request->anggota_kelas_id[$cound_siswa]);
                $kelas_id = Kelas::find($anggota->kelas_id);
                if($kelas_id->tingkatan_kelas == 1){
                    $kompetensi_hadis = "ciri-ri orang munafiq.";
                    $kompetensi_doa = "do'a mengumpulkan kebaikan di dunia dan akhirat.";
                    $kompetensi_hikmah = "kemuliaan seseorang.";
                }else if($kelas_id->tingkatan_kelas == 2){
                    $kompetensi_hadis = "ciri muslim sejati.";
                    $kompetensi_doa = "do'a agar amalan diterima.";
                    $kompetensi_hikmah = "belajar di waktu kecil.";
                }else if($kelas_id->tingkatan_kelas == 3){
                    $kompetensi_hadis = "dosa besar.";
                    $kompetensi_doa = "do'a agar dimudahkan.";
                    $kompetensi_hikmah = "berpikir sebelum bertindak.";
                }else if($kelas_id->tingkatan_kelas == 4){
                    $kompetensi_hadis = "ancaman bagi yang meninggalkan shalat.";
                    $kompetensi_doa = "do'a agar setiap urusan berakhir dengan baik.";
                    $kompetensi_hikmah = "buahnya cermat akan mendapatkan keselamatan.";
                }else if($kelas_id->tingkatan_kelas == 5){
                    $kompetensi_hadis = "salah satu amalan yang dicintai allah swt.";
                    $kompetensi_doa = "do'a memohon perlindungan dari bisikan setan.";
                    $kompetensi_hikmah = "larangan meghina orang miskin.";
                }else if($kelas_id->tingkatan_kelas == 6){
                    $kompetensi_hadis = "salah satu tanda keislaman seseorang.";
                    $kompetensi_doa = "do'a dijadikan hamba yang shaleh.";
                    $kompetensi_hikmah = "persahabatan dan tabi'at.";
                }
                if($request->hadis[$cound_siswa] < 75){
                    $deskripsi_hadis = "Ananda kurang dalam menghafal dan memahami hadist tentang ".$kompetensi_hadis;
                }else if($request->hadis[$cound_siswa] < 84){
                    $deskripsi_hadis = "Ananda cukup dalam menghafal dan memahami hadist tentang ".$kompetensi_hadis;
                }else if($request->hadis[$cound_siswa] < 93){
                    $deskripsi_hadis = "Ananda baik dalam menghafal dan memahami hadist tentang ".$kompetensi_hadis;
                }else if($request->hadis[$cound_siswa] <= 100){
                    $deskripsi_hadis = "Ananda sangat baik dalam menghafal dan memahami hadist tentang ".$kompetensi_hadis;
                }
                
                if($request->doa[$cound_siswa] < 75){
                    $deskripsi_doa = "Ananda kurang dalam menghafal ".$kompetensi_doa;
                }else if($request->doa[$cound_siswa] < 84){
                    $deskripsi_doa = "Ananda cukup dalam menghafal ".$kompetensi_doa;
                }else if($request->doa[$cound_siswa] < 93){
                    $deskripsi_doa = "Ananda baik dalam menghafal ".$kompetensi_doa;
                }else if($request->doa[$cound_siswa] <= 100){
                    $deskripsi_doa = "Ananda sangat baik dalam menghafal ".$kompetensi_doa;
                }
                
                if($request->hikmah[$cound_siswa] < 75){
                    $deskripsi_hikmah = "Ananda kurang dalam menghafal dan memahami kata-kata hikmah tentang ".$kompetensi_hikmah;
                }else if($request->hikmah[$cound_siswa] < 84){
                    $deskripsi_hikmah = "Ananda cukup dalam menghafal dan memahami kata-kata hikmah tentang ".$kompetensi_hikmah;
                }else if($request->hikmah[$cound_siswa] < 93){
                    $deskripsi_hikmah = "Ananda baik dalam menghafal dan memahami kata-kata hikmah tentang".$kompetensi_hikmah;
                }else if($request->hikmah[$cound_siswa] <= 100){
                    $deskripsi_hikmah = "Ananda sangat baik dalam menghafal dan memahami kata-kata hikmah tentang".$kompetensi_hikmah;
                }

                $data_nilai = array(
                    'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                    'hadis'  => $request->hadis[$cound_siswa],
                    'doa'  => $request->doa[$cound_siswa],
                    'hikmah'  => $request->hikmah[$cound_siswa],
                    'deskripsi_hadis'  => $deskripsi_hadis,
                    'deskripsi_doa'  => $deskripsi_doa,
                    'deskripsi_hikmah'  => $deskripsi_hikmah,
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
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $tapel = Tapel::latest()->first();
            $data_anggota_kelas = AnggotaT2Q::where('guru_id', $guru->id)->where('tingkat',$id)->where('tapel_id', $tapel->id)->get();
            $cek_nilai = NilaiHafalan::join('anggota_t2q','nilai_hafalan.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
            ->where('guru_id', $guru->id)->where('anggota_t2q.tingkat',$id)->where('tapel_id', $tapel->id)->get();
            $count_kd_nilai = count($cek_nilai);

            if ($count_kd_nilai == 0) {
                $title = 'Input Nilai hafalan';
                return view('t2q.penilaian-hafalan.create', compact('title', 'data_anggota_kelas'));
            } else {
                foreach ($data_anggota_kelas as $anggota_kelas) {
                    $data_nilai = NilaiHafalan::where('anggota_kelas_id', $anggota_kelas->anggota_kelas_id)->get();
                    $anggota_kelas->data_nilai = $data_nilai;
                }
                $title = 'Edit Nilai Hafalan';
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
                $anggota = AnggotaKelas::find($request->anggota_kelas_id[$cound_siswa]);
                $kelas_id = Kelas::find($anggota->kelas_id);
                if($kelas_id->tingkatan_kelas == 1){
                    $kompetensi_hadis = "ciri-ri orang munafiq.";
                    $kompetensi_doa = "do'a mengumpulkan kebaikan di dunia dan akhirat.";
                    $kompetensi_hikmah = "kemuliaan seseorang.";
                }else if($kelas_id->tingkatan_kelas == 2){
                    $kompetensi_hadis = "ciri muslim sejati.";
                    $kompetensi_doa = "do'a agar amalan diterima.";
                    $kompetensi_hikmah = "belajar di waktu kecil.";
                }else if($kelas_id->tingkatan_kelas == 3){
                    $kompetensi_hadis = "dosa besar.";
                    $kompetensi_doa = "do'a agar dimudahkan.";
                    $kompetensi_hikmah = "berpikir sebelum bertindak.";
                }else if($kelas_id->tingkatan_kelas == 4){
                    $kompetensi_hadis = "ancaman bagi yang meninggalkan shalat.";
                    $kompetensi_doa = "do'a agar setiap urusan berakhir dengan baik.";
                    $kompetensi_hikmah = "buahnya cermat akan mendapatkan keselamatan.";
                }else if($kelas_id->tingkatan_kelas == 5){
                    $kompetensi_hadis = "salah satu amalan yang dicintai allah swt.";
                    $kompetensi_doa = "do'a memohon perlindungan dari bisikan setan.";
                    $kompetensi_hikmah = "larangan meghina orang miskin.";
                }else if($kelas_id->tingkatan_kelas == 6){
                    $kompetensi_hadis = "salah satu tanda keislaman seseorang.";
                    $kompetensi_doa = "do'a dijadikan hamba yang shaleh.";
                    $kompetensi_hikmah = "persahabatan dan tabi'at.";
                }

                if($request->hadis[$cound_siswa] < 75){
                    $deskripsi_hadis = "Ananda kurang dalam menghafal dan memahami hadist tentang ".$kompetensi_hadis;
                }else if($request->hadis[$cound_siswa] < 84){
                    $deskripsi_hadis = "Ananda cukup dalam menghafal dan memahami hadist tentang ".$kompetensi_hadis;
                }else if($request->hadis[$cound_siswa] < 93){
                    $deskripsi_hadis = "Ananda baik dalam menghafal dan memahami hadist tentang ".$kompetensi_hadis;
                }else if($request->hadis[$cound_siswa] <= 100){
                    $deskripsi_hadis = "Ananda sangat baik dalam menghafal dan memahami hadist tentang ".$kompetensi_hadis;
                }
                
                if($request->doa[$cound_siswa] < 75){
                    $deskripsi_doa = "Ananda kurang dalam menghafal ".$kompetensi_doa;
                }else if($request->doa[$cound_siswa] < 84){
                    $deskripsi_doa = "Ananda cukup dalam menghafal ".$kompetensi_doa;
                }else if($request->doa[$cound_siswa] < 93){
                    $deskripsi_doa = "Ananda baik dalam menghafal ".$kompetensi_doa;
                }else if($request->doa[$cound_siswa] <= 100){
                    $deskripsi_doa = "Ananda sangat baik dalam menghafal ".$kompetensi_doa;
                }
                
                if($request->hikmah[$cound_siswa] < 75){
                    $deskripsi_hikmah = "Ananda kurang dalam menghafal dan memahami kata-kata hikmah tentang ".$kompetensi_hikmah;
                }else if($request->hikmah[$cound_siswa] < 84){
                    $deskripsi_hikmah = "Ananda cukup dalam menghafal dan memahami kata-kata hikmah tentang ".$kompetensi_hikmah;
                }else if($request->hikmah[$cound_siswa] < 93){
                    $deskripsi_hikmah = "Ananda baik dalam menghafal dan memahami kata-kata hikmah tentang".$kompetensi_hikmah;
                }else if($request->hikmah[$cound_siswa] <= 100){
                    $deskripsi_hikmah = "Ananda sangat baik dalam menghafal dan memahami kata-kata hikmah tentang".$kompetensi_hikmah;
                }
                $data_nilai = array(
                    'hadis'  => $request->hadis[$cound_siswa],
                    'doa'  => $request->doa[$cound_siswa],
                    'hikmah'  => $request->hikmah[$cound_siswa],
                    'deskripsi_hadis'  => $deskripsi_hadis,
                    'deskripsi_doa'  => $deskripsi_doa,
                    'deskripsi_hikmah'  => $deskripsi_hikmah,
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
