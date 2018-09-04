<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CapaianProgram extends Model
{

    protected $table = 'capaian_program';

    protected $fillable = ['kode', 'tolak_ukur', 'target'];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
