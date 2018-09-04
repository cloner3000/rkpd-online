<?php

namespace App\location;

use Illuminate\Database\Eloquent\Model;

class Villages extends Model
{
    protected $table = 'villages';

    protected $hidden = ['created_at', 'updated_at'];

    public function district()
    {
        return $this->belongsTo(Districts::class, 'district_id', 'id');
    }
}
