<?php

namespace App\Models\NilaiPrima;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ButirSikap;
use App\Models\RencanaPrima\RencanaAchievement;

class NilaiAchievement extends Model
{
    use HasFactory;
    protected $table = 'nilai_achievement';
    protected $fillable = [
        'rencana_achievement_id',
        'anggota_kelas_id',
        'nilai',
        'deskripsi',
    ];

    public function rencana_achievement()
    {
        return $this->belongsTo(RencanaAchievement::class,'rencana_achievement_id','id');
    }
}
