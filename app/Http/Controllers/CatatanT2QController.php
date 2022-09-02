<?php

namespace App\Http\Controllers;

use App\Models\CatatanT2Q;
use App\Models\Kelas;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\AnggotaKelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatatanT2QController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Input CatatanT2Q Siswa';
        $tapel = Tapel::findorfail(5);
        $guru = Guru::where('user_id', 4)->first();
        $id_kelas_diampu = Kelas::where('tapel_id', $tapel->id)->where('guru_id', $guru->id)->get('id');
        $data_anggota_kelas = AnggotaKelas::whereIn('kelas_id', $id_kelas_diampu)->get();
        foreach ($data_anggota_kelas as $anggota) {
            $catatan = CatatanT2Q::where('anggota_kelas_id', $anggota->id)->first();
            if (is_null($catatan)) {
                $anggota->catatan = "-";
            } else {
                $anggota->catatan = $catatan->catatan;
            }
        }

        return view('t2q.catatan.index', compact('title', 'data_anggota_kelas'));
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
                $data = array(
                    'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                    'catatan'  => $request->catatan[$cound_siswa],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                $cek_data = CatatanT2Q::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->first();
                if (is_null($cek_data)) {
                    CatatanT2Q::insert($data);
                } else {
                    $cek_data->update($data);
                }
            }
            return redirect('catatan-t2q')->with('success', 'Catatan T2Q siswa berhasil disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatatanT2Q  $catatanT2Q
     * @return \Illuminate\Http\Response
     */
    public function show(CatatanT2Q $catatanT2Q)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatatanT2Q  $catatanT2Q
     * @return \Illuminate\Http\Response
     */
    public function edit(CatatanT2Q $catatanT2Q)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CatatanT2Q  $catatanT2Q
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatatanT2Q $catatanT2Q)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatatanT2Q  $catatanT2Q
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatatanT2Q $catatanT2Q)
    {
        //
    }
}
