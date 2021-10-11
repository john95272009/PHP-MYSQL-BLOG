<?php 
$FilePath= $_SERVER['PHP_SELF'];
$FileName= basename($FilePath,'.php');
switch($FileName){
    case 'index':
    $page_index="0";
    break;
    case 'article_list':
    case 'article_add':
    case 'article_edit':
    $page_index="1";
    break;
    case 'works_list':
    case 'works_add':
    case 'works_edit':
    $page_index="2";
    break;
    case 'member_list':
    case 'member_add':
    case 'member_edit':
    $page_index="3";
    break;

  
    
}
//echo $page_index;
?>
<div class="top">
    <div class="container">
         <div class="row ">
           <div class="col-12 col-md-12">
                <div class="jumbotron">
                      <h1 class="text-center">管理頁面</h1>
                      <ul class="nav nav-pills">
                      <li class="nav-item">
                       <a class="nav-link" href="../index.php">首頁</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link <?php if($page_index==0){ echo "active" ;}?>" href="index.php">後臺首頁</a>
                      </li>
                       <li class="nav-item">
                      <a class="nav-link <?php if($page_index==1){ echo "active" ;}?>" href="article_list.php">所有文章</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link <?php if($page_index==2){ echo "active" ;}?>" href="works_list.php">所有作品</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link <?php if($page_index==3){ echo "active" ;}?>" href="member_list.php">所有會員</a>
                      </li>
                      
                      <li class="nav-item">
                      <a class="nav-link" href="logout.php">登出</a>
                     
                      </li>
                      </ul>
                </div>
            </div>
         </div>
    </div>
</div>
