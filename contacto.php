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

<h1 class="contacto-titulo t-p">Contáctanos</h1>
<main class="contacto-main">
  <section class="contacto-layout">
    
    <div class="contacto-formulario">
      <form action="#" method="post" class="contacto-form">
        
        <label class="contacto-label">
          <span class="contacto-span">Nombre</span>
          <input type="text" name="nombre" class="contacto-input" required>
        </label>

        <label class="contacto-label">
          <span class="contacto-span">Correo</span>
          <input type="email" name="correo" class="contacto-input" required>
        </label>

        <label class="contacto-label contacto-full">
          <span class="contacto-span">Asunto</span>
          <input type="text" name="asunto" class="contacto-input" required>
        </label>

        <label class="contacto-label contacto-full">
          <span class="contacto-span">Mensaje</span>
          <textarea name="mensaje" rows="6" class="contacto-textarea" required></textarea>
        </label>

        <button type="submit" class="contacto-boton">Enviar</button>
      </form>
    </div>

    <aside class="contacto-info">
      <div class="contacto-tarjeta">
        <h2 class="contacto-subtitulo">Información</h2>
        <p class="contacto-dato">Teléfono: +591 76543210</p>
        <p class="contacto-dato">Correo: contacto@ejemplo.com</p>
        <p class="contacto-dato">Dirección: Av. Siempre Viva 742</p>
      </div>

      <figure class="contacto-mapa">
        <img src="public/img/icons/mapa.png" alt="Mapa de ubicación" class="contacto-mapa-img">
      </figure>

      <div class="contacto-redes">
        <ion-icon name="logo-facebook" class="contacto-red"></ion-icon>
        <ion-icon name="logo-instagram" class="contacto-red"></ion-icon>
        <ion-icon name="logo-twitter" class="contacto-red"></ion-icon>
      </div>
    </aside>

  </section>
</main>

<?php include "views/layouts/footer.php"; ?>
</body>
</html>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>