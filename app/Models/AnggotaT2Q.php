<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaT2Q extends Model
{
    use HasFactory;
    protected $table = 'anggota_t2q';
    protected $fillable = [
        'siswa_id',
        'guru_id',
        'tapel',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function anggota_t2q()
    {
        return $this->hasMany(AnggotaT2Q::class);
    }
}
