<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(DistrictsSeeder::class);
        $this->call(VillagesSeeder::class);
        $this->call(VisiSeeder::class);
        $this->call(MisiSeeder::class);
        $this->call(PemdaSeeder::class);
        $this->call(JenisLokasiSeeder::class);
        $this->call(SumberAnggaranSeeder::class);
        $this->call(UrusanSeeder::class);
        $this->call(IndikatorHasilSeeder::class);
        $this->call(TahapanSeeder::class);
        $this->call(StatusKegiatanSeeder::class);
        $this->call(SatuanSeeder::class);
        $this->call(BidangUrusanSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(CapaianProgramSeeder::class);
        $this->call(TujuanSeeder::class);
        $this->call(SasaranSeeder::class);
        $this->call(IndikatorSasaranSeeder::class);
        $this->call(KegiatanSeeder::class);
        $this->call(IndikatorKegiatanSeeder::class);
        $this->call(JenisOpdSeeder::class);
        $this->call(OpdSeeder::class);
    }
}
