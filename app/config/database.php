<?php
$serverName = "localhost"; // cambia si tu instancia es distinta
$connectionInfo = [
    "Database" => "db-sis",
    "UID" => "kali",          // tu usuario de SQL Server
    "PWD" => "kali"   // tu contraseña
];

$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    die("❌ Error de conexión a SQL Server: " . print_r(sqlsrv_errors(), true));
}
?>
