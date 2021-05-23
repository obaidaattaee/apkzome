<?php

use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::create([
            'name' => 'super_admin',
            'display_name' => 'Super Admin',
            'description' => 'this user can access dashboard as make management users',
        ]);
        $customerRole = Role::create([
            'name' => 'customer',
            'display_name' => 'Customer',
            'description' => 'this user can\'nt access dashboard',
        ]);
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'this user can do any think',
        ]);
        $superAdmin = User::create([
            'name' => 'super admin',
            'email' => 'super-admin@admin.com',
            'password' => bcrypt(12345678),
        ]);
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt(12345678),
        ]);
        $customer = User::create([
            'name' => 'customer',
            'email' => 'customer@customer.com',
            'password' => bcrypt(12345678),
        ]);
        $superAdmin->roles()->sync([$superAdminRole->id , $adminRole->id , $customerRole->id]);
        $admin->roles()->sync([$adminRole->id]);
        $customer->roles()->sync([$customerRole->id]);
    }
}
