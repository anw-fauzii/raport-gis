<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanT2Q extends Model
{
    use HasFactory;
    protected $table = 'catatan_t2q';
    protected $fillable = [
        'anggota_kelas_id',
        'catatan',
    ];

    public function anggota_kelas()
    {
        return $this->belongsTo(AnggotaKelas::class);
    }
}
