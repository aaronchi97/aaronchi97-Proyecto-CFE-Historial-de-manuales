<?php

session_start();
//si el nombre y apellido estan vacios entonces redirigelos a la pagina de login.php
//esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
//lo compias y lo pegas desde el inicio entonces no te dejara, hasta que pongas un usuario valido
if (empty($_SESSION['nombre-sinasu']) and empty($_SESSION['apellido-sinasu'])) {
  header("location:login/login.php");
}

$id = $_SESSION["id-sinasu"];
?>

<!-- <style>
    ul li:nth-child(2) .activo{
        background: rgb(11, 150, 214) !important;
    }
</style> -->

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
<link rel="stylesheet" href="estiloinicio.css">
<div class="page-content">

  <h4 class="text-center text-secondery"> PERFIL</h4>

  <!--llamamos al controlador para enviar los datos a la base de datos y 
  en el form tenemos que especificar el metodo POST-->
  <?php
  include "../../modelo/conexion-SINASU.php";
  include "../../controlador/controlador_modificar_perfil_sinasu.php";

  $sql = $conexionSINASU->query(" select * from usuario where id_usuario=$id ");
  ?>

  <section class="row">
    <!--Aqui especificamos el metodo-->
    <!--LOS ESTILOS ESTAN EN estilos.css-->

    <form action="" method="post">

      <?php
      while ($datos = $sql->fetch_object()) { ?>
        <div hidden class="fl-flex-label mb-4 px-2 col-12  campo">

          <input type="text" placeholder="ID" class="input input__text inputmodal" name="txtid"
            value="<?= $datos->id_usuario ?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12  campo">

          <input type="text" placeholder="Nombre" class="input input__text inputmodal" name="txtnombre"
            value="<?= $datos->nombre ?>">
        </div>
        <div class="fl-flex-label mb-4 px-2 col-12  campo">

          <input type="text" placeholder="Apellido" class="input input__text inputmodal" name="txtapellido"
            value="<?= $datos->apellido ?>">
        </div>
        <div hidden class="fl-flex-label mb-4 px-2 col-12  campo">

          <input type="text" placeholder="Usuario" class="input input__text inputmodal" name="txtusuario"
            value="<?= $datos->usuario ?>">
        </div>



        <div class="text-right p-3">
          <!-- <a href="usuario.php" class="btn btn-secondary btn-rounded">Atras</a> -->
          <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
        </div>

      <?php } ?>

    </form>
  </section>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./../layout/footer_sinasu.php'); ?>