<?php
     ini_set("display_errors",1);
     ini_set("display_startup_errors",1);
     error_reporting(E_ALL);
 
     session_start();

     setcookie("carrito",json_encode($_SESSION["carrito"]),time()+(86400*7),"/");

     session_destroy();

     header("Location: /projects/2-DAW/proyecto_restaurantes/index.php");
     exit();
?>