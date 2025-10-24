<?php 
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;
?> 

<header>
  <nav class="navegacion">
    <div class="enlace-uno">
      <a href="/" class="especial">
        <img class="logo" src="public/img/logo.png" alt="Logo EcoAbrigo">
      </a>
      <a href="hombre.php?genero=1">Hombre</a>
      <a href="mujer.php?genero=0">Mujer</a>
      <a href="acerca.php">Nosotros</a>
      <a href="contacto.php">Contáctanos</a>
    </div>

    <div class="enlace-dos">
      <?php if ($auth): ?>
        <a href="/views/usuarios/cerrar-sesion.php">Cerrar Sesión</a>
      <?php else: ?>
        <a href="/views/usuarios/login.php">Iniciar Sesión</a>
        <a href="/views/usuarios/registro.php">Registrarse</a>
      <?php endif; ?>
    </div>
  </nav>

  <video src="/public/video/sis2.mp4" autoplay muted loop playsinline></video>
</header>
