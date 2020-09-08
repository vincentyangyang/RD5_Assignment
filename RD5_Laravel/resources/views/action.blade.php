<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>存/提款</title>

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

        #deposit{
            margin: auto;
            margin-top: 50px;
            display: none;
        }
        #withdrawal{
            margin: auto;
            margin-top: 50px;
            display: none;
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

        #signtwo{
            width: 10px;
            height: 20px; 
            background-color: #00994e;
            float: left;
            margin-top: 2px;
            margin-right: 3px;
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

    <div id="withdrawal" class="col-6">
        
        <div id="titletwo">
            <div id="signtwo"></div>

            <h5>提款</h5>
        </div>

        <div id="information">
            
            
            
            <div class="col-8" style="margin: auto;padding-top:35px;">

                <form method="POST" id="formtwo" action="actionPost">
                    @csrf

                    <div class="form-group row">
                        <label style="padding-left: 55px;" for="moneytwo" class="col-4 col-form-label">金額</label> 
                        <div class="col-7">
                            <input id="moneytwo" name="money" type="text" placeholder="最少需提出1000" class="form-control" >
                        </div>
                        <span class="float-right" style="font-size:10px;margin-left:170px;">您的餘額:{{ $customer['balance'] }}</span>
                    </div> 

        

                    <div class="form-group row">
                        <label style="padding-left: 55px;" for="remarkstwo" class="col-4 col-form-label">備註</label> 
                        <div class="col-8">
                            <textarea name="remarks" id="remarkstwo" cols="27" rows="5" style="resize: none;"> </textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button id="withdrawalOK" name="OK" value="withdrawal" type="submit" class="btn btn-success">提出</button>
                            <a href="./" class="btn btn-success">取消</a>
                        </div>
                        
                    </div>


                </form>

            </div>


        </div>

    </div>
 

    <!-- ----------------------------- -->

    <div id="deposit" class="col-6">
        
        <div id="title">
            <div id="sign"></div>

            <h5>存款</h5>
        </div>

        <div id="information">
            
            
            
            <div class="col-8" style="margin: auto;padding-top:35px;">

                <form method="POST" id="form" action="actionPost">
                    @csrf

                    <div class="form-group row">
                        <label style="padding-left: 55px;" for="money" class="col-4 col-form-label">金額</label> 
                        <div class="col-7">
                            <input id="money" name="money" type="text" placeholder="最少需存入1000" class="form-control">
                        </div>
                        <span class="float-right" style="font-size:10px; margin-left:250px;margin-left:170px;">您的餘額:{{ $customer['balance'] }}</span>
                    </div>

                    <div class="form-group row">
                        <label style="padding-left: 55px;" for="remarks" class="col-4 col-form-label">備註</label> 
                        <div class="col-8">
                        <textarea name="remarks" id="remarks" cols="27" rows="5" style="resize: none;"></textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button id="depositOK" name="OK" value="deposit" type="submit" class="btn btn-success">存入</button>
                            <a href="./" class="btn btn-success">取消</a>
                        </div>
                        
                    </div>


                </form>

            </div>


        </div>

    </div>
            

<script>

    var action = "{{ $action }}";


    if(action == "deposit"){
        $('.deposit').addClass("active");
        $('#deposit').show();
    }else{
        $('.withdrawal').addClass("active");
        $('#withdrawal').show();
    }

    //讓Enter無效
    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    }); 

    //提款
    $('#withdrawalOK').on('click',function(event){
        var money = parseInt($('#moneytwo').val());
        var balance = "{{ $customer['balance'] }}"

        if(money <= balance){
            var rule = /[^0]\d+/;

            if (money > 0 && rule.test(money)){
                if(money % 1000 != 0){
                    alert('請輸入1000之倍數');
                    event.preventDefault();
                    return false;
                }else{
                    $('form').submit();
                }
            }else{
                alert('請輸入有效數值');
                event.preventDefault();
                return false;
            }
        }else{
            alert('餘額不足');
            event.preventDefault();
            return false;
        }
    })

    //存款
    $('#depositOK').on('click',function(event){
        var money = parseInt($('#money').val());
        var rule = /[^0]\d+/;

        if (money > 0 && rule.test(money)){
            if(money % 1000 != 0){
                alert('請輸入1000之倍數');
                event.preventDefault();
                return false;
            }else{
                $('form').submit();
            }
        }else{
            alert('請輸入有效數值');
            event.preventDefault();
            return false;
        }
    })

    
    

</script>
    
</body>
</html>