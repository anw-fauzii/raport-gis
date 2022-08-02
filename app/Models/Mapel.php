<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $fillable = [
        'tapel',
        'nama_mapel',
        'kategori_mapel_id',
        'ringkasan_mapel'
    ];

    public function tapel()
    {
        return $this->belongsTo(Tapel::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriMapel::class,'kategori_mapel_id','id');
    }
}
