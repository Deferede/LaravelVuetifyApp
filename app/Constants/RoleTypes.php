<?php


namespace App\Constants;


final class RoleTypes
{
    const ADMIN_TYPE = 'admin';
    const DEFAULT_USER_TYPE = 'user';

    public static function getAllRoles()
    {
        return [
            self::ADMIN_TYPE => "Администратор",
            self::DEFAULT_USER_TYPE => "Пользователь"
        ];
    }
}
