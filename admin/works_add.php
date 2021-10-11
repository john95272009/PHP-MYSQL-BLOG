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
          <div class="col-12 col-md-12">
       

        <!--form內容-->
           <div class="alert alert-light" role="alert">
                <form id="article_add" method="POST"  >
                <div class="form-group ">
                 
                    <h1>新增作品</h1>
                    <label for="title">標題</label>
                    <input type="text" class="form-control " name="title" id="title" aria-describedby="emailHelp" placeholder="標題" >
                    <div class="invalid-feedback ">請輸入標題
                    </div>
                </div>
                <div class="form-group error">
                    <label for="intro">介紹</label>
                    <textarea id="intro" class="form-control" rows="6"></textarea>
                    </select>
                    
                 
                </div>
              
                <div class="form-group ">
                  <label for="content">圖片上傳</label>
                  <input type="file" class="image" accept="image/jpg,image/png,image/gif">
                  <div class="show_image">
           
                   </div>
                          <input type="hidden" id="image_path">
                     <a href="javascript:void(0);" class="del_image  btn btn-danger">刪除圖片</a> 
                </div>
                <div class="form-group ">
                  <label for="content">影片上傳</label>
                  <input type="file" class="video" accept="video/*">
                  <div class="show_video">
           
                   </div>
                          <input type="hidden" id="video_path">
                     <a href="javascript:void(0);" class="del_video  btn btn-danger">刪除圖片</a> 
                </div>
               


                <div class="form-group ">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline1" name="publish" class="custom-control-input" value="1" checked>
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
    $(document).ready(function(){
      $('input.image').on("change",function(){
           if($('#image_path').val()!='')
          {
              $.ajax({
                type:'POST',
                url:'../php/del_upload.php',
                data:{
                  'file_path': $('#image_path').val()
                },
                dataType:'html'
            }).done(function(data){
              if(data=='yes')
              {
              $('.show_image').html('');
              $('#image_path').val('');
          
              }
              else{
                console.log(data);
              }

            }).fail(function(jaXHR,textStatus,errorThrown){
                 console.log(jaXHR.responseText);
            })
          }
       var file= $(this)[0].files[0],
           save_path="files/images/";
           form_data=new FormData();
           form_data.append("file",file);
           form_data.append("save_path",save_path);
         
           $.ajax({
            type:'POST',
            url:'../php/upload_file.php',
            data:form_data,
            cache:false,//因為只有上傳檔案，所以不需要暫存
            processData:false,//因為只有上傳檔案，所以不要處理表單資訊
            contentType:false,//送過去的內容，由formdata產生了，所以
            dataType:'html'
           }).done(function(data){
           if(data=='yes'){
            $("div.show_image").html("<img src='../"+save_path+file['name']+"'>");
            $("#image_path").val(save_path+file['name']);
   
           }
           else{
             console.log(data);
           }
           }).fail(function(jaXHR,textStatus,errorThrown){
            console.log(jaXHR.responseText);
           })
      })


      //圖片刪除
         $('a.del_image').on('click',function()
    {
        if($('#image_path').val()!="")
        {
            var c =confirm('確定要刪除嗎?');
            if(c)
            {
              $.ajax({
                type:'POST',
                url:'../php/del_upload.php',
                data:{
                  'file_path': $('#image_path').val()
                },
                dataType:'html'
            }).done(function(data){
              if(data=='yes')
              {
              $('.show_image').html('');
              $('#image_path').val('');
              $('input.image').val('');
              }
              else{
                console.log(data);
              }

            }).fail(function(jaXHR,textStatus,errorThrown){
                 console.log(jaXHR.responseText);
            })




            }
        }
        else
        {
          alert('無資料');
        }


    })

          $('input.video').on("change",function(){

       var file= $(this)[0].files[0],
           save_path="files/videos/";
           form_data=new FormData();
           form_data.append("file",file);
           form_data.append("save_path",save_path);
         
           $.ajax({
            type:'POST',
            url:'../php/upload_fileV.php',
            data:form_data,
            cache:false,//因為只有上傳檔案，所以不需要暫存
            processData:false,//因為只有上傳檔案，所以不要處理表單資訊
            contentType:false,//送過去的內容，由formdata產生了，所以
            dataType:'html'
           }).done(function(data){
           if(data=='yes'){
            $("div.show_video").html("<video src='../"+save_path+file['name']+"' controls>");
            $("#video_path").val(save_path+file['name']);
   
           }
           else{
             console.log(data);
           }
           }).fail(function(jaXHR,textStatus,errorThrown){
            console.log(jaXHR.responseText);
           })
      })


      //圖片刪除
         $('a.del_video').on('click',function()
    {
        if($('#video_path').val()!="")
        {
            var c =confirm('確定要刪除嗎?');
            if(c)
            {
              $.ajax({
                type:'POST',
                url:'../php/del_uploadV.php',
                data:{
                  'file_path': $('#video_path').val()
                },
                dataType:'html'
            }).done(function(data){
              if(data=='yes')
              {
              $('.show_video').html('');
              $('#video_path').val('');
              $('input.video').val('');
              }
              else{
                console.log(data);
              }

            }).fail(function(jaXHR,textStatus,errorThrown){
                 console.log(jaXHR.responseText);
            })




            }
        }
        else
        {
          alert('無資料');
        }


    })






      //上船選項
      

     $('#article_add').on("submit",function(){
      if($('#title').val() == '' || $('#intro').val() == '')
      {
        alert('標題或內文都沒輸入');
      }
      else
      {
        $.ajax({
          type:'POST',
          url:'../php/add_work.php',
          data:{
            'title':$('#title').val(),
            'intro':$('#intro').val(),
            'video':$('#video_path').val(),
            'image':$('#image_path').val(),
            'publish':$("input[name='publish']:checked").val(),

               },
          dataType:'html'
        }).done(function(data){
         if(data=='yes')
          {
         alert('新增成功');
         location.href='works_list.php';
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
