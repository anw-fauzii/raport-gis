<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;
    protected $table = 'sekolah';
    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'kode_pos',
        'nomor_telpon',
        'alamat',
        'website',
        'email',
        'logo',
        'kepala_sekolah',
        'nip_kepala_sekolah',
    ];
}
