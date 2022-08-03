<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use App\Models\User;

class SiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 9 && $key <= 300) {
                $user = User::create([
                    'name' => strtoupper($row[1]),
                    'email' => $row[3],
                    'password' => Hash::make('12345678'),
                ]);

                $tanggal_lahir = ($row[6] - 25569) * 86400;
                Siswa::create([
                    'user_id' => $user->id,
                    'nis' => $row[1],
                    'nisn' => $row[2],
                    'nama_lengkap' => strtoupper($row[3]),
                    'jenis_kelamin' => $row[4],
                    'tempat_lahir' => $row[5],
                    'tanggal_lahir' => gmdate('Y-m-d', $tanggal_lahir),
                    'jenis_pendaftaran' => $row[7],
                    'agama' => $row[8],
                    'status_dalam_keluarga' => $row[9],
                    'anak_ke' => $row[10],
                    'alamat' => $row[11],
                    'nomor_hp' => $row[12],
                    'nama_ayah' => $row[13],
                    'pekerjaan_ayah' => $row[14],
                    'pendidikan_ayah' => $row[15],
                    'nama_ibu' => $row[16],
                    'pekerjaan_ibu' => $row[17],
                    'pendidikan_ibu' => $row[18],
                    'nama_wali' => $row[19],
                    'pekerjaan_wali' => $row[20],
                    'avatar' => 'default.png',
                    'status' => 1,
                ]);
            }
        }
    }
}
