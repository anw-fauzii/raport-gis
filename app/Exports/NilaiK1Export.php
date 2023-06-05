<?php

namespace App\Exports;

use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\AnggotaKelas;
use App\Models\RencanaNilaiK1;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NilaiK1Export implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $time_download = date('Y-m-d H:i:s');

        $tapel = Tapel::latest()->first();
        $id_kelas = Kelas::where('tapel_id', $tapel->id)->orderBy('tingkatan_kelas', 'ASC')->get('id');
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $kelas = Kelas::where('guru_id', $guru->id)->latest()->first();
        $data_anggota_kelas = AnggotaKelas::where('kelas_id', $kelas->id)->get();
        $data_rencana_penilaian = RencanaNilaiK1::where('kelas_id', $kelas->id)->orderBy('butir_sikap_id', 'ASC')->get();
        $count_kd = count($data_rencana_penilaian);

        return view('exports.nilai-k1', compact('time_download', 'data_anggota_kelas', 'data_rencana_penilaian', 'tapel', 'count_kd'));
    }
}
