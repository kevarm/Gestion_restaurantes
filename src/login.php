<?php
    ini_set("display_errors",1);
    ini_set("display_startup_errors",1);
    error_reporting(E_ALL);

    session_start();

    require_once $_SERVER["DOCUMENT_ROOT"]."/projects/2-DAW/proyecto_restaurantes/db/functions.php";

    $user=$_POST["user"]??"";
    $pass=$_POST["password"]??"";

    if(empty($user)||empty($pass)){
        header("Location: /projects/2-DAW/proyecto_restaurantes/index.php");
        exit();
    }

    try{
        $conn=conexion();
        if($conn===null){
            echo "Error en la conexion";
            exit();
        }
        $query=$conn->prepare("SELECT * from usuarios WHERE email=:email AND passw=:passw");
        $query->bindParam(":email",$user);
        $query->bindParam(":passw",$pass);
        $query->execute();
        $session_user=$query->fetch(PDO::FETCH_ASSOC);
        if ($session_user){
            $_SESSION["user"]=[
                "email"=>$session_user["email"],
                "codigo"=>$session_user["codigo"]
            ];
            if(isset($_COOKIE["carrito"])){
                $_SESSION["carrito"]=json_decode($_COOKIE["carrito"],true);
            }else{
                $_SESSION["carrito"]=[];
            }

            header("Location: /projects/2-DAW/proyecto_restaurantes/categorias.php");
        }else{
            header("Location: /projects/2-DAW/proyecto_restaurantes/index.php?error=1");
            exit();
        }

    }catch(PDOException $e){
        echo "Error: ".$e->getMessage();
        exit();
    }
?>