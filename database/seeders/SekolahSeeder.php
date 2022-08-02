<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sekolah;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sekolah::create([
            'nama_sekolah' => 'SD GIS Prima Insani',
            'npsn' => '69956855',
            'kode_pos' => '44112',
            'nomor_telpon' => '(0262) 231348',
            'alamat' => 'Jl. Ciledug No. 281',
            'website' => 'https://www.primainsani.sch.id',
            'email' => 'gis.primainsani.sch.id',
            'kepala_sekolah' => 'Puji Fauziah, S.Pd., SD.',
            'nip_kepala_sekolah' => '19023L1040211212119024'
        ]);
    }
}
