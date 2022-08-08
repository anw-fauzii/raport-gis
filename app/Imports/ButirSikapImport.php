<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\ButirSikap;
use Maatwebsite\Excel\Concerns\ToCollection;

class ButirSikapImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 9) {
                $cek_sikap = ButirSikap::where('kode', $row[2])->first();
                if (is_null($cek_sikap)) {
                    ButirSikap::create([
                        'jenis_kompetensi' => $row[1],
                        'kode' => $row[2],
                        'butir_sikap' => $row[3]
                    ]);
                } else {
                    $cek_sikap->update([
                        'jenis_kompetensi' => $row[1],
                        'kode' => $row[2],
                        'butir_sikap' => $row[3]
                    ]);
                }
            }
        }
    }
}
