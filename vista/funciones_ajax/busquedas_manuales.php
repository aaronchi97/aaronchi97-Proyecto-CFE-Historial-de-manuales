<?php
// busquedas_manuales.php

// Conectar a la base de datos y realizar la búsqueda
include "../../modelo/conexion.php";

// Consulta para obtener datos de id_motivomanual
$sql_busqueda_motivo = $conexion->query("SELECT DISTINCT TRIM(id_motivomanual) AS id_motivomanual FROM control_manuales");

// Consulta para obtener datos de cuenta
$sql_busqueda_cuenta = $conexion->query("SELECT DISTINCT cuenta FROM control_manuales");

// Consulta para obtener datos de respaldo 
$sql_busqueda_respaldo = $conexion->query("SELECT DISTINCT respaldo_man FROM control_manuales WHERE respaldo_man IS NOT NULL AND respaldo_man != '' ");


// Consulta para obtener datos de rpe auxiliar
$sql_busqueda_rpeauxiliar = $conexion->query("SELECT DISTINCT rpe_auxiliar FROM control_manuales WHERE rpe_auxiliar IS NOT NULL AND rpe_auxiliar != '' ");


// Consulta para obtener datos de responsable de elaboracion de manual
$sql_busqueda_responsablemanual = $conexion->query("SELECT DISTINCT responsable_manual FROM control_manuales WHERE responsable_manual IS NOT NULL AND responsable_manual != '' ");


// Inicialización de arrays vacíos
$responseMotivo = array();
$responseCuenta = array();
$responseRespaldo = array();
$responseRpeauxiliar = array();
$responseResponsableManual = array();


while ($row = $sql_busqueda_motivo->fetch_assoc()) {
    $temporal = $row;
    array_push($responseMotivo, $temporal['id_motivomanual']);
}

while ($row = $sql_busqueda_cuenta->fetch_assoc()) {
    $temporal = $row;
    array_push($responseCuenta, $temporal['cuenta']);
}

while ($row = $sql_busqueda_respaldo->fetch_assoc()) {
    $temporal = $row;
    array_push($responseRespaldo, $temporal['respaldo_man']);
}

while ($row = $sql_busqueda_rpeauxiliar->fetch_assoc()) {
    $temporal = $row;
    array_push($responseRpeauxiliar, $temporal['rpe_auxiliar']);
}

while ($row = $sql_busqueda_responsablemanual->fetch_assoc()) {
    $temporal = $row;
    array_push($responseResponsableManual, $temporal['responsable_manual']);
}


// Codificación de los resultados a JSON y salida
echo json_encode(array("motivo" => $responseMotivo, "cuenta" => $responseCuenta, "respaldo" => $responseRespaldo, "rpeauxiliar" => $responseRpeauxiliar, "responsablemanual" => $responseResponsableManual));

// Cierre de las consultas y conexión
$sql_busqueda_motivo->close();
$sql_busqueda_cuenta->close();
$sql_busqueda_respaldo->close();
$sql_busqueda_rpeauxiliar->close();
$sql_busqueda_responsablemanual->close();
$conexion->close();
?>
