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
    ul li:nth-child(2) .activo{
        background: #9889fe !important;
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
<?php require('./../layout/topbar_sinasu.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./../layout/sidebar_sinasu.php'); ?>

<!-- inicio del contenido principal -->
<!-- <link rel="stylesheet" href="../estiloinicio.css"> -->
<div class="page-content">

   <h4 class="text-center text-secondery"> REGISTRO DE AGENCIAS</h4>

   <!--llamamos al controlador para enviar los datos a la base de datos y 
  en el form tenemos que especificar el metodo POST-->
   <?php 
    include "../../modelo/conexion-SINASU.php";
    include "../../controlador/controlador_registrar_agencia_sinasu.php";
   ?>

   <section class="row">
    <!--Aqui especificamos el metodo-->
      <form action="" method="post">


      <div class="fl-flex-label mb-4 px-2col-md-4">
  
          <input type="text" placeholder="Nombre de agencia" class="input input__text" name="txtnombreagencia">
        </div>


        
        <div class="fl-flex-label mb-4 px-2 col-md-4 campo">

          <select name="txtid_usuario" class="input input__select inputmodal">
            <option value=""> Usuario</option>
            <?php
             $sql_buscar_usuario = $conexionSINASU->query(" SELECT * FROM usuario");
             while ($datos_buscar_usuario = $sql_buscar_usuario->fetch_object()) { ?>
            <option value="<?= $datos_buscar_usuario->id_usuario?>"><?= $datos_buscar_usuario->usuario ?></option>
             <?php }
             ?>
           </select>
                   
        </div>

         <!-- <div class="fl-flex-label mb-4 px- col-md-4 campo">

          <select name="txtresponsable" class="input input__select inputmodal">
            <option value=""> Nombre del responsable</option>
            <?php
             $sql_buscar_usuario = $conexionSINASU->query(" SELECT * FROM usuario");
             while ($datos_buscar_usuario = $sql_buscar_usuario->fetch_object()) { ?>
            <option value="<?= $datos_buscar_usuario->nombre?>"><?= $datos_buscar_usuario->nombre ?> <?= $datos_buscar_usuario->apellido ?></option>
             <?php }
             ?>
           </select>
                   
        </div> -->

      

        <div class="fl-flex-label mb-4 px-2 col-md-4">
           <!-- <img src="../public/images/itm-merida-fondo.webp" alt=""> -->
          <input type="text" placeholder="Zona" class="input input__text" name="txtzona">
        </div>

        <div class="fl-flex-label mb-4 px-2 col-md-8">
           <!-- <img src="../public/images/itm-merida-fondo.webp" alt=""> -->
          <input type="text" placeholder="Descripción" class="input input__text" name="txtdescripcion">
        </div>

    




       <div class="text-right p-3">
        <a href="agencias.php" class="btn btn-secondary btn-rounded">Atras</a>
        <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
       </div>

      </form>
   </section>

</div>
</div>
<!-- fin del contenido principal -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var nombreInput = document.querySelector('[name="txtnombreagencia"]');
        var apellidoInput = document.querySelector('[name="txtapellido"]');
        var usuarioInput = document.querySelector('[name="txtusuario"]');

        // Función para eliminar espacios en blanco
        function removeSpaces(input) {
            input.value = input.value.replace(/\s/g, ''); // Elimina espacios en blanco
        }

        // Evento input para los campos de nombre, apellido y usuario
        nombreInput.addEventListener('input', function() {
            removeSpaces(this);
        });

        apellidoInput.addEventListener('input', function() {
            removeSpaces(this);
        });

        usuarioInput.addEventListener('input', function() {
            removeSpaces(this);
        });
    });
</script>



<!-- por ultimo se carga el footer -->
<?php require('./../layout/footer_sinasu.php'); ?>