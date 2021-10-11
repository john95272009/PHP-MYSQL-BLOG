<?php 
require_once '../php/db_con.php';
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
header('location:login.php');
}
else{

}


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
         <div class="col-12 col-md-6 offset-md-3">
            <div class="alert alert-light" role="alert">
                <form id="register_form" action="abc.php" method="POST" >
                <div class="form-group ">
                    <label for="username">帳號</label>
                    <input type="text" class="form-control " name="username" id="username" aria-describedby="emailHelp" placeholder="帳號" required>
                    <div class="invalid-feedback ">帳號重覆
                    </div>
                </div>
                <div class="form-group error">
                    <label for="Password">密碼</label>
                    <input type="password" class="form-control " name="password" id="password" placeholder="密碼" required>
                </div>
                <div class="form-group error">
                    <label for="confirm_password">確認密碼</label>
                    <input type="password" class="form-control" id="confirm_password" placeholder="再輸入一次密碼" required>

                </div>
                <div class="form-group ">
                    <label for="name">姓名</label>
                    <input type="text" class="form-control " name="name" id="name" aria-describedby="emailHelp" placeholder="姓名" required>

                </div>
                <div class="form-group ">
                    <div class="col-12 col-md-6 offset-md-3 text-center">
                 <button type="submit" class="btn btn-primary">確認註冊</button>
                    </div>
                </div>

                </form>
            </div>
          </div>

        </div>

      </div>

    </div>




    <?php include_once 'footer.php' ?>
    <script>
    $(document).ready(function(){
      
 $("#username").on("input",function(){
            if($(this).val()!='')
            {
              $.ajax({
                type:"POST" ,
                url: "../php/check_username.php",
                data:{
                  'n':$(this).val()
                },
                dataType:"html"
              }).done(function(data){
              var newData=data.replace(/\s/g,'');
               console.log (data);
              if(newData=='no')
              {
                console.log (data);
                $("#username").addClass('is-invalid').removeClass('is-valid');
                $("#register_form button[type='submit']").attr('disabled',true);
              }
              else{
                $("#username").removeClass('is-invalid').addClass('is-valid');
                  $("#register_form button[type='submit']").attr('disabled',false);
              }

              }).fail(function(jaXHR,textStatus,errorThrown){
                alert("有產生錯誤");
                console.log(jaXHR.responseText);
              });
            }
            else{
                $("#username").removeClass('is-invalid').removeClass('is-valid');
                $("#register_form button[type='submit']").attr('disabled',false);
            }
          })






          $("#register_form").on("submit",function(){

            if($('#password').val()!=$('#confirm_password').val())
            {


           alert("有錯誤");
           
            }
            else
            {
               
                $.ajax({
                  type:"POST" ,
                  url: "../php/InsertMB.php",
                  data:{
                    'username':$('#username').val(),
                    'password':$('#password').val(),
                    'name':$('#name').val()
                  },
                  dataType:"html"
                }).done(function(data){
                  alert('登入跳轉');
                 location.href="member_list.php";

                }).fail(function(jaXHR,textStatus,errorThrown){
                  alert("有產生錯誤");
                  console.log(jaXHR.responseText);
                });
            




            }
            return false;
          
        })
 


    })


     
       
    </script>
</body>
</html>
