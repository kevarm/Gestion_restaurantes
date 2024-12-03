<?php
    function conexion(){
        try{
            $host="localhost";
            $db="restaurante";
            $user="root";
            $pass="";

            $dns="mysql:host=$host;dbname=$db";
            $conn=new PDO($dns,$user,$pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            error_log("Error en la conexión con la BD: ".$e->getMessage());
            return null;
        }
    }
?>