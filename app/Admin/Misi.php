<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Misi extends Model
{
    protected $table      = 'misi';
    protected $hidden     = 'id';
    protected $guard_name = 'admin';
    protected $fillable   = ['nama', 'urutan', 'visi_id'];

    public function Visi()
    {
        return $this->belongsTo(Visi::class);
    }
}
