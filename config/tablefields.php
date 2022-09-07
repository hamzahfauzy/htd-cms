<?php

return [
    'menus' => [
        'parent_id' => [
            'label' => 'parent',
            'type'  => 'options-obj:menus,id,name'
        ],
        'name' => [
            'label' => 'name',
            'type'  => 'text'
        ],
        'type_as' => [
            'label' => 'type as',
            'type'  => 'options:Link|Page|Category'
        ],
        'order_number' => [
            'label' => 'order number',
            'type'  => 'number'
        ],
        'content' => [
            'label' => 'content',
            'type'  => 'text'
        ]
    ],
    'categories'    => [
        'parent_id' => [
            'label' => 'parent',
            'type'  => 'options-obj:categories,id,name'
        ],
        'name' => [
            'label' => 'name',
            'type'  => 'text'
        ],
        'description' => [
            'label' => 'description',
            'type'  => 'textarea'
        ],
    ],
    'posts'    => [
        'author_id' => [
            'label' => 'author',
            'type'  => 'options-obj:users,id,name'
        ],
        'name' => [
            'label' => 'name',
            'type'  => 'text'
        ],
        'title' => [
            'label' => 'title',
            'type'  => 'text'
        ],
        'content' => [
            'label' => 'content',
            'type'  => 'textarea'
        ],
        'status' => [
            'label' => 'status',
            'type'  => 'options:Publish|Draft'
        ],
        'type_as' => [
            'label' => 'type as',
            'type'  => 'text'
        ],
        'thumb_url' => [
            'label' => 'thumb file',
            'type'  => 'text'
        ],
        'template' => [
            'label' => 'template',
            'type'  => 'text'
        ],
    ],
    'comments' => [
        'post_id' => [
            'label' => 'post',
            'type'  => 'options-obj:posts,id,title'
        ],
        'name' => [
            'label' => 'name',
            'type'  => 'text'
        ],
        'email' => [
            'label' => 'email',
            'type'  => 'text'
        ],
        'content' => [
            'label' => 'content',
            'type'  => 'text'
        ],
        'status' => [
            'label' => 'status',
            'type'  => 'options:Draft|Publish'
        ],
        'created_at' => [
            'label' => 'date',
            'type'  => 'datetime-local'
        ],
    ]
];