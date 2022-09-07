<?php
$conn = conn();
$db   = new Database($conn);
$name = $_GET['slug'];

$data = $db->all('posts',[
    'name' => $name,
    'status' => 'Publish'
]);

echo json_encode([
    'status'  => 'success',
    'message' => 'data retrieved',
    'data'    => $data
]);
die();