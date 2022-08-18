<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KdMapel extends Model
{
    use HasFactory;
    protected $table = 'kd_mapel';
    protected $fillable = [
        'mapel_id',
        'tapel_id',
        'tingkatan_kelas',
        'jenis_kompetensi',
        'kode_kd',
        'kompetensi_dasar',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
    
    public function tapel()
    {
        return $this->belongsTo(Tapel::class);
    }
}
