<?php 
include_once 'db_con.php';
include_once 'function.php';
$msg=update_member($_POST['id'],$_POST['username'],$_POST['password'],$_POST['name']);
if($msg)
{
	echo ("true");
}
else{
	echo ("no");
}

 ?>