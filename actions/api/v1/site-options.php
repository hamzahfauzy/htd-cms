<?php
$conn = conn();
$db   = new Database($conn);

$data['name'] = app('name');
$data['socials'] = [
    'facebook' => [
        'url' => '',
        'class' => 'facebook',
        'icon' => 'bx bxl-facebook',
    ],
    'instagram' => [
        'url' => '',
        'class' => 'instagram',
        'icon' => 'bx bxl-instagram',
    ],
    'youtube' => [
        'url' => '',
        'class' => 'youtube',
        'icon' => 'bx bxl-youtube',
    ]
];

echo json_encode([
    'status'  => 'success',
    'message' => 'data retrieved',
    'data'    => $data
]);
die();