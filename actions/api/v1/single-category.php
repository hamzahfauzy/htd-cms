<?php
$conn = conn();
$db   = new Database($conn);
$name = $_GET['name'];
$cat  = $db->single('categories',[
    'name' => $name
]);
$category_posts = $db->all('category_posts',['category_id'=>$cat->id]);
$data = [];
if($category_posts)
{
    $post_ids = array_map(function($cat_post){
        return $cat_post->post_id;
    }, $category_posts);
    
    $data = $db->all('posts',[
        'status' => 'Publish',
        'id' => ['IN','('.implode(',',$post_ids).')']
    ]);

    $data = array_map(function($p) use ($db){
        $category_posts = $db->all('category_posts',['post_id'=>$p->id]);
        $cat_ids = array_map(function($cat){
            return $cat->category_id;
        }, $category_posts);
        $p->categories = $db->all('categories',['id'=>['IN','('.implode(',',$cat_ids).')']]);
        return $p;
    }, $data);
}

echo json_encode([
    'status'  => 'success',
    'message' => 'data retrieved',
    'data'    => $data
]);
die();