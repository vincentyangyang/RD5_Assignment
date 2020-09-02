<?php
    session_start();

    $db = new PDO("mysql:host=127.0.0.1;dbname=myBank", "root", "root");
    $db->exec("SET CHARACTER SET utf8");

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        //存款,提款
        if(isset($_POST['action'])){  
            if($_POST['action'] == 'deposit'){
                $id = $_POST['id'];
                $money = $_POST['money'];
                $action = $_POST['action'];
                $balance = $_POST['balance'];
                $remarks = $_POST['remarks'];
                
                $sth = $db->prepare("insert into detail(cId,action,cash,nowBalance,remarks) values(:cId,:action,:cash,:nowBalance,:remarks)");

                $sth->bindParam("cId", $id, PDO::PARAM_INT);
                $sth->bindParam("action", $action, PDO::PARAM_STR, 50);
                $sth->bindParam("cash", $money, PDO::PARAM_INT);
                $sth->bindParam("nowBalance", $balance, PDO::PARAM_INT);
                $sth->bindParam("remarks", $remarks, PDO::PARAM_STR,1000);
            
                $sth->execute();

                $sth = $db->prepare("update customers set balance = :balance where cId = :cId");
        
                $sth->bindParam("cId", $id, PDO::PARAM_INT);
                $sth->bindParam("balance", $balance, PDO::PARAM_INT);
            
                $sth->execute();
            }else{
                $id = $_POST['id'];
                $money = $_POST['money'];
                $action = $_POST['action'];
                $balance = $_POST['balance'];
                $remarks = $_POST['remarks'];
                
                $sth = $db->prepare("insert into detail(cId,action,cash,nowBalance,remarks) values(:cId,:action,:cash,:nowBalance,:remarks)");

                $sth->bindParam("cId", $id, PDO::PARAM_INT);
                $sth->bindParam("action", $action, PDO::PARAM_STR, 50);
                $sth->bindParam("cash", $money, PDO::PARAM_INT);
                $sth->bindParam("nowBalance", $balance, PDO::PARAM_INT);
                $sth->bindParam("remarks", $remarks, PDO::PARAM_STR,1000);
            
                $sth->execute();

                $sth = $db->prepare("update customers set balance = :balance where cId = :cId");
        
                $sth->bindParam("cId", $id, PDO::PARAM_INT);
                $sth->bindParam("balance", $balance, PDO::PARAM_INT);
            
                $sth->execute();
            }

            $db = null;
            exit();
        }
        //會員註冊
        if(isset($_POST['register'])){
            $admin = $_POST['admin'];
            $pass = $_POST['pass'];
            $pass = password_hash($pass,PASSWORD_DEFAULT);
            $email = $_POST['email'];
            $birthday = $_POST['birthday'];
            $phone = $_POST['phone'];
        
        
            $sth = $db->prepare("select * from customers where admin = :admin");
                
            $sth->bindParam("admin", $admin, PDO::PARAM_STR, 50);
            $sth->execute();
        
            $row = $sth->fetch();
        
            if(!empty($row)){
              echo 'exist';
            }else{
                echo strlen($pass);
              $sth = $db->prepare("insert into customers (admin, password, email, birthday, phone) values (:admin, :pass, :email, :birthday, :phone)");
        
              $sth->bindParam("admin", $admin, PDO::PARAM_STR, 50);
              $sth->bindParam("pass", $pass, PDO::PARAM_STR, 100);
              $sth->bindParam("email", $email, PDO::PARAM_STR, 50);
              $sth->bindParam("birthday", $birthday, PDO::PARAM_STR, 50);
              $sth->bindParam("phone", $phone, PDO::PARAM_STR,50);
          
              $sth->execute();
            }

            $db = null;
            exit();
        
        }
        //使用者登入介面
        else{
            $acc = $_POST['admin'];
            $pass = $_POST['pass'];
     
            $sth = $db->prepare("select cId,password from customers where admin = :admin");
            $sth->bindParam("admin", $acc, PDO::PARAM_STR, 50);
            $sth->execute();
        
            $row = $sth->fetch();

            $re = password_verify($pass,$row['password']);
        
            if($re){
                $_SESSION["bank_login"] = $acc;
                $_SESSION["bank_id"] = $row['cId'];
                echo 'success';
            }else{
                echo 'fail';
            }

            $db = null;
            exit();
        }
    }




?>