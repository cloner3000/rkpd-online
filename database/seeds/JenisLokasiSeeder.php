<?php

use Illuminate\Database\Seeder;

class JenisLokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrays = [
            ['nama' => 'Kantor OPD'],
            ['nama' => 'Seluruh Kabupaten Sukabumi'],
            ['nama' => 'Kecamatan di Kabupaten Sukabumi'],
            ['nama' => 'Luar Kabupaten Sukabumi'],
            ['nama' => 'Luar Negeri'],
        ];

        foreach ($arrays as $array) {
            DB::table('jenis_lokasi')->insert($array);
        }
    }
}
