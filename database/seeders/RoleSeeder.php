<?php

namespace Database\Seeders;

use App\Constants\RoleTypes;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (RoleTypes::getAllRoles() as $name => $dname) {
            try {
                Role::create(['name' => $name, 'dname' => $dname]);
                echo $name. " created" . PHP_EOL;
            } catch (\Exception $e) {
                dump($e->getMessage());
            }
        }
    }
}
