<?php

namespace App\Http\Controllers;

use App\Models\KdMapel;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Excel;
use Carbon\Carbon;

class KdMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Kompetensi Dasar';
        $tapel = Tapel::findorfail(5);
        $data_mapel = Mapel::where('tapel', $tapel->tahun_pelajaran)->orderBy('nama_mapel', 'ASC')->get();
        $id_mapel = Mapel::where('tapel', $tapel->tahun_pelajaran)->get('id');

        $data_kelas = Kelas::where('tapel_id', $tapel->id)->groupBy('tingkatan_kelas')->orderBy('tingkatan_kelas', 'ASC')->get();
        
        if (count($data_mapel) == 0) {
            return redirect('mapel')->with('warning', 'Mohon isikan data mata pelajaran');
        } elseif (count($data_kelas) == 0) {
            return redirect('kelas')->with('warning', 'Mohon isikan data kelas');
        } else {
            $data_kd = KdMapel::whereIn('mapel_id', $id_mapel)->get();
            return view('admin.kd.index', compact('title', 'data_mapel', 'data_kelas', 'data_kd'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mapel_id' => 'required',
            'tingkatan_kelas' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            $title = 'Tambah Kompetensi Dasar';
            $mapel_id = $request->mapel_id;
            $tingkatan_kelas = $request->tingkatan_kelas;

            $tapel = Tapel::findorfail(5);
            $data_mapel = Mapel::where('tapel', $tapel->tahun_pelajaran)->orderBy('nama_mapel', 'ASC')->get();
            $data_kelas = Kelas::where('tapel_id', $tapel->id)->groupBy('tingkatan_kelas')->orderBy('tingkatan_kelas', 'ASC')->get();
            return view('admin.kd.create', compact('title', 'mapel_id', 'tingkatan_kelas', 'tapel', 'data_mapel', 'data_kelas'));
        }
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
            'jenis_kompetensi.*' => 'required',
            'kode_kd.*' => 'required|min:2|max:10',
            'kompetensi_dasar.*' => 'required|min:10|max:255',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            for ($count = 0; $count < count($request->jenis_kompetensi); $count++) {
                $data_kd = array(
                    'mapel_id'  => $request->mapel_id,
                    'tingkatan_kelas'  => $request->tingkatan_kelas,
                    'semester'  => $request->semester,
                    'jenis_kompetensi'  => $request->jenis_kompetensi[$count],
                    'kode_kd'  => $request->kode_kd[$count],
                    'kompetensi_dasar'  => $request->kompetensi_dasar[$count],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                $store_data_kd[] = $data_kd;
            }
            KdMapel::insert($store_data_kd);
            return redirect('kd-mapel')->with('success', 'Kompetensi dasar berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KdMapel  $kdMapel
     * @return \Illuminate\Http\Response
     */
    public function show(KdMapel $kdMapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KdMapel  $kdMapel
     * @return \Illuminate\Http\Response
     */
    public function edit(KdMapel $kdMapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KdMapel  $kdMapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kompetensi_dasar' => 'required|min:10|max:255',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            $kd = KdMapel::findorfail($id);
            $data_kd = [
                'kompetensi_dasar' => $request->kompetensi_dasar,
            ];
            $kd->update($data_kd);
            return back()->with('success', 'Kompetensi dasar berhasil diedit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KdMapel  $kdMapel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kd = KdMapel::findorfail($id);
        try {
            $kd->delete();
            return back()->with('success', 'Kompetensi dasar berhasil dihapus');
        } catch (Exception $e) {
            return back()->with('error', 'Data Kompetensi dasar tidak dapat dihapus');
        }
    }
}
