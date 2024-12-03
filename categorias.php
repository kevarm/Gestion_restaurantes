<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/projects/2-DAW/proyecto_restaurantes/db/functions.php";

if (!isset($_SESSION["user"])) {
    header("Location: /projects/2-DAW/proyecto_restaurantes/index.php");
    exit();
}

$user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="/projects/2-DAW/proyecto_restaurantes/css/categorias.css">
</head>

<body>
    <header>
        <a href="/projects/2-DAW/proyecto_restaurantes/src/logout.php">Cerrar sesión</a>
    </header>
    <main>
        <h1>Hola <?php echo htmlspecialchars($user["email"]); ?></h1>
        <?php
        try {
            $conn = conexion();
            if ($conn === null) {
                echo "Error en la conexion";
                exit();
            }
            $query = $conn->prepare("SELECT * from categorias");
            $query->execute();
            $lista_categorias = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($lista_categorias) {
                foreach($lista_categorias as $categoria){
                    $codigo=htmlspecialchars($categoria["codigo"]);
                    $nombre=htmlspecialchars($categoria["nombre"]);
                    $descripcion=htmlspecialchars($categoria["descripcion"]);

                    echo "<a href='producto.php?codigo=".$codigo."'>{$nombre}</a>";
                }
            } else {
                echo "<h3>No existen categorias</h3>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
        ?>
    </main>
</body>

</html>
