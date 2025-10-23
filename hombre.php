<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>
  <?php include 'views/layouts/header.php' ?>

  <main>
    <!-- esta img tiene que 100% with  y cada card maximo 8 columnas de 4-->
    <img class="img-completo" src="/public/img/principal/hombre.jpg" alt="">
    <?php  include 'anuncios.php' ?>
  </main>
  <?php include 'views/layouts/footer.php' ?>
</body>
</html>