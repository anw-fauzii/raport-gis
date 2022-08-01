<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKelas extends Model
{
    use HasFactory;
    protected $table = 'anggota_kelas';
    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'tapel_id',
        'pendaftaran',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function anggota_kelas()
    {
        return $this->hasMany(AnggotaKelas::class);
    }

}
