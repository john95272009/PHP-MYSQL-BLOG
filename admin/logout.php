<?php
session_start();
session_unset();
header('location:login.php?msg=已登出');

 ?>