<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        DB::table('permissions')->delete();

        $permissions = array(
            array('name' => 'get-user', 'display_name' => 'Create User', 'description' => 'Create a User'),
            array('name' => 'update-user', 'display_name' => 'Update User', 'description' =>'Update a User'),
            array('name' => 'delete-user', 'display_name' => 'Delete User', 'description' =>'Delete a User'),
            
            array('name' => 'create-role', 'display_name' => 'Create Role', 'description' => 'Create a Role'),
            array('name' => 'update-role', 'display_name' => 'Update Role', 'description' =>'Update a Role'),
            array('name' => 'delete-role', 'display_name' => 'Delete Role', 'description' =>'Delete a Role'),

            array('name' => 'create-state', 'display_name' => 'Create State', 'description' => 'Create a State'),
            array('name' => 'update-state', 'display_name' => 'Update State', 'description' =>'Update a State'),
            array('name' => 'delete-state', 'display_name' => 'Delete State', 'description' =>'Delete a State')
        );

        // Loop through each permission above and create the record for them in the database
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

    }
}
