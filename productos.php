<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/proyectos/Gestion_restaurantes/db/functions.php";

if (!isset($_SESSION["user"])) {
    header("Location: /proyectos/Gestion_restaurantes/index.php");
    exit();
}

$user = $_SESSION["user"];

if(isset($_GET["codigo"])){
    $categoria=htmlspecialchars($_GET["codigo"]);
}else{
    die("No existe la categoría");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
    <header>
        <a href="/proyectos/Gestion_restaurantes/src/logout.php">Cerrar sesión</a>
        <a href="/proyectos/Gestion_restaurantes/categorias.php">Volver a categorías</a>
        <a href="/proyectos/Gestion_restaurantes/carrito.php">Ir al carrito</a>
    </header>
    
    <?php
        try {
            $conn = conexion();
            if ($conn === null) {
                echo "Error en la conexion";
                exit();
            }
            $query = $conn->prepare("SELECT * from productos where categoria_id=:categoria;");
            $query->bindParam(":categoria",$categoria);
            $query->execute();
            $lista_productos = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($lista_productos) {
                foreach($lista_productos as $producto){
                    $codigo=htmlspecialchars($producto["codigo"]);
                    $nombre=htmlspecialchars($producto["nombre"]);
                    $descripcion=htmlspecialchars($producto["descripcion"]);
                    $peso=htmlspecialchars($producto["peso"]);
                    $cantidad=htmlspecialchars($producto["cantidad_stock"]);
                    $categoria_id=htmlspecialchars($producto["categoria_id"]);

                    echo "
                        <div>
                            <h3>$nombre</h3>
                            <p><strong>Descripción:</strong> $descripcion</p>
                            <p><strong>Stock disponible:</strong> $cantidad</p>
                            <p><strong>Peso:</strong> $peso kg</p>
                            <form action='/proyectos/Gestion_restaurantes/src/agregarCarrito.php' method='POST'>
                                <input type='hidden' name='codigoProducto' value='{$codigo}'>
                                <input type='hidden' name='codigoCategoria' value='{$categoria_id}'>
                                <label for='cantidad{$codigo}'>Cantidad:</label>
                                <input type='number' id='cantidad{$codigo}' name='cantidad' value='1' min='1' max='{$cantidad}' required>
                                <button type='submit'>Añadir al carrito</button>
                            </form>
                        </div>";          
                }
            } else {
                echo "<h3>No existen productos para esta categoría</h3>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
        ?>
</body>
</html>