<?php
// admin/ventas/lista.php
// include '../../app/config/session.php';
include '../../app/config/database.php';

// Consulta simple de ventas (ajusta nombres de tablas/campos si difieren)
$sql = "
  SELECT
    v.id,
    v.fecha,
    v.total,
    v.estado,
    c.nombre   AS cliente_nombre,
    c.apellido AS cliente_apellido,
    ve.nombre  AS vendedor_nombre,
    ve.apellido AS vendedor_apellido
  FROM ventas v
  LEFT JOIN clientes c ON v.cliente_id = c.id
  LEFT JOIN vendedor ve ON v.vendedor = ve.id
  ORDER BY v.id DESC
";
$resultado = sqlsrv_query($conn, $sql);
if ($resultado === false) {
  die('Error al consultar ventas: ' . print_r(sqlsrv_errors(), true));
}

function sv_fmt_fecha($f){
  // SQLSRV puede devolver DateTime o array con 'date'
  if ($f instanceof DateTime) return $f->format('Y-m-d H:i');
  if (is_array($f) && isset($f['date'])) return date('Y-m-d H:i', strtotime($f['date']));
  return htmlspecialchars((string)$f);
}
function sv_fmt_bs($n){
  if ($n === null) return '0.00';
  return number_format((float)$n, 2, '.', '');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ventas | Listado</title>
  <link rel="stylesheet" href="/admin/panel.css">
</head>
<body class="sv-page sv-page--ventas">


  <header class="header sv-header">
    <h1 class="titulo sv-title">Listado de Ventas</h1>
  </header>

  <!-- Botón Volver -->
  <div class="sv-actions">
    <a href="../index.php" class="sv-btn sv-btn--back">Volver</a>
  </div>

  <main class="sv-container">
    <div class="sv-table-wrap">
      <table class="sv-table">
        <thead class="sv-table__head">
          <tr class="sv-table__head-row">
            <th class="sv-th sv-th--id">ID</th>
            <th class="sv-th sv-th--fecha">Fecha</th>
            <th class="sv-th sv-th--cliente">Cliente</th>
            <th class="sv-th sv-th--vendedor">Vendedor</th>
            <th class="sv-th sv-th--estado">Estado</th>
            <th class="sv-th sv-th--total">Total (Bs)</th>
          </tr>
        </thead>
        <tbody class="sv-table__body">
          <?php while($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
            $cliente = trim(($row['cliente_nombre'] ?? '').' '.($row['cliente_apellido'] ?? ''));
            $vendedor= trim(($row['vendedor_nombre'] ?? '').' '.($row['vendedor_apellido'] ?? ''));
            $estado  = (string)($row['estado'] ?? '');
          ?>
          <tr class="sv-row">
            <td class="sv-td sv-td--id"><?php echo (int)$row['id']; ?></td>
            <td class="sv-td sv-td--fecha"><?php echo sv_fmt_fecha($row['fecha']); ?></td>
            <td class="sv-td sv-td--cliente"><?php echo htmlspecialchars($cliente ?: '—'); ?></td>
            <td class="sv-td sv-td--vendedor"><?php echo htmlspecialchars($vendedor ?: '—'); ?></td>
            <td class="sv-td sv-td--estado"><?php echo htmlspecialchars($estado ?: '—'); ?></td>
            <td class="sv-td sv-td--total"><?php echo sv_fmt_bs($row['total']); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
