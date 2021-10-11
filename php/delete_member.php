<?php
require_once 'db_con.php';
require_once 'function.php';
$result=delete_member($_POST['id']);
if($result)
{
echo (true);
}


?>
