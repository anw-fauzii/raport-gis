<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KenaikanSiswa extends Model
{
    use HasFactory;
    protected $table = 'kenaikan_siswa';
    protected $fillable = [
        'anggota_kelas_id',
        'status',
    ];

    public function anggota_kelas()
    {
        return $this->belongsTo(AnggotaKelas::class);
    }
}
