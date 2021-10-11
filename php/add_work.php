<?php
require_once 'db_con.php';
require_once 'function.php';

$title=$_POST['title'];
$intro=$_POST['intro'];
$video=$_POST['video'];
$image=$_POST['image'];
$publish=$_POST['publish'];
add_work($title,$intro,$image,$video,$publish);

?>
