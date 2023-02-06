<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //permission for posts
       Permission::create(['name' => 'permissions.index']);
       Permission::create(['name' => 'permissions.create']);
       Permission::create(['name' => 'permissions.edit']);
       Permission::create(['name' => 'permissions.delete']);

       //permission for tags
       Permission::create(['name' => 'roles.index']);
       Permission::create(['name' => 'roles.create']);
       Permission::create(['name' => 'roles.edit']);
       Permission::create(['name' => 'roles.delete']);

       //permission for categories
       Permission::create(['name' => 'users.index']);
       Permission::create(['name' => 'users.create']);
       Permission::create(['name' => 'users.edit']);
       Permission::create(['name' => 'users.delete']);
    }
}
