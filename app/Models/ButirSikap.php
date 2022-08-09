<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButirSikap extends Model
{
    use HasFactory;
    protected $table = 'butir_sikap';
    protected $fillable = [
        'kategori_butir_id',
        'kode',
        'butir_sikap',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriButirSikap::class,'kategori_butir_id','id');
    } 
}
