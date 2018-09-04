<?php

use Illuminate\Database\Seeder;
use App\Urusan;

class UrusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\urusan.csv');
        $arr  = csvToArray($file);
        $visi = \App\Admin\Visi::first();
        if (!empty($visi)) {
            for ($i = 0; $i < count($arr); $i ++)
            {
                if (empty( $arr[$i]['visi_id'])) {
                    $arr[$i]['visi_id'] = $visi->id;
                }

                Urusan::firstOrCreate($arr[$i]);
            }
        }
    }
}
