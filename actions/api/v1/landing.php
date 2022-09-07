<?php
$conn = conn();
$db   = new Database($conn);

$cat_exeption = [];
$data = [];
$hero_cat = $db->single('categories',['name'=>'Hero']);
if($hero_cat)
{
    $cat_exeption[] = $hero_cat->id;
    $cat_post_hero = $db->single('category_posts',['category_id'=>$hero_cat->id],['id'=>'DESC']);
    if($cat_post_hero)
    {
        $data['hero'] = $db->single('posts',['id'=>$cat_post_hero->post_id]);
    }
}

$featured_cat = $db->single('categories',['name'=>'Featured']);
if($featured_cat)
{
    $cat_exeption[] = $featured_cat->id;
    $cat_post_featured = $db->single('category_posts',['category_id'=>$featured_cat->id],['id'=>'DESC']);
    if($cat_post_featured)
    {
        $data['featured'] = $db->single('posts',['id'=>$cat_post_featured->post_id]);
    }
}

if(!empty($cat_exeption))
{
    $post_exception = $db->all('category_posts',['category_id'=>['IN','('.implode(',',$cat_exeption).')']]);
    if($post_exception)
    {
        $post_exception_ids = array_map(function($pe){return $pe->post_id;},$post_exception);
        $db->query = "SELECT * FROM posts WHERE id NOT IN (".implode(',',$post_exception_ids).") AND status = 'Publish' AND type_as = 'posts' ORDER BY created_at DESC LIMIT 3";
    }
}
else
{
    $db->query = "SELECT * FROM posts WHERE status = 'Publish' AND type_as = 'posts' ORDER BY created_at DESC LIMIT 3";
}
$posts = $db->exec('all');
$posts = array_map(function($p) use ($db){
    $category_posts = $db->all('category_posts',['post_id'=>$p->id]);
    $cat_ids = array_map(function($cat){
        return $cat->category_id;
    }, $category_posts);
    $p->categories = $db->all('categories',['id'=>['IN','('.implode(',',$cat_ids).')']]);
    return $p;
}, $posts);

$data['posts'] = $posts;

$data['stats'] = [
    'siswa'   => 520,
    'staff'   => 60,
    'jurusan'  => 2,
    'berita'   => count($posts)
];

$achievements_cat = $db->single('categories',['name'=>'Achievements']);
if($achievements_cat)
{
    $cat_post_achievements = $db->all('category_posts',['category_id'=>$achievements_cat->id],['id'=>'DESC']);
    if($cat_post_achievements)
    {
        $ids = array_map(function($c){
            return $c->post_id;
        }, $cat_post_achievements);
        $db->query = "SELECT * FROM posts WHERE id IN (".implode(',',$ids).") AND status = 'Publish' AND type_as = 'posts' ORDER BY created_at DESC LIMIT 3";
        $data['achievements'] = $db->exec('all');
    }
}

echo json_encode([
    'status'  => 'success',
    'message' => 'data retrieved',
    'data'    => $data
]);
die();