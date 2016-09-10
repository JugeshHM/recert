<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\RoleUser;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = DB::table('roles')
                          ->select('id')
                          ->where('name', '=', 'admin')
                          ->first();
        $user = DB::table('users')
                          ->select('id')
                          ->where('name', '=', 'admin')
                          ->first();

        $roles_user = array(
                              ['user_id' => $user->id, 'role_id' =>$role->id],
                          );
         DB::table('role_user')->insert($roles_user);

    }
}
