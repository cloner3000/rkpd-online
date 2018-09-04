<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class Roles extends Enum
{
    const ADMIN     = 'Administrator';
    const OPD       = 'OPD';
    const KECAMATAN = 'Kecamatan';
    const KELURAHAN = 'Kelurahan';
    const DESA      = 'Desa';
    const DPRD      = 'Anggota DPRD';
    const BPE       = 'Bidang Penelitian dan Evaluasi';
    const BPMM      = 'Bidang Pembangunan Manusia dan Masyarakat';
    const BES       = 'Bidang Ekonomi dan SDA';
    const BIPW      = 'Bidang Infrastruktur dan Pengembangan Wilayah';
    const BIDANG    = 'Bidang';
    const PUBLIK    = 'Publik';
    const TAPD      = 'TAPD';
}
