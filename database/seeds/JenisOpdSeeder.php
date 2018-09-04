<?php

use Illuminate\Database\Seeder;
use App\JenisOpd;

class JenisOpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\jenis_opd.csv');

        $arr = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++)
        {
            JenisOpd::firstOrCreate($arr[$i]);
        }
    }
}
