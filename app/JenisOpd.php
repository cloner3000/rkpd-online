<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisOpd extends Model
{
    protected $table = 'jenis_opd';

    protected $fillable = ['nama'];

    public function opd()
    {
        return $this->hasMany(Opd::class);
    }
}
