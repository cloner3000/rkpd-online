<?php

namespace App;

use App\location\Districts;
use App\location\Villages;
use Illuminate\Database\Eloquent\Model;

class LokasiKegiatan extends Model
{
    protected $table = 'lokasi_kegiatan';

    protected $fillable = ['nama'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function village()
    {
        return $this->belongsTo(Villages::class, 'village_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(Districts::class, 'district_id', 'id');
    }
}
