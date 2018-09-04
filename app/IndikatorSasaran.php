<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndikatorSasaran extends Model
{
    protected $table='indikator_sasaran';
    protected $fillable=['nama', 'sasaran_id'];
    
    public function Sasaran()
    {
        return $this->belongsTo(Sasaran::class);
    }
}
