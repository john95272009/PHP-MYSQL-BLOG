<?php
include_once 'db_con.php';
include_once 'function.php';
$check=check_has_username($_POST['n']);
if ($check)
{
  echo ("no");

}
else{
  echo ("yes");
}
?>
