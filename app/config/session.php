<?php
session_start();

$auth = $_SESSION['login'] ?? false;

if (!$auth) {
    header('Location: /');
    exit;
}

// Si quieres ver los datos de sesión en pruebas:
// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
?>
