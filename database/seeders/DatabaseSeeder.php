<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::create([
            'name'     => 'Tarequr Rahman Sabbir',
            'email'    => 'superadmin@app.com',
            'password' => Hash::make('password')
        ]);

        \App\Models\User::create([
            'name'     => 'Tayebur Rahman Sabbir',
            'email'    => 'admin@app.com',
            'password' => Hash::make('password')
        ]);

        $permissions = [
            'categories.index',
            'categories.create',
            'categories.show',
            'categories.update',
            'categories.delete',

            'sub-categories.index',
            'sub-categories.create',
            'sub-categories.show',
            'sub-categories.update',
            'sub-categories.delete',

            'brands.index',
            'brands.create',
            'brands.show',
            'brands.update',
            'brands.delete',

            'units.index',
            'units.create',
            'units.show',
            'units.update',
            'units.delete',
        ];

        $permissions = collect($permissions)->map(function ($permission) {
            return [
                'name' => $permission,
                'guard_name' => 'web'
            ];
        });

        Permission::insert($permissions->toArray());
        Role::create(['name' => 'Super Admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Admin'])->givePermissionTo([
            'categories.index',
            'categories.create',
            'categories.show',
            'categories.update',
            'categories.delete',
        ]);

        // User::find(1)->assignRole(['Super Admin','Admin']); //assign multiple role to super admin
        User::find(1)->assignRole('Super Admin');
        User::find(2)->assignRole('Admin');
    }
}
