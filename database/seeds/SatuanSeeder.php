<?php

use Illuminate\Database\Seeder;
use App\Satuan;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $file = storage_path('app\seeder\satuan.csv');
//
//        $arr = csvToArray($file);
//
//        for ($i = 0; $i < count($arr); $i ++)
//        {
//            Satuan::firstOrCreate($arr[$i]);
//        }

        $json = File::get(storage_path('app\seeder\satuan.json'));
        $items = json_decode($json);
        foreach ($items as $item) {
            $satuan = New Satuan();
            $satuan->id = $item->id;
            $satuan->nama = $item->nama;
            $satuan->save();
        }
    }
}
