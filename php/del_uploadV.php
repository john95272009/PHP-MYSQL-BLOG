<?php 

if(file_exists("../".$_POST['file_path']))
{
 if(unlink("../".$_POST['file_path']))
 {
 	echo "yes";
 }
 else
 {
 	echo "刪除失敗";
 }
}
else{
	echo "沒有資料";
}
 
 ?>
