<?php

$table = 'files';
$conn = conn();
$db   = new Database($conn);

$page = isset($_GET['page']) && $_GET['page'] > 0 ? $_GET['page'] : 1;
$length = isset($_GET['limit']) && $_GET['limit'] > 24 ? $_GET['limit'] : 24;
$start = ($page-1)*$length;

$where = "";

if(isset($_GET['type_as']) && !empty($_GET['type_as']))
{
    $where = "WHERE file_type LIKE '%$_GET[type_as]%'";
}

$db->query = "SELECT * FROM $table $where LIMIT $start,$length";
$data  = $db->exec('all');

$start = ($start+1)*$length;
$db->query = "SELECT * FROM $table $where LIMIT $start,$length";

$is_next  = $db->exec('exists');
$is_prev = $page > 1;

$response = [
    'datas' => $data,
    'pagination' => [
        'is_next' => $is_next,
        'is_prev' => $is_prev,
    ],
    'page' => $page,
];

echo json_encode($response);
die();