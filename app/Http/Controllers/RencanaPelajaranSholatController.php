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
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $data_rencana_penilaian = AnggotaT2Q::where('guru_id', $guru->id)->where('tapel', $tapel->tahun_pelajaran)->groupBy('tingkat')->get();

        $data_butir_sikap = ButirSikap::select('butir_sikap.*','kategori_butir.jenis')->join('kategori_butir','butir_sikap.kategori_butir_id','=','kategori_butir.id')
        ->where('jenis',"Pelajaran Sholat")->get();
        $count_nilai = RencanaPelajaranSholat::where('guru_id', $guru->id)->get();
        $ren_penilaian = RencanaPelajaranSholat::where('guru_id',$guru->id)->get();
        return view('t2q.rencana-sholat.index', compact('title', 'data_rencana_penilaian','count_nilai','data_butir_sikap','guru','ren_penilaian'));
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
                    'guru_id'  => $request->guru_id,
                    'tingkat'  => $request->tingkat,
                    'butir_sikap_id'  => $request->butir_sikap_id[$count],
                    'kategori' =>$request->kategori[$count],
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
