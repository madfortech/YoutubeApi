<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Manager']);
        $role3 = Role::create(['name' => 'Writer']);
        $role4 = Role::create(['name' => 'User']);

        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create permissions
        Permission::create(['name' => 'edit-articles']);
        Permission::create(['name' => 'delete-articles']);

      

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($role3);
        $role3->givePermissionTo('edit-articles');
        $role3->givePermissionTo('delete-articles');

        $user = \App\Models\User::factory()->create([
            'name' => 'Writer',
            'email' => 'writer@example.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($role3);
        $user->givePermissionTo('edit-articles');

        $user = \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($role4);
    }
}
