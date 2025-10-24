<?php
// include '../app/config/session.php';
include __DIR__ . '/../app/config/database.php'; // ajusta ruta si es necesario
$active = 'dashboard'; // <- marca el ítem activo del sidebar

// Helper para ejecutar una consulta escalar de forma segura
function kpi_scalar($conn, $sql, $params = []) {
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) return 0;
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC);
    return $row && isset($row[0]) ? (float)$row[0] : 0;
}

// Verifica si existe una tabla (ej: ventas_detalle)
function tabla_existe($conn, $nombreTabla) {
    $sql = "SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = ?";
    $stmt = sqlsrv_query($conn, $sql, [$nombreTabla]);
    if ($stmt === false) return false;
    return (bool) sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC);
}

// ---- KPIs ----

// Stock disponible (suma de cantidades en productos)
$kpi_stock_disponible = kpi_scalar($conn, "SELECT SUM(CAST(cantidad AS FLOAT)) FROM productos");

// Productos vendidos (si existe ventas_detalle: suma cantidades)
$kpi_productos_vendidos = 0;
if (tabla_existe($conn, 'ventas_detalle')) {
    $kpi_productos_vendidos = kpi_scalar($conn, "SELECT SUM(CAST(cantidad AS FLOAT)) FROM ventas_detalle");
}

// Pedidos (conteo de ventas)
$kpi_pedidos = 0;
if (tabla_existe($conn, 'ventas')) {
    $kpi_pedidos = kpi_scalar($conn, "SELECT COUNT(*) FROM ventas");
}

// Ganancia/Ingresos (aprox: SUM(total) en ventas)
$kpi_ganancia = 0.00;
if (tabla_existe($conn, 'ventas')) {
    $kpi_ganancia = kpi_scalar($conn, "SELECT SUM(CAST(total AS FLOAT)) FROM ventas");
}

// Formateo
function fnum($n) { return number_format((float)$n, 0, '.', ','); }
function fmon($n) { return number_format((float)$n, 2, '.', ','); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Administración</title>
  <link rel="stylesheet" href="/admin/panel.css">
  <link rel="stylesheet" href="/public/css/normalize.css">
</head>
<body>
  <div class="layout">
    <?php include 'sidebar.php'; ?>

    <main class="content">
      <h1>PANEL DE ADMINISTRACIÓN</h1>

      <section class="grid-kpis">
        <div class="kpi">
          <p class="kpi-label">Productos disponibles</p>
          <p class="kpi-value"><?php echo fnum($kpi_stock_disponible); ?></p>
        </div>
        <div class="kpi">
          <p class="kpi-label">Productos vendidos</p>
          <p class="kpi-value"><?php echo fnum($kpi_productos_vendidos); ?></p>
        </div>
        <div class="kpi">
          <p class="kpi-label">Pedidos</p>
          <p class="kpi-value"><?php echo fnum($kpi_pedidos); ?></p>
        </div>
        <div class="kpi">
          <p class="kpi-label">Ganancia</p>
          <p class="kpi-value">Bs <?php echo fmon($kpi_ganancia); ?></p>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
