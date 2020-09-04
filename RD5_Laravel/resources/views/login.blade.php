<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用戶登錄</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="<?= asset('bower/bootstrap/dist/css/bootstrap.min.css') ?>">
    <script src="<?= asset('bower/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= asset('bower/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    

    <style>
      body{
        padding: 0;
        margin: 0;
        background-color: #FFF5EE;
      }
      .navbar-nav{
        margin-left: 60px;
      }

      .footer{
        height: 30px;
        color: #ffffff;
        background: #c3c3c3;
        text-align: center;
        clear: both;
        margin-bottom:2px;
        padding-top: 4px;
        padding: auto;
        width: 100%;
      }

      .fixed-bottom {
        position: fixed;
        bottom: 0;
        width:100%;
      }

      #fail{
          color: red;
      }

    </style>


</head>

<body>
<nav class="navbar navbar-expand-md navbar-light" style="background-color: 	#BDB76B;">

  <a href="http://localhost:8000/RD5_Assignment/RD5_Laravel/public/login" class="navbar-brand">網銀</a>

  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
  </button>



</nav>

<div style="margin-top: 50px;" class="container">

<form method="post">


<div class="form-group row">
    <label for="admin" class="col-4 col-form-label"><span class="float-right">帳號</span></label> 
    <div class="col-4">
        <input id="admin" name="admin" type="text" class="form-control" value=""  placeholder="請輸入帳號" pattern="\w{7,}">
    </div>
</div>

<div class="form-group row">
    <label for="pass" class="col-4 col-form-label float-right"><span class="float-right">密碼</span></label> 
    <div class="col-4">
        <input id="pass" name="pass" type="password" class="form-control" value=""  placeholder="請輸入密碼" pattern="\w{7,}">
    </div>
</div>



<div class="form-group row">
    <div class="offset-4 col-8">
        <button id="submit" name="" value="OK" type="button" class="btn btn-success">登入</button>
        <button name="cancel" value="cancel" type="button" class="btn btn-success" onclick="window.location.href='register'">註冊</button>
    </div>
    
</div>


</form>

<div id="fail" class="text-center"> </div>


</div>


<div class="footer fixed-bottom">
  Ching Yo© 2020. All Rights Reserved
</div>

  <script type="text/javascript">

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#submit').on('click',function(){
      var dataList = {
        admin: $('#admin').val(),
        pass: $('#pass').val()
      }

      $.ajax({        
        type: "POST",
        url: "{{ route('loginPost') }}",
        data: dataList,
        success: function(msg) {
          console.log(msg);
          if (msg=="success"){
            window.location.href="./";
          }else if (msg=="fail"){
            $('#fail').html("帳號或密碼錯誤！！");
          }
        }
      })
    });

    

  </script>
</body>
</html>