<?php

    session_start();
    header("content-type:text/html; charset=utf-8");

    if (!isset($_SESSION["bank_login"])){
        header("Location: login.php");
        exit();
    }

    if(isset($_GET['action'])){
        if($_GET['action'] == 'deposit'){
            $action = 'deposit';
        }else{
            $action = 'withdrawal';
        }
    }

    $db = new PDO("mysql:host=127.0.0.1;dbname=myBank", "root", "root");
    $db->exec("SET CHARACTER SET utf8");
    $sth = $db->prepare("select * from customers where cId = :cId");
    $sth->bindParam("cId", $_SESSION['bank_id'], PDO::PARAM_INT);    
    $sth->execute();

    $row = $sth->fetch();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>存/提款</title>

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

    <a href="http://localhost:8000/RD5_Assignment/index.php" class="navbar-brand">網銀</a>

    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">

        <ul class="navbar-nav">

        <li class="nav-item index">
            <a href="index.php" class="nav-link">首頁</a>
        </li>

        <li class="nav-item withdrawal">
            <a href="action.php?action=withdrawal" class="nav-link">提款</a>
        </li>

        <li class="nav-item deposit">
            <a href="action.php?action=deposit" class="nav-link">存款</a>
        </li>

        <li class="nav-item detail">
            <a href="detail.php" class="nav-link">明細</a>
        </li>

        <li class="nav-item">
            <a href="login.php?logout=1" class="nav-link">登出</a>
        </li>

        </ul>

        <span id="guest">
        <a href="index.php" class="btn btn-outline-light btn-sm">你好！<?= $_SESSION['bank_login'] ?></a> 
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

                <form method="get" id="formtwo" >


                    <div class="form-group row">
                        <label style="padding-left: 55px;" for="moneytwo" class="col-4 col-form-label">金額</label> 
                        <div class="col-7">
                            <input id="moneytwo" name="money" type="text" placeholder="最少需提出1000" class="form-control" >
                        </div>
                        <span class="float-right" style="font-size:10px;margin-left:170px;">您的餘額:<?= $row['balance'] ?></span>
                    </div> 

        

                    <div class="form-group row">
                        <label style="padding-left: 55px;" for="remarkstwo" class="col-4 col-form-label">備註</label> 
                        <div class="col-8">
                            <textarea name="remarks" id="remarkstwo" cols="27" rows="5" style="resize: none;"> </textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button id="submittwo" name="" value="OK" type="button" onclick="goWithdrawal(<?= $_SESSION['bank_id'] ?>)" class="btn btn-success">提出</button>
                            <a href="index.php" class="btn btn-success">取消</a>
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

                <form method="get" id="form" >


                    <div class="form-group row">
                        <label style="padding-left: 55px;" for="money" class="col-4 col-form-label">金額</label> 
                        <div class="col-7">
                            <input id="money" name="money" type="text" placeholder="最少需存入1000" class="form-control">
                        </div>
                        <span class="float-right" style="font-size:10px; margin-left:250px;margin-left:170px;">您的餘額:<?= $row['balance'] ?></span>
                    </div>

                    <div class="form-group row">
                        <label style="padding-left: 55px;" for="remarks" class="col-4 col-form-label">備註</label> 
                        <div class="col-8">
                        <textarea name="remarks" id="remarks" cols="27" rows="5" style="resize: none;"></textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button id="submit" name="" value="OK" type="button" onclick="goDeposit(<?= $_SESSION['bank_id'] ?>)"class="btn btn-success">存入</button>
                            <a href="index.php" class="btn btn-success">取消</a>
                        </div>
                        
                    </div>


                </form>

            </div>


        </div>

    </div>
            

<script>

    var action = "<?= $action ?>";  

    if(action == "deposit"){
        $('.deposit').addClass("active");
        $('#deposit').show();
    }else{
        $('.withdrawal').addClass("active");
        $('#withdrawal').show();
    }


    function goWithdrawal(id){
        var money = parseInt($('#moneytwo').val());
        var balance = parseInt("<?= $row['balance']?>");

        if(money < balance){
            var rule = /[^0]\d+/;
            balance -= money;
            var remarks = $("#remarkstwo").val();

            if (money > 0 && rule.test(money)){
                if(money % 1000 != 0){
                    alert('請輸入1000之倍數');
                }else{
                    var dataList = {
                        id: id,
                        money: money,
                        action: 'withdrawal',
                        balance: balance,
                        remarks: remarks
                    }

                    $.ajax({
                        type: "post",
                        url: "add.php",
                        data: dataList,
                        success: function(e){
                            window.location.replace("detail.php");  
                        }
                    })
                }
            }else{
                alert('請輸入有效數值');
            }
        }else{
            alert('餘額不足');
        }


    }

    function goDeposit(id){
        var money = parseInt($('#money').val());

        var balance = parseInt("<?= $row['balance']?>");
        var rule = /[^0]\d+/;
        balance += money;
        var remarks = $("#remarks").val();

        if (money > 0 &&  rule.test(money)){
            if(money % 1000 != 0){
                alert('請輸入1000之倍數');
            }else{
                var dataList = {
                    id: id,
                    money: money,
                    action: 'deposit',
                    balance: balance,
                    remarks: remarks
                }

                $.ajax({
                    type: "post",
                    url: "add.php",
                    data: dataList,
                    success: function(e){
                        window.location.replace("detail.php");  
                    }
                })
            }
        }else{
            alert('請輸入有效數值');
        }

    }

    
    

</script>
    
</body>
</html>