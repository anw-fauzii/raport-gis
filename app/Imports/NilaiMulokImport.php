<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\NilaiMulok;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\NilaiRapotMulok;
use Carbon\Carbon;

class NilaiMulokImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 10 && $key <= 500) {
                if($row[6]){
                    $rumus = (($row[5] * 2) + $row[6] + $row[7])/4;
                }else{
                    $rumus = (($row[5] * 2) + $row[7])/3;
                }
                $user = NilaiMulok::create([
                    'anggota_kelas_id'  => $row[1],
                    'rencana_mulok_id' => $row[2],
                    'nilai_ph'  => $row[5],
                    'nilai_pts'  => $row[6],
                    'nilai_pas'  => $row[7],
                    'nilai_kd' => round($rumus,0),
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ]);
            }
        }
    }
}
