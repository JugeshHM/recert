<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;
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
        DB::table('role_user')->delete();

        $role = Role::where('name', '=', 'admin')
            ->select('id')
            ->first();
        $user = User::where('name', '=', 'admin')
            ->select('id')
            ->first();

        $roles_user = array(
            'user_id' => $user->id,
            'role_id' => $role->id
        );

        RoleUser::create($roles_user);

    }
}
