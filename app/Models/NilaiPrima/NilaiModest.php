<?php

namespace App\Models\NilaiPrima;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ButirSikap;
use App\Models\RencanaPrima\RencanaModest;

class NilaiModest extends Model
{
    use HasFactory;
    protected $table = 'nilai_modest';
    protected $fillable = [
        'rencana_modest_id',
        'anggota_kelas_id',
        'nilai',
        'deskripsi',
    ];

    public function rencana_modest()
    {
        return $this->belongsTo(RencanaModest::class,'rencana_modest_id','id');
    }
}
