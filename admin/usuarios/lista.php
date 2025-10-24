<?php
// admin/usuarios/lista.php
// include '../../app/config/session.php';
include '../../app/config/database.php';

/*
  Ajusta nombres si tu esquema difiere.
  Supuesto tabla: empleados(id, nombre, apellido, correo, telefono, rol, creado_en)
*/

$sql = "
  SELECT
    id,
    nombre,
    apellido,
    correo,
    telefono,
    rol,
    creado_en
  FROM empleados
  ORDER BY id DESC
";
// $resultado = sqlsrv_query($conn, $sql);
// if ($resultado === false) {
//   die('Error al consultar empleados: ' . print_r(sqlsrv_errors(), true));
// }

// function ue_fmt_fecha($f){
//   if ($f instanceof DateTime) return $f->format('Y-m-d');
//   if (is_array($f) && isset($f['date'])) return date('Y-m-d', strtotime($f['date']));
//   return htmlspecialchars((string)$f);
// }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Usuarios | Empleados</title>
  <link rel="stylesheet" href="/admin/panel.css">
</head>
<body class="ue-page ue-page--lista">

  <header class="header ue-header">
    <h1 class="titulo ue-title">Empleados</h1>
  </header>

  <div class="ue-actions-top">
    <a href="../index.php" class="ue-btn ue-btn--back">Volver</a>
    <a href="./crear.php" class="ue-btn ue-btn--primary">Nuevo Empleado</a>
  </div>

  <main class="ue-container">
    <div class="ue-table-wrap">
      <table class="ue-table">
        <thead class="ue-table__head">
          <tr class="ue-table__head-row">
            <th class="ue-th ue-th--id">ID</th>
            <th class="ue-th ue-th--nombre">Nombre</th>
            <th class="ue-th ue-th--correo">Correo</th>
            <th class="ue-th ue-th--telefono">Teléfono</th>
            <th class="ue-th ue-th--rol">Rol</th>
            <th class="ue-th ue-th--creado">Creado</th>
            <th class="ue-th ue-th--acciones">Acciones</th>
          </tr>
        </thead>
        <tbody class="ue-table__body">
          <?php while($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) { 
            $nombreCompleto = trim(($row['nombre'] ?? '').' '.($row['apellido'] ?? ''));
          ?>
          <tr class="ue-row">
            <td class="ue-td ue-td--id"><?php echo (int)$row['id']; ?></td>
            <td class="ue-td ue-td--nombre"><?php echo htmlspecialchars($nombreCompleto ?: '—'); ?></td>
            <td class="ue-td ue-td--correo"><?php echo htmlspecialchars($row['correo'] ?? '—'); ?></td>
            <td class="ue-td ue-td--telefono"><?php echo htmlspecialchars($row['telefono'] ?? '—'); ?></td>
            <td class="ue-td ue-td--rol"><?php echo htmlspecialchars($row['rol'] ?? '—'); ?></td>
            <td class="ue-td ue-td--creado"><?php echo ue_fmt_fecha($row['creado_en']); ?></td>
            <td class="ue-td ue-td--acciones">
              <a class="ue-btn ue-btn--mini ue-btn--primary" href="./editar.php?id=<?php echo (int)$row['id']; ?>">Editar</a>
              <form class="ue-form ue-form--inline" action="./eliminar.php" method="POST" onsubmit="return confirm('¿Eliminar empleado #<?php echo (int)$row['id']; ?>?');">
                <input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
                <button type="submit" class="ue-btn ue-btn--mini ue-btn--danger">Eliminar</button>
              </form>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
