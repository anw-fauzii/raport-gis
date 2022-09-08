<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiT2Q extends Model
{
    use HasFactory;
    protected $table = 'nilai_t2q';
    protected $fillable = [
        'anggota_kelas_id',
        'tingkat',
        'tahsin_jilid',
        'tahsin_halaman',
        'tahsin_kekurangan',
        'tahsin_kelebihan',
        'tahsin_nilai',
        'tahfidz_surah',
        'tahfidz_ayat',
        'tahfidz_nilai',
    ];
}
