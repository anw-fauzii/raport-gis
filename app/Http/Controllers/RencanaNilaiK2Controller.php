<?php

namespace App\Http\Controllers;

use App\Models\RencanaNilaiK2;
use App\Models\Guru;
use App\Models\ButirSikap;
use App\Models\Tapel;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RencanaNilaiK2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Rencana KD/Butir Sosial';
        $tapel = Tapel::findorfail(5);

        $guru = Guru::where('user_id', 4)->first();
        $kelas = Kelas::where('guru_id', $guru->id)->first();
        $data_butir_sikap = ButirSikap::where('kategori_butir_id', 2)->get();
        $data_rencana_penilaian = RencanaNilaiK2::join('butir_sikap','rencana_nilai_k2.butir_sikap_id','=','butir_sikap.id')
        ->select('butir_sikap.kode','butir_sikap.butir_sikap','rencana_nilai_k2.*')->where('kategori_butir_id', 2)->where('kelas_id', $kelas->id)->get();
        return view('walikelas.rencana-k2.index', compact('title', 'data_rencana_penilaian','data_butir_sikap','kelas'));
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
            RencanaNilaiK2::insert($store_data_sikap);
            return redirect('rencana-k2')->with('success', 'Rencana nilai spiritual berhasil dipilih');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RencanaNilaiK2  $rencanaNilaiK2
     * @return \Illuminate\Http\Response
     */
    public function show(RencanaNilaiK2 $rencanaNilaiK2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RencanaNilaiK2  $rencanaNilaiK2
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaNilaiK2 $rencanaNilaiK2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RencanaNilaiK2  $rencanaNilaiK2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RencanaNilaiK2 $rencanaNilaiK2)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RencanaNilaiK2  $rencanaNilaiK2
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $butir_sikap = RencanaNilaiK2::findorfail($id);
        $butir_sikap->delete();
        return back()->with('success', 'Butir Sikap berhasil dihapus');
    }
}
