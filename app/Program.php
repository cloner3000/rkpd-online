<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';

    protected $fillable = ['kode', 'nama', 'bidang_urusan_id'];

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function bidangUrusan()
    {
        return $this->belongsTo(BidangUrusan::class);
    }

    public function opd()
    {
        return $this->hasManyThrough(Opd::class, Kegiatan::class);
    }

    public function capaianProgram()
    {
        return $this->hasMany(CapaianProgram::class);
    }
}
