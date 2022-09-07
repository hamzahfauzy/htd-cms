<?php

if(empty($where))
{
    $where .= " WHERE type_as = '$_GET[type_as]'";
}
else
{
    $where .= " AND type_as = '$_GET[type_as]'";
}

$db->query = "SELECT * FROM $table $where ORDER BY ".$columns[$order[0]['column']]." ".$order[0]['dir']." LIMIT $start,$length";
$data  = $db->exec('all');

$data = array_map(function($d) use ($db){
    $categories = $db->all('category_posts',['post_id'=>$d->id]);
    $categories = array_map(function($cat) use ($db){
        return $db->single('categories',['id'=>$cat->category_id])->name;
    }, $categories);
    $d->categories = implode(', ',$categories);
    $d->title = $d->title .'<br><i><small>'.$d->name.'</small></i>';
    return $d;
}, $data);

$where = str_replace('WHERE','',$where);

$total = $db->exists($table,$where,[
    $columns[$order[0]['column']] => $order[0]['dir']
]);

return compact('data','total');