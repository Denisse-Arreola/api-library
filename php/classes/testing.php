<?php

    require_once("user.php");

    if(isset($_GET["email"])&&isset($_GET["password"])){
        $email =$_GET["email"];
        $password =$_GET["password"];

        $testing = new usuario($email,$password);
        echo $testing->verifyUser();
        
    } else{
        echo json_encode(array('error'=>false));
    }
?>