<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Mapel;

class MapelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 9 && $key <= 59) {
                Mapel::create([
                    'tapel' =>  $row[1],
                    'kategori_mapel_id' => $row[2],
                    'nama_mapel' => $row[3],
                    'ringkasan_mapel' => $row[4]
                ]);
            }
        }
    }
}
