<?php

use Illuminate\Database\Seeder;
use App\Opd;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\opd.csv');

        $arr = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++)
        {
            Opd::firstOrCreate($arr[$i]);
        }

        $user = \App\User::find(174);
        $opd = Opd::find(171);

        $user->opd()->attach($opd);
        $user->save();

        $bapeeda =\App\User::find(3);
        $bapeeda->opd()->attach($opd);
        $bapeeda->save();
    }
}
