<?php

namespace App;

use App\location\Districts;
use App\location\Villages;
use App\Tahapan;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    protected $table = 'anggaran';

    protected $casts = [
        'is_kelurahan' => 'boolean',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function kegiatan()
    {

        return $this->belongsTo(Kegiatan::class);
    }

    public function sumberAnggaran()
    {
        return $this->belongsTo(SumberAnggaran::class);
    }

    public function jenisLokasi()
    {
        return $this->belongsTo(JenisLokasi::class);
    }

    public function statusKegiatan()
    {
        return $this->belongsTo(StatusKegiatan::class);
    }

    public function tahapan()
    {
        return $this->belongsTo(Tahapan::class);
    }

    public function firstCreate()
    {
        return $this->belongsTo(User::class, 'first_create_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function bidangUrusan()
    {
      return $this->belongsTo(BidangUrusan::class);
    }

    public function opdPelaksana()
    {
        return $this->belongsTo(Opd::class, 'opd_pelaksana_id');
    }

    public function targetAnggaran()
    {
        return $this->hasMany(TargetAnggaran::class);
    }

    public function scopeAllByUser($query)
    {
        return $query->whereUserId(auth()->user()->id);
    }

    public function scopeTahapanAndIsKelurahan($query, $name_tahapan, $is_kelurahan = false)
    {
        $tahapan = Tahapan::whereNama($name_tahapan)->firstOrFail();

        return $query->whereTahapanId($tahapan->id)->whereIsKelurahan($is_kelurahan);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query
                ->WhereHas(
                    'kegiatan', function ($q2) use ($search) {
                        $q2->where('nama', 'like', '%'.$search.'%');
                    })
                ->orWhere('lokasi', 'like', '%'.$search.'%');
        }

        return $query;
    }

    public function districtOpd()
    {
        return $this->belongsTo(Opd::class, 'district_id', 'id');
    }

    public function villageOpd()
    {
        return $this->belongsTo(Opd::class, 'village_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Villages::class, 'village_id');
    }

    public function scopeWithLaporan($query)
    {
        return $query
            ->with('user')
            ->with('kegiatan')
            ->with('sumberAnggaran')
            ->with('opd')
            ->with('districtOpd')
            ->with('villageOpd')
            ->with('opdPelaksana')
            ->with('firstCreate')
            ->with('targetAnggaran')
            ->with('sumberAnggaran')
            ->with('targetAnggaran.indikatorKegiatan')
            ->with('targetAnggaran.indikatorKegiatan.satuan')
            ->with('bidangurusan');
    }
}
