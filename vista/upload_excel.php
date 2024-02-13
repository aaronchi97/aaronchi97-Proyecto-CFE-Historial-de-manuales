<?php
// Incluye el archivo de conexión
include '../modelo/conexion.php';

session_start();

// Obtener los datos del formulario

$nombre_doc = $_FILES["file"]["name"];
$ruta_doc = "/uploads/" . "Excel" . $nombre_doc;
$fecha_subida = date("Y-m-d H:i:s");

// Mover el archivo al directorio de subidas
if (move_uploaded_file($_FILES["file"]["tmp_name"], $ruta_doc)) {
  // Insertar la información del archivo en la tabla documentos
  $sql = "INSERT INTO excel (nombre_archivo,ruta_archivo , fecha_subida)
            VALUES ('$nombre_doc','$ruta_doc', '$fecha_subida')";

  if ($conexion->query($sql) === TRUE) {
    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');
    echo json_encode(["message" => "Archivo subido correctamente"]);
  } else {
    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');
    echo json_encode(["error" => "Error al subir el archivo: " . $conexion->error]);
  }
} else {
  // Establecer el tipo de contenido como JSON
  header('Content-Type: application/json');
  echo json_encode(["error" => "Error al subir el archivo"]);
}

// Cierra la conexión a la base de datos (opcional)
//$conexionSINASU->close();