<?php

namespace App\Models\RencanaPrima;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ButirSikap;
use App\Models\Kelas;

class RencanaAchievement extends Model
{
    use HasFactory;
    protected $table = 'rencana_achievement';
    protected $fillable = [
        'kelas_id',
        'butir_sikap_id',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function butir_sikap()
    {
        return $this->belongsTo(ButirSikap::class,'butir_sikap_id','id');
    }
}
