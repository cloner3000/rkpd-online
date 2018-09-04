<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tahapan extends Model
{
    protected $table = 'tahapan';

    protected $fillable = ['nama', 'mulai', 'selesai'];

    protected $dates = ['mulai', 'selesai'];

    public function canEntry($tahapan)
    {
        $tahapan = $this->whereNama($tahapan)->first();
        if (! $tahapan) {
            return false;
        }
        if (Carbon::now()->between(Carbon::parse($tahapan->mulai), Carbon::parse($tahapan->selesai))) {
            return true;
        }
        return false;
    }

    public function canTransfer($tahapan)
    {
        $tahapan = $this->whereNama($tahapan)->first();
        if (! $tahapan) {
            return false;
        }
        if (Carbon::now()->between(Carbon::parse($tahapan->mulai), Carbon::parse($tahapan->selesai))) {
            return true;
        }
        return false;
    }

}
