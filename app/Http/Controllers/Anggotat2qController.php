<?php

namespace App\Http\Controllers;

use App\Models\AnggotaT2Q;
use App\Models\AnggotaKelas;
use App\Models\Guru;
use App\Models\Tapel;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class Anggotat2qController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tapel = Tapel::findorfail(5);
        $title = 'Data Guru T2Q';
        $data_guru = Guru::where('jabatan', '2')->get();
        foreach ($data_guru as $guru) {
            $jumlah_anggota = AnggotaT2Q::where('guru_id', $guru->id)->count();
            $guru->jumlah_anggota = $jumlah_anggota;
        }
        return view('admin.t2q.index', compact('title', 'data_guru', 'tapel', 'data_guru'));
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
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('warning', 'Tidak ada siswa yang dipilih');
        } else {
            $siswa_id = $request->input('siswa_id');
            $tapel = Tapel::latest()->first();
            for ($count = 0; $count < count($siswa_id); $count++) {
                $data = array(
                    'tingkat'=> $request->tingkat,
                    'anggota_kelas_id' => $siswa_id[$count],
                    'guru_id'  => $request->guru_id,
                    'tapel' => $tapel->tahun_pelajaran,
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                $insert_data[] = $data;
            }

            AnggotaT2Q::insert($insert_data);
            Siswa::whereIn('id', $siswa_id)->update(['guru_id' => $request->input('guru_id')]);
            return back()->with('success', 'Anggota kelas berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnggotaT2Q  $anggotaT2Q
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Kelompok T2Q';
        $guru = Guru::findorfail($id);
        $anggota_t2q = AnggotaT2Q::where('guru_id',$id)->get();
        $id_anggota_ekstrakulikuler = AnggotaT2Q::where('guru_id', $id)->get('anggota_kelas_id');
        $siswa_belum_masuk_kelas = AnggotaKelas::whereNotIn('id', $id_anggota_ekstrakulikuler)->get();
        return view('admin.t2q.show', compact('title', 'guru', 'anggota_t2q', 'siswa_belum_masuk_kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnggotaT2Q  $anggotaT2Q
     * @return \Illuminate\Http\Response
     */
    public function edit(AnggotaT2Q $anggotaT2Q)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnggotaT2Q  $anggotaT2Q
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnggotaT2Q $anggotaT2Q)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnggotaT2Q  $anggotaT2Q
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $anggota_kelas = AnggotaT2Q::findorfail($id);
            $siswa = Siswa::findorfail($anggota_kelas->siswa_id);

            $update_guru_id = [
                'guru_id' => null,
            ];

            $anggota_kelas->delete();
            $siswa->update($update_guru_id);
            return back()->with('success', 'Anggota kelas berhasil dihapus');
        } catch (Exception $e) {
            return back()->with('error', 'Anggota kelas tidak dapat dihapus');
        }
    }
}
