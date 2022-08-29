<?php

namespace App\Models\NilaiPrima;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ButirSikap;
use App\Models\RencanaPrima\RencanaInnovative;

class NilaiInnovative extends Model
{
    use HasFactory;
    protected $table = 'nilai_innovative';
    protected $fillable = [
        'rencana_innovative_id',
        'anggota_kelas_id',
        'nilai',
        'deskripsi',
    ];

    public function rencana_innovative()
    {
        return $this->belongsTo(RencanaInnovative::class,'rencana_innovative_id','id');
    }
}
