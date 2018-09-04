<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['nama', 'deskripsi', 'keyword', 'indikator_sasaran_id'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function opd()
    {
        return $this->belongsToMany(Opd::class, 'opd_kegiatan');
    }

    public function indikatorKegiatan()
    {
        return $this->hasMany(IndikatorKegiatan::class);
    }

    public function indikatorSasaran()
    {
        return $this->belongsTo(IndikatorSasaran::class);
    }

    public function scopeWithAll($query)
    {
        $query->with('indikatorKegiatan',
            'indikatorKegiatan.indikatorHasil',
            'indikatorKegiatan.satuan',
            'indikatorKegiatan.targetAnggaran',
            'program',
            'program.capaianProgram',
            'program.capaianProgram.satuan',
            'opd'
            );
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->Where('nama', 'like', '%'.$search.'%')
                ->Where('deskripsi', 'like', '%'.$search.'%')
                ->Where('keyword', 'like', '%'.$search.'%');
        }

        return $query;
    }
}
