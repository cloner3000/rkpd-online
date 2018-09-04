<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidangUrusan extends Model
{
    protected $table = 'bidang_urusan';

    protected $fillable = ['kode', 'nama'];

    public function program()
    {
        return $this->hasMany(Program::class);
    }

    public function opds()
    {
        return $this->belongsToMany(
            Opd::class,
            'bidang_urusan_opd',
            'bidang_urusan_id',
            'opd_id');
    }

    public function urusan()
    {
        return $this->belongsTo(Urusan::class);
    }
}
