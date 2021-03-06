<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'Modules\\AdminUsers\\Database\\Seeders\\AdminUsersDatabaseSeeder' => $baseDir . '/Database/Seeders/AdminUsersDatabaseSeeder.php',
    'Modules\\AdminUsers\\Filters\\UsersFilter' => $baseDir . '/Filters/UsersFilter.php',
    'Modules\\AdminUsers\\Http\\Controllers\\AdminUsersController' => $baseDir . '/Http/Controllers/AdminUsersController.php',
    'Modules\\AdminUsers\\Http\\Controllers\\Settings\\PermissionsSettingsController' => $baseDir . '/Http/Controllers/Settings/PermissionsSettingsController.php',
    'Modules\\AdminUsers\\Http\\Controllers\\Settings\\RolesSettingsController' => $baseDir . '/Http/Controllers/Settings/RolesSettingsController.php',
    'Modules\\AdminUsers\\Http\\Controllers\\Settings\\UserSettingsController' => $baseDir . '/Http/Controllers/Settings/UserSettingsController.php',
    'Modules\\AdminUsers\\Http\\Requests\\Settings\\RoleSettingsRequest' => $baseDir . '/Http/Requests/Settings/RoleSettingsRequest.php',
    'Modules\\AdminUsers\\Http\\Requests\\Settings\\UserSettingsRequest' => $baseDir . '/Http/Requests/Settings/UserSettingsRequest.php',
    'Modules\\AdminUsers\\Providers\\AdminUsersServiceProvider' => $baseDir . '/Providers/AdminUsersServiceProvider.php',
    'Modules\\AdminUsers\\Providers\\RouteServiceProvider' => $baseDir . '/Providers/RouteServiceProvider.php',
    'Modules\\AdminUsers\\Services\\UserService' => $baseDir . '/Services/UserService.php',
    'Modules\\AdminUsers\\Transformers\\PermissionResource' => $baseDir . '/Transformers/PermissionResource.php',
    'Modules\\AdminUsers\\Transformers\\RoleResource' => $baseDir . '/Transformers/RoleResource.php',
    'Modules\\AdminUsers\\Transformers\\UserResource' => $baseDir . '/Transformers/UserResource.php',
    'Modules\\AdminUsers\\Transformers\\UsersResource' => $baseDir . '/Transformers/UsersResource.php',
);
