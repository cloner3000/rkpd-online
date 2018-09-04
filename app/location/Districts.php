<?php

namespace App\location;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    protected $table = 'districts';

    public function villages()
    {
        return $this->hasMany(Villages::class, 'district_id', 'id');
    }
}
