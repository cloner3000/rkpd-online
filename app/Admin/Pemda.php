<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pemda extends Model
{
    protected $table      = 'pemda';
    protected $guard_name = 'admin';
    protected $fillable   = [
        'tahun', 'nama', 'ibu_kota', 'alamat', 'logo', 'nama_kepala_daerah', 'jabatan_kepala_daerah', 'nama_sekda',
        'nip_sekda', 'jabatan_sekda'
    ];

    public function getImageUrlAttribute($value)
    {
        if (!empty($this->attributes['logo'])) {
            return Storage::disk('public')->url($this->attributes['logo']);
        }

        return "";
    }

    public function visi()
    {
        return $this->belongsTo(Visi::class);
    }
}
