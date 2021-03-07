<?php

// Pruebas con una sección de Api en PHP
// buscamos un parámetro que establezca una 
// acción a seguir.

function retError(){
    echo json_encode(Array(
            'error' => 'No params settled.',
            'res' => false
        )
    );    

}


if (isset($_GET['book_action'])) { // Leemos la Acción

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

    } 


    else {
        retError();
    }


} else {

    retError();

}



?>