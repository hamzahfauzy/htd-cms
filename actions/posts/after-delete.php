<?php

set_flash_msg(['success'=>__($_GET['type_as']).' berhasil dihapus']);
header('location:'.routeTo('crud/index',['table'=>$table,'type_as'=>$_GET['type_as']]));