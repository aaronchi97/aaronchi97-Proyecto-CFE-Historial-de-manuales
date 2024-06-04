<?php
// Incluye el archivo de conexión
include '../../modelo/conexion-SINASU.php';

session_start();

// Obtener los datos del formulario
$id_agencia = $_SESSION["id-agencia-sinasu"]; // usar $_POST['id_agencia']
$mostrar_id_guia_sesion = $_SESSION["mostrar-id-guia"];


?>