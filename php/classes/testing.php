<?php

require_once("user.php");

// echo "Esto es una prueba";
// echo "</br>";

$testing = new usuario("arxie.denisse@gmail.com","12345");

echo $testing->verifyUser();



?>