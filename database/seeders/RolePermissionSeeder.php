<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['view tickets', 'manage tickets', 'manage users'] as $name) {
            Permission::findOrCreate($name);
        }

        Role::findOrCreate('admin')->syncPermissions(Permission::all());
        Role::findOrCreate('supervisor')->syncPermissions(['view tickets', 'manage tickets']);
        Role::findOrCreate('staff')->syncPermissions(['view tickets']);

        $user = User::where('email', 'test@example.com')->first();
        $user?->assignRole('admin');
    }
}
