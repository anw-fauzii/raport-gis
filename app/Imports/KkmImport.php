<?php

namespace App\Imports;

use App\Models\Kkm;
use App\Models\Tapel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class KkmImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 10) {
                if ($row[4] > 0 && $row[4] <= 100) {
                    $cek_kkm = Kkm::where('mapel_id', $row[1])->where('tingkat', $row[2])->first();
                    $tapel = Tapel::latest()->first();
                    if (is_null($cek_kkm)) {
                        Kkm::create([
                            'mapel_id' => $row[1],
                            'tapel_id' => $tapel->id,
                            'tingkat' => $row[2],
                            'kkm' => $row[4]
                        ]);
                    } else {
                        $cek_kkm->update([
                            'mapel_id' => $row[1],
                            'tapel_id' => $tapel->id,
                            'tingkat' => $row[2],
                            'kkm' => $row[4]
                        ]);
                    }
                } else {
                    return back()->with('warning', 'Maaf, KKM Nomor ' . $row[0] . ' harus bernilai antara 0 sampai 100');
                }
            }
        }
    }
}
