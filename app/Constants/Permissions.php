<?php


namespace App\Constants;


final class Permissions
{
    public const PERMISSIONS = [
        'crm' => [
            'users' => [
                'list' => 'Просмотр юзеров',
                'create' => 'Создание юзеров',
                'edit' => 'Редактирование юзеров',
                'delete' => 'Удаление юзеров',
            ],
            'permissions' => [
                'list' => 'Просмотр прав доступа',
            ],
            'roles' => [
                'list' => 'Просмотр ролей',
                'edit' => 'Редактирование ролей',
            ],
            'statuses' => [
                'list' => 'Просмотр статусов',
                'create' => 'Создание статусов',
                'edit' => 'Редактирование статусов',
                'delete' => 'Удаление статусов',
            ],
            'status_types' => [
                'list' => 'Просмотр типов статусов',
                'create' => 'Создание типов статусов',
                'edit' => 'Редактирование типов статусов',
                'delete' => 'Удаление типов статусов',
            ],
            'status_categories' => [
                'list' => 'Просмотр категорий статусов',
                'create' => 'Создание категорий статусов',
                'edit' => 'Редактирование категорий статусов',
                'delete' => 'Удаление категорий статусов',
            ],
            'leads' => [
                'list' => 'Просмотр лидов'
            ]

        ],
    ];

    public static function getAllPermissions()
    {
        return self::PERMISSIONS;
    }
}
