<?php

use Illuminate\Database\Seeder;
use App\Admin\Sasaran;

class SasaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\sasaran.csv');

        $arr = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++)
        {
            Sasaran::firstOrCreate($arr[$i]);
        }
    }
}
