<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSholat extends Model
{
    use HasFactory;
    protected $table = 'nilai_sholat';
    protected $fillable = [
        'rencana_nilai_sholat_id',
        'anggota_kelas_id',
        'nilai',
    ];

    public function rencana_nilai_sholat()
    {
        return $this->belongsTo(RencanaPelajaranSholat::class,'rencana_nilai_sholat_id','id');
    }
}
