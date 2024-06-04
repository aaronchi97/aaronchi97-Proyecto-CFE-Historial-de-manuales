<?php

session_start();
//Esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
//lo compias y lo pegas desde el inicio entonces no te dejara, hasta que pongas un usuario valido
if (empty($_SESSION['nombre-sinasu']) and empty($_SESSION['apellido-sinasu'])) {
  header("location:../login/login_sinasu.php");
}

?>

<style>
  ul li:nth-child(1) .activo {
    background: #9889fe !important;
  }
</style>




<!-- primero se carga el topbar -->
<?php require('./../layout/topbar_sinasu.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./../layout/sidebar_sinasu.php'); ?>


<!-- inicio del contenido principal -->
<link rel="stylesheet" href="estilosinasu.css">
<div class="page-content">



  <?php
  //hacemos la conexion
  include "../../modelo/conexion-SINASU.php";
  // include "../../controlador/controlador_vista_documentos_sinasu.php";
  // include "../../controlador/controlador_vista_agencias_id_sinasu.php";
  
  // include "../../controlador/controlador_modificar_usuario_sinasu.php";
  

  //Hacemos la consulta relacionando las tablas que necesitemos
  //para dicha consulta necesitamos la tabla usuario
  // $sql = $conexionSINASU->query(" SELECT * from usuario ");
  
  $sql_mostrar_departamentos = $conexionSINASU->query(" SELECT * from departamentos ");

  $sql_cantidad_departamentos = $conexionSINASU->query("SELECT COUNT(*) AS Total FROM departamentos");
  $resultado = $sql_cantidad_departamentos->fetch_assoc(); // Obtener el resultado como un array asociativo
  $total_departamentos = $resultado['Total']; // Acceder al valor 'Total'
  


  $id_usuario_agencias = $_SESSION["id-sinasu"];

  $id_agencia_filtro_usuario = $_SESSION["id-agencia-sinasu"];
  // echo $id_agencia_filtro_usuario;
  
  // $sql_obtener_id_agencia = $conexionSINASU->query("SELECT id_agencia FROM agencias WHERE id_usuario = '$id_usuario_agencias' ");
// $sql_obtener_id_agencia = $conexionSINASU->query("SELECT * FROM agencias WHERE id_usuario = '$id_usuario_agencias'");
// $resultado = $sql_obtener_id_agencia->fetch_object();
  
  // $_SESSION['id-agencia'] = $resultado->id_agencia;
// $id_agencia_resultado = $_SESSION['id-agencia'];
  
  // echo "id de agencia: $id_agencia_resultado";
  



  ?>

  <h4 class="text-center text-secondery">DEPARTAMENTOS</h4>

  <!-- BOTON PARA REGISTRAR AGENCIA -->

  <!-- <a href="registro_agencias.php" class="btn btn-primary btn-rounded mb-3 otro"><i class="fa-solid fa-user-plus "></i>
    &nbsp;
    REGISTRAR NUEVO DEPARTAMENTO</a> -->




  <section class="continer-agencias">


    <?php
    if ($_SESSION['rol-sinasu'] != 3) { ?>

      <?php
      while ($datos_mostrar_departamentos = $sql_mostrar_departamentos->fetch_object()) { ?>

        <!-- <a class="boton-sinasu-agencias"  href="agencias_filtros.php?id_agencias_filtro=<?= $datos_mostrar_departamentos->id_agencia ?>"> -->
        <a class="boton-sinasu-agencias"
          href="agencias.php?id_departamento=<?= $datos_mostrar_departamentos->id_departamento ?>">



          <div class="parte-sinasu-agencias">

            <figure>
              <img src="img-sinasu/departamento<?= $datos_mostrar_departamentos->id_departamento ?>.jpg" alt="">
            </figure>

            <div class="fondo-agencias-2"></div>

            <i class="fa-solid fa-building-user"></i>

            <h1>
              <?= $datos_mostrar_departamentos->nombre_departamento ?>
            </h1>


            <!-- <h1><?= $datos_mostrar_departamentos->responsable_agencia ?></h1> -->

          </div>


        </a>




      <?php } ?>


      <?php

    } else { ?>

      <?php

      for ($j = 1; $j <= $total_departamentos; $i++) {

        $sql_nombre_elemento = $conexionSINASU->query("SELECT * FROM agencias  where id_agencia = $j AND id_usuario = $id_usuario_agencias ");


        $datos_nombre_elemento = $sql_nombre_elemento->fetch_object();
        $datos_nombre_elemento_siguiente = $sql_nombre_elemento_siguiente->fetch_object();

        ?>


        <?php
      }
      ?>




      <?php
    }
    ?>

    <!-- -----------------HACER EL WHILE PARA VINCULAR TODAS LAS 10 AGENCIAS DE LA BASE DE DATOS-------------------------------- -->






  </section>



  <!-- por ultimo se carga el footer -->
  <?php require('./../layout/footer_sinasu.php'); ?>