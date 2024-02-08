<?php

session_start();
//si el nombre y apellido estan vacios entonces redirigelos a la pagina de login.php
//esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
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

  <h4 class="text-center text-secondery">SELECCIONA EL TIPO DE DOCUMENTO</h4>


  <?php
  //hacemos la conexion
  include "../../modelo/conexion-SINASU.php";
  //llamamos al controlador para eliminar registros
//   include "../../controlador/controlador_modificar_usuario_sinasu.php";
//   include "../../controlador/controlador_eliminar_usuario_sinasu.php";
  
  //Hacemos la consulta relacionando las tablas que necesitemos
  //para dicha consulta necesitamos la tabla usuario
  $sql = $conexionSINASU->query(" SELECT * FROM sinasu_guias JOIN filtro_documentos ON sinasu_guias.id_elemento = filtro_documentos.id_elemento;");

  $id_agencias_filtro = $_GET['id_agencias_filtro'];
  // echo "id_agencias_filtro: $id_agencias_filtro";
  
  ?>

  <?php
  if ($_SESSION['rol-sinasu'] != 3) {
    ?>
    <a href="../SINASU/agencias.php" class="btn btn-danger btn-rounded mb-3"><i class="fa-regular fa-circle-left"></i>
      &nbsp; ATRAS</a>
  <?php } else { ?>

    <a hidden href="../SINASU/agencias.php" class="btn btn-danger btn-rounded mb-3"><i
        class="fa-regular fa-circle-left"></i> &nbsp; ATRAS</a>

  <?php } ?>


  <section class="continer-agencias-filtros">


    <!-- <form action="">
           <input type="text" placeholder="DNI del maestro" name="txtdni">
       </form> -->
    <?php

    for ($i = 1; $i <= 4; $i++) {
      $sql_nombre_elemento = $conexionSINASU->query("SELECT guias.id_guia, documentos.elemento 
              FROM sinasu_guias guias
              JOIN filtro_documentos documentos ON guias.id_elemento = documentos.id_elemento
              WHERE guias.id_elemento = $i AND guias.id_agencia = $id_agencias_filtro ");

      $sql_nombre_elemento_siguiente = $conexionSINASU->query("SELECT guias.id_guia, documentos.elemento 
               FROM sinasu_guias guias
               JOIN filtro_documentos documentos ON guias.id_elemento = documentos.id_elemento
               WHERE guias.id_elemento = $i + 1 AND guias.id_agencia = $id_agencias_filtro ");

      $datos_nombre_elemento = $sql_nombre_elemento->fetch_object();
      $datos_nombre_elemento_siguiente = $sql_nombre_elemento_siguiente->fetch_object();

      ?>
      <?php
      if ($i != 4) { ?>
        <a class="boton-sinasu-agencias-filtros"
          href="../SINASU_AGENCIAS/agencia1.php?id_guia<?= $i ?>=<?= $datos_nombre_elemento->id_guia ?>&id_guia_siguiente<?= $i ?>=<?= $datos_nombre_elemento_siguiente->id_guia ?>&id_agencia_especifica=<?= $id_agencias_filtro ?>">
          <div class="parte-sinasu-agencias-filtros">
            <figure>
              <img src="img-sinasu/Yucatan.webp" alt="">
            </figure>
            <div class="fondo-agencias-filtros-2"></div>
            <i class="fa-regular fa-folder-open"></i>
            <h1>
              <?= $datos_nombre_elemento->elemento ?>
            </h1>
          </div>
        </a>

      <?php } else { ?>

        <a class="boton-sinasu-agencias-filtros"
          href="../SINASU_AGENCIAS/agencia1.php?id_guia<?= $i ?>=<?= $datos_nombre_elemento->id_guia ?>&id_agencia_especifica=<?= $id_agencias_filtro ?>">
          <div class="parte-sinasu-agencias-filtros">
            <figure>
              <img src="img-sinasu/Yucatan.webp" alt="">
            </figure>
            <div class="fondo-agencias-filtros-2"></div>
            <i class="fa-regular fa-folder-open"></i>
            <h1>
              <?= $datos_nombre_elemento->elemento ?>
            </h1>
          </div>
        </a>

        <?php
      }
      ?>


      <?php
    }
    ?>






    <!-- 
       <a class="boton-sinasu-agencias-filtros"  href="../SINASU_AGENCIAS/agencia1.php?id_guia=<?= $datos->id_elemento + 1 ?>">

    

          
           <div  class="parte-sinasu-agencias-filtros">

               <figure>
                   <img src="img-sinasu/Yucatan.webp" alt="">
                </figure>

               <div class="fondo-agencias-filtros-2"></div>
         
               <i class="fa-regular fa-folder-open"></i>
     
               <h1> Control del Proceso</h1>

          </div>

       </a> -->





  </section>



  <!-- por ultimo se carga el footer -->
  <?php require('./../layout/footer_sinasu.php'); ?>