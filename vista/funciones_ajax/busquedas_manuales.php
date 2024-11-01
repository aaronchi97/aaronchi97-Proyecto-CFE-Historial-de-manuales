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


// Consulta para obtener datos de rpe auxiliar en tabla control manuales
$sql_busqueda_rpeauxiliar = $conexion->query("SELECT DISTINCT rpe_auxiliar FROM control_manuales WHERE rpe_auxiliar IS NOT NULL AND rpe_auxiliar != '' ");




// Consulta para obtener datos de responsable de elaboracion de manual
$sql_busqueda_responsablemanual = $conexion->query("SELECT  nombre, apellido FROM usuario");
$sql_busqueda_responsablemanual2 = $conexion->query("SELECT DISTINCT responsable_manual FROM control_manuales WHERE responsable_manual IS NOT NULL AND responsable_manual != '' ");



// Consulta para obtener datos de agencia de elaboracion de manual
$sql_busqueda_agencia = $conexion->query("SELECT DISTINCT agencia FROM control_manuales WHERE agencia IS NOT NULL AND agencia != '' ");


// Consulta para obtener datos de tarifa de elaboracion de manual
$sql_busqueda_tarifa = $conexion->query("SELECT DISTINCT tarifa FROM control_manuales WHERE tarifa IS NOT NULL AND tarifa != '' ");




//CONSULTAS DIRECTAS DE TABLAS ESPECIFICAS SIN DEPENDENCIA -----------------------------------------------------------------------------------------------------------------------------------------------------------------

// Consulta para obtener datos del motivo de manual en la tabla motivo_manual
$sql_busqueda_motivo_tabla = $conexion->query("SELECT DISTINCT motivo_manual FROM motivo_manuales");

// Consulta para obtener datos de cuenta en la tabla cuentas
$sql_busqueda_cuenta_tabla = $conexion->query("SELECT DISTINCT cuenta FROM cuentas");


// Consulta para obtener datos de respaldo de tabla respaldo_manual
// $sql_busqueda_respaldo = $conexion->query("SELECT DISTINCT respaldo_man FROM respaldo man WHERE respaldo_man IS NOT NULL AND respaldo_man != '' ");
$sql_busqueda_respaldo_tabla = $conexion->query("SELECT DISTINCT respaldo_man FROM respaldo_manuales");


// Consulta para obtener datos de rpe auxiliar en tabla rpe_auxiliar
$sql_busqueda_rpeauxiliar_tabla = $conexion->query("SELECT DISTINCT rpe_auxiliar FROM rpe_auxiliar  ");









// Inicialización de arrays vacíos
$responseMotivo = array();
$responseCuenta = array();
$responseRespaldo = array();
$responseRpeauxiliar = array();
$responseResponsableManual = array();
$responseResponsableManual2 = array();
$responseAgencia = array();
$responseTarifa = array();
//consultas nuevas de tablas especificas
$responseMotivoTabla = array();
$responseCuentaTabla = array();
$responseRespaldoTabla = array();
$responseRpeauxiliarTabla = array();




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
    $temporal = array(
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido']
    );
    array_push($responseResponsableManual, $temporal);
}


while ($row = $sql_busqueda_responsablemanual2->fetch_assoc()) {
    $temporal = $row;
    array_push($responseResponsableManual2, $temporal['responsable_manual']);
}


while ($row = $sql_busqueda_agencia->fetch_assoc()) {
    $temporal = $row;
    array_push($responseAgencia, $temporal['agencia']);
}


while ($row = $sql_busqueda_tarifa->fetch_assoc()) {
    $temporal = $row;
    array_push($responseTarifa, $temporal['tarifa']);
}

// Procesar los resultados de las nuevas consultas
while ($row = $sql_busqueda_motivo_tabla->fetch_assoc()) {
    array_push($responseMotivoTabla, $row['motivo_manual']);
}

while ($row = $sql_busqueda_cuenta_tabla->fetch_assoc()) {
    array_push($responseCuentaTabla, $row['cuenta']);
}

while ($row = $sql_busqueda_respaldo_tabla->fetch_assoc()) {
    array_push($responseRespaldoTabla, $row['respaldo_man']);
}

while ($row = $sql_busqueda_rpeauxiliar_tabla->fetch_assoc()) {
    array_push($responseRpeauxiliarTabla, $row['rpe_auxiliar']);
}








// Codificación de los resultados a JSON y salida
echo json_encode(array(
    "motivo" => $responseMotivo,
    "cuenta" => $responseCuenta,
    "respaldo" => $responseRespaldo,
    "rpeauxiliar" => $responseRpeauxiliar,
    "responsablemanual" => $responseResponsableManual,
    "responsablemanual2" => $responseResponsableManual2,
    "agencia" => $responseAgencia,
    "tarifa" => $responseTarifa,
    "motivo_tabla" => $responseMotivoTabla,
    "cuenta_tabla" => $responseCuentaTabla,
    "respaldo_tabla" => $responseRespaldoTabla,
    "rpeauxiliar_tabla" => $responseRpeauxiliarTabla
));

// Cierre de las consultas y conexión
$sql_busqueda_motivo->close();
$sql_busqueda_cuenta->close();
$sql_busqueda_respaldo->close();
$sql_busqueda_rpeauxiliar->close();
$sql_busqueda_responsablemanual->close();
$sql_busqueda_responsablemanual2->close();
$sql_busqueda_agencia->close();
$sql_busqueda_motivo_tabla->close();
$sql_busqueda_cuenta_tabla->close();
$sql_busqueda_respaldo_tabla->close();
$sql_busqueda_rpeauxiliar_tabla->close();
$conexion->close();
