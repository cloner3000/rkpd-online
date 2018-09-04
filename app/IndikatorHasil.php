<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndikatorHasil extends Model
{
    protected $table = 'indikator_hasil';

    protected $fillable = ['nama'];

    protected $hidden = ['created_at', 'updated_at'];

    public function indikatorKegiatan ()
    {
        return $this->hasMany(IndikatorKegiatan::class);
    }
}
