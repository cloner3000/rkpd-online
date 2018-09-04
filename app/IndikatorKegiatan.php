<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndikatorKegiatan extends Model
{
    protected $table = 'indikator_kegiatan';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['tolak_ukur', 'target'];

    public function IndikatorHasil()
    {
        return $this->belongsTo(IndikatorHasil::class);
    }

    public function Satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function Kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function targetAnggaran()
    {
        return $this->hasMany(TargetAnggaran::class);
    }
}
