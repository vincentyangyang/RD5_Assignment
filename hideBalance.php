<?php

    require("config.php");

    session_start();

    if(isset($_POST['display'])){

        $sth = $db->prepare("update customers set display = :display where cId = :cId");
        $sth->bindParam("cId", $_SESSION['bank_id'], PDO::PARAM_INT);    
        $sth->bindParam("display", $_POST['display'], PDO::PARAM_INT);   
        $sth->execute();

        $db = null;
    }



?>