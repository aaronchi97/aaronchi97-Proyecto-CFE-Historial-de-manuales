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

  <h4 class="text-center text-secondery"> REGISTRO ASISTENCIAS</h4>

  <?php
  //hacemos la conexion
  include "../modelo/conexion.php";
  //llamamos al controlador 
  include "../controlador/controlador_asis_vistas.php";
  // include "vista/registro_asistencias_vista2.php";
  

  //Hacemos la consulta relacionando las tablas que necesitemos
  //para dicha consulta
  $sql = $conexion->query(" SELECT * FROM dias ");

  ?>

<a href="reporte_asistencias.php" class="btn btn-warning btn-rounded mb-3"><i class="fa-regular fa-clipboard"></i> &nbsp;
    REPORTE DE ASISTENCIAS</a>

  <table class="table table-bordered table-hover col-12" id=""> <!--id="example"-->
    <thead>
      <tr>
        <!-- <th scope="col">ID</th> -->
        <!-- <th scope="col"></th> -->
        <th scope="col">SELECCIONA DIA</th>
        <th scope="col"></th>
      </tr>
    </thead>

    <tbody>

      <?php
      while ($datos = $sql->fetch_object()) { ?>

        <!--dentro imprimiremos los valores que contienen mis tablas 
    en la base de datos-->
        <tr>
           <!-- <td>
            <?= $datos->id_dia ?>
          </td>  -->

          <td >
            <?= $datos->nombre_dias ?>
          </td>

          <td class="col-8">
            <a class="btn btn-primary btn-rounded  mb-1" href="registro_asistencias_vista2.php?id=<?= $datos->id_dia ?>" >
           SELECCIONAR
            </a>
          </td>   


        </tr>
      <?php }

      ?>



    </tbody>
  </table>


</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>