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
               ['name' => 'create-role', 'display_name' => 'create-role', 'description' =>'create-role'],
               ['name' => 'update-role', 'display_name' => 'update-role', 'description' =>'update-role'],
               ['name' => 'delete-role', 'display_name' => 'delete-role', 'description' =>'delete-role'],
           );

           // Loop through each user above and create the record for them in the database
           foreach ($permissions as $permission)
           {
               Permission::create($permission);
           }

    }
}
