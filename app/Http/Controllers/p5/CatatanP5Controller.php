<?php

namespace App\Http\Controllers\p5;

use App\Http\Controllers\Controller;
use App\Models\p5\P5;
use App\Models\p5\CatatanP5;
use App\Models\Kelas;
use App\Models\AnggotaKelas;
use App\Models\Guru;
use App\Models\Tapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CatatanP5Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('wali')){
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $kelas = Kelas::where('guru_id', $guru->id)->latest()->first();
            $data_anggota_kelas = AnggotaKelas::where('kelas_id', $kelas->id)->get();
            $id_p5 = P5::where('kelas_id', $kelas->id)->get('id');
            if(count($id_p5) == 0){
                return redirect()->route('projek-p5.index')->with('warning', 'Buat terlebih dahulu projek P5.');
            }else{
                $data_p5 = CatatanP5::whereIn('p5_id', $id_p5)->groupBy('p5_id')->get();

                $count_p5 = count($data_p5);

                if ($count_p5 == 0) {
                    $data_rencana_penilaian = P5::where('kelas_id', $kelas->id)->get();
                    $count_p5 = count($data_rencana_penilaian);
                    $title = 'Input Catatan P5';
                    return view('walikelas.p5.catatan-p5.create', compact('title', 'data_anggota_kelas', 'data_rencana_penilaian', 'count_p5'));
                } else {
                    foreach ($data_anggota_kelas as $anggota_kelas) {
                        $data_nilai = CatatanP5::whereIn('p5_id', $id_p5)->where('anggota_kelas_id', $anggota_kelas->id)->get();
                        $anggota_kelas->data_nilai = $data_nilai;
                    }
                    $title = 'Edit Catatan P5';
                    return view('walikelas.p5.catatan-p5.edit', compact('title', 'data_anggota_kelas', 'count_p5', 'data_p5','kelas'));
                }
            }
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
        if(Auth::user()->hasRole('wali')){
            if (is_null($request->anggota_kelas_id)) {
                return back()->with('error', 'Data siswa tidak ditemukan');
            } else {
                for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                    for ($count_penilaian = 0; $count_penilaian < count($request->p5_id); $count_penilaian++) {
                        $data_nilai = array(
                            'p5_id' => $request->p5_id[$count_penilaian],
                            'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                            'catatan'  => $request->catatan[$count_penilaian][$cound_siswa],
                            'created_at'  => Carbon::now(),
                            'updated_at'  => Carbon::now(),
                        );
                        $data_penilaian_siswa[] = $data_nilai;
                    }
                    $store_data_penilaian = $data_penilaian_siswa;
                }
                CatatanP5::insert($store_data_penilaian);
                return redirect()->back()->with('success', 'Data nilai spiritual berhasil disimpan.');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatatanP5  $catatanP5
     * @return \Illuminate\Http\Response
     */
    public function show(CatatanP5 $catatanP5)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatatanP5  $catatanP5
     * @return \Illuminate\Http\Response
     */
    public function edit(CatatanP5 $catatanP5)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CatatanP5  $catatanP5
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasRole('wali')){
            for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                for ($count_penilaian = 0; $count_penilaian < count($request->p5_id); $count_penilaian++) {
                    $nilai = CatatanP5::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->where('p5_id', $request->p5_id[$count_penilaian])->first();
                    $data_nilai = [
                        'catatan'  => $request->catatan[$count_penilaian][$cound_siswa],
                        'updated_at'  => Carbon::now(),
                    ];
                    $nilai->update($data_nilai);
                }
            }
            return redirect()->back()->with('success', 'Data nilai spiritual berhasil edit.');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatatanP5  $catatanP5
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatatanP5 $catatanP5)
    {
        //
    }
}
