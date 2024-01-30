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

  <h4 class="text-center text-secondery">AGENCIAS</h4>

  <?php
  //hacemos la conexion
  include "../../modelo/conexion-SINASU.php";
  // include "../../controlador/controlador_vista_agencias_id_sinasu.php";

  // include "../../controlador/controlador_modificar_usuario_sinasu.php";


  //Hacemos la consulta relacionando las tablas que necesitemos
  //para dicha consulta necesitamos la tabla usuario
  // $sql = $conexionSINASU->query(" SELECT * from usuario ");
  $sql_mostrar_agencias = $conexionSINASU->query(" SELECT * from agencias ");
  


    ?>

    <!-- BOTON PARA REGISTRAR AGENCIA -->

<a href="registro_agencias.php" class="btn btn-primary btn-rounded mb-3 otro"><i class="fa-solid fa-user-plus "></i> &nbsp;
    REGISTRAR NUEVA AGENCIA</a>


    

  <section class="continer-agencias">
       



<!-- -----------------HACER EL WHILE PARA VINCULAR TODAS LAS 10 AGENCIAS DE LA BASE DE DATOS-------------------------------- -->
       <?php
       while( $datos_mostrar_agencias = $sql_mostrar_agencias ->fetch_object()){ ?>

        <a class="boton-sinasu-agencias"  href="agencias_filtros.php?id_agencias_filtro=<?= $datos_mostrar_agencias->id_agencia ?>">
            <?php
        // Guarda el valor en la variable de sesión
            // $_SESSION['id_agencias_filtro'] = $datos_mostrar_agencias->id_agencia;
            //       ?>

       <!-- "../SINASU_AGENCIAS/agencia1.php" -->
          
           <div  class="parte-sinasu-agencias">

               <figure>
                   <img src="img-sinasu/Yucatan.webp" alt="">
                </figure>

               <div class="fondo-agencias-2"></div> 
         
               <i class="fa-regular fa-folder-open"></i>

               <h1><?= $datos_mostrar_agencias->zona ?></h1>
     
               <h1><?= $datos_mostrar_agencias->nombre_agencia ?></h1>

               <!-- <h1><?= $datos_mostrar_agencias->responsable_agencia ?></h1> -->

          </div>

       </a>
        
       <?php }?>

      

   </section>



<!-- por ultimo se carga el footer -->
<?php require('./../layout/footer_sinasu.php'); ?>