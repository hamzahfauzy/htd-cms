<?php

$table = 'posts';
Page::set_title('Tambah '._ucwords(__($table)));
$error_msg = get_flash_msg('error');
$success_msg = get_flash_msg('success');
$old = get_flash_msg('old');
$fields = config('fields')[$table];

$conn = conn();
$db   = new Database($conn);

if(file_exists('../actions/'.$table.'/override-create-fields.php'))
    $fields = require '../actions/'.$table.'/override-create-fields.php';

if(request() == 'POST')
{

    $_POST[$table]['author_id'] = auth()->user->id;
    $_POST[$table]['name'] = slug($_POST[$table]['title']);
    $_POST[$table]['type_as'] = $_GET['type_as'];
    $insert = $db->insert($table,$_POST[$table]);

    if(count($_POST['categories']))
    {
        foreach($_POST['categories'] as $category)
        {
            $db->insert('category_posts',[
                'post_id' => $insert->id,
                'category_id' => $category
            ]);
        }
    }

    set_flash_msg(['success'=>__($_GET['type_as']).' berhasil ditambahkan']);
    header('location:'.routeTo('posts/edit',['id'=>$insert->id,'type_as'=>$_GET['type_as']]));
}

$categories = $db->all('categories');

return compact('table','error_msg','success_msg','old','fields','categories');