<?php
// Incluye el archivo de conexión a la base de datos
// Guardar los datos recibidos en un archivo de registro

include '../../modelo/conexion-SINASU.php';

// Verificamos si se recibieron datos en formato JSON
$data = json_decode(file_get_contents("php://input"), true);
$id_proceso = isset($data['id_proceso']) ? $data['id_proceso'] : null;
file_put_contents('datos_recibidos.log', print_r($data, true) . PHP_EOL, FILE_APPEND);
var_dump($data);

// Imprimir los datos recibidos para verificar
echo "Datos recibidos:\n";
var_dump($data);
echo "\n";

// Verificamos que los datos se recibieron correctamente
if (!empty($data) && isset($id_proceso)) {
  // Iteramos sobre los datos recibidos
  foreach ($data['datos_actualizados'] as $item) {
    $idGuia = $item['idGuia'];
    $nuevoEstado = $item['nuevoEstado'];
    $observaciones = $item['observaciones'];

    try {
      // Preparamos la consulta SQL utilizando la conexión a la base de datos
      $consulta = $conexionSINASU->prepare("UPDATE sinasu_guias_" . $id_proceso . " SET id_estado = ?, observaciones = ? WHERE id_guia = ?");
      $consulta->bind_param("isi", $nuevoEstado, $observaciones, $idGuia); // 'isi' indica que el primer y tercer parámetros son enteros y el segundo es una cadena

      // Ejecutamos la consulta
      $consulta->execute();

      // Aquí podrías realizar cualquier otra lógica necesaria

    } catch (Exception $e) {
      // Manejo de errores
      echo "Error: " . $e->getMessage();
    }
  }

  // Respondemos con un código de estado 200 para indicar que la operación se realizó con éxito
  http_response_code(200);
} else {
  // Si no se recibieron datos o falta el id_proceso, respondemos con un código de error 400 (Solicitud incorrecta)
  http_response_code(400);
}

?>