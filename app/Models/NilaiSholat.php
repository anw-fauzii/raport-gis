<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSholat extends Model
{
    use HasFactory;
    protected $table = 'nilai_sholat';
    protected $fillable = [
        'anggota_kelas_id',
        'tingkat',
        'praktik_wudhu',
        'bacaan_sholat',
        'gerakan_sholat',
        'dzikir'
    ];
}
