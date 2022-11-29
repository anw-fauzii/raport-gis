<?php

namespace App\Http\Controllers;

use App\Models\NilaiEkstrakulikuler;
use App\Models\AnggotaEkstrakulikuler;
use App\Models\AnggotaKelas;
use App\Models\Ekstrakulikuler;
use Carbon\Carbon;
use App\Models\Guru;
use App\Models\Tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class NilaiEkstrakulikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Input Nilai Ekstrakulikuler';
        $tapel = Tapel::findorfail(5);

        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $data_ekstrakulikuler = Ekstrakulikuler::where('tapel_id', $tapel->id)->where('guru_id', $guru->id)->orderBy('nama_ekstrakulikuler', 'ASC')->get();
        $cek_nilai = NilaiEkstrakulikuler::join('ekstrakulikuler','ekstrakulikuler.id','=','nilai_ekstrakulikuler.ekstrakulikuler_id')
            ->where('guru_id', $guru->id)->get();
        return view('walikelas.ekstrakulikuler.pilihan.index', compact('title', 'data_ekstrakulikuler','cek_nilai'));
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
        if(Auth::user()->hasRole('mapel|wali')){
            for ($cound_siswa = 0; $cound_siswa < count($request->anggota_ekstrakulikuler_id); $cound_siswa++) {
                $data_nilai = array(
                    'ekstrakulikuler_id' => $request->ekstrakulikuler_id,
                    'anggota_ekstrakulikuler_id'  => $request->anggota_ekstrakulikuler_id[$cound_siswa],
                    'nilai'  => $request->nilai[$cound_siswa],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                $cek_data = NilaiEkstrakulikuler::where('ekstrakulikuler_id', $request->ekstrakulikuler_id)->where('anggota_ekstrakulikuler_id', $request->anggota_ekstrakulikuler_id[$cound_siswa])->first();
                if (is_null($cek_data)) {
                    NilaiEkstrakulikuler::insert($data_nilai);
                } else {
                    $cek_data->update($data_nilai);
                }
            }
            return redirect('penilaian-ekstrakulikuler')->with('success', 'Data nilai Ekstrakulikuler berhasil diupdate.');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiEkstrakulikuler  $nilaiEkstrakulikuler
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiEkstrakulikuler $nilaiEkstrakulikuler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiEkstrakulikuler  $nilaiEkstrakulikuler
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Input Nilai Ekstrakulikuler';
        $tapel = Tapel::findorfail(5);
        $decrypted = Crypt::decrypt($id);
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $data_ekstrakulikuler = Ekstrakulikuler::where('tapel_id', $tapel->id)->where('guru_id', $guru->id)->orderBy('nama_ekstrakulikuler', 'ASC')->get();

        $ekstrakulikuler = Ekstrakulikuler::findorfail($decrypted);

        $id_all_anggota_ekstra = AnggotaEkstrakulikuler::where('ekstrakulikuler_id', $ekstrakulikuler->id)->get('anggota_kelas_id');
        $id_anggota_kelas_dipilih = AnggotaKelas::whereIn('id', $id_all_anggota_ekstra)->get('id');

        $id_kelas = AnggotaKelas::whereIn('id', $id_all_anggota_ekstra)->get('kelas_id');

        $data_anggota_ekstrakulikuler = AnggotaEkstrakulikuler::where('ekstrakulikuler_id', $ekstrakulikuler->id)->whereIn('anggota_kelas_id', $id_anggota_kelas_dipilih)->get();
        foreach ($data_anggota_ekstrakulikuler as $anggota) {
            $nilai = NilaiEkstrakulikuler::where('ekstrakulikuler_id', $anggota->ekstrakulikuler_id)->where('anggota_ekstrakulikuler_id', $anggota->id)->first();
            if (is_null($nilai)) {
                $anggota->nilai = null;
                $anggota->deskripsi = null;
            } else {
                $anggota->nilai = $nilai->nilai;
                $anggota->deskripsi = $nilai->deskripsi;
            }
        }

        return view('walikelas.ekstrakulikuler.pilihan.create', compact('title', 'data_ekstrakulikuler', 'ekstrakulikuler', 'data_anggota_ekstrakulikuler'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiEkstrakulikuler  $nilaiEkstrakulikuler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiEkstrakulikuler $nilaiEkstrakulikuler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiEkstrakulikuler  $nilaiEkstrakulikuler
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiEkstrakulikuler $nilaiEkstrakulikuler)
    {
        //
    }
}
