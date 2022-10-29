<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
        DB::beginTransaction();
        try {
            $staf = User::create(array_merge([
                'email' => 'staf@gmail.com',
                'name'  => 'staf',
            ], $default_user_value));

            $spv = User::create(array_merge([
                'email' => 'spv@gmail.com',
                'name'  => 'spv',
            ], $default_user_value));

            $manager = User::create(array_merge([
                'email' => 'manager@gmail.com',
                'name'  => 'manager',
            ], $default_user_value));

            $role = Role::create(['name' => 'staff']);
            $role = Role::create(['name' => 'spv']);
            $role = Role::create(['name' => 'manager']);

            $permission = Permission::create(['name' => 'read role']);
            $permission = Permission::create(['name' => 'create role']);
            $permission = Permission::create(['name' => 'update role']);
            $permission = Permission::create(['name' => 'delete role']);

            $staf->assignRole('staff');
            $spv->assignRole('spv');
            $manager->assignRole('manager');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
