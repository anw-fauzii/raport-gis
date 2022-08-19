<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaNilaiK4 extends Model
{
    use HasFactory;
    protected $table = 'rencana_nilai_k4';
    protected $fillable = [
        'pembelajaran_id',
        'kd_mapel_id',
    ];

    public function pembelajaran()
    {
        return $this->belongsTo(Pembelajaran::class);
    }
    
    public function kd_mapel()
    {
        return $this->belongsTo(KdMapel::class);
    }
}
