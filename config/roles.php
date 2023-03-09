<?php

use App\Enums\Roles;

return [
    Roles::ADMIN => [
        'create_user',
        'update_user',
        'ban_user',
        'create_role',
        'create_permission',
    ],
    Roles::NORMAL_USER => [
        'update_profile',
        'deactivate_profile',
    ]
];
