<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./public/css/estilos.css">
</head>
<body>
    <?php include __DIR__ . '/views/layouts/header.php'; ?>
  <main>
    <img class="img-completo" src="public/img/principal/hombre.jpg" alt="Hombre">
    <?php include __DIR__ . '/anuncios.php'; ?>
  </main>
  <?php include __DIR__ . '/views/layouts/footer.php'; ?>

</body>
</html>