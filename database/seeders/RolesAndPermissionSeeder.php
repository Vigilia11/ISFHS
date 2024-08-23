<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create facility']);
        Permission::create(['name' => 'read facility']);
        Permission::create(['name' => 'update facility']);
        Permission::create(['name' => 'delete facility']);

        Permission::create(['name' => 'create rate']);
        Permission::create(['name' => 'read rate']);
        Permission::create(['name' => 'update rate']);
        Permission::create(['name' => 'delete rate']);

        Permission::create(['name' => 'create comment']);
        Permission::create(['name' => 'read comment']);
        Permission::create(['name' => 'update comment']);
        Permission::create(['name' => 'delete comment']);

        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

         // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'student']);
        $role1->givePermissionTo('read facility');
        $role1->givePermissionTo('create rate');
        $role1->givePermissionTo('read rate');
        $role1->givePermissionTo('update rate');
        $role1->givePermissionTo('create comment');
        $role1->givePermissionTo('read comment');
        $role1->givePermissionTo('update comment');
        $role1->givePermissionTo('delete comment');

        $role2 = Role::create(['name' => 'facilitator']);
        $role2->givePermissionTo('create facility');
        $role2->givePermissionTo('read facility');
        $role2->givePermissionTo('update facility');
        $role2->givePermissionTo('delete facility');
        $role2->givePermissionTo('create comment');
        $role2->givePermissionTo('read comment');
        $role2->givePermissionTo('update comment');
        $role2->givePermissionTo('delete comment');

        $role3 = Role::create(['name' => 'moderator']);
        $role3->givePermissionTo('read user');
        $role3->givePermissionTo('delete user');
        $role3->givePermissionTo('read facility');
        $role3->givePermissionTo('update facility');
        $role3->givePermissionTo('delete facility');
        $role3->givePermissionTo('read comment');
        $role3->givePermissionTo('delete comment');

        $role4 = Role::create(['name' => 'admin']);

    }
}
