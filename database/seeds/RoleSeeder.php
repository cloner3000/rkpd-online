<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app\seeder\roles.csv');
        $arr  = csvToArray($file);
        for ($i = 0; $i < count($arr); $i ++)
        {
            Role::firstOrCreate($arr[$i]);
        }
    }
}
