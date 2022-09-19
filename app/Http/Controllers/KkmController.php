<?php

namespace App\Http\Controllers;

use App\Models\Kkm;
use App\Models\Tapel;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Exports\KkmExport;
use App\Imports\KkmImport;
use Illuminate\Support\Facades\Validator;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KkmController extends Controller
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
            $title = 'KKM Mata Pelajaran';
            $tapel = Tapel::findorfail(5);
            $data_mapel = Mapel::where('tapel', $tapel->tahun_pelajaran)->orderBy('nama_mapel', 'ASC')->get();
            $id_mapel = Mapel::where('tapel', $tapel->tahun_pelajaran)->get('id');

            $cek_pembelajaran = Pembelajaran::whereIn('mapel_id', $id_mapel)->whereNotNull('guru_id')->where('status', 1)->get();
            if (count($cek_pembelajaran) == 0) {
                return redirect('pembelajaran')->with('warning', 'Mohon isikan data pembelajaran');
            } else {
                $data_kkm = Kkm::whereIn('mapel_id', $id_mapel)->get();
                return view('admin.kkm.index', compact('title', 'data_mapel', 'data_kkm'));
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
        if(Auth::user()->hasRole('admin')){
            $filename = 'format_import_kkm_k13 ' . date('Y-m-d H_i_s') . '.xls';
            return Excel::download(new KkmExport, $filename);
        }else{
            return response()->view('errors.403', [abort(403), 403]);
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
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'mapel_id' => 'required',
                'tingkat' => 'required',
                'kkm' => 'required|numeric|between:0,100',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            } else {
                $cek_kkm = Kkm::where('mapel_id', $request->mapel_id)->where('tingkat', $request->tingkat)->first();
                if (is_null($cek_kkm)) {
                    $kkm = new Kkm([
                        'mapel_id' => $request->mapel_id,
                        'tingkat' => $request->tingkat,
                        'kkm' => ltrim($request->kkm),
                    ]);
                    $kkm->save();
                    return back()->with('success', 'KKM berhasil ditambahkan');
                } else {
                    return back()->with('error', 'Data KKM sudah ada');
                }
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kkm  $kkm
     * @return \Illuminate\Http\Response
     */
    public function show(Kkm $kkm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kkm  $kkm
     * @return \Illuminate\Http\Response
     */
    public function edit(Kkm $kkm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kkm  $kkm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'kkm' => 'required|numeric|between:0,100',
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            } else {
                $kkm = Kkm::findorfail($id);
                $data = [
                    'kkm' => ltrim($request->kkm),
                ];
                $kkm->update($data);
                return back()->with('success', 'KKM berhasil diedit');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kkm  $kkm
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasRole('admin')){
            $kkm = Kkm::findorfail($id);
            try {
                $kkm->delete();
                return back()->with('success', 'KKM berhasil dihapus');
            } catch (Exception $e) {
                return back()->with('warning', 'Data tidak dapat dihapus');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    public function import(Request $request)
    {
        if(Auth::user()->hasRole('admin')){
            try {
                Excel::import(new KkmImport, $request->file('file_import'));
                return back()->with('success', 'Data KKM berhasil diimport');
            } catch (Exception $e) {
                return back()->with('error', 'Maaf, format data tidak sesuai');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }
}
