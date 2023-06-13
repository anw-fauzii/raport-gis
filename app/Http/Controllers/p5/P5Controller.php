<?php

namespace App\Http\Controllers\p5;

use App\Http\Controllers\Controller;
use App\Models\p5\P5;
use App\Models\p5\P5Deskripsi;
use App\Models\p5\NilaiP5;
use App\Models\p5\CatatanP5;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Guru;
use App\Models\Tapel;
use App\Models\AnggotaKelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Validator;
use PDF;

class P5Controller extends Controller
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
            $title = 'Projek P5';
            $tapel = Tapel::latest()->first();
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $kelas = Kelas::where('guru_id', $guru->id)->latest()->first();
            $p5 = P5::where('kelas_id', $kelas->id)->get();
            $p5deskripsi = P5Deskripsi::All();
            return view('walikelas.p5.projek-p5.index', compact('title', 'p5','kelas','p5deskripsi'));
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
                'judul.*' => 'required|min:2',
                'deskripsi.*' => 'required|min:10',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            } else {
                for ($count = 0; $count < count($request->judul); $count++) {
                    $data_kd = array(
                        'no'=> $count + 1,
                        'kelas_id'  => $request->kelas_id,
                        'judul'  => $request->judul[$count],
                        'deskripsi'  => $request->deskripsi[$count],
                        'created_at'  => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    );
                    $store_data_kd[] = $data_kd;
                }
                P5::insert($store_data_kd);
                return redirect('projek-p5')->with('success', 'Projek P5 berhasil ditambahkan');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\P5  $p5
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $title = 'Raport';
        $tapel = Tapel::latest()->first();
        $decrypted = Crypt::decrypt($id);
        $sekolah = Sekolah::first();
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $kelas = Kelas::where('tapel_id', $tapel->id)->where('guru_id', $guru->id)->orWhere('pendamping_id', $guru->id)->first();
        $anggota_kelas = AnggotaKelas::findorfail($decrypted);
        $p5=P5::where('kelas_id', $kelas->id)->get();
        $nilai=NilaiP5::where('anggota_kelas_id', $decrypted)->get();
        $catatan=CatatanP5::where('anggota_kelas_id', $decrypted)->get();
        $kelengkapan_raport = PDF::loadview('walikelas.raport.p5', 
        compact('title','sekolah','anggota_kelas','nilai','catatan','p5','guru','sekolah'))->setPaper('A4','potrait');
    
        return $kelengkapan_raport->stream('RAPORT ' . $anggota_kelas->kelas->nama_kelas . '_' . $anggota_kelas->siswa->nama_lengkap . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\P5  $p5
     * @return \Illuminate\Http\Response
     */
    public function edit(P5 $p5)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\P5  $p5
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, P5 $p5)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\P5  $p5
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasRole('wali')){
            $P5 = P5::findorfail($id);
            try {
                P5Deskripsi::where('p5_id', $id)->delete();
                $P5->delete();
                return back()->with('success', 'Projek P5 berhasil dihapus');
            } catch (\Exception $e) {
                return back()->with('warning', 'Kosongkan anggota kelas terlebih dahulu');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }
}
