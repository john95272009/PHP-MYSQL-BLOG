<?php 

	if(file_exists($_FILES['file']['tmp_name']))
{

$target_folder=$_POST['save_path'];
	$file_name = $_FILES['file']['name'];
	if(move_uploaded_file($_FILES['file']['tmp_name'],"../".$target_folder.$file_name))
	{
		echo "yes";
	}
	else
	{
		echo "請確認{$_POST['save_path']}是否為有效路徑";
	}
}

 ?>