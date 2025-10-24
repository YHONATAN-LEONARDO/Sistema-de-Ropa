<?php
require '../../app/config/database.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accion"]) && $_POST["accion"] === "login") {
    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];

    // Buscar usuario por correo
    $sql = "SELECT id, nombre, correo, password_hash, rol FROM dbo.usuarios WHERE correo = ?";
    $stmt = sqlsrv_query($conn, $sql, [$correo]);

    if ($stmt === false) {
        $mensaje = "Error al consultar la base de datos.";
    } else {
        $usuario = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario["password_hash"])) {
            session_start();

            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nombre"] = $usuario["nombre"];
            $_SESSION["usuario_rol"] = $usuario["rol"];
            $_SESSION["login"] = true;

            header("Location: /");
            exit;
        } else {
            $mensaje = "Correo o contraseña incorrectos.";
        }
    }

    if ($stmt) sqlsrv_free_stmt($stmt);
}

sqlsrv_close($conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - EcoAbrigo</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .mensaje {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #ff0000ff;
      color: #ffffffff;
      padding: 10px 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      text-align: center;
      opacity: 0;
      transition: opacity 0.5s ease;
      z-index: 999;
      font-weight: 900;
    }
    .mensaje.visible { opacity: 1; }
     .volver {
  position: absolute;
  top: 50px;
  left: 50px;
  background-color: #ff2626ff;
  color: #ffffffff;
  text-decoration: none;
  font-size: 4rem;           /* tamaño del icono */
  padding: 1rem;
  border-radius: 20%;
  width: 7rem;
  height: 5rem;
  display: grid;
  place-content: center;
  font-weight: 900;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
  transition: all 0.3s ease;
}

  </style>
</head>
<body class="login-body">

  <?php if (!empty($mensaje)): ?>
    <div class="mensaje visible" id="mensaje"><?php echo htmlspecialchars($mensaje); ?></div>
    <script>
      const msg = document.getElementById('mensaje');
      setTimeout(() => msg.classList.remove('visible'), 3000);
      setTimeout(() => msg.remove(), 3500);
    </script>
  <?php endif; ?>

  <a href="/" class="volver">⮌</a>
  <main class="login">
    <section class="login-box">
      <h2>Iniciar Sesión</h2>
      <form class="formulario" action="login.php" method="POST">
        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" placeholder="Ingresa tu correo" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" placeholder="Ingresa tu contraseña" required>

        <button type="submit" name="accion" value="login">Ingresar</button>
      </form>

      <p>¿No tienes cuenta? <a href="registro.php" class="registrate">Regístrate aquí</a></p>
    </section>
  </main>

  <script>
    const msg = document.getElementById('mensaje');
    if (msg) setTimeout(() => msg.remove(), 3000);
  </script>
</body>
</html>
