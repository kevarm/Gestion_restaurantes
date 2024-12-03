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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="/proyectos/Gestion_restaurantes/css/carrito.css">
</head>

<body>
    <header>
        <a href="/proyectos/Gestion_restaurantes/src/logout.php">Cerrar sesión</a>
        <a href="/proyectos/Gestion_restaurantes/categorias.php">Categorías</a>
    </header>
    <main>
        <h1>Usuario: <?php echo htmlspecialchars($user["email"]); ?></h1>
        <?php
        try {
            if (empty($_SESSION['carrito'])){
                echo "<p>No tienes productos en tu carrito</p>";
            } else {
                $conn = conexion();
                if ($conn === null) {
                    echo "Error en la conexion";
                    exit();
                }
                $importe = 0;
                foreach ($_SESSION['carrito'] as $codigo => $producto) {
                    $query = $conn->prepare("SELECT * FROM productos WHERE codigo=:codigo");
                    $query->bindParam(':codigo', $codigo, PDO::PARAM_INT);
                    $query->execute();
                    $productos = $query->fetch(PDO::FETCH_ASSOC);

                    // Depuración: Imprimir el resultado
                    var_dump($productos);

                    if ($productos) {
                        $nombre = htmlspecialchars($productos["nombre"]);
                        $descripcion = htmlspecialchars($productos["descripcion"]);
                        $cantidad = htmlspecialchars($productos["cantidad"]);

                        echo "
                        <div>
                            <h5>{$nombre}</h5>
                            <p>{$descripcion}</p>
                            <p>Cantidad disponible: {$cantidad}</p>
                        </div>
                        <form action='/proyectos/Gestion_restaurantes/src/eliminarCarrito.php' method='POST'>
                            <input type='hidden' name='codigo' value='{$codigo}'>
                            <label for='cantidad{$codigo}'>Eliminar cantidad:</label>
                            <input type='number' id='cantidad{$codigo}' name='cantidadEliminar' min='1' max='{$cantidad}' value='1' required>
                            <button type='submit'>Eliminar del carrito</button>
                        </form>";
                    }
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
        ?>
    </main>
</body>

</html>

