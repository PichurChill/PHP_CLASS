<?php
header('content-type:text/html;charset=utf-8');
require_once 'upload.class.php';
// print_r($_FILES);die;
$upload=new upload('myfile','jin');
$dst=$upload->uploadFile();
echo $dst;