<?php

use Illuminate\Database\Seeder;

class VillagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\kelurahan.csv');

        $arr = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++)
        {
            $arr[$i]['district_id'] = substr($arr[$i]['id'], 0,7);
            \App\location\Villages::firstOrCreate($arr[$i]);
        }


        $file = storage_path('app\seeder\desa.csv');

        $arr = csvToArray($file);

        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i]['district_id'] = substr($arr[$i]['id'], 0,7);
            \App\location\Villages::firstOrCreate($arr[$i]);
        }
    }
}
