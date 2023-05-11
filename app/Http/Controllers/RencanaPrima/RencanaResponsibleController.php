<?php

namespace App\Http\Controllers\RencanaPrima;

use App\Http\Controllers\Controller;
use App\Models\RencanaPrima\RencanaResponsible;
use App\Models\Guru;
use App\Models\ButirSikap;
use App\Models\Tapel;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RencanaResponsibleController extends Controller
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
            $title = 'Rencana Responsible';
            $tapel = Tapel::findorfail(6);
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $kelas = Kelas::where('guru_id', $guru->id)->first();
            $data_butir_sikap = ButirSikap::where('kategori_butir_id', 9)->get();
            $data_rencana_penilaian = RencanaResponsible::join('butir_sikap','rencana_responsible.butir_sikap_id','=','butir_sikap.id')
            ->select('butir_sikap.kode','butir_sikap.butir_sikap','rencana_responsible.*')->where('kategori_butir_id', 9)->where('kelas_id', $kelas->id)->get();
            return view('walikelas.prima.rencana-responsible.index', compact('title', 'data_rencana_penilaian','data_butir_sikap','kelas'));
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
                RencanaResponsible::insert($store_data_sikap);
                return redirect('rencana-responsible')->with('success', 'Rencana nilai responsible berhasil dipilih');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RencanaPrima\Responsible  $responsible
     * @return \Illuminate\Http\Response
     */
    public function show(Responsible $responsible)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RencanaPrima\Responsible  $responsible
     * @return \Illuminate\Http\Response
     */
    public function edit(Responsible $responsible)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RencanaPrima\Responsible  $responsible
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Responsible $responsible)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RencanaPrima\Responsible  $responsible
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasRole('wali')){
            $butir_sikap = RencanaResponsible::findorfail($id);
            $butir_sikap->delete();
            return back()->with('success', 'Butir Sikap berhasil dihapus');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }
}
