<?php
// Incluye el archivo de conexión
include '../../modelo/conexion-SINASU.php';
include '../../controlador/controlador_registrar_agencias_documentos.php';
// include '../../controlador/controlador_vista_documentos_sinasu.php';

session_start();

// Obtener los datos del formulario
$id_agencia = $_SESSION["id-agencia-sinasu"]; // usar $_POST['id_agencia']
$id_proceso = $_SESSION["mostrar-id-proceso"];
$mostrar_id_guia_sesion = $_SESSION["mostrar-id-guia"];
$id_usuario = $_SESSION["id-sinasu"];
// echo $mostrar_id_guia_sesion;
// echo "la guia es: " . $mostrar_id_guia_sesion;

$qry = new controller_documents();
$nombre_doc = $_FILES["file"]["name"]; //Nombre original
$extension = pathinfo($nombre_doc, PATHINFO_EXTENSION); //Nos da la extension del archivo
$ruta_doc = "../SINASU/uploads/control" . $id_agencia . $nombre_doc;
$fecha_subida = date("Y-m-d H:i:s");
$observaciones = "Sin observaciones"; // Puedes definir aquí tus observaciones predeterminadas
$estado = "3"; // Puedes definir aquí el estado predeterminado
$id_estado_evidencia = "2";
$nombre_responsable = $qry->get_nombreAdmin($id_usuario, $conexionSINASU, $id_proceso);
$modificador = "Sin modificar";
// $nombre_responsable = $qry->get_nombre($id_agencia, $conexionSINASU, $id_proceso); // Puedes definir aquí el nombre predeterminado

// Mover el archivo al directorio de subidas
if (move_uploaded_file($_FILES["file"]["tmp_name"], $ruta_doc)) {
  // Insertar la información del archivo en la tabla documentos
  $sql = "INSERT INTO documentos (id_guia, id_proceso, ruta_doc, nombre_doc, fecha_subida, observaciones, id_estado, id_estado_evidencia, nombre_responsable, modificador)
            VALUES ('$mostrar_id_guia_sesion', '$id_proceso', '$ruta_doc', '$nombre_doc', '$fecha_subida', '$observaciones', '$estado', '$id_estado_evidencia' ,'$nombre_responsable', '$modificador')";

  if ($conexionSINASU->query($sql) === TRUE) {
    // Actualizar el estado de la guía
    $actualizacionExitosa = $qry->actualizarEstadoGuia($mostrar_id_guia_sesion, $id_proceso, $conexionSINASU);

    if ($actualizacionExitosa) {
      // Establecer el tipo de contenido como JSON
      header('Content-Type: application/json');
      echo json_encode(["message" => "Archivo subido correctamente"]);
    } else {
      // Establecer el tipo de contenido como JSON
      header('Content-Type: application/json');
      echo json_encode(["error" => "Error al actualizar el estado de la guía"]);
    }
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