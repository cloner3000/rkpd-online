<?php

use Illuminate\Database\Seeder;
use App\Kegiatan;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\kegiatan.csv');

        $arr = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++)
        {
            Kegiatan::firstOrCreate($arr[$i]);
        }
    }
}
