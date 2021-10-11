<?php
include_once 'db_con.php';
include_once 'function.php';
$username = $_POST['username'];
$password= $_POST['password'];
$name=$_POST['name'];

$msg=add_member($username,$password,$name);
if(!empty($msg))
{
echo $msg;
}
else
{
  echo "發生不明錯誤";
}



?>
