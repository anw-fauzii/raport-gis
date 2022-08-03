<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;
    protected $table = 'kehadiran';
    protected $fillable = [
        'anggota_kelas_id',
        'sakit',
        'izin',
        'tanpa_keterangan'
    ];

    public function anggota_kelas()
    {
        return $this->belongsTo(AnggotaKelas::class);
    }
}
