<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\KdMapel;
use App\Models\RencanaKokulikuler;
use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\Tapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RencanaKokulikulerController extends Controller
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
        $title = 'Rencana Nilai Kokulikuler';
        $tapel = Tapel::latest()->first();     
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $id_kelas = Kelas::where('tapel_id', $tapel->id)->get('id');
        if(Auth::user()->hasRole('wali')){
            $kelas_diampu = Kelas::where('guru_id', $guru->id)->first();
            $data_kd_mapel = KdMapel::where('tapel_id', $tapel->id)->where('tingkatan_kelas',$kelas_diampu->tingkatan_kelas)->where('jenis_kompetensi', 1)->get();
            $data_rencana_penilaian = Pembelajaran::select('kategori_mapel_id','pembelajaran.*')->join('mapel','pembelajaran.mapel_id','=','mapel.id')->where('kategori_mapel_id',5)->where('guru_id', $guru->id)->whereIn('kelas_id', $id_kelas)->where('status', 1)->orderBy('mapel_id', 'ASC')->orderBy('kelas_id', 'ASC')->get();
            $ren_penilaian = RencanaKokulikuler::all();
            foreach ($data_rencana_penilaian as $penilaian) {
                $rencana_penilaian = RencanaKokulikuler::where('pembelajaran_id', $penilaian->id)->get();
                $penilaian->jumlah_rencana_penilaian = count($rencana_penilaian);
            }
            return view('guru.rencana-kokulikuler.index', compact('title', 'data_rencana_penilaian','data_kd_mapel','ren_penilaian'));

        }else if(Auth::user()->hasRole('mapel')){
            $data_kd_mapel = KdMapel::where('tapel_id', $tapel->id)->where('jenis_kompetensi', 1)->get();
            $data_rencana_penilaian = Pembelajaran::select('kategori_mapel_id','pembelajaran.*')->join('mapel','pembelajaran.mapel_id','=','mapel.id')->where('kategori_mapel_id',5)->where('guru_id', $guru->id)->whereIn('kelas_id', $id_kelas)->where('status', 1)->orderBy('mapel_id', 'ASC')->orderBy('kelas_id', 'ASC')->get();
            $ren_penilaian = RencanaKokulikuler::all();
            foreach ($data_rencana_penilaian as $penilaian) {
                $rencana_penilaian = RencanaKokulikuler::where('pembelajaran_id', $penilaian->id)->get();
                $penilaian->jumlah_rencana_penilaian = count($rencana_penilaian);
            }
            return view('guru.rencana-kokulikuler.index', compact('title', 'data_rencana_penilaian','data_kd_mapel','ren_penilaian'));
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
        if(Auth::user()->hasAnyRole('wali|mapel')){
            $validator = Validator::make($request->all(), [
                'butir_sikap_id' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->with('error', 'Tidak ada butir sikap yang dipilih');
            } else {
                for ($count = 0; $count < count($request->butir_sikap_id); $count++) {
                    $data_sikap = array(
                        'pembelajaran_id'  => $request->pembelajaran_id,
                        'kd_mapel_id'  => $request->butir_sikap_id[$count],
                        'created_at'  => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    );
                    $store_data_kokulikuler[] = $data_sikap;
                }
                RencanaKokulikuler::insert($store_data_kokulikuler);
                return redirect('rencana-kokulikuler')->with('success', 'Rencana nilai pengetahuan berhasil dipilih');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RencanaKokulikuler  $rencanaKokulikuler
     * @return \Illuminate\Http\Response
     */
    public function show(RencanaKokulikuler $rencanaKokulikuler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RencanaKokulikuler  $rencanaKokulikuler
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaKokulikuler $rencanaKokulikuler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RencanaKokulikuler  $rencanaKokulikuler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RencanaKokulikuler $rencanaKokulikuler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RencanaKokulikuler  $rencanaKokulikuler
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasAnyRole('wali|mapel')){
            $butir_sikap = RencanaKokulikuler::findorfail($id);
            $butir_sikap->delete();
            return back()->with('success', 'Butir Sikap berhasil dihapus');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }
}
