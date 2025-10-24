<?php
// admin/reportes/ventas_dia.php
// include '../../app/config/session.php';
include '../../app/config/database.php';

/*
  Reporte simple: Ventas por día
  Supone tabla: ventas(id, fecha, total, ...)
*/

$sql = "
  SELECT
    CONVERT(date, v.fecha) AS dia,
    COUNT(*)               AS ventas,
    SUM(v.total)           AS total_bs
  FROM ventas v
  GROUP BY CONVERT(date, v.fecha)
  ORDER BY dia DESC
";
$resultado = sqlsrv_query($conn, $sql);
if ($resultado === false) {
  die('Error al consultar reportes: ' . print_r(sqlsrv_errors(), true));
}

function rp_fmt_dia($d){
  if ($d instanceof DateTime) return $d->format('Y-m-d');
  if (is_array($d) && isset($d['date'])) return date('Y-m-d', strtotime($d['date']));
  return htmlspecialchars((string)$d);
}
function rp_fmt_bs($n){
  if ($n === null) return '0.00';
  return number_format((float)$n, 2, '.', '');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reportes | Ventas por Día</title>
  <link rel="stylesheet" href="/admin/panel.css">
</head>
<body class="rp-page rp-page--reportes">

 

  <header class="header rp-header">
    <h1 class="titulo rp-title">Reporte: Ventas por Día</h1>
  </header>

  <!-- Botón Volver -->
  <div class="rp-actions">
    <a href="../index.php" class="rp-btn rp-btn--back">Volver</a>
  </div>

  <main class="rp-container">
    <div class="rp-table-wrap">
      <table class="rp-table">
        <thead class="rp-table__head">
          <tr class="rp-table__head-row">
            <th class="rp-th rp-th--fecha">Fecha</th>
            <th class="rp-th rp-th--ventas">N° Ventas</th>
            <th class="rp-th rp-th--total">Total (Bs)</th>
          </tr>
        </thead>
        <tbody class="rp-table__body">
          <?php while($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) { ?>
            <tr class="rp-row">
              <td class="rp-td rp-td--fecha"><?php echo rp_fmt_dia($row['dia']); ?></td>
              <td class="rp-td rp-td--ventas"><?php echo (int)$row['ventas']; ?></td>
              <td class="rp-td rp-td--total"><?php echo rp_fmt_bs($row['total_bs']); ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
