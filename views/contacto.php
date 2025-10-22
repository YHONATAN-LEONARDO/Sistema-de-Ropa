<?php /* contacto.php */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="public/css/estilos.css"/>
  <title>Contáctanos</title>
</head>
<body>
<?php include "views/layouts/header.php"; ?>

<main class="contenedor contacto">
  <section class="contacto-flex">
    <div class="col formulario">
      <h1>Contáctanos</h1>
      <form action="#" method="post" class="form-grid">
        <label>
          <span>Nombre</span>
          <input type="text" name="nombre" required>
        </label>
        <label>
          <span>Correo</span>
          <input type="email" name="correo" required>
        </label>
        <label class="full">
          <span>Asunto</span>
          <input type="text" name="asunto" required>
        </label>
        <label class="full">
          <span>Mensaje</span>
          <textarea name="mensaje" rows="6" required></textarea>
        </label>
        <button type="submit" class="btn">Enviar</button>
      </form>
    </div>

    <aside class="col info">
      <div class="tarjeta-info">
        <h2>Información</h2>
        <p>Teléfono</p>
        <p>Correo</p>
        <p>Dirección</p>
      </div>

      <figure class="mapa">
        <img src="public/img/contacto/mapa.jpg" alt="">
      </figure>

      <div class="redes-flex">
        <img src="public/img/contacto/rrss-1.png" alt="">
        <img src="public/img/contacto/rrss-2.png" alt="">
        <img src="public/img/contacto/rrss-3.png" alt="">
      </div>
    </aside>
  </section>
</main>

<?php include "views/layouts/footer.php"; ?>
</body>
</html>
