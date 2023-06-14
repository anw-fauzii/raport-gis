<?php

namespace App\Http\Controllers;

use App\Models\NilaiTahfidz;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Kelas;
use Carbon\Carbon;
use App\Models\AnggotaT2Q;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiT2QController extends Controller
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
            $title = 'Nilai Tahsin Tahfidz';
            $tapel = Tapel::latest()->first();     
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $data_rencana_penilaian = AnggotaT2Q::where('guru_id', $guru->id)->where('tapel_id', $tapel->id)->groupBy('tingkat')->get();
            $cek_nilai = NilaiTahfidz::join('anggota_t2q','nilai_tahfidz.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
            ->where('guru_id', $guru->id)->where('tapel_id', $tapel->id)->get();
            return view('t2q.penilaian-t2q.index', compact('title', 'data_rencana_penilaian','guru','cek_nilai'));
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
                    'tahfidz_surah'  => $request->tahfidz_surah[$cound_siswa],
                    'tahfidz_kelebihan'  => implode(", ",$request->tahfidz_kelebihan[$cound_siswa]),
                    'tahfidz_kekurangan'  => implode(", ",$request->tahfidz_kekurangan[$cound_siswa]),
                    'tahfidz_nilai'  => $request->tahfidz_nilai[$cound_siswa],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                NilaiTahfidz::insert($data_nilai);  
            }
            return redirect('penilaian-t2q')->with('success', 'Data nilai tahsin tahfidz berhasil disimpan.');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiTahfidz  $NilaiTahfidz
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiTahfidz $NilaiTahfidz)
    {
        return response()->view('errors.404', [abort(404), 404]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiTahfidz  $NilaiTahfidz
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasRole('t2q')){
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $tapel = Tapel::latest()->first();
            $data_anggota_kelas = AnggotaT2Q::where('guru_id', $guru->id)->where('tingkat',$id)->where('tapel_id', $tapel->id)->get();
            $cek_nilai = NilaiTahfidz::join('anggota_t2q','nilai_tahfidz.anggota_kelas_id','=','anggota_t2q.anggota_kelas_id')
            ->where('guru_id', $guru->id)->where('anggota_t2q.tingkat',$id)->where('tapel_id', $tapel->id)->get();
            $count_kd_nilai = count($cek_nilai);
            $komentar = Komentar::where('jenis', 1)->get();

            if ($count_kd_nilai == 0) {
                $title = 'Input Nilai t2q';
                return view('t2q.penilaian-t2q.create', compact('title', 'komentar', 'data_anggota_kelas'));
            } else {
                foreach ($data_anggota_kelas as $anggota_kelas) {
                    $data_nilai = NilaiTahfidz::where('anggota_kelas_id', $anggota_kelas->anggota_kelas_id)->get();
                    $anggota_kelas->data_nilai = $data_nilai;
                }
                $title = 'Edit Nilai Pengetahuan';
                return view('t2q.penilaian-t2q.edit', compact('title','komentar', 'data_anggota_kelas'));
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiTahfidz  $NilaiTahfidz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasRole('t2q')){
            for ($cound_siswa = 1; $cound_siswa <= $request->jumlah; $cound_siswa++) {
                $nilai = NilaiTahfidz::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->first();
                $data_nilai = array(
                    'tahfidz_surah'  => $request->tahfidz_surah[$cound_siswa],
                    'tahfidz_kelebihan'  => implode(", ",$request->tahfidz_kelebihan[$cound_siswa]),
                    'tahfidz_kekurangan'  => implode(", ",$request->tahfidz_kekurangan[$cound_siswa]),
                    'tahfidz_nilai'  => $request->tahfidz_nilai[$cound_siswa],
                    'updated_at'  => Carbon::now(),
                );
                $nilai->update($data_nilai);  
            }
            return redirect('penilaian-t2q')->with('success', 'Data nilai tahsin tahfidz berhasil diupdate.');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiTahfidz  $NilaiTahfidz
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiTahfidz $NilaiTahfidz)
    {
        return response()->view('errors.404', [abort(404), 404]);
    }
}
