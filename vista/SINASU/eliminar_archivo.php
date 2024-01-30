<?php
// Verifica si se ha recibido una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtiene los datos enviados desde el cliente
  $fileName = $_POST["fileName"];

  // Realizar una consulta para obtener el id_documento del archivo
  $query = "SELECT id_documento FROM documentos WHERE nombre_doc = '$fileName'";
  $result = mysqli_query($conexionSINASU, $query);

  if ($result) {
    // Obtener el id_documento del resultado de la consulta
    $row = mysqli_fetch_assoc($result);
    $idDocumento = $row['id_documento'];

    // Verificar si se encontró el id_documento
    if ($idDocumento !== null) {
      // El archivo existe en la base de datos, puedes usar $idDocumento para eliminarlo
      // Resto del código...
    } else {
      // El archivo no se encontró en la base de datos
      echo json_encode(["success" => false, "message" => "El archivo no existe en la base de datos"]);
    }
  } else {
    // Error al ejecutar la consulta
    echo json_encode(["success" => false, "message" => "Error al buscar el archivo en la base de datos"]);
  }
} else {
  // Si no es una solicitud POST, devuelve un mensaje de error
  echo json_encode(["success" => false, "message" => "Solicitud no válida"]);
}

?>