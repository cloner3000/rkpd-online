<?php

use Illuminate\Database\Seeder;
use App\Admin\Tujuan;

class TujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\tujuan.csv');

        $arr = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++)
        {
            Tujuan::firstOrCreate($arr[$i]);
        }
    }
}
