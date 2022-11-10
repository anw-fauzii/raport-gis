<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakulikuler;
use App\Models\AnggotaKelas;
use App\Models\AnggotaEkstrakulikuler;
use App\Models\Tapel;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EkstrakulikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $tapel = Tapel::findorfail(5);
            $title = 'Data Ekstrakulikuler';
            $data_ekstrakulikuler = Ekstrakulikuler::where('tapel_id', $tapel->id)->orderBy('nama_ekstrakulikuler', 'ASC')->get();
            foreach ($data_ekstrakulikuler as $ekstrakulikuler) {
                $jumlah_anggota = AnggotaEkstrakulikuler::where('ekstrakulikuler_id', $ekstrakulikuler->id)->count();
                $ekstrakulikuler->jumlah_anggota = $jumlah_anggota;
            }
            $data_guru = Guru::orderBy('nama_lengkap', 'ASC')->get();
            return view('admin.ekstrakulikuler.index', compact('title', 'data_ekstrakulikuler', 'tapel', 'data_guru'));
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
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'nama_ekstrakulikuler' => 'required|min:1|max:30',
                'guru_id' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            } else {
                $tapel = Tapel::findorfail(5);
                $ekstrakulikuler = new Ekstrakulikuler([
                    'tapel_id' => $tapel->id,
                    'guru_id' => $request->guru_id,
                    'nama_ekstrakulikuler' => $request->nama_ekstrakulikuler,
                ]);
                $ekstrakulikuler->save();
                return back()->with('success', 'Sukes! Ekstrakulikuler berhasil ditambahkan');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnggotaEkstrakulikuler  $anggotaEkstrakulikuler
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->hasRole('admin')){
            $title = 'Anggota Ekstrakulikuler';
            $ekstrakulikuler = Ekstrakulikuler::findorfail($id);
            $anggota_ekstrakulikuler = AnggotaEkstrakulikuler::where('ekstrakulikuler_id',$id)->get();
            $siswa_belum_masuk_ekstrakulikuler = Siswa::where('status', 1)->where('ekstrakulikuler_id', null)->get();
            foreach ($siswa_belum_masuk_ekstrakulikuler as $belum_masuk_ekstrakulikuler) {
                $kelas_sebelumhya = AnggotaEkstrakulikuler::join('anggota_kelas','anggota_kelas.id','=','anggota_ekstrakulikuler.anggota_kelas_id')
                ->where('siswa_id', $belum_masuk_ekstrakulikuler->id)->orderBy('anggota_ekstrakulikuler.id', 'DESC')->first();
                if (is_null($kelas_sebelumhya)) {
                    $belum_masuk_ekstrakulikuler->kelas_sebelumhya = null;
                } else {
                    $belum_masuk_ekstrakulikuler->kelas_sebelumhya = $kelas_sebelumhya->kelas->nama_kelas;
                }
            }
            return view('admin.ekstrakulikuler.show', compact('title', 'ekstrakulikuler', 'anggota_ekstrakulikuler', 'siswa_belum_masuk_ekstrakulikuler'));
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnggotaEkstrakulikuler  $anggotaEkstrakulikuler
     * @return \Illuminate\Http\Response
     */
    public function edit(AnggotaEkstrakulikuler $anggotaEkstrakulikuler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnggotaEkstrakulikuler  $anggotaEkstrakulikuler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'nama_ekstrakulikuler' => 'required|min:1|max:30',
                'guru_id' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            } else {
                $ekstrakulikuler = Ekstrakulikuler::findorfail($id);
                $data_kelas = [
                    'guru_id' => $request->guru_id,
                    'nama_ekstrakulikuler' => $request->nama_ekstrakulikuler,
                ];
                $ekstrakulikuler->update($data_kelas);
                return back()->with('success', 'Sukses! Ekstrakulikuler berhasil diedit');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnggotaEkstrakulikuler  $anggotaEkstrakulikuler
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasRole('admin')){
            $ekstrakulikuler = Ekstrakulikuler::findorfail($id);
            try {
                $ekstrakulikuler->delete();
                return back()->with('success', 'Estrakulikuler berhasil dihapus');
            } catch (Exception $e) {
                return back()->with('warning', 'Kosongkan anggota Ekstrakulikuler terlebih dahulu');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }
}
