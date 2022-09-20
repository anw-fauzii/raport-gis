<?php

namespace App\Http\Controllers;

use App\Models\NilaiK1;
use App\Models\RencanaNilaiK1;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Kelas;
use Carbon\Carbon;
use App\Models\AnggotaKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiK1Controller extends Controller
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
        if(Auth::user()->hasRole('wali')){
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $kelas = Kelas::where('guru_id', $guru->id)->first();
            $data_anggota_kelas = AnggotaKelas::where('kelas_id', $kelas->id)->get();
            
            $id_data_rencana_penilaian = RencanaNilaiK1::where('kelas_id', $kelas->id)->orderBy('butir_sikap_id', 'ASC')->get('id');
            if(count($id_data_rencana_penilaian) == 0){
                return redirect()->route('rencana-k1.index')->with('warning', 'Buat terlebih dahulu rancana penilaian.');
            }else{
                $data_kd_nilai = NilaiK1::whereIn('rencana_nilai_k1_id', $id_data_rencana_penilaian)->groupBy('rencana_nilai_k1_id')->get();
        
                $count_kd_nilai = count($data_kd_nilai);

                if ($count_kd_nilai == 0) {
                    $data_rencana_penilaian = RencanaNilaiK1::where('kelas_id', $kelas->id)->orderBy('butir_sikap_id', 'ASC')->get();
                    $count_kd = count($data_rencana_penilaian);
                    $title = 'Input KI-1/Nilai Spiritual';
                    return view('walikelas.penilaian-k1.create', compact('title', 'data_anggota_kelas', 'data_rencana_penilaian', 'count_kd'));
                } else {
                    foreach ($data_anggota_kelas as $anggota_kelas) {
                        $data_nilai = NilaiK1::whereIn('rencana_nilai_k1_id', $id_data_rencana_penilaian)->where('anggota_kelas_id', $anggota_kelas->id)->get();
                        $anggota_kelas->data_nilai = $data_nilai;
                    }
                    $title = 'Edit KI-1/Nilai Spiritual';
                    return view('walikelas.penilaian-k1.edit', compact('title', 'data_anggota_kelas', 'count_kd_nilai', 'data_kd_nilai','kelas'));
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
    public function create(Request $request)
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
                    for ($count_penilaian = 0; $count_penilaian < count($request->rencana_nilai_k1_id); $count_penilaian++) {
                        $data_nilai = array(
                            'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                            'rencana_nilai_k1_id' => $request->rencana_nilai_k1_id[$count_penilaian],
                            'nilai'  => ltrim($request->nilai[$count_penilaian][$cound_siswa]),
                            'created_at'  => Carbon::now(),
                            'updated_at'  => Carbon::now(),
                        );
                        $data_penilaian_siswa[] = $data_nilai;
                    }
                    $store_data_penilaian = $data_penilaian_siswa;
                }
                NilaiK1::insert($store_data_penilaian);
                return redirect()->back()->with('success', 'Data nilai spiritual berhasil disimpan.');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiK1  $nilaiK1
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiK1 $nilaiK1)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiK1  $nilaiK1
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiK1 $nilaiK1)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiK1  $nilaiK1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasRole('wali')){
            for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                for ($count_penilaian = 0; $count_penilaian < count($request->rencana_nilai_k1_id); $count_penilaian++) {
                    $nilai = NilaiK1::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->where('rencana_nilai_k1_id', $request->rencana_nilai_k1_id[$count_penilaian])->first();
                    $data_nilai = [
                        'nilai'  => ltrim($request->nilai[$count_penilaian][$cound_siswa]),
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
     * @param  \App\Models\NilaiK1  $nilaiK1
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiK1 $nilaiK1)
    {
        //
    }
}
