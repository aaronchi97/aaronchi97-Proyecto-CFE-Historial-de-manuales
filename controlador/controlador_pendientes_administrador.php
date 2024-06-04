<?php


class Pendientes
{
  private $conexion;

  public function __construct($conexion)
  {
    $this->conexion = $conexion;
  }

  public function getConsultasPreparadas($consulta, $parametros)
  {
    try {
      // Preparar la consulta
      $stmt = $this->conexion->prepare($consulta);

      // Enlazar los parámetros
      if ($stmt) {
        $tipos = str_repeat('s', count($parametros)); // suponemos que todos los parámetros son strings
        $stmt->bind_param($tipos, ...$parametros);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $resultado = $stmt->get_result();

        // Convertir el resultado a un array asociativo
        $resultados = [];
        while ($fila = $resultado->fetch_assoc()) {
          $resultados[] = $fila;
        }

        return $resultados;
      } else {
        throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
      }
    } catch (Exception $e) {
      // Manejar errores si la consulta falla
      echo "Error al ejecutar la consulta: " . $e->getMessage();
      return false;
    }
  }
}

// // Crear una instancia de conexión
// include '../modelo/conexion-sinasu.php'; // Asegúrate de que la ruta sea correcta
// $pendientes = new Pendientes($conexionSINASU);

// // Uso de la función
// $consulta = "SELECT COUNT(id_estado) FROM sinasu_guias_1 WHERE id_estado = ?";
// $parametros = array('3'); // suponiendo que $usuario contiene el valor que deseas buscar

// $resultado = $pendientes->getConsultasPreparadas($consulta, $parametros);
// // print_r($resultado);
// foreach ($resultado as $fila) {
//   if (isset ($fila['COUNT(id_estado)'])) {
//     // Accede a la clave "id_estado"
//     echo "Número de pendientes: " . $fila['COUNT(id_estado)'];
//   } else {
//     // Si la clave no está definida, haz algo más o simplemente ignóralo
//     echo "La clave 'id_estado' no está definida en esta fila.";
//   }
// }

// $consultaid_guia = "SELECT id_guia FROM sinasu_guias_1 WHERE id_estado = ?";
// $resultado_id_guia = $pendientes->getConsultasPreparadas($consultaid_guia, $parametros);
// // print_r($resultado);

// foreach ($resultado_id_guia as $fila) {
//   echo "<ul> <br>";
//   if (isset ($fila['id_guia'])) {
//     // Accede a la clave "id_estado"

//     echo "<li>" . $fila['id_guia'] . "</li> ";
//   } else {
//     // Si la clave no está definida, haz algo más o simplemente ignóralo
//     echo "La clave 'id_estado' no está definida en esta fila.";
//   }
//   echo "</ul>";
// }


?>