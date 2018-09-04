<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SumberAnggaran extends Model
{

    protected $hidden = ['created_at', 'updated_at'];

    protected $table = 'sumber_anggaran';

    protected $fillable = ['nama'];
}
