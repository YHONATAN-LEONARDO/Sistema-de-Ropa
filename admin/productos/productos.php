<?php 
include  '../../app/config/database.php'; 
include '../../app/config/session.php';
$mensaje = $_GET['mensaje'] ?? null;

// Si se envía el formulario para eliminar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener la imagen del producto antes de eliminarlo
    $sqlImg = "SELECT imagen FROM productos WHERE id = ?";
    $stmtImg = sqlsrv_query($conn, $sqlImg, [$id]);
    $producto = sqlsrv_fetch_array($stmtImg, SQLSRV_FETCH_ASSOC);

    if ($producto && $producto['imagen']) {
        $ruta = "../../imagenes/" . $producto['imagen'];
        if (file_exists($ruta)) {
            unlink($ruta); // Eliminar imagen del servidor
        }
    }

    // Eliminar producto de la base de datos
    $sqlDel = "DELETE FROM productos WHERE id = ?";
    $stmtDel = sqlsrv_query($conn, $sqlDel, [$id]);

    if ($stmtDel) {
        header("Location: ./productos.php?mensaje=3");
        exit;
    } else {
        echo "<div class='alerta error'>Error al eliminar el producto.</div>";
    }
}

// Consulta general de productos
$sql = "
    SELECT 
        p.id, 
        p.titulo, 
        p.imagen, 
        p.precio, 
        v.nombre AS nombre_vendedor, 
        v.apellido AS apellido_vendedor
    FROM productos p
    INNER JOIN vendedor v ON p.vendedor = v.id
    ORDER BY p.id DESC
";
$resultado = sqlsrv_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Nueva Prenda</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header class="header">
        <h1 class="titulo">Registros de Ropa</h1>
    </header>

    <?php if($mensaje == 1){ ?>
        <div class="alerta exito" id="mensaje">Se creó correctamente</div>
    <?php } elseif($mensaje == 2){ ?>
        <div class="alerta exito" id="mensaje">Producto actualizado correctamente</div>
    <?php } elseif($mensaje == 3){ ?>
        <div class="alerta exito" id="mensaje">Producto eliminado correctamente</div>
    <?php } ?>
    <div>
        <a href="../index.php"><div class="crear">volver</div></a>

        <a href="./crear.php"><div class="crear">Nuevo Producto</div></a>
    </div>
    

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                    <td>
                        <img class="tabla-img" 
                             src="../../imagenes/<?php echo htmlspecialchars($row['imagen']); ?>" 
                             alt="<?php echo htmlspecialchars($row['titulo']); ?>">
                    </td>
                    <td><?php echo $row['precio']; ?> Bs</td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="Eliminar" class="boton eliminar">
                        </form>
                        <a class="boton actualizar" href="actualizar.php?id=<?php echo $row['id']; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        // Ocultar el mensaje después de 3 segundos
        const mensaje = document.getElementById('mensaje');
        if (mensaje) {
            setTimeout(() => {
                mensaje.style.display = 'none';
            }, 3000);
        }
    </script>
</body>
</html>
