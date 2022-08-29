<?php

namespace App\Models\NilaiPrima;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ButirSikap;
use App\Models\RencanaPrima\RencanaResponsible;

class NilaiResponsible extends Model
{
    use HasFactory;
    protected $table = 'nilai_responsible';
    protected $fillable = [
        'rencana_responsible_id',
        'anggota_kelas_id',
        'nilai',
        'deskripsi',
    ];

    public function rencana_responsible()
    {
        return $this->belongsTo(RencanaResponsible::class,'rencana_responsible_id','id');
    }
}
