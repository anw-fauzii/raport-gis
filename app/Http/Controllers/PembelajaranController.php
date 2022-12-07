<?php

namespace App\Http\Controllers;

use App\Models\Pembelajaran;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Tapel;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PembelajaranController extends Controller
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
        if(Auth::user()->hasRole('admin')){
            $tapel = Tapel::findorfail(5);
            $data_mapel = Mapel::where('tapel', $tapel->tahun_pelajaran)->orderBy('nama_mapel', 'ASC')->get();
            $data_kelas = Kelas::where('tapel_id', $tapel->id)->orderBy('tingkatan_kelas', 'ASC')->get();

            if (count($data_mapel) == 0) {
                return redirect('mapel')->with('warning', 'Mohon isikan data mata pelajaran');
            } elseif (count($data_kelas) == 0) {
                return redirect('kelas')->with('warning', 'Mohon isikan data kelas');
            } else {
                $title = 'Data Pembelajaran';
                $id_kelas = Kelas::where('tapel_id', $tapel->id)->orderBy('tingkatan_kelas', 'ASC')->get('id');
                $data_pembelajaran = Pembelajaran::whereIn('kelas_id', $id_kelas)->whereNotNull('guru_id')->where('status', 1)->orderBy('kelas_id', 'ASC')->get();
                return view('admin.pembelajaran.index', compact('title', 'data_kelas', 'data_pembelajaran'));
            }
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
            if (!is_null($request->pembelajaran_id)) {
                for ($count = 0; $count < count($request->pembelajaran_id); $count++) {
                    $pembelajaran = Pembelajaran::findorfail($request->pembelajaran_id[$count]);
                    $update_data = array(
                        'guru_id'  => $request->update_guru_id[$count],
                        'status'  => $request->update_status[$count],
                    );
                    $pembelajaran->update($update_data);
                }
                if (!is_null($request->mapel_id)) {
                    for ($count = 0; $count < count($request->mapel_id); $count++) {
                        $data_baru = array(
                            'kelas_id'  => $request->kelas_id[$count],
                            'mapel_id'  => $request->mapel_id[$count],
                            'guru_id'  => $request->guru_id[$count],
                            'status'  => $request->status[$count],
                            'created_at'  => Carbon::now(),
                            'updated_at'  => Carbon::now(),
                        );
                        $store_data_baru[] = $data_baru;
                    }
                    Pembelajaran::insert($store_data_baru);
                }
            } else {
                for ($count = 0; $count < count($request->mapel_id); $count++) {
                    $data_baru = array(
                        'kelas_id'  => $request->kelas_id[$count],
                        'mapel_id'  => $request->mapel_id[$count],
                        'guru_id'  => $request->guru_id[$count],
                        'status'  => $request->status[$count],
                        'created_at'  => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    );
                    $store_data_baru[] = $data_baru;
                }
                Pembelajaran::insert($store_data_baru);
            }
            return redirect('pembelajaran')->with('success', 'Setting pembelajaran berhasil');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelajaran  $pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelajaran $pembelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembelajaran  $pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelajaran $pembelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembelajaran  $pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelajaran $pembelajaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelajaran  $pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelajaran $pembelajaran)
    {
        //
    }

    public function setting(Request $request)
    {
        if(Auth::user()->hasRole('admin')){
            $title = 'Setting Pembelajaran';
            $tapel = Tapel::findorfail(5);
            $id_kelas = Kelas::findorfail($request->kelas_id);
            $kelas = Kelas::where('tingkatan_kelas', $id_kelas->tingkatan_kelas)->get();
            $data_kelas = Kelas::where('tapel_id', $tapel->id)->orderBy('tingkatan_kelas', 'ASC')->get();

            $data_pembelajaran_kelas = Pembelajaran::where('kelas_id', $request->kelas_id)->get();
            $mapel_id_pembelajaran_kelas = Pembelajaran::where('kelas_id', $request->kelas_id)->get('mapel_id');
            $data_mapel = Mapel::whereNotIn('id', $mapel_id_pembelajaran_kelas)->where(function($query) {
                $query->where('kategori_mapel_id',"3")
                    ->orWhere('kategori_mapel_id',"5")
                    ->orWhere('kategori_mapel_id',"6");
            })->orderBy('nama_mapel', 'ASC')->get();
            $data_guru = Guru::where('jabatan', 3)->get();
            return view('admin.pembelajaran.show', compact('id_kelas','title', 'tapel', 'kelas', 'data_kelas', 'data_pembelajaran_kelas', 'data_mapel','data_guru'));
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }
}
