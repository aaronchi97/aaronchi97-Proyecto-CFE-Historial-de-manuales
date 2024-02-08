<?php
// Incluye el archivo de conexión
include '../../modelo/conexion-SINASU.php';
include '../../controlador/controlador_registrar_agencias_documentos.php';
// include '../../controlador/controlador_vista_documentos_sinasu.php';

session_start();

// Obtener los datos del formulario
$id_agencia = $_SESSION["id-agencia-sinasu"]; // usar $_POST['id_agencia']
$mostrar_id_guia_sesion = $_SESSION["mostrar-id-guia"];
// echo $mostrar_id_guia_sesion;
echo "la guia es: " . $mostrar_id_guia_sesion;

$qry = new controller_documents();
$nombre_doc = $_FILES["file"]["name"];
$ruta_doc = "../SINASU/uploads/" . $nombre_doc;
$fecha_subida = date("Y-m-d H:i:s");
$observaciones = "Sin observaciones"; // Puedes definir aquí tus observaciones predeterminadas
$estado = "en supervisión"; // Puedes definir aquí el estado predeterminado
$nombre_responsable = $qry->get_nombre($id_agencia, $conexionSINASU); // Puedes definir aquí el nombre predeterminado

// Mover el archivo al directorio de subidas
if (move_uploaded_file($_FILES["file"]["tmp_name"], $ruta_doc)) {
  // Insertar la información del archivo en la tabla documentos
  $sql = "INSERT INTO documentos (id_guia, ruta_doc, nombre_doc, fecha_subida, observaciones, estado, nombre_responsable)
            VALUES ('$mostrar_id_guia_sesion', '$ruta_doc', '$nombre_doc', '$fecha_subida', '$observaciones', '$estado', '$nombre_responsable')";

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