<?php
require_once 'php/db_con.php';
require_once 'php/function.php';
$datas=get_publish_workslist();
//print_r($datas);
 ?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="作者">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>公司網站</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="files/images/icon.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/article_list.css">
    <style>
    *{
      margin: 0;
      padding: 0;
      list-style: none;
    }

/*    .top .container .row h1{
        width: 100%;
        text-align: center;
    }*/
    </style>

</head>
<body>
    <?php 
    include_once 'php/menu.php'
    ?>

    <!--網站內容-->
    <div class="main">
      <div class="container">
        <div class="row">
     
                    
            
            
            
            <?php if(!empty($datas)):?>
            <?php foreach ($datas as  $work): ?>
            
            <?php  $abstract=mb_substr($work['intro'],0,100,"UTF-8");?>
            
            <div class="col-12 col-md-4"  >
              <div class="card">
                    <?php if($work['image_path']): ?>
                    <img src="files/images/<?php echo $work['image_path']; ?>" class="card-img-top" alt="...">     
                    <?php else: ?>
                        <video controls class="card-img-top"> <source src="files/videos/<?php echo $work['video_path']; ?>" ></video> 
                     <?php endif; ?>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $work['title'];?></h5>
                      <p class="card-text"><?php echo $abstract?>...more</p>
                      <a href="work.php?id=<?php echo $work['id']; ?>" class="btn btn-primary container-fluid">進入文章</a>

                    </div>

              </div>
            </div>
            <?php endforeach;?>
            <?php else: ?>
            沒資料阿0.0
        
            <?php endif; ?>

          
        </div>
      </div>
    </div>





    <?php include_once 'php/footer.php' ?>
</body>
</html>
