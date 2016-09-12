<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\PermissionRole;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->delete();

        $permissions = Permission::select('id')
            ->get();

        $role = Role::where('name', '=', 'admin')
            ->select('id')
            ->first();

        foreach ($permissions as $key => $value) {
            $permission_role = array(
                'permission_id' => $value->id,
                'role_id' => $role->id
            );
            PermissionRole::create($permission_role);
        }
    }
}
