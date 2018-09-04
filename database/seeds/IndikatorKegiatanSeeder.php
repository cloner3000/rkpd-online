<?php

use Illuminate\Database\Seeder;
use App\IndikatorKegiatan;

class IndikatorKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\indikator_kegiatan.csv');
        $arr  = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++) {
            IndikatorKegiatan::firstOrCreate($arr[$i]);
        }
    }
}
