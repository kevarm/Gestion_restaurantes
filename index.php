<?php
    session_start();
    if(isset($_SESSION['user'])){
        header("Location: /projects/2-DAW/proyecto_restaurantes/categorias.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/projects/2-DAW/proyecto_restaurantes/css/index.css">
    <title>Login</title>
</head>
<body>
    <form action="/projects/2-DAW/proyecto_restaurantes/src/login.php" method="post">
        <label for="user">Usuario: </label>
        <input type="text" id="user" name="user">
        <label for="password">Contraseña: </label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Acceder">
    </form>
</body>
</html>