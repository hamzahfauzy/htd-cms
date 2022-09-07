<?php

$table = 'files';
$conn = conn();
$db   = new Database($conn);

$data = $db->single($table,['id'=>$_GET['id']]);

$filename = str_replace(routeTo(''),'',$data->file_url);

unlink($filename);

$db->delete($table,[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Berkas berhasil dihapus']);
header('location:'.routeTo('files/index'));
die();