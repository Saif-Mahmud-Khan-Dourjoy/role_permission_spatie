<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create role
        $roleSuperAdmin = Role::create(['name' => 'superAdmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        
        $roleAuthor = Role::create(['name' => 'author']);
        $roleUser = Role::create(['name' => 'user']);

        //create Permission Array list
        $permissions=[

            [ 
             'group_name'=>'Dashboard',
             'permission_name'=>[
              'dashboard.view',
              'dashboard.edit',
          ],
      ],

      [
         'group_name'=>'Blog',
         'permission_name'=>[
          'blog.create',
          'blog.view',
          'blog.edit',
          'blog.delete',
          'blog.approve',
      ],
  ],

  [
     'group_name'=>'Role',
     'permission_name'=>[
      'role.create',
      'role.view',
      'role.edit',
      'role.delete',
      'role.approve',
  ],
],

[
 'group_name'=>'Admin',
 'permission_name'=>[
  'admin.create',
  'admin.view',
  'admin.edit',
  'admin.delete',
  'admin.approve',
],
],
[
 'group_name'=>'Profile',
 'permission_name'=>[

  'profile.create',
  'profile.view',
],
],


];

        //Create Permission && Assign permission to Role

for ($i=0; $i <count($permissions); $i++) { 

    $group_name=$permissions[$i]['group_name'];
    $permission_name_array=$permissions[$i]['permission_name'];

    for($j=0; $j <count($permission_name_array); $j++){
        $permission = Permission::create(['group_name' => $group_name , 'name'=> $permission_name_array[$j]]);
        $roleSuperAdmin->givePermissionTo($permission);
        $permission->assignRole($roleSuperAdmin);
    }


}


}
}
