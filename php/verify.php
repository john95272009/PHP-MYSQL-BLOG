<?php 
require_once 'db_con.php';
require_once 'function.php';
$msg = verify_user($_POST['us'],$_POST['pwd']);
echo $msg;

 ?>