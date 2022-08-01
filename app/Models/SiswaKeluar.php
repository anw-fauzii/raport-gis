<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaKeluar extends Model
{
    use HasFactory;
    protected $table = 'siswa_keluar';
    protected $fillable = [
        'siswa_id',
        'keluar_karena',
        'tanggal_keluar',
        'alasan_keluar'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
