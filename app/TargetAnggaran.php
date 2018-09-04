<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetAnggaran extends Model
{
    protected $table = 'target_anggaran';

    protected $fillable = ['target'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'target' => 'bigInteger',
    ];

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class);
    }

    public function indikatorKegiatan()
    {
        return $this->belongsTo(IndikatorKegiatan::class);
    }
}
