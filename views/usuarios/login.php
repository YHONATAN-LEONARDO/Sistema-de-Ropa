<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - EcoAbrigo</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">

  <main class="login">
    <section class="login-box">
      <h2>Iniciar Sesión</h2>
      <form class="formulario" action="../../app/controllers/UsuarioController.php" method="POST">
        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" placeholder="Ingresa tu correo" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" placeholder="Ingresa tu contraseña" required>

        <button type="submit" name="accion" value="login">Ingresar</button>
      </form>

      <p>¿No tienes cuenta? <a href="registro.php" class="registrate">Regístrate aquí</a></p>
    </section>
  </main>

</body>
</html>
