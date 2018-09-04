<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class Tahapan extends Enum
{
    const USULAN_MASYARAKAT     = 'Usulan Masyarakat';
    const POKOK_PIKIRAN_DEWAN   = 'Pokok Pikiran Dewan';
    const DESA                  = 'Musrenbang Desa/Kelurahan';
    const KECAMATAN             = 'Musrenbang Kecamatan';
    const RANCANGAN_AWAL        = 'Rancangan Awal Renja';
    const RANCANGAN_RENJA       = 'Rancangan Renja';
    const KABUPATEN             = 'Musrenbang Kabupaten';
    const RANCANGAN_AKHIR       = 'Rancangan Akhir Renja';
    const RANCANGAN_KUA_PPAS    = 'Rancangan KUA PPAS';
    const KUA_PPAS              = 'KUA PPAS';
}
