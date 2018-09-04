<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Sasaran extends Model
{
    protected $table      = 'sasaran';
    protected $hidden     = 'id';
    protected $guard_name = 'admin';
    protected $fillable   = ['nama', 'tujuan_id'];

    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query
                ->WhereHas(
                    'tujuan', function ($q2) use ($search) {
                    $q2->where('nama', 'like', '%'.$search.'%');
                })
                ->orWhere('nama', 'like', '%'.$search.'%');
        }

        return $query;
    }
}
