<?php

    require_once("classes/user.php");

    // Retorna el error
    function error(){
        echo json_encode(Array(
                'error' => 'No params settled.',
                'res' => false
            )
        );    
    }

    if(isset($_GET["email"])&&isset($_GET["password"])){    
        //Verifica el inicio de sesión

        $email =$_GET["email"];
        $password =$_GET["password"];

        $user = new usuario($email,$password);
        $user_data = $user->verifyUser();

        $verify = json_decode($user_data);
			
        if($verify->res == true ){

            session_start();
            $_SESSION["user"] = $user_data;
            echo $_SESSION["user"];

        }else{

            error();
        }
        
    } else if(isset($_GET["firstname_"])&&isset($_GET["lastname_"])&&isset($_GET["email_"])&&isset($_GET["password_"])){
        //Envia los parametros para el registro de nuevo usuario

        $firstname = $_GET["firstname_"];
        $lastname = $_GET["lastname_"];
        $email = $_GET["email_"];
        $password = $_GET["password_"];

        $user = new usuario($firstname, $lastname, $email, $password);
        echo $user->newUser();

    } else if (isset($_GET['session_action'])) { 
        
        session_start();

        if(empty($_SESSION)){
				error();

        } else if($_GET['session_action']=="destroy"){

            session_destroy();

            echo json_encode(Array(
                    'status' => 'Sesion terminada',
                    'res' => true
                    )
            ); 

        } else if($_GET['session_action']=="verify"){

            echo json_encode(Array(
                    'status' => 'Sesion activa',
                    'res' => true
                    )
            ); 

        } else{
            error();
        }
        

    } else{
        //Mandamos a llamar el error
        error();
    }
?>