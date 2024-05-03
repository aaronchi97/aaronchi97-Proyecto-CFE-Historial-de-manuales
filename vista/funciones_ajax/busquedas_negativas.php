<?php
// busquedas_manuales.php

// Conectar a la base de datos y realizar la búsqueda
include "../../modelo/conexion.php";

// Consulta para obtener datos de resplado de negativas id_justificacionnegativa
$sql_busqueda_justificacion = $conexion->query("SELECT DISTINCT id_justificacionnegativas FROM control_negativas WHERE id_justificacionnegativas IS NOT NULL AND id_justificacionnegativas != '' ");

// Consulta para obtener datos de cuenta
$sql_busqueda_cuenta = $conexion->query("SELECT DISTINCT cuenta FROM control_negativas WHERE cuenta IS NOT NULL AND cuenta != '' ");

// Consulta para obtener datos de medidor
$sql_busqueda_medidor = $conexion->query("SELECT DISTINCT medidor FROM control_negativas WHERE medidor IS NOT NULL AND medidor != '' ");


// Consulta para obtener datos de aa_mm
$sql_busqueda_aamm = $conexion->query("SELECT DISTINCT aa_mm FROM control_negativas WHERE aa_mm IS NOT NULL AND aa_mm != '' ");




// Consulta para obtener datos de responsable de elaboracion de negativas
$sql_busqueda_responsablenegativa = $conexion->query("SELECT  nombre, apellido FROM usuario");
$sql_busqueda_responsablenegativa2 = $conexion->query("SELECT DISTINCT responsable_negativa FROM control_negativas WHERE responsable_negativa IS NOT NULL AND responsable_negativa != '' ");



// Consulta para obtener datos de agencia de elaboracion de negativas
$sql_busqueda_tipo_medidor = $conexion->query("SELECT DISTINCT tipo_medidor FROM control_negativas WHERE  tipo_medidor IS NOT NULL AND  tipo_medidor != '' ");


// Consulta para obtener datos de tarifa de elaboracion de negativas
$sql_busqueda_tarifa = $conexion->query("SELECT DISTINCT tarifa FROM control_negativas WHERE tarifa IS NOT NULL AND tarifa != '' ");

// Consulta para obtener datos de motivo correccion en negativas
$sql_busqueda_motivo_correccion = $conexion->query("SELECT DISTINCT motivo_correccion FROM motivo_correccion_neg WHERE motivo_correccion IS NOT NULL AND motivo_correccion != '' ");

// Consulta para obtener datos de resplado de negativas en respaldos_negativa
$sql_busqueda_respaldos = $conexion->query("SELECT DISTINCT respaldo_negativa FROM respaldo_negativas WHERE respaldo_negativa IS NOT NULL AND respaldo_negativa != '' ");







// Inicialización de arrays vacíos
$responseJustificacion = array();
$responseCuenta = array();
$responseMedidor = array();
$responseAAMM = array();
$responseResponsableNegativa = array();
$responseResponsableNegativa2 = array();
$responseTipo_medidor = array();
$responseTarifa = array();
$responseMotivoCorreccion = array();
$responseRespaldos = array();


while ($row = $sql_busqueda_justificacion->fetch_assoc()) {
    $temporal = $row;
    array_push($responseJustificacion, $temporal['id_justificacionnegativas']);
}

while ($row = $sql_busqueda_cuenta->fetch_assoc()) {
    $temporal = $row;
    array_push($responseCuenta, $temporal['cuenta']);
}

while ($row = $sql_busqueda_medidor->fetch_assoc()) {
    $temporal = $row;
    array_push($responseMedidor, $temporal['medidor']);
}

while ($row = $sql_busqueda_aamm->fetch_assoc()) {
    $temporal = $row;
    array_push($responseAAMM, $temporal['aa_mm']);
}


while ($row = $sql_busqueda_responsablenegativa->fetch_assoc()) {
    $temporal = array(
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido']
    );
    array_push($responseResponsableNegativa, $temporal);
}


while ($row = $sql_busqueda_responsablenegativa2->fetch_assoc()) {
    $temporal = $row;
    array_push($responseResponsableNegativa2, $temporal['responsable_negativa']);
}


while ($row = $sql_busqueda_tipo_medidor->fetch_assoc()) {
    $temporal = $row;
    array_push($responseTipo_medidor, $temporal['tipo_medidor']);
}


while ($row = $sql_busqueda_tarifa->fetch_assoc()) {
    $temporal = $row;
    array_push($responseTarifa, $temporal['tarifa']);
}

while ($row = $sql_busqueda_motivo_correccion->fetch_assoc()) {
    $temporal = $row;
    array_push($responseMotivoCorreccion, $temporal['motivo_correccion']);
}

while ($row = $sql_busqueda_respaldos->fetch_assoc()) {
    $temporal = $row;
    array_push($responseRespaldos, $temporal['respaldo_negativa']);
}







// Codificación de los resultados a JSON y salida
echo json_encode(array(
    "justificacion" => $responseJustificacion, "cuenta" => $responseCuenta, "medidor" => $responseMedidor,
    "aamm" => $responseAAMM, "responsablenegativa" => $responseResponsableNegativa,
    "responsablenegativa2" => $responseResponsableNegativa2, "tipo_medidor" => $responseTipo_medidor,
    "tarifa" => $responseTarifa, "motivoCorreccion" => $responseMotivoCorreccion, "respaldo_negativas" => $responseRespaldos
));

// Cierre de las consultas y conexión
$sql_busqueda_justificacion->close();
$sql_busqueda_cuenta->close();
$sql_busqueda_medidor->close();
$sql_busqueda_aamm->close();
$sql_busqueda_responsablenegativa->close();
$sql_busqueda_responsablenegativa2->close();
$sql_busqueda_tipo_medidor->close();
$sql_busqueda_tarifa->close();
$sql_busqueda_motivo_correccion->close();
$sql_busqueda_respaldos->close();
$conexion->close();
