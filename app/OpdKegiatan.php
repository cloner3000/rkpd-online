<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpdKegiatan extends Model
{
    protected $table = 'opd_kegiatan';

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
