<?php
    @session_start();
    $host="localhost";
    // mysqli_connect($host,'username','password','database');
    $_SESSION['link'] = mysqli_connect($host,'','','');
    if($_SESSION['link'])
    {
        mysqli_query($_SESSION['link'],"SET NAMES utf8");
    }
    else
    {
      echo "錯誤",mysqli_connect_error();
    }




 ?>
