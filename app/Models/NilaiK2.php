<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiK2 extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'nilai_k2';
    protected $fillable = [
        'rencana_nilai_sosial_id',
        'anggota_kelas_id',
        'nilai',
        'deskripsi',
    ];

    public function rencana_nilai_k2()
    {
        return $this->belongsTo(RencanaNilaiK2::class,'rencana_nilai_k2_id','id');
    }
}
