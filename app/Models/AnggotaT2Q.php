<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaT2Q extends Model
{
    use HasFactory;
    protected $table = 'anggota_t2q';
    protected $fillable = [
        'tingkat',
        'anggota_kelas_id',
        'guru_id',
        'tapel',
    ];

    public function anggota_kelas()
    {
        return $this->belongsTo(AnggotaKelas::class,'anggota_kelas_id','id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
