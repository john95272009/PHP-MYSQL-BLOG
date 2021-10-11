<?php
/*           文章列表          */
@session_start();
function get_publish_article()
{
  $datas = array();
  $sql="select * from `article` where `publish` = 1";
  $result = mysqli_query($_SESSION['link'], $sql);
  if ($result)
  {
    //執行成功
      if(mysqli_num_rows($result)>0)
      {
        while ($row=mysqli_fetch_assoc($result))
        {
          $datas[] = $row;
        }
      }
  }
  else {
    echo "錯誤".mysqli_error($_SESSION['link']);
  }
  return $datas;
}
/*           文章          */
function get_article($id)
{
  $ariticle=null;
  $sql="select * from `article` where `publish`=1 AND `id` = {$id}";
  $result = mysqli_query($_SESSION['link'],$sql);
  if ($result)
  {
    //執行成功
      if(mysqli_num_rows($result)>0)
      {
        while ($row=mysqli_fetch_assoc($result))
        {
          $article=$row;
        }
      }
  }
  else {
    echo "錯誤".mysqli_error($_SESSION['link']);
  }
  return $article;
}
/*           作品列表          */
function get_publish_workslist()
{
  $datas=array();
  $sql="select * from `works` where `publish` =1 ";
  $result=mysqli_query($_SESSION['link'],$sql);
  if ($result)
  {
      if(mysqli_num_rows($result)>0)
      {
        while($row=mysqli_fetch_assoc($result))
        {
          $datas[]=$row;
        }
      }

  }
  else
  {
    echo "錯誤".mysqli_error($_SESSION['link']);

  }
  mysqli_close($_SESSION['link']);
  return $datas;
}

function get_work($id){
  $work=null;
  $sql="select * from `works` where `publish`=1 and `id`={$id}";
  $result = mysqli_query($_SESSION['link'],$sql);
  if($result)
  {
    if(mysqli_num_rows($result)>0)
    {
      while($row=mysqli_fetch_assoc($result))
      {
        $work=$row;
      }
    }
  }
  else{
    echo "錯誤".mysqli_error($_SESSION['link']);
  }
  return $work;
}


function check_has_username($username){
  $result = null;
  $sql = "select * from `user` WHERE `username`='{$username}'";
  $query=mysqli_query($_SESSION['link'],$sql);
  if($query)
  {
    if(mysqli_num_rows($query)>=1){
      $result=true;
    }
  }
  else{
    echo "sql錯誤".$sql.mysqli_error($_SESSION['link']);
  }
  return $result;
}
//增加會員
function add_member($username,$password,$name){
  $result=null;
  $password=md5($password);
  $sql="INSERT INTO `user` (`username`,`password`,`name`) VALUES ('{$username}','{$password}','{$name}')";
  $query=mysqli_query($_SESSION['link'],$sql);

  if (mysqli_affected_rows($_SESSION['link'])>0)
  {
    $new_id=mysqli_insert_id($_SESSION['link']);
    return "更新成功";
  }
  elseif(mysqli_affected_rows($_SESSION['link'])==0)
  {
    return "沒新增資料";
  }
  else{
    return "語法錯誤";
  }
}
  function add_work($title,$intro,$image,$video,$publish){
        $result=null;
        $video_path=$video;
        $image_path=$image;
   
    $date=date('Y-m-d H:i:s');
    if($video == '')
    {
      $video_path='null';
    }
    else
    { 
      $video=basename($video);
      $video_path="'{$video}'";
    }
   
     if($image == '')
    {
      $image_path='null';
    }
    else
    {
      $image=basename($image);
      $image_path="'{$image}'";
    }
   
    $sql="INSERT INTO works 
    (`title`,`intro`,`image_path`,`video_path`,`publish`,`create_user_id`,`upload_date`)  VALUES 
    ('{$title}','{$intro}',{$image_path},{$video_path},$publish,'{$_SESSION['create_user_id']}','{$date}') ";
    $query=mysqli_query($_SESSION['link'],$sql);
    if($query)
    {
      if(mysqli_affected_rows($_SESSION['link'])>0)
      {
      echo "yes";
      }
      else{
        echo "錯誤";
      }
    }
    else{
      echo  "錯誤".mysqli_error($_SESSION['link']);
    }
   

}
 function update_work($title,$intro,$image,$video,$publish,$id){
        $result=null;
        $video_path=$video;
        $image_path=$image;
        $result=get_edit_work($id);

        if(file_exists('../files/images'.$result['image_path']))
        {


          if($image != $result['image_path'])
          {
            unlink('../files/images/'.$result['image_path']);
          }
         }
         if($video_path !='')
         {
        if(file_exists('../files/videos/'.$result['video_path']))
        {


          if($image != $result['video_path'])
          {
            unlink("../files/videos/{$result['video_path']}");
          }
         }
       }
    if($video == '')
    {
      $video_path='null';
    }
    else
    { 
      $video=basename($video);
      $video_path="'{$video}'";
    }
   
     if($image == '')
    {
      $image_path='null';
    }
    else
    {
      $image=basename($image);
      $image_path="'{$image}'";
    }
    $sql="UPDATE `works` SET `title`='{$title}',`intro`='{$intro}',`image_path`= {$image_path},`video_path`={$video_path},`publish`=$publish WHERE  `id`='{$id}'";

   
    $query=mysqli_query($_SESSION['link'],$sql);
    if($query)
    {
      if(mysqli_affected_rows($_SESSION['link'])>0)
      {
        echo "yes";
      }
      else{
        echo "錯誤";
      }
    }
    else{
      echo  "錯誤123".mysqli_error($_SESSION['link']);
    }
   

}
//帳密是否正確
function verify_user($username,$password){
$result=null;
$password=md5($password);
$sql="select * from `user` where `username`='{$username}' and `password`='{$password}'";
$result=mysqli_query($_SESSION['link'],$sql);
if($result)
{
  if(mysqli_num_rows($result)>0)
  {
      $data = mysqli_fetch_assoc($result);
      $_SESSION['is_login']=true;
      $_SESSION['create_user_id']=$username;
      return "true";
  }
  else
  {
  return "帳號錯誤";
  }
}
else{
  return "語法錯誤";
}


}

