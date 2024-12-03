<?php
    ini_set("display_errors",1);
    ini_set("display_startup_errors",1);
    error_reporting(E_ALL);

    session_start();

    require_once $_SERVER["DOCUMENT_ROOT"]."/projects/2-DAW/proyecto_restaurantes/db/functions.php";

    if(!isset($_SESSION["user"])){
        header("Location: /projects/2-DAW/proyecto_restaurantes/index.php");
        exit();
    }

    $user=$_SESSION["user"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
</head>
<body>
    <header>
        <a href="/projects/2-DAW/proyecto_restaurantes/src/logout.php">Cerrar sesión</a>
    </header>
    <h1>Hola <?php echo htmlspecialchars($user["email"]); ?></h1>
</body>
</html>