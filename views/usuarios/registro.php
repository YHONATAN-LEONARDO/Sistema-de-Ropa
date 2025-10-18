<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - EcoAbrigo</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="body-register">

  <main class="login">
    <section class="login-box">
      <h2>Crear Cuenta</h2>

      <!-- formulario -->
      <form class="formulario" action="../../app/controllers/UsuarioController.php" method="POST">
        
        <label for="nombre">Nombre completo:</label>
        <input type="text" name="nombre" placeholder="Tu nombre completo" required>

        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" placeholder="ejemplo@correo.com" required>

        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" placeholder="Número de contacto" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" placeholder="Crea una contraseña" required>

        <label for="confirmar">Confirmar contraseña:</label>
        <input type="password" name="confirmar" placeholder="Repite tu contraseña" required>

        <button type="submit" name="accion" value="registrar">Registrarse</button>
      </form>
      <!-- formulario -->

      <p>¿Ya tienes una cuenta? <a href="login.php" class="registrate">Inicia sesión aquí</a></p>
    </section>
  </main>

</body>
</html>
