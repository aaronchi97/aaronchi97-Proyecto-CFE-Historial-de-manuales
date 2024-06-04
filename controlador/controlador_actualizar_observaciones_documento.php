<?php
// Incluir el archivo de conexión a la base de datos
include "../modelo/conexion-SINASU.php";

// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $id_documento = $_POST["id_documento"];
  $observaciones = $_POST["observaciones"];

  // Consulta SQL para actualizar los datos del documento
  $sql = "UPDATE documentos SET observaciones=? WHERE id_documento=?";

  // Preparar la consulta
  $stmt = $conexionSINASU->prepare($sql);
  if ($stmt === false) {
    die ("Error al preparar la consulta: " . $conexionSINASU->error);
  }

  // Vincular los parámetros
  $stmt->bind_param("si", $observaciones, $id_documento);

  // Ejecutar la consulta
  if ($stmt->execute()) {
    // Redirigir al usuario a donde desees después de la actualización
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    echo "Error al actualizar los datos: " . $stmt->error;
  }

  // Cerrar la declaración y la conexión
  $stmt->close();
  $conexionSINASU->close();
} else {
  // Si la solicitud no es POST, redirigir a una página de error o hacer algo más
  // Por ejemplo, redirigir a la página de inicio
  header("Location: inicio.php");
  exit();
}
?>