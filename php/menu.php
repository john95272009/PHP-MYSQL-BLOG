<?php 
$FilePath= $_SERVER['PHP_SELF'];
$FileName= basename($FilePath,'.php');
switch($FileName){
    case 'index':
    $page_index="0";
    break;
    case 'article':
    $page_index="1";
    break;
    case 'article_list';
    $page_index="1";
    break;
    case 'works_list':
    $page_index="2";
    break;
    case 'work':
    $page_index="2";
    break;
    case 'registed':
    $page_index="3";
    break;   
    case 'about':
    $page_index="4";
    break;     
    
}
//echo $page_index;
?>
<div class="top">
    <div class="container">
         <div class="row ">
           <div class="col-12 col-md-12">
                <div class="jumbotron">
                      <h1 class="text-center">部落格網站</h1>
                      <ul class="nav nav-pills">
                      <li class="nav-item">
                      <a class="nav-link <?php if($page_index==0){ echo "active" ;}?>" href="index.php">首頁</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link <?php if($page_index==1){ echo "active" ;}?>" href="article_list.php">文章</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link <?php if($page_index==2){ echo "active" ;}?>" href="works_list.php">作品</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link" href="registed.php">註冊</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link <?php if($page_index==4){ echo "active" ;}?> " href="about.php">關於我們</a>
                     
                      </li>
                      </ul>
                </div>
            </div>
         </div>
    </div>
</div>
