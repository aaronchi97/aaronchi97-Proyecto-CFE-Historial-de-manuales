<?php
// Incluye el archivo de conexión
include '../../modelo/conexion-SINASU.php';

// Obtener los datos del formulario
$id_guia = 1; // usar $_POST['id_guia']
$nombre_doc = $_FILES["file"]["name"];
$ruta_doc = "../SINASU/uploads/" . $nombre_doc;
$fecha_subida = date("Y-m-d H:i:s");
$observaciones = ""; // Puedes definir aquí tus observaciones predeterminadas
$estado = "en supervisión"; // Puedes definir aquí el estado predeterminado
$nombre_responsable = "nombre"; // Puedes definir aquí el nombre predeterminado

// Mover el archivo al directorio de subidas
if (move_uploaded_file($_FILES["file"]["tmp_name"], $ruta_doc)) {
  // Insertar la información del archivo en la tabla documentos
  $sql = "INSERT INTO documentos (id_guia, ruta_doc, nombre_doc, fecha_subida, observaciones, estado, nombre_responsable)
            VALUES ('$id_guia', '$ruta_doc', '$nombre_doc', '$fecha_subida', '$observaciones', '$estado', '$nombre_responsable')";

  if ($conexionSINASU->query($sql) === TRUE) {
    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');
    echo json_encode(["message" => "Archivo subido correctamente"]);
  } else {
    // Establecer el tipo de contenido como JSON
    header('Content-Type: application/json');
    echo json_encode(["error" => "Error al subir el archivo: " . $conexionSINASU->error]);
  }
} else {
  // Establecer el tipo de contenido como JSON
  header('Content-Type: application/json');
  echo json_encode(["error" => "Error al subir el archivo"]);
}

// Cierra la conexión a la base de datos (opcional)
//$conexionSINASU->close();
?>