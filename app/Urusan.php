<?php

namespace App;

use App\Admin\Visi;
use Illuminate\Database\Eloquent\Model;

class Urusan extends Model
{
    protected $table = 'urusan';

    protected $fillable = ['kode', 'nama'];

    public function visi()
    {
        return $this->belongsTo(Visi::class);
    }
}
