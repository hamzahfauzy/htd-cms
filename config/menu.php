<?php

return [
    'dashboard'  => 'default/index',
    'menus'      => 'crud/index?table=menus',
    'categories' => 'crud/index?table=categories',
    'posts'      => 'crud/index?table=posts&type_as=posts',
    'pages'      => 'crud/index?table=posts&type_as=pages',
    'comments'   => 'crud/index?table=comments',
    'files'      => 'files/index',
    'users'      => [
        'all users' => 'users/index',
        'roles'  => 'roles/index'
    ],
    'settings'   => [
        'application' => 'application/index',
        'other'  => 'application/other'
    ]
];