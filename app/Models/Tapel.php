<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tapel extends Model
{
    use HasFactory;
    protected $table = 'tapel';
    protected $fillable = [
        'tahun_pelajaran',
        'semester'
    ];

    public function tgl_raport()
    {
        return $this->hasOne(TanggalRaport::class);
    }
}
