<?php

use Illuminate\Database\Seeder;
use App\Admin\Misi;

class MisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\misi.csv');
        $arr  = csvToArray($file);
        for ($i = 0; $i < count($arr); $i ++)
        {
            Misi::firstOrCreate($arr[$i]);
        }
    }
}
