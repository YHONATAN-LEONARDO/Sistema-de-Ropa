
<?php 

    $mensaje = $_GET['mensaje'] ?? null;


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
    <?php if($mensaje == 1){ ?>
        <div class="alerta exito">Se creo correctamente</div>
    <?php } ?>

    
</body>
</html>
