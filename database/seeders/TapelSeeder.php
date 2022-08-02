<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tapel;

class TapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tapel::create([
            'id'=>'5',
            'tahun_pelajaran' => '2022/2023',
            'semester' => '1',
        ]);
    }
}
