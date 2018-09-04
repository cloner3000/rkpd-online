<?php

use Illuminate\Database\Seeder;
use App\Admin\Visi;

class VisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\visi.csv');
        $arr  = csvToArray($file);
        for ($i = 0; $i < count($arr); $i ++)
        {
            Visi::firstOrCreate($arr[$i]);
        }
    }
}
