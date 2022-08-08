<?php

namespace App\Http\Controllers;

use App\Models\TanggalRaport;
use App\Models\Tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TanggalRaportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Tanggal Raport';
        $tapel = Tapel::findorfail(5);
        $data_tgl_raport = TanggalRaport::where('tapel_id', $tapel->id)->get();
        return view('admin.tanggal-raport.index', compact('title', 'tapel', 'data_tgl_raport'));
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
            'tapel_id' => 'required|unique:tanggal_raport',
            'tempat_penerbitan' => 'required|min:3|max:50',
            'tanggal_pembagian' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            $tgl_raport = new TanggalRaport([
                'tapel_id' => $request->tapel_id,
                'tempat_penerbitan' => $request->tempat_penerbitan,
                'tanggal_pembagian' => $request->tanggal_pembagian,
            ]);
            $tgl_raport->save();
            return back()->with('success', 'Tanggal raport berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TanggalRaport  $tanggalRaport
     * @return \Illuminate\Http\Response
     */
    public function show(TanggalRaport $tanggalRaport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TanggalRaport  $tanggalRaport
     * @return \Illuminate\Http\Response
     */
    public function edit(TanggalRaport $tanggalRaport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TanggalRaport  $tanggalRaport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tempat_penerbitan' => 'required|min:3|max:50',
            'tanggal_pembagian' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        } else {
            $tgl_raport = TanggalRaport::findorfail($id);
            $data_tgl_raport = [
                'tempat_penerbitan' => $request->tempat_penerbitan,
                'tanggal_pembagian' => $request->tanggal_pembagian,
            ];
            $tgl_raport->update($data_tgl_raport);
            return back()->with('success', 'Tanggal raport  berhasil diedit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TanggalRaport  $tanggalRaport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tgl_raport = TanggalRaport::findorfail($id);
        try {
            $tgl_raport->delete();
            return back()->with('success', 'Tanggal raport berhasil dihapus');
        } catch (Exeption $e) {
            return back()->with('error', 'Tanggal raport tidak dapat dihapus');
        }
    }
}
