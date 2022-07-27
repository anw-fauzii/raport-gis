<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Profil Sekolah';
        $sekolah = Sekolah::first();
        return view('admin.sekolah.index', compact('title', 'sekolah'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function show(Sekolah $sekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sekolah $sekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_sekolah' => 'required|min:5|max:100',
            'npsn' => 'required|numeric|digits_between:8,10',
            'nss' => 'nullable|numeric|digits:15',
            'alamat' => 'required|min:10|max:255',
            'kode_pos' => 'required|numeric|digits:5',
            'nomor_telpon' => 'required|numeric|digits_between:5,13',
            'website' => 'nullable|min:5|max:100',
            'email' => 'required|email|min:5|max:35',
            'kepala_sekolah' => 'required|min:3|max:100',
            'nip_kepala_sekolah' => 'nullable|digits:18',
            'logo' => 'max:2048|image',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            $sekolah = Sekolah::findorfail($id);

            if ($request->has('logo')) {
                $logo_file = $request->file('logo');
                $name_logo = 'logo.' . $logo_file->getClientOriginalExtension();
                $logo_file->move('assets/images/logo/', $name_logo);

                $data_sekolah = [
                    'nama_sekolah' => strtoupper($request->nama_sekolah),
                    'npsn' => $request->npsn,
                    'nss' => $request->nss,
                    'alamat' => $request->alamat,
                    'kode_pos' => $request->kode_pos,
                    'email' => $request->email,
                    'nomor_telpon' => $request->nomor_telpon,
                    'website' => $request->website,
                    'kepala_sekolah' => strtoupper($request->kepala_sekolah),
                    'nip_kepala_sekolah' => $request->nip_kepala_sekolah,
                    'logo' => $name_logo,
                ];
            } else {
                $data_sekolah = [
                    'nama_sekolah' => strtoupper($request->nama_sekolah),
                    'npsn' => $request->npsn,
                    'nss' => $request->nss,
                    'alamat' => $request->alamat,
                    'kode_pos' => $request->kode_pos,
                    'email' => $request->email,
                    'nomor_telpon' => $request->nomor_telpon,
                    'website' => $request->website,
                    'kepala_sekolah' => strtoupper($request->kepala_sekolah),
                    'nip_kepala_sekolah' => $request->nip_kepala_sekolah,
                ];
            }
            $sekolah->update($data_sekolah);
            return back()->with('success', 'Sukses! Profil Sekolah Berhasil Diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sekolah $sekolah)
    {
        //
    }
}
