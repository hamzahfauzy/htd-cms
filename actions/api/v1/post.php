<?php
$conn = conn();
$db   = new Database($conn);

$data = $db->all('posts',[
    'status' => 'Publish'
]);

$data = array_map(function($p) use ($db){
    $category_posts = $db->all('category_posts',['post_id'=>$p->id]);
    $cat_ids = array_map(function($cat){
        return $cat->category_id;
    }, $category_posts);
    $p->categories = $db->all('categories',['id'=>['IN','('.implode(',',$cat_ids).')']]);
    return $p;
}, $data);

echo json_encode([
    'status'  => 'success',
    'message' => 'data retrieved',
    'data'    => $data
]);
die();