<?php

namespace App\Http\Controllers;

use App\Models\RencanaPelajaranSholat;
use App\Models\Guru;
use App\Models\ButirSikap;
use App\Models\Tapel;
use App\Models\Kelas;
use App\Models\AnggotaT2Q;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RencanaPelajaranSholatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Rencana Nilai Pengetahuan';
        $tapel = Tapel::findorfail(5);     
        $guru = Guru::where('user_id', 2)->first();
        $data_rencana_penilaian = AnggotaT2Q::select('siswa.kelas_id')->join('siswa','anggota_t2q.siswa_id','=','siswa.id')->where('anggota_t2q.guru_id', $guru->id)->where('tapel', $tapel->tahun_pelajaran)->distinct('kelas_id')->get();

        $data_butir_sikap = ButirSikap::select('butir_sikap.*','kategori_butir.jenis')->join('kategori_butir','butir_sikap.kategori_butir_id','=','kategori_butir.id')
        ->where('jenis',"Pelajaran Sholat")->get();
        $sa = RencanaPelajaranSholat::join('butir_sikap','rencana_nilai_sholat.butir_sikap_id','=','butir_sikap.id')
        ->select('butir_sikap.kategori_butir_id','butir_sikap.butir_sikap','rencana_nilai_sholat.*')->where('guru_id', $guru->id)->get();
        return view('t2q.rencana-sholat.index', compact('title', 'data_rencana_penilaian','data_butir_sikap','guru'));
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
            'butir_sikap_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'Tidak ada butir sikap yang dipilih');
        } else {
            for ($count = 0; $count < count($request->butir_sikap_id); $count++) {
                $data_sikap = array(
                    'kelas_id'  => $request->kelas_id,
                    'butir_sikap_id'  => $request->butir_sikap_id[$count],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                $store_data_sikap[] = $data_sikap;
            }
            RencanaPelajaranSholat::insert($store_data_sikap);
            return redirect('rencana-pelajaran-sholat')->with('success', 'Rencana nilai spiritual berhasil dipilih');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RencanaPelajaranSholat  $rencanaPelajaranSholat
     * @return \Illuminate\Http\Response
     */
    public function show(RencanaPelajaranSholat $rencanaPelajaranSholat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RencanaPelajaranSholat  $rencanaPelajaranSholat
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaPelajaranSholat $rencanaPelajaranSholat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RencanaPelajaranSholat  $rencanaPelajaranSholat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RencanaPelajaranSholat $rencanaPelajaranSholat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RencanaPelajaranSholat  $rencanaPelajaranSholat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $butir_sikap = RencanaPelajaranSholat::findorfail($id);
        $butir_sikap->delete();
        return back()->with('success', 'Butir Sikap berhasil dihapus');
    }
}
