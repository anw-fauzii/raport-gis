<?php

namespace App\Exports;

use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\AnggotaKelas;
use App\Models\RencanaNilaiK4;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NilaiK4Export implements FromView, ShouldAutoSize
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }
    
    public function view(): View
    {
        $time_download = date('Y-m-d H:i:s');
        $tapel = Tapel::latest()->first();
        $pembelajaran = Pembelajaran::findorfail($this->id);
        $data_anggota_kelas = AnggotaKelas::where('kelas_id', $pembelajaran->kelas_id)->get();

        $data_kode_penilaian = RencanaNilaiK4::where('pembelajaran_id', $this->id)->get();

        return view('exports.nilai-k4', compact('time_download', 'tapel', 'pembelajaran', 'data_anggota_kelas', 'data_kode_penilaian'));
    }
}
