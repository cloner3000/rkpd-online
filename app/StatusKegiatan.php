<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusKegiatan extends Model
{
    protected $table = 'status_kegiatan';

    protected $fillable = ['nama'];
}
