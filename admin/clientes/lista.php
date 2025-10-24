<?php
// admin/clientes/lista.php
// include '../../app/config/session.php';
include '../../app/config/database.php';

/*
  Ajusta si tus nombres de columnas/tablas difieren.
  Supuesto:
  - Tabla clientes: id, nombre, apellido, correo, telefono, creado_en
*/

$sql = "
  SELECT
    id,
    nombre,
    apellido,
    correo,
    telefono,
    creado_en
  FROM clientes
  ORDER BY id DESC
";
$resultado = sqlsrv_query($conn, $sql);
if ($resultado === false) {
  die('Error al consultar clientes: ' . print_r(sqlsrv_errors(), true));
}

function cl_fmt_fecha($f){
  if ($f instanceof DateTime) return $f->format('Y-m-d');
  if (is_array($f) && isset($f['date'])) return date('Y-m-d', strtotime($f['date']));
  return htmlspecialchars((string)$f);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clientes | Listado</title>
  <link rel="stylesheet" href="/admin/panel.css">
</head>
<body class="cl-page cl-page--clientes">


  <header class="header cl-header">
    <h1 class="titulo cl-title">Listado de Clientes</h1>
  </header>

  <!-- Botón Volver (simple) -->
  <div class="cl-actions-top">
    <a href="../index.php" class="cl-btn cl-btn--back">Volver</a>
  </div>

  <main class="cl-container">
    <div class="cl-table-wrap">
      <table class="cl-table">
        <thead class="cl-table__head">
          <tr class="cl-table__head-row">
            <th class="cl-th cl-th--id">ID</th>
            <th class="cl-th cl-th--nombre">Nombre</th>
            <th class="cl-th cl-th--correo">Correo</th>
            <th class="cl-th cl-th--telefono">Teléfono</th>
            <th class="cl-th cl-th--creado">Creado</th>
          </tr>
        </thead>
        <tbody class="cl-table__body">
          <?php while($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
            $nombreCompleto = trim(($row['nombre'] ?? '').' '.($row['apellido'] ?? ''));
          ?>
          <tr class="cl-row">
            <td class="cl-td cl-td--id"><?php echo (int)$row['id']; ?></td>
            <td class="cl-td cl-td--nombre"><?php echo htmlspecialchars($nombreCompleto ?: '—'); ?></td>
            <td class="cl-td cl-td--correo"><?php echo htmlspecialchars($row['correo'] ?? '—'); ?></td>
            <td class="cl-td cl-td--telefono"><?php echo htmlspecialchars($row['telefono'] ?? '—'); ?></td>
            <td class="cl-td cl-td--creado"><?php echo cl_fmt_fecha($row['creado_en']); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
