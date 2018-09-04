<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahapanOpd extends Model
{
    protected $table = 'tahapan_opd';

    public function tahapan()
    {
        return $this->belongsTo(Tahapan::class);
    }

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
