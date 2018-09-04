<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Visi extends Model
{
    protected $table      = 'visi';
    protected $hidden     = 'id';
    protected $guard_name = 'admin';
    protected $fillable   = ['nama', 'mulai', 'selesai', 'status'];
    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive(Builder $query)
    {
        return $query->where('status', true)->first();
    }
}
