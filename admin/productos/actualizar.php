<?php 

include '../../app/config/database.php'; 

// Obtener ID del producto a actualizar
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Error: No se proporcionó un ID válido.");
}

// Consultar producto actual
$sqlProducto = "SELECT * FROM productos WHERE id = ?";
$paramsProducto = [$id];
$stmtProducto = sqlsrv_query($conn, $sqlProducto, $paramsProducto);
$producto = sqlsrv_fetch_array($stmtProducto, SQLSRV_FETCH_ASSOC);

if (!$producto) {
    die("Error: Producto no encontrado.");
}

// Consultar vendedores
$consultaVendedor = "SELECT * FROM vendedor";
$resultado = sqlsrv_query($conn, $consultaVendedor);

// Variables iniciales con los datos actuales
$titulo      = $producto['titulo'];
$precio      = $producto['precio'];
$descripcion = $producto['descripcion'];
$cantidad    = $producto['cantidad'];
$categoria   = $producto['categoria'];
$talla       = $producto['talla'];
$genero      = $producto['genero'];
$color       = $producto['color'];
$vendedor    = $producto['vendedor'];
$imagenActual = $producto['imagen'];

$errores = []; 

// Si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo      = $_POST['titulo'];
    $precio      = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $cantidad    = $_POST['cantidad'];
    $categoria   = $_POST['categoria'];
    $talla       = $_POST['talla'];
    $genero      = $_POST['genero'];
    $color       = $_POST['color'];
    $vendedor    = $_POST['vendedor'];
    $imagen      = $_FILES['imagen'];

    // Validaciones básicas
    if (!$titulo) $errores[] = 'Debes añadir un título';
    if (!$precio || $precio <= 0) $errores[] = 'Debes ingresar un precio válido';
    if (!$descripcion) $errores[] = 'Debes añadir una descripción';
    if (!$cantidad || $cantidad <= 0) $errores[] = 'Debes indicar la cantidad';
    if (!$categoria) $errores[] = 'Debes seleccionar una categoría';
    if (!$talla) $errores[] = 'Debes seleccionar una talla';
    if (!$genero) $errores[] = 'Debes seleccionar el género';
    if (!$color) $errores[] = 'Debes añadir un color';
    if (!$vendedor) $errores[] = 'Debes seleccionar un vendedor';

    if (empty($errores)) {
        // Manejo de imagen
        $carpetaImg = '../../imagenes/';
        if (!is_dir($carpetaImg)) {
            mkdir($carpetaImg);
        }
        if($imagen['name']){
             unlink($carpetaImg . $producto['imagen']);

        }
        if ($imagen && $imagen['name']) {
            // Subir nueva imagen
            $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
            move_uploaded_file($imagen['tmp_name'], $carpetaImg . $nombreImg);
        } else {
            // Mantener la actual
            $nombreImg = $imagenActual;
        }

        // Actualizar en la base de datos
        $sql = "UPDATE productos 
                SET titulo = ?, precio = ?, descripcion = ?, cantidad = ?, categoria = ?, 
                    talla = ?, genero = ?, color = ?, vendedor = ?, imagen = ?
                WHERE id = ?";
        
        $params = [
            $titulo, $precio, $descripcion, $cantidad, $categoria,
            $talla, $genero, $color, $vendedor, $nombreImg, $id
        ];
        
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt) {
            header('Location: ./productos.php?mensaje=2');
            exit;
        } else {
            $errores[] = "Error al actualizar el producto.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Prenda</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header class="header">
        <h1 class="titulo">Actualizar Producto</h1>
    </header>

    <?php foreach($errores as $error){ ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <a href="./productos.php"><button>Volver</button></a>

    <main class="contenedor">
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <!-- Información general -->
            <fieldset class="fieldset">
                <legend class="legend">Información General</legend>

                <label for="titulo" class="label">Título:</label>
                <input type="text" id="titulo" name="titulo" class="input" value="<?php echo $titulo; ?>">

                <label for="precio" class="label">Precio:</label>
                <input type="number" id="precio" name="precio" class="input" value="<?php echo $precio; ?>">

                <label for="imagen" class="label">Imagen actual:</label>
                <img src="../../imagenes/<?php echo $imagenActual; ?>" width="100">
                <input type="file" id="imagen" name="imagen" class="input" accept="image/jpeg, image/png">

                <label for="descripcion" class="label">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="textarea"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <!-- Detalles -->
            <fieldset class="fieldset">
                <legend class="legend">Detalles de la Prenda</legend>

                <label for="cantidad" class="label">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" class="input" value="<?php echo $cantidad; ?>">

                <label for="categoria" class="label">Tipo de prenda:</label>
                <select id="categoria" name="categoria" class="select">
                    <option value="">Seleccione una opción</option>
                    <option value="camisa" <?php if($categoria=='camisa') echo 'selected'; ?>>Camisa</option>
                    <option value="pantalon" <?php if($categoria=='pantalon') echo 'selected'; ?>>Pantalón</option>
                    <option value="abrigo" <?php if($categoria=='abrigo') echo 'selected'; ?>>Abrigo</option>
                    <option value="falda" <?php if($categoria=='falda') echo 'selected'; ?>>Falda</option>
                    <option value="vestido" <?php if($categoria=='vestido') echo 'selected'; ?>>Vestido</option>
                </select>

                <label for="talla" class="label">Talla:</label>
                <select id="talla" name="talla" class="select">
                    <option value="">--Seleccione--</option>
                    <option value="S" <?php if($talla=='S') echo 'selected'; ?>>S</option>
                    <option value="M" <?php if($talla=='M') echo 'selected'; ?>>M</option>
                    <option value="L" <?php if($talla=='L') echo 'selected'; ?>>L</option>
                    <option value="XL" <?php if($talla=='XL') echo 'selected'; ?>>XL</option>
                </select>

                <label for="genero" class="label">Género:</label>
                <select id="genero" name="genero" class="select">
                    <option value="">Seleccione</option>
                    <option value="hombre" <?php if($genero=='hombre') echo 'selected'; ?>>Hombre</option>
                    <option value="mujer" <?php if($genero=='mujer') echo 'selected'; ?>>Mujer</option>
                </select>

                <label for="color" class="label">Color:</label>
                <input type="text" id="color" name="color" class="input" value="<?php echo $color; ?>">
            </fieldset>

            <!-- Vendedor -->
            <fieldset class="fieldset">
                <legend class="legend">Vendedor</legend>
                <label for="vendedor" class="label">Nombre del vendedor:</label>
                <select id="vendedor" name="vendedor" class="select">
                    <option value="">--Seleccione--</option>
                    <?php while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['id']; ?>" <?php if($vendedor == $row['id']) echo 'selected'; ?>>
                            <?php echo $row['nombre'] . " " . $row['apellido']; ?>
                        </option>
                    <?php } ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Producto" class="boton-verde">
        </form>
    </main>
</body>
</html>
