<?php
header("Content-Type: application/xls");
header("Content-Disposition:attachment; filename=prueba_excel.xls");


?>

<?php

include "../modelo/conexion.php";


  $sql=$conexion->query(" SELECT
  asis_doc.id_asistencia,
  asis_doc.id_asignacion,
  asis_doc.id_presencia,
  asis_doc.fecha_captura,
  asig.id_docente,
  asig.id_aula,
  asig.id_dia,
  asig.id_horario,
  pres.id_presencia,
  pres.nombre_presencia,
  doce.nombre,
  doce.apellido,
  doce.expediente,
  aula.nombre_aula,
  dia.nombre_dias,
  hora.hora
  FROM
  asistencia_docentes asis_doc
  INNER JOIN asignaciones asig ON asis_doc.id_asignacion = asig.id_asignacion
  INNER JOIN presencia pres ON asis_doc.id_presencia = pres.id_presencia
  INNER JOIN docentes doce ON asig.id_docente = doce.id_docente
  INNER JOIN aulas aula ON asig.id_aula = aula.id_aula
  INNER JOIN dias dia ON asig.id_dia = dia.id_dia
  INNER JOIN horario hora ON asig.id_horario = hora.id_horario ");

?>

<table class="table table-bordered table-hover col-12" id="example">
    <thead>
      <tr>
      <th scope="col">NOMBRE</th>
        <th scope="col">APELLIDO</th>
        <th scope="col">EXPEDIENTE</th>
        <th scope="col">DIA</th>
        <th scope="col">HORARIO</th>
        <th scope="col">AULA</th>
        <th scope="col">ASISTENCIA</th>
        <th scope="col">FECHA/ASISTENCIA</th>
        

      </tr>
    </thead>

    <tbody>

      <?php
      while ($datos = $sql->fetch_object()) { ?>

        <!--dentro imprimiremos los valores que contienen mis tablas 
    en la base de datos-->
        <tr>
           <td>
            <?= $datos->nombre ?>
          </td>
          <td>
            <?= $datos->apellido ?>
          </td>
          <td>
            <?= $datos->expediente ?>
          </td>
          <td>
            <?= $datos->nombre_dias ?>
          </td>
          <td>
            <?= $datos->hora ?>
          </td>
          <td>
            <?= $datos->nombre_aula ?>
          </td>
          <td>
            <?= $datos->nombre_presencia?>
          </td>
          <td>
            <?= $datos->fecha_captura?>
          </td>

        </tr>
      <?php }

      ?>

    </tbody>
  </table>