<?php
// Incluye el archivo de conexión y los controladores necesarios
include '../../modelo/conexion-SINASU.php';
include '../../controlador/controlador_registrar_agencias_documentos.php';

session_start();

// Obtener los datos del formulario
$id_agencia_url = $_POST["mostrar_id_agencia"];
$id_agencia = $_SESSION["id-agencia-sinasu"];
$id_proceso = $_SESSION["mostrar-id-proceso"];
$mostrar_id_guia_sesion = $_SESSION["mostrar-id-guia"];
$id_usuario = $_SESSION["id-sinasu"];

// Inicializar la clase del controlador de documentos
$qry = new controller_documents();

$nombre_doc = $_FILES["file"]["name"]; // Nombre original
$extension = pathinfo($nombre_doc, PATHINFO_EXTENSION); // Obtener la extensión del archivo
$fecha_subida = date("Y-m-d H:i:s"); // Obtener la fecha y hora actual

// Función para obtener el mes de una fecha
function getMonth($fecha) {
    $date = new DateTime($fecha);
    return $date->format('m');
}

// Función para obtener el nombre del mes
function getMonthName($month) {
  return match ($month) {
      '01' => 'enero',
      '02' => 'febrero',
      '03' => 'marzo',
      '04' => 'abril',
      '05' => 'mayo',
      '06' => 'junio',
      '07' => 'julio',
      '08' => 'agosto',
      '09' => 'septiembre',
      '10' => 'octubre',
      '11' => 'noviembre',
      '12' => 'diciembre',
      default => 'mes desconocido',
  };
}

// Función para obtener el año de una fecha
function getYear($fecha) {
    $date = new DateTime($fecha);
    return $date->format('Y');
}

// Función para crear la ruta de la evidencia
function RutearEvidencia($fecha, $id_agencia_url, $nombre_doc) {
    $year = getYear($fecha);
    $month = getMonth($fecha);
    $monthName = getMonthName($month);

    // Crear directorios si no existen
    $ruta_directorio = "../SINASU/uploads/" . $id_agencia_url . "/" . $year . "/" . $monthName;
    if (!is_dir($ruta_directorio)) {
        mkdir($ruta_directorio, 0777, true);
    }

    $ruta = $ruta_directorio . "/" . $nombre_doc;
    return $ruta;
}

$ruta_doc = RutearEvidencia($fecha_subida, $id_agencia_url, $nombre_doc);

$observaciones = "Sin observaciones";
$estado = "3";
$id_estado_evidencia = "2";
$nombre_responsable = $qry->get_nombreAdmin($id_usuario, $conexionSINASU, $id_proceso);
$modificador = "Sin modificar";

// Mover el archivo al directorio de subidas
if (move_uploaded_file($_FILES["file"]["tmp_name"], $ruta_doc)) {
    // Insertar la información del archivo en la tabla documentos
    $sql = "INSERT INTO documentos (id_guia, id_proceso, ruta_doc, nombre_doc, fecha_subida, observaciones, id_estado, id_estado_evidencia, nombre_responsable, modificador)
            VALUES ('$mostrar_id_guia_sesion', '$id_proceso', '$ruta_doc', '$nombre_doc', '$fecha_subida', '$observaciones', '$estado', '$id_estado_evidencia', '$nombre_responsable', '$modificador')";

    if ($conexionSINASU->query($sql) === TRUE) {
        // Actualizar el estado de la guía
        $actualizacionExitosa = $qry->actualizarEstadoGuia($mostrar_id_guia_sesion, $id_proceso, $conexionSINASU);

        if ($actualizacionExitosa) {
            header('Content-Type: application/json');
            echo json_encode(["message" => "Archivo subido correctamente"]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(["error" => "Error al actualizar el estado de la guía"]);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Error al subir el archivo: " . $conexionSINASU->error]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Error al subir el archivo"]);
}

// Cierra la conexión a la base de datos (opcional)
// $conexionSINASU->close();
?>