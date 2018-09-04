<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class IndikatorSasaran extends Model
{
    protected $table      = 'indikator_sasaran';
    protected $hidden     = 'id';
    protected $guard_name = 'admin';
    protected $fillable   = ['nama', 'sasaran_id',];

    public function sasaran()
    {
        return $this->belongsTo(Sasaran::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query
                ->WhereHas(
                    'sasaran', function ($q2) use ($search) {
                    $q2->where('nama', 'like', '%'.$search.'%');
                })
                ->orWhere('nama', 'like', '%'.$search.'%');
        }

        return $query;
    }
}
