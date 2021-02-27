<?php

namespace Database\Seeders;

use App\Constants\RoleTypes;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->afterCreating(function (User $fakeUser) {
            try {
                $fakeUser->syncRoles(RoleTypes::DEFAULT_USER_TYPE);
            } catch (\Exception $exception) {
                dump($exception->getMessage());
                $fakeUser->forceDelete();
            }
        })->create();
    }
}
