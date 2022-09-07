<?php

$table = 'posts';
Page::set_title('Edit '._ucwords(__($table)));
$conn = conn();
$db   = new Database($conn);
$error_msg = get_flash_msg('error');
$success_msg = get_flash_msg('success');
$old = get_flash_msg('old');
$fields = config('fields')[$table];

$data = $db->single($table,[
    'id' => $_GET['id']
]);

if(file_exists('../actions/'.$table.'/override-edit-fields.php'))
    $fields = require '../actions/'.$table.'/override-edit-fields.php';

if(request() == 'POST')
{
    $edit = $db->update($table,$_POST[$table],[
        'id' => $_GET['id']
    ]);

    if(count($_POST['categories']))
    {
        $db->delete('category_posts',['post_id'=>$_GET['id']]);
        foreach($_POST['categories'] as $category)
        {
            $db->insert('category_posts',[
                'post_id' => $edit->id,
                'category_id' => $category
            ]);
        }
    }

    set_flash_msg(['success'=>__($_GET['type_as']).' berhasil edit']);
    header('location:'.routeTo('posts/edit',['id'=>$edit->id,'type_as'=>$_GET['type_as']]));
}

$data->categories = array_map(function($c){
    return $c->category_id;
}, $db->all('category_posts',['post_id'=>$_GET['id']]));

$categories = $db->all('categories');

return [
    'data' => $data,
    'categories' => $categories,
    'error_msg' => $error_msg,
    'success_msg' => $success_msg,
    'old' => $old,
    'table' => $table,
    'fields' => $fields
];