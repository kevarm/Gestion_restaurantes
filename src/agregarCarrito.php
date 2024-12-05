<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/projects/2-DAW/proyecto_restaurantes/db/functions.php";

// Verificar que los parámetros POST estén definidos
$user = $_POST["user"] ?? "";
$pass = $_POST["password"] ?? "";

if (empty($user) || empty($pass)) {
    header("Location: /projects/2-DAW/proyecto_restaurantes/index.php");
    exit();
}

// Verificar que se reciban los parámetros necesarios para el carrito
if (isset($_POST['codigo'], $_POST['cantidad'])) {
    $codigo = $_POST['codigo'];
    $categoria = $_POST['categoria'];
    $cantidad = (int) $_POST['cantidad'];

    if ($cantidad <= 0) {
        echo "La cantidad solicitada no es válida";
        exit();
    }

    $conn = conexion();
    if ($conn === null) {
        echo "Fallo en la conexión";
        exit();
    }
    
    // Consulta para obtener el stock del producto
    $query = $conn->prepare("SELECT cantidad_stock FROM producto WHERE codigo = :codigo");
    $query->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $query->execute();
    $producto = $query->fetch(PDO::FETCH_ASSOC);

    // Depurar: Mostrar los parámetros recibidos y el estado del producto
    var_dump($_POST);  // Verifica si 'codigo' y 'cantidad' se están recibiendo correctamente.
    var_dump($producto);  // Verifica si el producto se encuentra en la base de datos.

    if ($producto) {
        $stock = $producto['cantidad_stock'];

        // Depuración: Verifica el stock disponible
        var_dump($stock);

        if ($stock >= $cantidad) {
            // Si el carrito no está inicializado, lo inicializamos
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            // Depuración: Verifica el estado del carrito antes de agregar el producto
            var_dump($_SESSION['carrito']);

            if (isset($_SESSION['carrito'][$codigo])) {
                // Si el producto ya está en el carrito, actualizamos la cantidad
                $totalCarrito = $_SESSION['carrito'][$codigo]['cantidad'] + $cantidad;

                // Verificar si la cantidad total no excede el stock
                if ($totalCarrito <= $stock) {
                    $_SESSION['carrito'][$codigo]['cantidad'] += $cantidad;
                } else {
                    echo "No hay suficiente stock disponible";
                    exit();
                }
            } else {
                // Si el producto no está en el carrito, lo agregamos
                $_SESSION['carrito'][$codigo] = ['codigo' => $codigo, 'cantidad' => $cantidad];
            }

            // Actualizar el stock en la base de datos
            $stock_actualizado = $stock - $cantidad;
            $queryActualizar = $conn->prepare("UPDATE producto SET cantidad_stock = :stock_actualizado WHERE codigo = :codigo");
            $queryActualizar->bindParam(':stock_actualizado', $stock_actualizado, PDO::PARAM_INT);
            $queryActualizar->bindParam(':codigo', $codigo, PDO::PARAM_INT);

            // Depurar: Verifica si la actualización de la base de datos fue exitosa
            if ($queryActualizar->execute()) {
                // Redirigir al usuario después de actualizar el carrito y el stock
                header("Location: /projects/2-DAW/proyecto_restaurantes/productos.php?codigo=" . $codigo);
                exit();
            } else {
                echo "Error al actualizar el stock";
                exit();
            }

        } else {
            echo "No hay suficiente stock";
        }
    } else {
        echo "Producto no encontrado";
        exit();
    }
} else {
    echo "Error: No se ha recibido un parámetro básico";
    exit();
}
?>

