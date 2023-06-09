<?php

namespace App\Models\p5;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\p5\P5;

class P5Deskripsi extends Model
{
    use HasFactory;
    protected $table = 'p5_deskripsi';
    protected $fillable = [
        'dimensi',
        'p5_id',
        'judul',
        'deskripsi',
    ];

    public function p5()
    {
        return $this->belongsTo(P5::class,'p5_id','id');
    }
}
