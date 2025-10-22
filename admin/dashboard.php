
<?php 

    require '../app/config/database.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
        
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Nueva Prenda</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <h1 class="titulo">Registro de Ropa</h1>
    </header>

    <main class="contenedor">
        <form class="formulario" method="POST" action="./productos/crear.php">

            <!-- Información general -->
            <fieldset class="fieldset">
                <legend class="legend">Información General</legend>

                <label for="titulo" class="label">Título:</label>
                <input type="text" id="titulo" name="titulo" class="input" placeholder="Título de la prenda">

                <label for="precio" class="label">Precio:</label>
                <input type="number" id="precio" name="precio" class="input" placeholder="Precio en Bs" min="0">

                <label for="imagen" class="label">Imagen:</label>
                <input type="file" id="imagen" name="imagen" class="input" accept="image/jpeg, image/png">

                <label for="descripcion" class="label">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="textarea" rows="4" placeholder="Descripción breve de la prenda"></textarea>
            </fieldset>

            <!-- Detalles de la prenda -->
            <fieldset class="fieldset">
                <legend class="legend">Detalles de la Prenda</legend>
                <label for="cantidad" class="label">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" class="input" placeholder="Cantidad" min="0">
                <label for="categoria" class="label">Tipo de prenda:</label>
                <select id="categoria" name="categoria" class="select">
                    <option value="">--Seleccione--</option>
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
                    <option value="">--Seleccione--</option>
                    <option value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                </select>

                <label for="color" class="label">Color:</label>
                <input type="text" id="color" name="color" class="input" placeholder="Ejemplo: Negro, Blanco, Gris">
            </fieldset>

            <!-- Información del vendedor -->
            <fieldset class="fieldset">
                <legend class="legend">Vendedor</legend>

                <label for="vendedor" class="label">Nombre del vendedor:</label>
                <select id="vendedor" name="vendedor" class="select">
                    <option value="">--Seleccione--</option>
                    <option value="juan">Juan</option>
                    <option value="pedro">Pedro</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Producto" class="boton-verde">
        </form>
    </main>
</body>
</html>
