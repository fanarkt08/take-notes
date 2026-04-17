<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $permission = Permission::create(['name' => 'manage notes']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($permission);

        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('ophee_admin-Fana01#'),
        ]);
        $admin->assignRole('admin');

        User::create([
            'name'     => 'Test User',
            'email'    => 'test@example.com',
            'password' => Hash::make('ophee_user-Fana012#'),
        ]);
    }
}
