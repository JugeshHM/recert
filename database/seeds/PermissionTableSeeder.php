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
            array('name' => 'create-role', 'display_name' => 'Create Role', 'description' => 'Create a Role'),
            array('name' => 'update-role', 'display_name' => 'Update Role', 'description' =>'Update a Role'),
            array('name' => 'delete-role', 'display_name' => 'Delete Role', 'description' =>'Delete a Role')
        );

        // Loop through each permission above and create the record for them in the database
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

    }
}
