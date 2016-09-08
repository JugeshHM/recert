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
        //
        $permissions = DB::table('permissions')
            ->select('id')
            ->get();
        $role = DB::table('roles')
            ->select('id')
            ->where('name', '=', 'admin')
            ->first();

        foreach ($permissions as $key => $value) {
            DB::table('permission_role')->insert(
                ['permission_id' => $value->id, 'role_id' =>$role->id]
            );
        }
    }
}
