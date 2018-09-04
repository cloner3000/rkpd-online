<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Tujuan extends Model
{
    protected $table      = 'tujuan';
    protected $hidden     = 'id';
    protected $guard_name = 'admin';
    protected $fillable   = ['nama', 'misi_id'];

    public function Misi()
    {
        return $this->belongsTo(Misi::class);
    }
}
