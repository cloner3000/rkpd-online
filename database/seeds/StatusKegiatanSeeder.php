<?php

use Illuminate\Database\Seeder;
use App\StatusKegiatan;

class StatusKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\status_kegiatan.csv');
        $arr  = csvToArray($file);
        for ($i = 0; $i < count($arr); $i ++)
        {
            StatusKegiatan::firstOrCreate($arr[$i]);
        }
    }
}
