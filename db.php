<?php

    $servidor = "localhost";
    $db = "app";
    $name = "root";
    $password = "";

    try{
        $conn = new PDO("mysql:host=$servidor;db=$db",$name,$password);
    }catch(Exception $ex){
        echo $ex->getMessage(); 
    };

?>     