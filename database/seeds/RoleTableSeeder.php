<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        DB::table('roles')->delete();

        $roles = array(
            ['name' => 'admin', 'display_name' => 'Administrator', 'description' =>'Administrator'],
            ['name' => 'employee', 'display_name' => 'Employee', 'description' =>'employee'],
            ['name' => 'employer', 'display_name' => 'Employer', 'description' =>'employer']
        );

        // Loop through each user above and create the record for them in the database
        foreach ($roles as $role)
        {
            Role::create($role);
        }

    }
}
