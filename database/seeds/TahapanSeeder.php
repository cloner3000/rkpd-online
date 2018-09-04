<?php

use Illuminate\Database\Seeder;
use App\Tahapan;
use Carbon\Carbon;

class TahapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\tahapan.csv');
        $arr  = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++) {
            $mulai   = new Carbon($arr[$i]['mulai']);
            $selesai = new Carbon($arr[$i]['selesai']);
            $arr[$i]['mulai']   = $mulai;
            $arr[$i]['selesai'] = $selesai;
            Tahapan::firstOrCreate($arr[$i]);
        }
    }
}
