<?php


    session_start();

    if(isset($_POST['display'])){
        $db = new PDO("mysql:host=127.0.0.1;dbname=myBank", "root", "root");
        $db->exec("SET CHARACTER SET utf8");

        $sth = $db->prepare("update customers set display = :display where cId = :cId");
        $sth->bindParam("cId", $_SESSION['id'], PDO::PARAM_INT);    
        $sth->bindParam("display", $_POST['display'], PDO::PARAM_INT);   
        $sth->execute();

        $db = null;
    }



?>