<?php

namespace App\Http\Controllers;

use App\Models\CatatanT2Q;
use App\Models\Kelas;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\AnggotaKelas;
use App\Models\AnggotaT2Q;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatatanT2QController extends Controller
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
        if(Auth::user()->hasRole('t2q')){
            $title = 'Catatan T2Q Siswa';
            $tapel = Tapel::latest()->first();
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $data_anggota_kelas = AnggotaT2Q::join('anggota_kelas','anggota_t2q.anggota_kelas_id','=','anggota_kelas.id')
            ->where('guru_id', $guru->id)->where('anggota_t2q.tapel_id',$tapel->id)->orderBy('kelas_id','ASC')->get();
            foreach ($data_anggota_kelas as $anggota) {
                $catatan = CatatanT2Q::where('anggota_kelas_id', $anggota->id)->first();
                if (is_null($catatan)) {
                    $anggota->catatan = "-";
                } else {
                    $anggota->catatan = $catatan->catatan;
                }
            }
            return view('t2q.catatan.index', compact('title', 'data_anggota_kelas'));
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
        return response()->view('errors.404', [abort(404), 404]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('t2q')){
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
        }else{
            return response()->view('errors.403', [abort(403), 403]);
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
        return response()->view('errors.404', [abort(404), 404]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatatanT2Q  $catatanT2Q
     * @return \Illuminate\Http\Response
     */
    public function edit(CatatanT2Q $catatanT2Q)
    {
        return response()->view('errors.404', [abort(404), 404]);
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
        return response()->view('errors.404', [abort(404), 404]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatatanT2Q  $catatanT2Q
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatatanT2Q $catatanT2Q)
    {
        return response()->view('errors.404', [abort(404), 404]);
    }
}
