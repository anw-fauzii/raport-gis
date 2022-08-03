<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Excel;
use Illuminate\Support\Facades\Response;
use App\Imports\GuruImport;
use App\Exports\GuruExport;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Guru';
        $data_guru = Guru::orderBy('nama_lengkap', 'ASC')->get();
        return view('admin.guru.index', compact('title', 'data_guru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $file = public_path() . "/format_excel/format_import_guru.xlsx";
        $headers = array(
            'Content-Type: application/xlsx',
        );
        return Response::download($file, 'format_import_guru ' . date('Y-m-d H_i_s') . '.xlsx', $headers);
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
            'nama_lengkap' => 'required|min:3|max:100',
            'gelar' => 'required|min:3|max:10',
            'nip' => 'unique:guru',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required|min:3',
            'tanggal_lahir' => 'required',
            'nuptk' => 'nullable|digits:16|unique:guru',
            'alamat' => 'required|min:4|max:255',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            try {
                $user = new User([
                    'name' => $request->nama_lengkap,
                    'email' => $request->nip,
                    'password' => Hash::make('12345678'),
                ]);
                $user->save();
            } catch (Exception $e) {
                return back()->with('error', 'Gagal! Username Sudah Digunakan');
            }

            $guru = new Guru([
                'user_id' => $user->id,
                'nama_lengkap' => strtoupper($request->nama_lengkap),
                'gelar' => $request->gelar,
                'nip' => $request->nip,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nuptk' => $request->nuptk,
                'alamat' => $request->alamat,
                'avatar' => 'default.png'
            ]);
            $guru->save();
            return back()->with('success', 'Sukses! Guru Berhasil Ditambah');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $filename = 'data_guru ' . date('Y-m-d H_i_s') . '.xls';
        return Excel::download(new GuruExport, $filename);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'gelar' => 'required|min:3|max:10',
            'nip' => 'unique:guru',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required|min:3',
            'tanggal_lahir' => 'required',
            'nuptk' => 'nullable|digits:16|unique:guru',
            'alamat' => 'required|min:4|max:255',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            try {
                $user = User::findorfail($request->user_id);
                $data_user = [
                    'name' => $request->nama_lengkap,
                    'email' => $request->nip,
                ];
                $user->update($data_user);
            } catch (Exception $e) {
                return back()->with('error', 'Gagal! Username Sudah Digunakan');
            }
            $guru = Guru::findorfail($id);
            $data_guru = [
                'gelar' => $request->gelar,
                'nip' => $request->nip,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nuptk' => $request->nuptk,
                'alamat' => $request->alamat,
            ];

            $guru->update($data_guru);
            return back()->with('success', 'Sukses! Guru Berhasil Ditambah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Guru::findorfail($id);
        $user = User::findorfail($guru->user_id);
        try {
            $guru->delete();
            $user->delete();
            return back()->with('success', 'Sukses! Guru Berhasil Dihapus');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal! Guru Gagal Dihapus');
        }
    }

    public function export()
    {
        $filename = 'data_guru ' . date('Y-m-d H_i_s') . '.xls';
        return Excel::download(new GuruExport, $filename);
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new GuruImport, $request->file('file_import'));
            return back()->with('success', 'Data guru berhasil diimport');
        } catch (Exception $e) {
            return back()->with('error', 'Maaf, format data tidak sesuai');
        }
    }
}