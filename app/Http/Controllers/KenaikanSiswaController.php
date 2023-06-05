<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelas;
use App\Models\KenaikanSiswa;
use App\Models\Kelas;
use App\Models\Tapel;
use App\Models\Guru;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KenaikanSiswaController extends Controller
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
            $title = 'Input Status Kenaikan Siswa';
            $tapel = Tapel::latest()->first();
            if($tapel->semester == 2){
                $guru = Guru::where('user_id', Auth::user()->id)->first();
                $id_kelas_diampu = Kelas::where('tapel_id', $tapel->id)->where('guru_id', $guru->id)->get('id');
                $data_anggota_kelas = AnggotaKelas::whereIn('kelas_id', $id_kelas_diampu)->get();
                foreach ($data_anggota_kelas as $anggota) {
                    $status = KenaikanSiswa::where('anggota_kelas_id', $anggota->id)->first();
                    if (is_null($status)) {
                        $anggota->status = "-";
                    } else {
                        $anggota->status = $status->status;
                    }
                }
                return view('walikelas.kenaikan-siswa.index', compact('title', 'data_anggota_kelas'));
            }else{
                return redirect()->back()->with('warning', 'Halaman ini bisa diakses ketika sudah semsester 2');
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
                    $data = array(
                        'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                        'status'  => $request->status[$cound_siswa],
                        'created_at'  => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    );
                    $cek_data = KenaikanSiswa::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->first();
                    if (is_null($cek_data)) {
                        KenaikanSiswa::insert($data);
                    } else {
                        $cek_data->update($data);
                    }
                }
                return redirect('kenaikan-siswa')->with('success', 'Kenaikan siswa berhasil disimpan');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KenaikanSiswa  $kenaikanSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(KenaikanSiswa $kenaikanSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KenaikanSiswa  $kenaikanSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(KenaikanSiswa $kenaikanSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KenaikanSiswa  $kenaikanSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KenaikanSiswa $kenaikanSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KenaikanSiswa  $kenaikanSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(KenaikanSiswa $kenaikanSiswa)
    {
        //
    }
}
