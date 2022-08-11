<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaNilaiK2 extends Model
{
    use HasFactory;
    protected $table = 'rencana_nilai_k2';
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
