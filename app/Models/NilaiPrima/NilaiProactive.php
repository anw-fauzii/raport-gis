<?php

namespace App\Models\NilaiPrima;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ButirSikap;
use App\Models\RencanaPrima\RencanaProactive;

class NilaiProactive extends Model
{
    use HasFactory;
    protected $table = 'nilai_proactive';
    protected $fillable = [
        'rencana_proactive_id',
        'anggota_kelas_id',
        'nilai',
        'deskripsi',
    ];

    public function rencana_proactive()
    {
        return $this->belongsTo(RencanaProactive::class,'rencana_proactive_id','id');
    }
}
