<?php /* hombre.php */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="public/css/estilos.css"/>
  <title>EcoAbrigo | Hombre</title>
</head>
<body>
<?php include "/views/layouts/header.php"; ?>

<main class="contenedor hombre">
  <section class="hero-seccion">
    <div class="hero-contenido">
      <h1>Hombre</h1>
      <p>Prendas pensadas para resistir el día a día.</p>
    </div>
    <figure class="hero-imagen">
      <img src="public/img/hombre/hero-hombre.jpg" alt="Colección Hombre"/>
    </figure>
  </section>

  <section class="grid-productos" aria-label="Lista de productos para hombre">
    <!-- Grid de productos (CSS Grid) -->
    <?php for ($i=1; $i<=8; $i++): ?>
      <article class="card-producto">
        <figure class="card-media">
          <img src="public/img/hombre/prod-<?php echo $i;?>.jpg" alt="Producto Hombre <?php echo $i;?>"/>
        </figure>
        <div class="card-info">
          <h3>Producto Hombre <?php echo $i;?></h3>
          <p>Talla/Material/Detalle</p>
          <button class="btn">Agregar al carrito</button>
        </div>
      </article>
    <?php endfor; ?>
  </section>

  <section class="destacados">
    <h2>Destacados</h2>
    <div class="carrusel-flex">
      <?php for ($i=1; $i<=6; $i++): ?>
        <div class="slide">
          <img src="public/img/hombre/dest-<?php echo $i;?>.jpg" alt="Destacado Hombre <?php echo $i;?>"/>
        </div>
      <?php endfor; ?>
    </div>
  </section>
</main>

<?php include "/views/layouts/footer.php"; ?>
</body>
</html>
