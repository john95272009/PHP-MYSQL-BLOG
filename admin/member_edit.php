<?php 
require_once '../php/db_con.php';
require_once '../php/function.php';
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
header('location:login.php');
}
else{

}

$data= get_edit_member($_GET['i']);



?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="作者">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新增文章</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../files/images/icon.png">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
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
    include_once 'menu.php'
    ?>


    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
       

        <!--form內容-->
           <div class="alert alert-light" role="alert">
                <form id="member_edit" method="POST"  >
                <div class="form-group ">
                  <input type="hidden" name="" id='id' value="<?php echo $data['id']; ?>">
                    <h1>編輯</h1>
                    <label for="username">帳號</label>
                    <input type="text" class="form-control " name="title" id="username" placeholder="請輸入帳號" value="<?php echo $data['username']; ?>" >
                    <div class="invalid-feedback ">請輸入標題
                    </div>
                </div>
                <div class="form-group error">
                    <label for="password">密碼</label>
                     <input type="password" class="form-control " name="title" id="password" placeholder="密碼" value="" >
                    
                 
                </div>
              
                <div class="form-group ">
                  <label for="name">姓名</label>
                 <input type="text" class="form-control " name="title" id="name" placeholder="姓名" value="<?php echo $data['name']; ?>" >
                </div>


           
                  <button type="submit" class="btn btn-primary">Submit</button>
           
                </form>
            </div>









          </div>

        </div>

      </div>

    </div>




    <?php include_once 'footer.php' ?>
    <script>
    $(document).ready(function(){
      
      



     $('#member_edit').on("submit",function(){
      if($('#username').val() == '' || $('#name').val() == '')
      {
        alert('帳號或名字沒輸入');
      }
      else
      {
        $.ajax({
          type:'POST',
          url:'../php/update_member.php',
          data:{
            'username':$('#username').val(),
            'password':$('#password').val(),
            'name':$('#name').val(),
             'id':$('#id').val()
         
               },
          dataType:'html'
        }).done(function(data){
         if(data)
          {
          alert('更新成功');
          location.href="member_list.php";
          }
          else{
            alert(data);
          }
        }).fail(function(jaXHR,textStatus,errorThrown){
             console.log(jaXHR.responseText);
        })
      }
         return false;
      
      })
 


    })


     
       
    </script>
</body>
</html>
