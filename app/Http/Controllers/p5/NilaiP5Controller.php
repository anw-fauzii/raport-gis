<?php

namespace App\Http\Controllers\p5;

use App\Http\Controllers\Controller;
use App\Models\p5\P5;
use App\Models\p5\NilaiP5;
use App\Models\p5\P5Deskripsi;
use App\Models\Kelas;
use App\Models\AnggotaKelas;
use App\Models\Guru;
use App\Models\Tapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Validator;

class NilaiP5Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole('wali|mapel')){
            $title = 'Nilai P5';
            $tapel = Tapel::latest()->first();

            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $id_kelas = Kelas::where('tapel_id', $tapel->id)->get('id');

            $data_penilaian = P5::whereIn('kelas_id', $id_kelas)->get();

            foreach ($data_penilaian as $penilaian) {
                $data_rencana_nilai = P5Deskripsi::where('p5_id', $penilaian->id)->get();
                $id_rencana_nilai = P5Deskripsi::where('p5_id', $penilaian->id)->get('id');
                $telah_dinilai = NilaiP5::whereIn('p5_deskripsi_id', $id_rencana_nilai)->groupBy('p5_deskripsi_id')->get();

                $penilaian->jumlah_rencana_penilaian = count($data_rencana_nilai);
                $penilaian->jumlah_telah_dinilai = count($telah_dinilai);
                $penilaian->data_rencana_nilai = $data_rencana_nilai;
            }
            return view('walikelas.p5.nilai-p5.index', compact('title', 'data_penilaian'));
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
        if(Auth::user()->hasAnyRole('wali|mapel')){
            if (is_null($request->anggota_kelas_id)) {
                return back()->with('toast_error', 'Data siswa tidak ditemukan');
            } else {
                for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                    for ($count_penilaian = 0; $count_penilaian < count($request->p5_id); $count_penilaian++) {
                        $data_nilai = array(
                            'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                            'p5_deskripsi_id' => $request->p5_id[$count_penilaian],
                            'nilai' => $request->input('nilai')[$request->anggota_kelas_id[$cound_siswa]][$request->p5_id[$count_penilaian]],
                            'created_at'  => Carbon::now(),
                            'updated_at'  => Carbon::now(),
                        );
                        $data_penilaian_siswa[] = $data_nilai;
                    }
                    $store_data_penilaian = $data_penilaian_siswa;
                }
                NilaiP5::insert($store_data_penilaian);
                return redirect('nilai-p5')->with('success', 'Data nilai pengetahuan berhasil disimpan.');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiP5  $nilaiP5
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiP5 $nilaiP5)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiP5  $nilaiP5
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasAnyRole('wali|mapel')){
            $decrypted = Crypt::decrypt($id);
            $pembelajaran = P5::findorfail($decrypted);
            $data_anggota_kelas = AnggotaKelas::where('kelas_id', $pembelajaran->kelas_id)->get();

            $id_data_rencana_penilaian = P5Deskripsi::where('p5_id', $decrypted)->get('id');

            $data_kd_nilai = NilaiP5::whereIn('p5_deskripsi_id', $id_data_rencana_penilaian)->groupBy('p5_deskripsi_id')->get();
            $count_kd_nilai = count($data_kd_nilai);
            $data_kode_penilaian = P5Deskripsi::where('p5_id', $decrypted)->get();
            $count_kd = count($data_kode_penilaian);
            if ($count_kd_nilai == 0) {
                $data_rencana_penilaian = P5Deskripsi::where('p5_id', $decrypted)->get();
                $title = 'Input '.$pembelajaran->judul;
                return view('walikelas.p5.nilai-p5.create', compact('title', 'pembelajaran', 'data_anggota_kelas', 'data_rencana_penilaian', 'data_kode_penilaian', 'count_kd'));
            } else {
                foreach ($data_anggota_kelas as $anggota_kelas) {
                    $data_nilai = NilaiP5::where('anggota_kelas_id', $anggota_kelas->id)->whereIn('p5_deskripsi_id', $id_data_rencana_penilaian)->get();
                    $anggota_kelas->data_nilai = $data_nilai;
                }
                $title = 'Edit'.$pembelajaran->judul;
                return view('walikelas.p5.nilai-p5.edit', compact('title', 'pembelajaran', 'data_anggota_kelas', 'data_kode_penilaian','count_kd', 'count_kd_nilai', 'data_kd_nilai'));
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiP5  $nilaiP5
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasAnyRole('wali|mapel')){
            for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                for ($count_penilaian = 0; $count_penilaian < count($request->p5_id); $count_penilaian++) {
                    $nilai = NilaiP5::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->where('p5_deskripsi_id', $request->p5_id[$count_penilaian])->first();
                    $data_nilai = [
                        'nilai' => $request->input('nilai')[$request->anggota_kelas_id[$cound_siswa]][$count_penilaian],
                        'updated_at'  => Carbon::now(),
                    ];
                    $nilai->update($data_nilai);
                }
            }
            return redirect('nilai-p5')->with('success', 'Data nilai pengetahuan berhasil diedit.');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiP5  $nilaiP5
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiP5 $nilaiP5)
    {
        //
    }
}
