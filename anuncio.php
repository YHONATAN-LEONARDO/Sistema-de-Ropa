<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>
    <?php
include 'app/config/database.php';

$id = $_GET['id'];
$sql = "
  SELECT id, titulo, imagen, color, talla, descripcion, precio
  FROM productos
  WHERE id = $id
";
$result = sqlsrv_query($conn, $sql);
$p = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
?>

<?php include 'views/layouts/header.php'; ?>
<h1 class="t-p">Estilo que conquista.</h1>
<main class="anuncio-page">
  <div class="anuncio-img media">
    <img class="anuncio-img__img" src="imagenes/<?php echo $p['imagen']; ?>" alt="<?php echo $p['titulo']; ?>">
  </div>
  
  <div class="anuncio-datos panel">
    <h1><?php echo $p['titulo']; ?></h1>
    <p><strong>Precio:</strong> <?php echo $p['precio']; ?> Bs</p>

    <div class="anuncio-descripcion-wrap">
      <p class="anuncio-descripcion"><?php echo nl2br($p['descripcion']); ?></p>
      <p class="anuncio-mas-vendido-boton">lo mas vendido</p>
    </div>

    <p class="anuncio-label-color">color:</p>
    <p class="anuncio-color"><?php echo $p['color']; ?></p>

    <p class="anuncio-label-talla">talla:</p>
    <p class="anuncio-talla"><?php echo $p['talla']; ?></p>

    <div class="anuncio-acciones">
      <div class="anuncio-cantidad">
        <button class="anuncio-cantidad-menos" type="button">-</button>
        <p class="anuncio-cantidad-valor">1</p>
        <button class="anuncio-cantidad-mas" type="button">+</button>
      </div>
      <button class="anuncio-add-cart" type="button">añadir a la cesta</button>
    </div>

    <p class="anuncio-envio-info">Envío GRATIS en pedidos de 70bs o más y Click & Collect</p>
    <h2 class="anuncio-disponibilidad-titulo">Disponibilidad en tienda</h2>
  </div>
</main>
<?php include 'views/layouts/footer.php'; ?>

</body>
</html>