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
    ul li:nth-child(2) .activo{
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

   <h4 class="text-center text-secondery">  REGISTRO DE USUARIOS</h4>

   <!--llamamos al controlador para enviar los datos a la base de datos y 
  en el form tenemos que especificar el metodo POST-->
   <?php 
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_usuario.php";
   ?>

   <section class="row">
    <!--Aqui especificamos el metodo-->
      <form action="" method="post">
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
          <img src="../public/images/itm-merida-fondo.webp" alt="">
          <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" >
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 ">
           <img src="../public/images/itm-merida-fondo.webp" alt="">
          <input type="text" placeholder="Apellido" class="input input__text" name="txtapellido" >
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 ">
           <img src="../public/images/itm-merida-fondo.webp" alt="">
          <input type="text" placeholder="Usuario" class="input input__text" name="txtusuario" >
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 ">
           <img src="../public/images/itm-merida-fondo.webp" alt="">
          <input type="password" placeholder="Contrasea" class="input input__text" name="txtpassword" >
        </div>

       <div class="text-right p-3">
        <a href="usuario.php" class="btn btn-secondary btn-rounded">Atras</a>
        <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
       </div>

      </form>
   </section>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>