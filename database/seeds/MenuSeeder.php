<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = \Spatie\Permission\Models\Role::findByName('Administrator', 'web');

        $musrenbangDesa = 'Musrenbang Desa';
        DB::table('menu')->insert([
            'nama' => $musrenbangDesa,
            'url' => 'musrenbang/musrenbang-desa',
            'icon' => 'flaticon-suitcase',
            'urutan' => 1,
            'aktif' => true,
        ]);
        Permission::create(['name' => create_permission_name($musrenbangDesa), 'guard_name' => 'web']);

        $role->givePermissionTo(create_permission_name($musrenbangDesa));

        $musrenbangKelurahan = 'Musrenbang Kelurahan';
        DB::table('menu')->insert([
            'nama' => $musrenbangKelurahan,
            'url' => 'musrenbang/musrenbang-kelurahan',
            'icon' => 'flaticon-comment',
            'urutan' => 2,
            'aktif' => true,
        ]);
        Permission::create(['name' => create_permission_name($musrenbangKelurahan), 'guard_name' => 'web']);
        $role->givePermissionTo(create_permission_name($musrenbangKelurahan));

        $dewan = 'Pokok Pikiran Dewan';
        DB::table('menu')->insert([
            'nama' => $dewan,
            'url' => 'musrenbang/musrenbang-dewan',
            'icon' => 'flaticon-comment',
            'urutan' => 3,
            'aktif' => true,
        ]);
        Permission::create(['name' => create_permission_name($dewan), 'guard_name' => 'web']);
        $role->givePermissionTo(create_permission_name($dewan));

        $kecamatan = 'Musrenbang Kecamatan';
        DB::table('menu')->insert([
            'nama' => $kecamatan,
            'url' => 'musrenbang/musrenbang-kecamatan',
            'icon' => 'flaticon-comment',
            'urutan' => 4,
            'aktif' => true,
        ]);
        Permission::create(['name' => create_permission_name($kecamatan), 'guard_name' => 'web']);
        $role->givePermissionTo(create_permission_name($kecamatan));

        $awal = 'Rancangan Awal';
        DB::table('menu')->insert([
            'nama' => $awal,
            'icon' => 'flaticon-list-1',
            'url' => 'rancangan/awal',
            'urutan' => 5,
            'aktif' => true,
        ]);
        Permission::create(['name' => create_permission_name($awal), 'guard_name' => 'web']);
        $role->givePermissionTo(create_permission_name($awal));

        $raker = 'Rencana Kerja';
        DB::table('menu')->insert([
            'nama' => $raker,
            'icon' => 'flaticon-line-graph',
            'url' => 'rancangan/kerja',
            'urutan' => 6,
            'aktif' => true,
        ]);
        Permission::create(['name' => create_permission_name($raker), 'guard_name' => 'web']);
        $role->givePermissionTo(create_permission_name($raker));

        $kab = 'Musrendbang Kabupaten';
        DB::table('menu')->insert([
            'nama' => $kab,
            'url' => 'musrenbang/musrenbang-kabupaten',
            'icon' => 'flaticon-map',
            'urutan' => 7,
            'aktif' => true,
        ]);
        Permission::create(['name' => create_permission_name($kab), 'guard_name' => 'web']);
        $role->givePermissionTo(create_permission_name($kab));

        $akhir = 'Rancangan Akhir';
        DB::table('menu')->insert([
            'nama' => $akhir,
            'url' => 'rancangan/akhir',
            'icon' => 'flaticon-lock',
            'urutan' => 8,
            'aktif' => true,
        ]);
        Permission::create(['name' => create_permission_name($akhir), 'guard_name' => 'web']);
        $role->givePermissionTo(create_permission_name($akhir));

    }
}