//獲取所有文章
function get_all_article()
{
  $ariticle=array();
  $sql="select * from `article`";
  $result = mysqli_query($_SESSION['link'],$sql);
  if ($result)
  {
    //執行成功
      if(mysqli_num_rows($result)>0)
      {
        while ($row=mysqli_fetch_assoc($result))
        {
          $article[]=$row;
        }
      }
  }
  else {
    echo "錯誤".mysqli_error($_SESSION['link']);
  }
  return $article ?? [];
}
function get_all_works()
{

  $ariticle=array();

  $sql="select * from `works`";
  $result = mysqli_query($_SESSION['link'], $sql);
  if ($result)
  {
    //執行成功
      if(mysqli_num_rows($result)>0)
      {
        while ($row=mysqli_fetch_assoc($result))
        {
          $article[]=$row;
            
        }
      }
 
  }
  else {
    echo "錯誤".mysqli_error($_SESSION['link']);
  }
  if(!empty($article))
  {
    return $article;
  }

    
}
function get_all_member()
{
  $ariticle=array();
  $sql="select * from `user`";
  $result = mysqli_query($_SESSION['link'],$sql);
  if ($result)
  {
    //執行成功
      if(mysqli_num_rows($result)>0)
      {
        while ($row=mysqli_fetch_assoc($result))
        {
          $article[]=$row;
        }
      }
  }
  else {
    echo "錯誤".mysqli_error($_SESSION['link']);
  }
  return $article;
}
function add_article($title,$category,$content,$publish){
    $result=null;

    $date=date('Y-m-d H:i:s');
    $sql="INSERT INTO article (`title`,`category`,`publish`,`content`,`create_date`,`create_user_id`)  VALUES 
    ('{$title}','{$category}','{$publish}','{$content}','{$date}','{$_SESSION['create_user_id']}')";
    $query=mysqli_query($_SESSION['link'],$sql);
    if($query)
    {
      if(mysqli_affected_rows($_SESSION['link'])>0)
      {
        $result=true;
      }
      else{
        echo "錯誤";
      }
    }
    else{
      echo  "錯誤".mysqli_error($_SESSION['link']);
    }
    return $result;


}
function get_edit_article($id)
{
   $ariticle=null;
  $sql="select * from `article` WHERE `id` ='{$id}' ";
  $result = mysqli_query($_SESSION['link'],$sql);
  if ($result)
  {
    //執行成功
      if(mysqli_num_rows($result)==1)
      {
       
          $article=mysqli_fetch_assoc($result);
      }
  }
  else {
    echo "錯誤".mysqli_error($_SESSION['link']);
  }
  return $article;
 }
