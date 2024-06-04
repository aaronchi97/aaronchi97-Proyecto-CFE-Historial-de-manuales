<?php
include '../../modelo/conexion-SINASU.php';

// Obtener la cadena JSON del cuerpo de la solicitud POST
$json_data = file_get_contents('php://input');

// Decodificar la cadena JSON en un objeto PHP
$data = json_decode($json_data);

// Verificar si la decodificación fue exitosa y si tiene los datos esperados
if ($data !== null && isset($data->comentario) && isset($data->fileName)) {
  $fileName = $data->fileName;
  $comentario = $data->comentario;

  // Preparar la consulta SQL para actualizar las observaciones del archivo
  $sql = "UPDATE documentos SET observaciones = ? WHERE nombre_doc = ?";
  $stmt = $conexion->prepare($sql);

  if ($stmt) {
    // Vincular los parámetros y ejecutar la consulta preparada
    $stmt->bind_param("ss", $comentario, $fileName);
    $stmt->execute();

    // Verificar si la actualización fue exitosa
    if ($stmt->affected_rows > 0) {
      // Enviar una respuesta JSON al cliente para confirmar que las observaciones se han actualizado correctamente
      echo json_encode(["success" => true]);
    } else {
      // Enviar una respuesta JSON al cliente si no se pudo actualizar ninguna fila
      echo json_encode(["error" => "No se pudo actualizar las observaciones"]);
    }
  } else {
    // Enviar una respuesta JSON al cliente si la consulta preparada falló
    echo json_encode(["error" => "Error en la preparación de la consulta"]);
  }

  // Cerrar la consulta preparada y la conexión a la base de datos
  $stmt->close();
  $conexion->close();
} else {
  // Enviar una respuesta JSON al cliente si falta algún parámetro
  echo json_encode(["error" => "Falta el nombre de archivo o el comentario"]);
}
?>