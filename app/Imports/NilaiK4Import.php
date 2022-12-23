<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\NilaiK4;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\NilaiRapotk4;
use Carbon\Carbon;

class NilaiK4Import implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 10 && $key <= 500) {
                $user = NilaiK4::create([
                    'anggota_kelas_id'  => $row[1],
                    'rencana_nilai_k4_id' => $row[2],
                    'nilai'  => $row[5],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ]);
            }
        }
    }
}
