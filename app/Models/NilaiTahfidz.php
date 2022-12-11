<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiTahfidz extends Model
{
    use HasFactory;
    protected $table = 'nilai_tahfidz';
    protected $fillable = [
        'anggota_kelas_id',
        'tingkat',
        'tahfidz_surah',
        'tahfidz_kelebihan',
        'tahfidz_kekurangan',
        'tahfidz_nilai',
    ];
}
