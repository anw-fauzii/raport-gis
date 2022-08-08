<?php

namespace App\Exports;

use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\Tapel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KkmExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $time_download = date('Y-m-d H:i:s');

        $tapel = Tapel::findorfail(5);
        $id_kelas = Kelas::where('tapel_id', $tapel->id)->orderBy('tingkatan_kelas', 'ASC')->get('id');
        
        $data_pembelajaran = Pembelajaran::join('kelas','kelas.id','=','pembelajaran.kelas_id')->whereIn('kelas_id', $id_kelas)
        ->whereNotNull('pembelajaran.guru_id')->where('status', 1)->orderBy('kelas_id', 'ASC')->groupBy('tingkatan_kelas','mapel_id')->orderBy('mapel_id', 'ASC')->get();
        return view('exports.kkm', compact('time_download', 'tapel', 'data_pembelajaran'));
    }
}
