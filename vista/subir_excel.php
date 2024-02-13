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
    background: #598b6b !important;
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

  <h4 style="margin-bottom: 5%;" class="text-center text-secondery"> Subir manuales o negativas</h4>

  <?php
  //hacemos la conexion
  include "../modelo/conexion.php";
  //llamamos al controlador para eliminar registros
  include "../controlador/controlador_modificar_usuario.php";
  include "../controlador/controlador_eliminar_usuario.php";


  ?>


  <body class="cuerpo_subir">

    <div class="subir">
      <div class="drop-area">
        <h2>Arrastra y suelta el documento Excel</h2>
        <span>O</i>
        </span>
        <button>Selecciona tus archivos</button>
        <input type="file" name="" id="input-file" hidden multipart>
      </div>
      <div id="preview">
      </div>
    </div>

</div>
</body>
<script src="upload_excel.js"></script>


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>