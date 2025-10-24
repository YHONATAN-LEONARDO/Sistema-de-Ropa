<?php 
include  '../../app/config/database.php'; 
// include '../../app/config/session.php';
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
    <link rel="stylesheet" href="/admin/panel.css">
</head>
<body class="pr-page pr-page--productos">


    <header class="header pr-header">
        <h1 class="titulo pr-title">Registros de Ropa</h1>
    </header>

    <?php if($mensaje == 1){ ?>
        <div class="alerta exito pr-alert pr-alert--success" id="mensaje">Se creó correctamente</div>
    <?php } elseif($mensaje == 2){ ?>
        <div class="alerta exito pr-alert pr-alert--updated" id="mensaje">Producto actualizado correctamente</div>
    <?php } elseif($mensaje == 3){ ?>
        <div class="alerta exito pr-alert pr-alert--deleted" id="mensaje">Producto eliminado correctamente</div>
    <?php } ?>

    <div class="pr-actions">
        <a href="../index.php"><div class="crear pr-btn pr-btn--back">volver</div></a>
        <a href="./crear.php"><div class="crear pr-btn pr-btn--new">Nuevo Producto</div></a>
    </div>

    <div class="table-wrap pr-table-wrap">
        
      <table class="pr-table">
          <thead class="pr-table__head">
              <tr class="pr-table__head-row">
                  <th class="pr-table__th pr-table__th--id">ID</th>
                  <th class="pr-table__th pr-table__th--titulo">Título</th>
                  <th class="pr-table__th pr-table__th--imagen">Imagen</th>
                  <th class="pr-table__th pr-table__th--precio">Precio</th>
                  <th class="pr-table__th pr-table__th--acciones">Acciones</th>
              </tr>
          </thead>
          <tbody class="pr-table__body">
              <?php while($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) { ?>
                  <tr class="pr-table__row">
                      <td class="pr-table__td pr-table__td--id"><?php echo $row['id']; ?></td>
                      <td class="pr-table__td pr-table__td--titulo"><?php echo htmlspecialchars($row['titulo']); ?></td>
                      <td class="pr-table__td pr-table__td--imagen">
                          <img class="tabla-img pr-table__img" 
                               src="../../imagenes/<?php echo htmlspecialchars($row['imagen']); ?>" 
                               alt="<?php echo htmlspecialchars($row['titulo']); ?>">
                      </td>
                      <td class="pr-table__td pr-table__td--precio"><?php echo $row['precio']; ?> Bs</td>
                      <td class="pr-table__td pr-table__td--acciones">
                          <form action="" method="POST" class="pr-form pr-form--delete">
                              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                              <input type="submit" value="Eliminar" class="boton eliminar pr-btn pr-btn--danger">
                          </form>
                          <a class="boton actualizar pr-btn pr-btn--update" href="actualizar.php?id=<?php echo $row['id']; ?>">Actualizar</a>
                      </td>
                  </tr>
              <?php } ?>
          </tbody>
      </table>
    </div>

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
