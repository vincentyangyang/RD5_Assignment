<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>

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


        #page-container {
            position: relative;
            min-height: 100vh;
        }


        .navbar-nav{
            margin-left: 60px;
        }

        #navbarCollapse{
            position: relative;
        }

        #guest{
            position: absolute;
            right: 50px;
            color: white;
        }

        #content{
            margin: auto;
            margin-top: 50px;
        }

        #information{
            background-color: white;
            height: 300px;
            box-shadow: 0px 5px 15px -10px rgba(0,0,0,0.55);

        }

        #sign{
            width: 10px;
            height: 20px; 
            background-color: #00994e;
            float: left;
            margin-top: 2px;
            margin-right: 3px;
        }

        #eye{
            position: absolute;
            right: 0px;
            margin-right:100px; 
        }

        #TWDdeposit{
            position: absolute;
            right: 0px;
            margin-right:110px; 
        }
      
      
      </style>


</head>
<body>

    <nav class="navbar navbar-expand-md navbar-light" style="background-color: 	#BDB76B;">

    <a href="http://localhost:8000/RD5_Assignment/RD5_Laravel/public/" class="navbar-brand">網銀</a>

    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">

        <ul class="navbar-nav">

        <li class="nav-item index">
            <a href="./" class="nav-link">首頁</a>
        </li>

        <li class="nav-item withdrawal">
            <a href="action?action=withdrawal" class="nav-link">提款</a>
        </li>

        <li class="nav-item deposit">
            <a href="action?action=deposit" class="nav-link">存款</a>
        </li>

        <li class="nav-item detail">
            <a href="detail" class="nav-link">明細</a>
        </li>

        <li class="nav-item">
            <a href="login?logout=1" class="nav-link">登出</a>
        </li>

        </ul>

        <span id="guest">
        <a href="./" class="btn btn-outline-light btn-sm">你好！{{ Session::get('bank_login') }}</a> 
    </span>
    
    </div>
    </nav>

    <div id="content" class="col-6">
        
        <div>
            <div id="sign"></div>

            <h5>我的帳號總覽</h5>
        </div>

        <div id="information">

            <div id="TD-Box" style="margin-bottom: 60px;">
     
                    <div style="margin-left: 80px;padding-top:30px;">
                        <p style="float: left;margin-top: 15px;">台幣資產總額</p>
                        <span class="balanceOne text-right">{{ $customer['balance'] }}</span>
                    </div>
                    <button id="eye" onclick="hide()" style="border: none;margin-top:15px;" type="button"><img src="<?= asset('bower/image/eye.png') ?>" style="height:20px; width:29px;"> </button>
            </div>

            <hr style="margin-bottom: 30px;">

            <div id="TD-Box" style="">
        
                <div calss="col-6" style="margin-left: 80px;">
                    <p style="float: left;margin-top: 3px; ">活期儲蓄薪資轉帳存款</p>
                    <span class="balanceTwo text-right"></span>
                    <a id="TWDdeposit" href="action?action=deposit" class="btn btn-sm btn-outline-success">台幣存款</a>
                </div>
                

            </div>

            <div>
            
            </div>      
        
        </div>
    </div>

<script>

    $('.index').addClass("active");

    var flag = "{{ $customer['display'] }}";

    display();

    function display(){
        if (flag == 1){
            $(".balanceOne").prop("style","");
            $(".balanceTwo").prop("style","");
            $(".balanceOne").html('{{ $customer["balance"] }}' +"<span style='font-size: 25px;'>元</span>");
            $(".balanceTwo").html('{{ $customer["balance"] }}' +"元");
            $(".balanceOne").css({"font-size": "35px","color": "#73B839","margin-right":"10px","float":"left","width":"370px"});
            $(".balanceTwo").css({"font-size": "20px","float":"left","width":"260px"});
        }else{
            $(".balanceOne").html("*******");
            $(".balanceTwo").html("*******");
            $(".balanceOne").css({"font-size": "35px","color": "#73B839","margin-right":"10px","float":"left","padding-left":"270px","margin-top":"10px"});
            $(".balanceTwo").css({"font-size": "20px","float":"left","padding-left":"210px","margin-top":"7px"});
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function hide(){
        if (flag == 1){
            flag = 0;
            display();

            $.ajax({
                type: "post",
                url: "{{ route('indexPost') }}",
                data: {display: 0}
            })
        }else{
            flag = 1;
            display();

            dataList = {
                
            }
            $.ajax({
                type: "post",
                url: "{{ route('indexPost') }}",
                data: {display: 1}
            })
        }
    }

</script>
    
</body>
</html>