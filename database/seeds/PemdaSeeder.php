<?php

use Illuminate\Database\Seeder;
use App\Admin\Pemda;

class PemdaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\pemda.csv');
        $arr  = csvToArray($file);
        for ($i = 0; $i < count($arr); $i ++)
        {
            Pemda::firstOrCreate($arr[$i]);
        }
    }
}
