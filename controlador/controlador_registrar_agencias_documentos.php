<?php
class controller_documents
{
  public function __construct()
  {

  }
  public function get_nombre($nombre_responsable, $conexionSINASU, $id_proceso)
  {

    $sql_nombre_responsable = $conexionSINASU->query("SELECT a.responsable_agencia
    FROM sinasu_guias_" . $id_proceso . " AS g
    JOIN agencias a ON g.id_agencia = a.id_agencia
    WHERE g.id_agencia = '$nombre_responsable';
    ");
    return $sql_nombre_responsable->fetch_assoc()['responsable_agencia'];

  }
  public function get_nombreAdmin($nombre_responsable, $conexionSINASU, $id_proceso)
  {

    $sql_nombre_responsable_Admin = $conexionSINASU->query("SELECT usuario
    FROM usuario
    WHERE id_usuario = '$nombre_responsable';
    ");
    return $sql_nombre_responsable_Admin->fetch_assoc()['usuario'];

  }

  // Método para actualizar el estado de la guía
  public function actualizarEstadoGuia($idGuia, $idProceso, $conexionSINASU)
  {
    // Código para actualizar el estado de la guía en la base de datos
    $nuevoEstadoID = 3; // ID del estado "en revisión" en tu tabla de estados
    $query = "UPDATE sinasu_guias_" . $idProceso . " SET id_estado = '$nuevoEstadoID' WHERE id_guia = $idGuia";
    $resultado = mysqli_query($conexionSINASU, $query);

    // Verificar si la actualización fue exitosa y devolver true o false
    if ($resultado) {
      return true;
    } else {
      return false;
    }
  }

}
?>