<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggalRaport extends Model
{
    use HasFactory;
    protected $table = 'tanggal_raport';
    protected $fillable = [
        'tapel_id',
        'tempat_penerbitan',
        'tanggal_pembagian',
    ];
    protected $dates = ['tanggal_pembagian'];

    public function tapel()
    {
        return $this->belongsTo(Tapel::class);
    }
}
