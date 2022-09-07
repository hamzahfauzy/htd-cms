<?php

$table = 'files';
Page::set_title(_ucwords(__('files')));
$conn = conn();
$db   = new Database($conn);

if(isset($_FILES['files']))
{
    $uploadFolder = "uploads";

    if (!is_dir($uploadFolder)) {
        mkdir($uploadFolder, 0777);
    }


    foreach($_FILES['files']['name'] as $i => $fname)
    {
        $ext  = pathinfo($fname, PATHINFO_EXTENSION);
        $name = strtotime('now').$i.'.'.$ext;
        $file = 'uploads/'.$name;
        copy($_FILES['files']['tmp_name'][$i],$file);

        $db->insert('files',[
            'file_name' => $fname,
            'file_url' => asset($file),
            'file_type' => mime_content_type($file)
        ]);
    }
    
    set_flash_msg(['success'=>'File berhasil diupload']);
    header('location:'.routeTo('files/index'));
}

$success_msg = get_flash_msg('success');

$page = isset($_GET['page']) && $_GET['page'] > 0 ? $_GET['page'] : 1;
$length = isset($_GET['limit']) && $_GET['limit'] > 24 ? $_GET['limit'] : 24;
$start = ($page-1)*$length;

$where = "";

$db->query = "SELECT * FROM $table $where LIMIT $start,$length";
$data  = $db->exec('all');

$start = ($start+1)*$length;
$db->query = "SELECT * FROM $table $where LIMIT $start,$length";

$is_next  = $db->exec('exists');
$is_prev = $page > 1;

return [
    'datas' => $data,
    'pagination' => [
        'is_next' => $is_next,
        'is_prev' => $is_prev,
    ],
    'page' => $page,
    'success_msg' => $success_msg,
];