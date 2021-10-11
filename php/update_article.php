<?php 
include_once 'db_con.php';
include_once 'function.php';
$msg=update_article($_POST['id'],$_POST['title'],$_POST['category'],$_POST['content'],$_POST['publish']);
if($msg)
{
	echo ("true");
}
else{
	echo ("no");
}

 ?>