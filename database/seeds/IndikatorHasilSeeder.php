<?php

use Illuminate\Database\Seeder;
use App\IndikatorHasil;
class IndikatorHasilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\indikator_hasil.csv');
        $arr  = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++) {
            IndikatorHasil::firstOrCreate($arr[$i]);
        }
    }
}
