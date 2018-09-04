<?php

use Illuminate\Database\Seeder;
use App\CapaianProgram;

class CapaianProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\capaian_program.csv');

        $arr = csvToArray($file);

        for ($i = 0; $i < count($arr); $i ++)
        {
            CapaianProgram::firstOrCreate($arr[$i]);
        }
    }
}
