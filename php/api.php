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
        echo $user->verifyUser();
        
    } else if(isset($_GET["firstname_"])&&isset($_GET["lastname_"])&&isset($_GET["email_"])&&isset($_GET["password_"])){
        //Envia los parametros para el registro de nuevo usuario

        $firstname = $_GET["firstname_"];
        $lastname = $_GET["lastname_"];
        $email = $_GET["email_"];
        $password = $_GET["password_"];

        $user = new usuario($firstname, $lastname, $email, $password);
        echo $user->newUser();

    } else if (isset($_GET['book_action'])) { 
        // Leemos la Acción

        if ( $_GET['book_action'] == 'set_book' && isset( $_GET['book_ID'] ) ){
            // Caso: Establecer un libro global En las Cookies.

            setcookie('book_ID', $_GET['book_ID']);
        
            echo json_encode(Array(
                    'status' => 'Libro en Índice.',
                    'res' => true
                )
            );
    

        } else if ($_GET['book_action'] == 'get_book'){
            // Caso: Extraer un libro global En las Cookies.
        
        
            echo json_encode(Array(
                    'id' => $_COOKIE['book_ID'],
                    'status' => true
                )
            );

        } else {
            error();
        }

    } else{
        //Mandamos a llamar el error
        error();
    }
?>