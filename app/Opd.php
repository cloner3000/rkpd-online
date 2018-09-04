<?php

namespace App;

use App\location\Districts;
use App\location\Villages;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    protected $table = 'opd';

    protected $fillable = ['kode', 'nama'];

    protected $hidden = ['created_at', 'updated_at'];

    public function kegiatan()
    {
        return $this->belongsToMany(Kegiatan::class, 'opdKegiatan');
    }

    public function bidangUrusans()
    {
        return $this->belongsToMany(
            BidangUrusan::class,
            'bidang_urusan_opd',
            'opd_id',
            'bidang_urusan_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_opd', 'user_id', 'opd_id');
    }

    public function anggaran()
    {
        return $this->hasMany(Anggaran::class);
    }

    public function jenisOpd()
    {
        return $this->belongsTo(JenisOpd::class);
    }

    public function village()
    {
        return $this->belongsTo(Villages::class, 'kode', 'id');
    }

    public function district()
    {
        return $this->belongsTo(Districts::class, 'kode', 'id');
    }

    public function getFullNameAttribute()
    {
        $name  = '';

        if (!empty($this->village->district)) {
            $name = ' KECAMATAN ' .$this->village->district->name;
        }

        return  $this->nama. $name;
    }

    public function scopeWithAll($query)
    {
        $query->with('villages',
            'villages.name'
        );
    }

    public function scopeWhereJenisOpd($query, $jenis)
    {
        if ($jenis) {
            $query->WhereHas('jenisOpd', function ($q2) use ($jenis) {
                $q2->where('nama', $jenis);
            });
        }

        return $query;
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query
                ->WhereHas(
                    'jenisOpd', function ($q2) use ($search) {
                    $q2->where('nama', 'like', '%'.$search.'%');
                })
                ->orWhere('nama', 'like', '%'.$search.'%');
        }

        return $query;
    }
}
