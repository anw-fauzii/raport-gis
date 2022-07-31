<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tapel;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tapel = Tapel::findorfail(5);
        $title = 'Data Kelas';
            $data_kelas = Kelas::where('tapel_id', $tapel->id)->orderBy('tingkatan_kelas', 'ASC')->get();
            foreach ($data_kelas as $kelas) {
                $jumlah_anggota = Siswa::where('kelas_id', $kelas->id)->count();
                $kelas->jumlah_anggota = $jumlah_anggota;
            }
            $data_guru = Guru::orderBy('nama_lengkap', 'ASC')->get();
            return view('admin.kelas.index', compact('title', 'data_kelas', 'tapel', 'data_guru'));
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
            'tingkatan_kelas' => 'required|numeric|digits_between:1,2',
            'nama_kelas' => 'required|min:1|max:30',
            'guru_id' => 'required',
            'pendamping_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            $tapel = Tapel::findorfail(5);
            $kelas = new Kelas([
                'tapel_id' => $tapel->id,
                'guru_id' => $request->guru_id,
                'pendamping_id' => $request->pendamping_id,
                'tingkatan_kelas' => $request->tingkatan_kelas,
                'nama_kelas' => $request->nama_kelas,
            ]);
            $kelas->save();
            return back()->with('success', 'Sukes! Kelas berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|min:1|max:30',
            'guru_id' => 'required',
            'pendamping_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            $kelas = Kelas::findorfail($id);
            $data_kelas = [
                'nama_kelas' => $request->nama_kelas,
                'guru_id' => $request->guru_id,
                'pendamping_id' => $request->pendamping_id,
            ];
            $kelas->update($data_kelas);
            return back()->with('success', 'Sukses! Kelas berhasil diedit');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findorfail($id);
        try {
            $kelas->delete();
            return back()->with('success', 'Kelas berhasil dihapus');
        } catch (Exception $e) {
            return back()->with('warning', 'Kosongkan anggota kelas terlebih dahulu');
        }
    }
}
