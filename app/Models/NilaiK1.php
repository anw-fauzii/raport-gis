<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiK1 extends Model
{
    use HasFactory;
    protected $table = 'nilai_k1';
    protected $fillable = [
        'rencana_nilai_sosial_id',
        'anggota_kelas_id',
        'nilai',
        'deskripsi',
    ];

    public function rencana_nilai_ki1()
    {
        return $this->belongsTo(RencanaNilaiK1::class,'rencana_nilai_ki1_id','id');
    }
}