function get_edit_member($id)
{

   $ariticle=null;
  $sql="select * from `user` WHERE `id` ='{$id}' ";
  $result = mysqli_query($_SESSION['link'],$sql);
  if ($result)
  {
    //執行成功
      if(mysqli_num_rows($result)==1)
      {
       
          $article=mysqli_fetch_assoc($result);
      }
  }
  else {
    echo "錯誤".mysqli_error($_SESSION['link']);
  }
  return $article;
 
}
function get_edit_work($id)
{
  $result=null;
  $sql="select * from works WHERE `id` = '{$id}'";
  $query=mysqli_query($_SESSION['link'],$sql);
  if($query)
  {
    if(mysqli_num_rows($query)>0)
    {
      $result=mysqli_fetch_assoc($query);
      echo "";
    }
  }
  else
  {
    echo "錯誤".mysqli_error($_SESSION['link']);

  }
  return $result;
}
function update_article($id,$title,$category,$content,$publish){
      $modify_date=date('Y-m-d H:i:s');
      $result=false;
      $sql="UPDATE `article` SET 
      `title`='{$title}',
      `category`='{$category}',
      `content`='{$content}',
      `publish`='{$publish}',
      `modify_date`='{$modify_date}'
      WHERE `id`={$id}
      ";
      $query=mysqli_query($_SESSION['link'],$sql);
      if($query)
      {
          if(mysqli_affected_rows($_SESSION['link'])>0)
          {
           $result=true;

          }
      }
      else
      {

        echo "{$sql}語法錯誤".mysqli_error($_SESSION['link']);
      }
      return $result;
}

function update_member($id,$username,$password,$name){
      $sql_password='';
      if(!empty($password))
      {
        $sql_password="`password`='{$password}',";
      }
      $result=false;
      $sql="UPDATE `user` SET 
      `username`='{$username}',
      {$sql_password}
      `name`='{$name}'
      
      WHERE `id`={$id}
      ";
      $query=mysqli_query($_SESSION['link'],$sql);
      if($query)
      {
          if(mysqli_affected_rows($_SESSION['link'])>0)
          {
           $result=true;

          }
      }
      else
      {

        echo "{$sql}語法錯誤".mysqli_error($_SESSION['link']);
      }
      return $result;
}
function delete_article($id){
 $sql="DELETE  FROM `article` WHERE `id`= $id";
 $result=null;
 $query=mysqli_query($_SESSION['link'],$sql);
 if($query)
 {
   if(mysqli_affected_rows($_SESSION['link'])>0)
   {
    $result=true;
   }
   else
   {
    echo "沒有資料被錯誤";
   }

 }
 else
 {
  echo "{$sql}語法錯誤".mysql_error($_SESSION['link']);
 }
  return $result;

 }
 function delete_work($id){
       

 //刪除檔案
        $resultt=get_edit_work($id);
     
        if(file_exists('../files/images/'.$resultt['image_path']))
        {
                
        unlink('../files/images/'.$resultt['image_path']);
        }
               if(file_exists('../files/videos/'.$resultt['video_path']))
        {
        unlink('../files/videos/'.$resultt['video_path']);
          
        }
 

  $sql="DELETE  FROM `works` WHERE `id`= $id";       
 $result=null;
 $query=mysqli_query($_SESSION['link'],$sql);
 if($query)
 {
   if(mysqli_affected_rows($_SESSION['link'])>0)
   {
    $result=true;
   }
   else
   {
    echo "沒有資料被錯誤";
   }

 }
 else
 {
  echo "{$sql}語法錯誤".mysql_error($_SESSION['link']);
 }
  return $result;

 }
 function delete_member($id){
 $sql="DELETE  FROM `user` WHERE `id`= $id";
 $result=null;
 $query=mysqli_query($_SESSION['link'],$sql);
 if($query)
 {
   if(mysqli_affected_rows($_SESSION['link'])>0)
   {
    $result=true;
   }
   else
   {
    echo "沒有資料被錯誤";
   }

 }
 else
 {
  echo "{$sql}語法錯誤".mysql_error($_SESSION['link']);
 }
  return $result;

 }
 ?>