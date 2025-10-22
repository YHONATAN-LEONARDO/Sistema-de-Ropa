
<?php 

    // include  '../../app/config/database.php';
    $consultaVendedor = "SELECT * FROM vendedor";
    $resultado = sqlsrv_query($conn, $consultaVendedor);

    $titulo      = '';
    $precio      = '';
    $descripcion = '';
    $cantidad    = '';
    $categoria   = '';
    $talla       = '';
    $genero      = '';
    $color       = '';
    $vendedor    = '';
    $errores = []; 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        echo "<pre>";
        var_dump($_FILES);
        echo "</pre>";
        exit;
        $titulo      = $_POST['titulo'];
        $precio      = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $cantidad    = $_POST['cantidad'];
        $categoria   = $_POST['categoria'];
        $talla       = $_POST['talla'];
        $genero      = $_POST['genero'];
        $color       = $_POST['color'];
        $vendedor    = $_POST['vendedor'];

         if (!$titulo) {
        $errores[] = 'Debes añadir un título';
        }
        if (!$precio || $precio <= 0) {
            $errores[] = 'Debes ingresar un precio válido';
        }
        if (!$descripcion) {
            $errores[] = 'Debes añadir una descripción';
        }
        if (!$cantidad || $cantidad <= 0) {
            $errores[] = 'Debes indicar la cantidad';
        }
        if (!$categoria) {
            $errores[] = 'Debes seleccionar una categoría';
        }
        if (!$talla) {
            $errores[] = 'Debes seleccionar una talla';
        }
        if (!$genero) {
            $errores[] = 'Debes seleccionar el género';
        }
        if (!$color) {
            $errores[] = 'Debes añadir un color';
        }
        if (!$vendedor) {
            $errores[] = 'Debes seleccionar un vendedor';
        }

        if(empty($errores)){
            
            $sql = "INSERT INTO productos (titulo, precio, descripcion, cantidad, categoria, talla, genero, color, vendedor)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            //  Crear arreglo con los valores
            $params = [
                $titulo,
                $precio,
                $descripcion,
                $cantidad,
                $categoria,
                $talla,
                $genero,
                $color,
                $vendedor
            ];
            
            //  Ejecutar la consulta
            $stmt = sqlsrv_query($conn, $sql, $params);
            if($stmt){
                header('Location: ./productos.php');
            }
        }

        
    }

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
        <h1 class="titulo">Registro de Ropa</h1>
    </header>
    <?php 
        foreach($errores as $error){
            ?>
            <div class="alerta error">
                <?php echo $error;?>
            </div>

        <?php } ?>

    <a href="./productos.php"><button>Volver</button></a>
    <main class="contenedor">
        <form class="formulario" method="POST" action="/admin/productos/crear.php" enctype="multipart/form-data">

            <!-- Información general -->
            <fieldset class="fieldset">
                <legend class="legend">Información General</legend>

                <label for="titulo" class="label">Título:</label>
                <input type="text" id="titulo" name="titulo" class="input" placeholder="Título de la prenda" value="<?php echo $titulo?>">

                <label for="precio" class="label">Precio:</label>
                <input type="number" id="precio" name="precio" class="input" placeholder="Precio en Bs" min="0" value="<?php echo $precio?>">

                <label for="imagen" class="label">Imagen:</label>
                <input type="file" id="imagen" name="imagen" class="input" accept="image/jpeg, image/png">

                <label for="descripcion" class="label">Descripción:</label>
                <textarea  id="descripcion" name="descripcion" class="textarea" rows="4" placeholder="Descripción breve de la prenda"><?php echo $descripcion?></textarea>
            </fieldset>

            <!-- Detalles de la prenda -->
            <fieldset class="fieldset">
                <legend class="legend">Detalles de la Prenda</legend>
                <label for="cantidad" class="label">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" class="input" placeholder="Cantidad" min="0" value="<?php echo $cantidad?>">
                <label for="categoria" class="label">Tipo de prenda:</label>
                <select id="categoria" name="categoria" class="select">
                    <option value="">Seleccione una opción</option>
                    <option value="camisa">Camisa</option>
                    <option value="pantalon">Pantalón</option>
                    <option value="abrigo">Abrigo</option>
                    <option value="falda">Falda</option>
                    <option value="vestido">Vestido</option>
                </select>

                <label for="talla" class="label">Talla:</label>
                <select id="talla" name="talla" class="select">
                    <option value="">--Seleccione--</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>

                <label for="genero" class="label">Género:</label>
                <select id="genero" name="genero" class="select">
                    <option value="">Seleccione</option>
                    <option value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                </select>

                <label for="color" class="label">Color:</label>
                <input type="text" id="color" name="color" class="input" placeholder="Ejemplo: Negro, Blanco, Gris" value="<?php echo $color?>">
            </fieldset>

           <!-- Información del vendedor -->
            <fieldset class="fieldset">
                <legend class="legend">Vendedor</legend>

                <label for="vendedor" class="label">Nombre del vendedor:</label>
                <select id="vendedor" name="vendedor" class="select">
                    <option value="">--Seleccione--</option>
                    <?php while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['nombre'] . " " . $row['apellido']; ?>
                        </option>
                    <?php } ?>
                </select>
            </fieldset>


            <input type="submit" value="Crear Producto" class="boton-verde">
        </form>
    </main>
</body>
</html>
