<?php

namespace Database\Seeders;

use App\Constants\RoleTypes;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $admin = User::create([
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'admin'
            ]);

            $admin->syncRoles(Role::findByName(RoleTypes::ADMIN_TYPE));
        } catch (\Exception $e){
            dump($e->getMessage());
        }
    }
}
