<?php
$conn = conn();
$db   = new Database($conn);

$data = $db->all('menus',[
    'parent_id' => ['IS','NULL']
],[
    'order_number' => 'ASC'
]);

$data = array_map(function($d) use ($db){
    $d->childs = $db->all('menus',['parent_id'=>$d->id]);
    return $d;
},$data);

echo json_encode([
    'status'  => 'success',
    'message' => 'data retrieved',
    'data'    => $data
]);
die();