<?php


if (!empty ($_GET['id_proceso'])) {
  $id_proceso = $_GET['id_proceso'];
  $id_guia = $_GET['id_guia'];



  $sql_id_guia_revision_administrador = $conexionSINASU->query("SELECT d.*, e.*, ee.nombre_estado_evidencia
FROM documentos d
INNER JOIN sinasu_guias_" . $id_proceso . " AS g ON d.id_guia = g.id_guia
INNER JOIN estado e ON d.id_estado = e.id_estado
INNER JOIN procesos p ON p.id_proceso = d.id_proceso
INNER JOIN estado_evidencias ee ON d.id_estado_evidencia = ee.id_estado_evidencia
WHERE d.id_guia = '$id_guia' AND d.id_proceso = '$id_proceso';
");

  $sql_pregunta = $conexionSINASU->query("SELECT pregunta FROM sinasu_guias_" . $id_proceso . " WHERE id_guia = '$id_guia';");
}

?>