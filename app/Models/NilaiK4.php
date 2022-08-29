<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiK4 extends Model
{
    use HasFactory;
    protected $table = 'nilai_k4';
    protected $fillable = [
        'rencana_nilai_k4_id',
        'anggota_kelas_id',
        'nilai',
    ];

    public function rencana_mapel()
    {
        return $this->belongsTo(RencanaNilaik4::class,'rencana_nilai_k4_id','id');
    }
}
