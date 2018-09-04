<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function opd()
    {
        return $this->belongsToMany(Opd::class, 'users_opd', 'user_id', 'opd_id');
    }

    public function anggaran()
    {
        return $this->hasMany(Anggaran::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query
                ->Where('name', 'like', '%'.$search.'%')
                ->orWhere('nama_lengkap', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
        }

        return $query;
    }

    public function getImageUrlAttribute($value)
    {
        if (!empty($this->attributes['photo'])) {
            return Storage::disk('public')->url($this->attributes['photo']);
        }

        return "";
    }
}
