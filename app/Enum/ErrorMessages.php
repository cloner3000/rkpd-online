<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class ErrorMessages extends Enum
{
    const CLOSED_ENTRY = 'Proses entri data di tutup. Untuk informasi lebih lanjut hubungi administrator!';
    const IS_TRANSFER  = 'Data Sudah Ditransfer !';
    const DISTRICT_NOT_FOUND = 'Anda tidak memiliki Kecamatan';
    const VILLAGE_NOT_FOUND  = 'Anda tidak memliki Desa /Kelurahan';
}