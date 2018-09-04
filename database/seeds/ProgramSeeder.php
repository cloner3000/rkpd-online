<?php

use Illuminate\Database\Seeder;
use App\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\program.csv');

        $arr = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++)
        {
            Program::firstOrCreate($arr[$i]);
        }
    }
}
