<?php

session_start();
//si el nombre y apellido estan vacios entonces redirigelos a la pagina de login.php
//esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
//lo compias y lo pegas desde el inicio entonces no te dejara, hasta que pongas un usuario valido
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
  header("location:login/login.php");
}

?>

<style>
  ul li:nth-child(1) .activo {
    background: rgb(11, 150, 214) !important;
  }
</style>

<!-- Crear el metodo advertencia para el boton de eliminar registro -->
<!-- <script>
    function advertencia() {
        var not = confirm("¿Estas seguro de eliminar el registro?");
        return not;
    }
 </script> -->



<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<link rel="stylesheet" href="estiloinicio.css">
<div class="page-content">

  <h4 class="text-center text-secondery"> REPORTE DE ASISTENCIAS</h4>

  <?php
  //hacemos la conexion
  include "../modelo/conexion.php";
  //llamamos al controlador para eliminar registros
  

  //Hacemos la consulta relacionando las tablas que necesitemos
  //para dicha consulta
  $sql = $conexion->query(" SELECT
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
  INNER JOIN horario hora ON asig.id_horario = hora.id_horario
    
    ");

  ?>

  <a href="" class="btn btn-danger btn-rounded mb-3"><i class="fa-solid fa-file-pdf"></i> &nbsp;
    PDF</a>

    <a href="../controlador/generar_excel.php" class="btn btn-success btn-rounded mb-3"><i class="fa-solid fa-file-excel"></i> &nbsp;
    EXCEL</a>
  

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
        <th scope="col"></th>

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

          <td>
            <a class="btn btn-danger" href="reporte_asistencias.php?id=<?= $datos->id_asignacion ?>" onclick=" advertencia(event)"><i
                class="fa-solid fa-trash-can"></i></a>
          </td>


        </tr>
      <?php }

      ?>



    </tbody>
  </table>

  <a class="btn btn-danger btn-rounded  mb-1" href="registro_asistencias.php">
    REGRESAR
  </a>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>