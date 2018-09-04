<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file       = storage_path('app\seeder\users.csv');
        $file_roles = storage_path('app\seeder\role_user.csv');
        $arr        = csvToArray($file);
        $arr_roles  = csvToArray($file_roles);

        $this->seederPermissionAdmin();

        for ($i = 0; $i < count($arr); $i ++) {
            $arr[$i]['password'] = Hash::make($arr[$i]['password']);
            $user = User::firstOrCreate($arr[$i]);
            $this->createAdminRolesAndPermission($user, $arr_roles[$i]);
        }
    }

    private function createAdminRolesAndPermission($user, $user_role)
    {
        if ($user->id = $user_role['user_id']) {
            $role = Role::find($user_role['role_id']);
            if (!empty($role)) {
                $user->assignRole($role->name);
            }
        }
    }

    private function seederPermissionAdmin()
    {
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        $role = Role::findByName('Administrator');
        $role->givePermissionTo('create roles', 'edit roles', 'update roles', 'delete roles');
    }
}
