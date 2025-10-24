<?php
require '../../app/config/database.php';

$mensaje = "";

// Inicializar variables vacías para que los inputs no den error en la primera carga
$nombre = $correo = $telefono = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accion"]) && $_POST["accion"] === "registrar") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $telefono = trim($_POST["telefono"]);
    $password = $_POST["password"];
    $confirmar = $_POST["confirmar"];

    if ($password !== $confirmar) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        $checkSql = "SELECT COUNT(*) AS existe FROM dbo.usuarios WHERE correo = ?";
        $checkStmt = sqlsrv_query($conn, $checkSql, [$correo]);
        $row = sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC);

        if ($row && $row['existe'] > 0) {
            $mensaje = "El correo ya está registrado.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insertSql = "INSERT INTO dbo.usuarios (nombre, correo, password_hash, rol) VALUES (?, ?, ?, ?)";
            $params = [$nombre, $correo, $hash, 'cliente'];
            $stmt = sqlsrv_query($conn, $insertSql, $params);

            if ($stmt === false) {
                $mensaje = "Error al registrar usuario.";
            } else {
                header("Location: /");
                exit;
            }
            sqlsrv_free_stmt($stmt);
        }
        sqlsrv_free_stmt($checkStmt);
    }
}

sqlsrv_close($conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - EcoAbrigo</title>
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
    }
    .mensaje.visible {
      opacity: 1;
    }
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
<body class="body-register">

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
      <h2>Crear Cuenta</h2>

      <form class="formulario" action="registro.php" method="POST">
        <label for="nombre">Nombre completo:</label>
        <input type="text" name="nombre" placeholder="Tu nombre completo" required value="<?php echo htmlspecialchars($nombre); ?>">

        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" placeholder="ejemplo@correo.com" required value="<?php echo htmlspecialchars($correo); ?>">

        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" placeholder="Número de contacto" required value="<?php echo htmlspecialchars($telefono); ?>">

        <label for="password">Contraseña:</label>
        <input type="password" name="password" placeholder="Crea una contraseña" required>

        <label for="confirmar">Confirmar contraseña:</label>
        <input type="password" name="confirmar" placeholder="Repite tu contraseña" required>

        <button type="submit" name="accion" value="registrar">Registrarse</button>
      </form>

      <p>¿Ya tienes una cuenta? <a href="login.php" class="registrate">Inicia sesión aquí</a></p>
    </section>
  </main>

  <script>
    const msg = document.getElementById('mensaje');
    if (msg) setTimeout(() => msg.remove(), 3000);
  </script>
</body>
</html>
