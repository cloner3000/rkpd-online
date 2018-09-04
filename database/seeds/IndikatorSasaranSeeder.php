<?php

use Illuminate\Database\Seeder;
use App\Admin\IndikatorSasaran;

class IndikatorSasaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\indikator_sasaran.csv');

        $arr = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++)
        {
            IndikatorSasaran::firstOrCreate($arr[$i]);
        }
    }
}
