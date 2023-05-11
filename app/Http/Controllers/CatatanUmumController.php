<?php

namespace App\Http\Controllers;

use App\Models\CatatanUmum;
use App\Models\Kelas;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\AnggotaKelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatatanUmumController extends Controller
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
            $title = 'Input Catatan Umum Siswa';
            $tapel = Tapel::findorfail(6);
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $id_kelas_diampu = Kelas::where('tapel_id', $tapel->id)->where('guru_id', $guru->id)->get('id');
            $data_anggota_kelas = AnggotaKelas::whereIn('kelas_id', $id_kelas_diampu)->get();
            foreach ($data_anggota_kelas as $anggota) {
                $catatan = CatatanUmum::where('anggota_kelas_id', $anggota->id)->first();
                if (is_null($catatan)) {
                    $anggota->catatan = "-";
                } else {
                    $anggota->catatan = $catatan->catatan;
                }
            }
            return view('walikelas.catatan-umum.index', compact('title', 'data_anggota_kelas'));
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
                        'catatan'  => $request->catatan[$cound_siswa],
                        'created_at'  => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    );
                    $cek_data = CatatanUmum::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->first();
                    if (is_null($cek_data)) {
                        CatatanUmum::insert($data);
                    } else {
                        $cek_data->update($data);
                    }
                }
                return redirect('catatan-umum')->with('success', 'Catatan Umum siswa berhasil disimpan');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatatanUmum  $catatanUmum
     * @return \Illuminate\Http\Response
     */
    public function show(CatatanUmum $catatanUmum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatatanUmum  $catatanUmum
     * @return \Illuminate\Http\Response
     */
    public function edit(CatatanUmum $catatanUmum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CatatanUmum  $catatanUmum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatatanUmum $catatanUmum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatatanUmum  $catatanUmum
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatatanUmum $catatanUmum)
    {
        //
    }
}
