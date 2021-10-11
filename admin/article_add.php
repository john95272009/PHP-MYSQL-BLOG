<?php 
require_once '../php/db_con.php';
if(! isset($_SESSION['is_login']) || ! $_SESSION['is_login'])
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="../files/images/icon.png">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <style>
    * {
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
            <form id="article_add" method="POST">
              <div class="form-group ">
                <h1>新增</h1>
                <label for="title">標題</label>
                <input type="text" class="form-control " name="title" id="title" aria-describedby="emailHelp"
                  placeholder="標題">
                <div class="invalid-feedback ">請輸入標題
                </div>
              </div>
              <div class="form-group error">
                <label for="category">種類</label>
                <select class="form-control" id="category">
                  <option value="新聞">新聞</option>
                  <option value="遊戲">遊戲</option>
                </select>
              </div>
              <div class="form-group ">
                <label for="content">內文</label>
                <textarea class="form-control" name="" id="content" cols="30" rows="8"></textarea>
              </div>
              <div class="form-group ">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline1" name="publish" class="custom-control-input" value="1"
                    checked>
                  <label class="custom-control-label" for="customRadioInline1">發佈</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline2" name="publish" class="custom-control-input" value="0">
                  <label class="custom-control-label" for="customRadioInline2">不發佈</label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">新增</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once 'footer.php' ?>
  <script>
    $(document).ready(function () {
      $('#article_add').on("submit", function () {
        if ($('#title').val() == '' || $('#content').val() == '') {
          alert('標題或內文都沒輸入');
        }
        else {
          $.ajax({
            type: 'POST',
            url: '../php/add_article.php',
            data: {
              'title': $('#title').val(),
              'category': $('#category').val(),
              'content': $('#content').val(),
              'publish': $("input[name='publish']:checked").val()
            },
            dataType: 'html'
          }).done(function (data) {
            if (data) {
              alert('新增成功');
              location.href = "article_list.php";
            }
            else {
              alert(data);
            }
          }).fail(function (jaXHR, textStatus, errorThrown) {
            console.log(jaXHR.responseText);
          })
        }
        return false;
      })
    })
  </script>
</body>

</html>