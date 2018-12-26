<?php

namespace App\Services;

use App\Anggaran;
use App\Enum\Roles;
use App\Tahapan;
use App\Enum\Tahapan as TahapanName;

class DashboardService
{
    public function index()
    {
        $user     = auth()->user();
        $tahapans = Tahapan::orderBy('id', 'ASC');

        switch ($user) {
            case $user->hasRole(Roles::DESA):
                $tahapans = $tahapans->whereNama(TahapanName::DESA);
                break;
            case $user->hasRole(Roles::KELURAHAN):
                $tahapans = $tahapans->whereNama(TahapanName::DESA);
                break;
            case $user->hasRole(Roles::KECAMATAN):
                $tahapans = $tahapans->whereIn('nama', array(
                    TahapanName::KECAMATAN,
                    TahapanName::DESA,
                    TahapanName::RANCANGAN_AWAL,
                    TahapanName::RANCANGAN_RENJA,
                    TahapanName::KABUPATEN,
                    TahapanName::RANCANGAN_AKHIR,
                ));
                break;
            case $user->hasRole(Roles::OPD):
                $tahapans = $tahapans->whereIn('nama', array(
                    TahapanName::POKOK_PIKIRAN_DEWAN,
                    TahapanName::KECAMATAN,
                    TahapanName::RANCANGAN_AWAL,
                    TahapanName::RANCANGAN_RENJA,
                    TahapanName::KABUPATEN,
                    TahapanName::RANCANGAN_AKHIR,
                ));
                break;
            case $user->hasRole(Roles::DPRD):
                $tahapans = $tahapans->where('nama', '=', TahapanName::POKOK_PIKIRAN_DEWAN);
                break;
            case $user->hasRole(Roles::TAPD):
                $tahapans = $tahapans->whereIn('nama', array(
                    TahapanName::RANCANGAN_KUA_PPAS,
                    TahapanName::KUA_PPAS,
                ));
                break;
        }

        $tahapans = $tahapans->where('id', '!=', 1)->pluck('nama', 'id');

        foreach ($tahapans as $key => $tahapan) {
            $items[$key] = [
                'total' => $this->getData($key, $tahapan)->count(),
                'transfer' => $this->getData($key, $tahapan)->whereIsTransfer(true)->count()
            ];
        }

        return $items;
    }

    public function getData($tahapan, $tahapan_name)
    {
        $user = auth()->user();
        $items = Anggaran::whereTahapanId($tahapan);

        if ($user->hasRole(Roles::DESA)) {
            $items = $items->AllByUser();
        }

        if ($user->hasRole(Roles::KELURAHAN)) {
            $items = $items->AllByUser();
        }

        if ($user->hasRole(Roles::KECAMATAN) && $user->opd->first()) {
            $query = '%Kecamatan: '.strtoupper($user->name).',%';
            $items = $items->where('lokasi', 'like' , $query);
        }

        if ($user->hasRole(Roles::OPD) && $user->opd->first()) {
            if ($tahapan_name == TahapanName::POKOK_PIKIRAN_DEWAN || $tahapan_name == TahapanName::KECAMATAN) {
                $items = $items->whereOpdId($user->opd()->first()->id);
            }
        }

        if ($tahapan_name == TahapanName::RANCANGAN_AWAL) {
            if ($user->hasRole(Roles::KECAMATAN) || $user->hasRole(Roles::OPD)) {
                $items = $items->AllByUser();
            }
        }

        if ($tahapan_name == TahapanName::RANCANGAN_RENJA) {
            if ($user->hasRole(Roles::KECAMATAN) || $user->hasRole(Roles::OPD)) {
                $items = $items->AllByUser();
            }
        }

        if ($tahapan_name == TahapanName::RANCANGAN_AKHIR && $user->hasRole(Roles::OPD)) {
            $items = $items->AllByUser();
        }

        if ($tahapan_name == TahapanName::KABUPATEN) {
            if ($user->hasRole(Roles::OPD)) {
                $items = $items->AllByUser();
            }
        }

        return $items;
    }
}
