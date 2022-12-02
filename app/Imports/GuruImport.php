<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use App\Models\Guru;
use App\Models\User;

class GuruImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 9 && $key <= 59) {
                $user = User::create([
                    'name' => $row[1],
                    'email' => $row[3],
                    'password' => Hash::make('12345678'),
                ]);
                if($row[4] == 1){
                    $user->assignRole('wali');
                }else if($row[4] == 2){
                    $user->assignRole('t2q');
                }else if($row[4] == 3){
                    $user->assignRole('mapel');
                }
                
                $tanggal_lahir = ($row[7] - 25569) * 86400;
                Guru::create([
                    'user_id' => $user->id,
                    'nama_lengkap' => $row[1],
                    'gelar' => $row[2],
                    'nip' => $row[3],
                    'jabatan' => $row[4],
                    'jenis_kelamin' => $row[5],
                    'tempat_lahir' => $row[6],
                    'tanggal_lahir' => gmdate('Y-m-d', $tanggal_lahir),
                    'nuptk' => $row[8],
                    'alamat' => $row[9],
                    'avatar' => 'default.png'
                ]);
            }
        }
    }
}
