<?php


header("content-type:text/html; charset=utf-8");

$db = new PDO("mysql:host=127.0.0.1;dbname=my_Bank", "root", "root");
$db->exec("SET CHARACTER SET utf8");


?>