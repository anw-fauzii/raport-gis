<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tapel;
use App\Models\Mapel;
use App\Models\Kkm;
use Illuminate\Support\Facades\Auth;

class IntervalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','revalidate']);
    }

    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $title = 'Interval Predikat';
            $tapel = Tapel::findorfail(6);
            $id_mapel = Mapel::where('tapel', $tapel->tahun_pelajaran)->get('id');
            $data_kkm = Kkm::whereIn('mapel_id', $id_mapel)->orderBy('tingkat', 'ASC')->orderBy('mapel_id', 'ASC')->get();
            if (count($id_mapel) == 0) {
                return redirect('mapel')->with('warning', 'Mohon isikan data mata pelajaran');
            } else {
                foreach ($data_kkm as $kkm) {
                    $range = (100 - $kkm->kkm) / 3;
                    $kkm->predikat_c = round($kkm->kkm, 0);
                    $kkm->predikat_b = round($kkm->kkm + $range, 0);
                    $kkm->predikat_a = round($kkm->kkm + ($range * 2), 0);
                }
                return view('admin.interval-nilai.index', compact('title', 'data_kkm'));
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }
}
