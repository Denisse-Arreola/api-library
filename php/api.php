<?php

    require_once("classes/user.php");

    if(isset($_GET["email"])&&isset($_GET["password"])){
        $email =$_GET["email"];
        $password =$_GET["password"];

        $user = new usuario($email,$password);
        echo $user->verifyUser();
        
    } else if(isset($_GET["firstname_"])&&isset($_GET["lastname_"])&&isset($_GET["email_"])&&isset($_GET["password_"])){
        $firstname = $_GET["firstname_"];
        $lastname = $_GET["lastname_"];
        $email = $_GET["email_"];
        $password = $_GET["password_"];

        $user = new usuario($firstname, $lastname, $email, $password);
        echo $user->newUser();

    }else{
        echo json_encode(array('error'=>false));
    }
?>