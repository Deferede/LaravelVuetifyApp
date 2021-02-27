<?php

namespace Database\Seeders;

use App\Constants\Permissions;
use App\Constants\RoleTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permissions::getAllPermissions();

        $permissionsCount = 0;
        foreach ($permissions as $app => $permissionGroup) {
            foreach ($permissionGroup as $group) {
                $permissionsCount += count($group);
            }
        }

        $bar = $this->command->getOutput()->createProgressBar($permissionsCount);

        $bar->start();
        foreach ($permissions as $app => $permissionGroup) {
            foreach ($permissionGroup as $group => $p_items) {
                foreach ($p_items as $p_name => $p_dname) {
                    try {
                        Permission::create(['name' => "$app.$group-$p_name", 'dname' => $p_dname]);
                        $bar->advance();
                    } catch (\Exception $e) {
                        dump($e->getMessage());
                    }
                }
            }
        }
        $bar->finish();
        echo PHP_EOL;
        Role::findByName(RoleTypes::ADMIN_TYPE)->syncPermissions(Permission::all());
    }
}
