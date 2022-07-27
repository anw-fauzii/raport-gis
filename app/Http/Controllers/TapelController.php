<?php

namespace App\Http\Controllers;

use App\Models\Tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Tahun Pelajaran';
        $data_tapel = Tapel::orderBy('id', 'DESC')->get();
        return view('admin.tapel.index', compact('title', 'data_tapel'));
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
            'tahun_pelajaran' => 'required|min:9|max:9',
            'semester' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            $tapel = new Tapel([
                'tahun_pelajaran' => $request->tahun_pelajaran,
                'semester' => $request->semester,
            ]);
            $tapel->save();
            return back()->with('success', 'Sukses! Tahun Pelajaran Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tapel  $tapel
     * @return \Illuminate\Http\Response
     */
    public function show(Tapel $tapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tapel  $tapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Tapel $tapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tapel  $tapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'tahun_pelajaran' => 'required|min:9|max:9',
            'semester' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            $tapel = Tapel::findorfail($id);
            $data = [
                'tahun_pelajaran' => $request->tahun_pelajaran,
                'semester' => $request->semester,
            ];
            $tapel->update($data);
            return back()->with('success', 'Sukses! Tahun Pelajaran Diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tapel  $tapel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tapel = Tapel::findorfail($id);
        $tapel->delete();
        return back()->with('success', 'Sukses! Tahun Pelajaran Dihapus');
    }
}
