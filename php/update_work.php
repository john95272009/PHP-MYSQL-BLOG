<?php 
include_once 'db_con.php';
include_once 'function.php';
$title=$_POST['title'];
$intro=$_POST['intro'];
$video=$_POST['video'];
$image=$_POST['image'];
$publish=$_POST['publish'];
$id =$_POST['id'];
update_work($title,$intro,$image,$video,$publish,$id);
 ?>