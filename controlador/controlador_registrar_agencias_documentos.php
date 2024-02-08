<?php
class controller_documents
{
  public function __construct()
  {

  }
  public function get_nombre($nombre_responsable, $conexionSINASU)
  {

    $sql_nombre_responsable = $conexionSINASU->query("SELECT a.responsable_agencia
    FROM sinasu_guias g
    JOIN agencias a ON g.id_agencia = a.id_agencia
    WHERE g.id_agencia = '$nombre_responsable';
    ");
    return $sql_nombre_responsable->fetch_assoc()['responsable_agencia'];


  }
}
?>