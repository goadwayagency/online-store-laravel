<?php

return [
    'sections' => [
        [
            'title' => 'settings',
            'items' => [
                ['name' => 'Admin Dashboard', 'route' => 'admin.dashboard.index', 'icon' => 'dashboard'],
                ['name' => 'Roles', 'route' => 'admin.roles.index', 'icon' => 'roles'],
                ['name' => 'Users', 'route' => 'admin.users.index', 'icon' => 'users'],
            ],
        ],
    ],
];
