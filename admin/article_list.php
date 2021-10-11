<?php 
require_once '../php/db_con.php';
require_once '../php/function.php';
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
header('location:login.php');
}
else{
    
}
$datas=get_all_article();

?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="作者">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>所有文章</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="shortcut icon" href="../files/images/icon.png">
    <link rel="stylesheet" href="../css/style.css">
    <style>
    *{
      margin: 0;
      padding: 0;
      list-style: none;
    }
    .add a{
		margin: 20px;
    }
    

/*    .top .container .row h1{
        width: 100%;
        text-align: center;
    }*/
    </style>

</head>
<body>
    <?php 
    include_once 'menu.php'
    ?>

    <div class="main">
      <div class="container ">
	        <div class="row">
	               <div class="col-12 col-md-12 add">
	            	<a href="article_add.php" class="btn btn-success">新增網頁</a>
	   
					</div>
	        </div>


	        <div class="row">
	          <div class="col-12 col-md-12">
	         
	        

	            <table class="table">
	            	<?php if(!empty($datas)): ?>
	            	<tr>
	            	<th>id</th>	
	            	<th>title</th>
	            	<th>category</th>
	            	<th>content</th>
	            	<th>publish</th>
	            	<th>管理動作</th>
	            	</tr>
	            	<?php foreach ($datas as $key => $value):?>
					<tr>
	            	<td><?php echo $value['id']; ?></td>	
	            	<td><?php echo $value['title']; ?></td>
	            	<td><?php echo $value['category']; ?></td>
	            	<td><?php echo mb_substr($value['content'],0,30).'...'; ?></td>
	            	<td><?php echo ($value['publish']?'發佈中':'非發佈中'); ?></td>
	            	<td><a class="btn btn-success" href="article_edit.php?i=<?php echo $value['id']; ?>">編輯</a>
	            	<a class="btn btn-danger btn_delete" href="javascript:void(0)" data-id="<?php echo $value['id']; ?>">刪除</a></td>
	            	</tr>
					<?php endforeach; ?>
					<?php else: ?>
					
					<td colspan="5">無資料</td>
					<?php endif; ?>
	            </table>

	            
	          </div>

	        </div>

      </div>

    </div>




    <?php include_once 'footer.php' ?>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('a.btn_delete').click(function(){

    			var c =confirm('你確定要刪除嗎'),
    			this_tr=$(this).parent().parent();
    			if(c)
    			{
    			$.ajax({
    				type:'POST',
    				url:'../php/delete_article.php',
    				data:{
    					'id':$(this).attr('data-id')
    				},
    				dataType:'html'

    			}).done(function(data){
    			   if(data)
			          {
			          alert('更新成功');
			          this_tr.fadeOut();
			          }
			          else{
			            alert(data);
			          }
    			}).fail(function(jaXHR,textStatus,errorThrown)
    				{
    				  console.log(jaXHR.responseText);
    			})
    			
    			}
    		})
    	})
    </script>
</body>
</html>
