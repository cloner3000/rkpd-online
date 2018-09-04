<?php

use Illuminate\Database\Seeder;
use App\SumberAnggaran;

class SumberAnggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\sumber_anggaran.csv');

        $arr = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++)
        {
            SumberAnggaran::firstOrCreate($arr[$i]);
        }
    }
}
