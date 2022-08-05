<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kkm extends Model
{
    use HasFactory;
    protected $table = 'kkm';
    protected $fillable = [
        'mapel_id',
        'tingkat',
        'kkm',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
