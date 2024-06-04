<?php

session_start();
//si el nombre y apellido estan vacios entonces redirigelos a la pagina de login.php
//esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
//lo compias y lo pegas desde el inicio entonces no te dejara, hasta que pongas un usuario valido
if (empty ($_SESSION['nombre-sinasu']) and empty ($_SESSION['apellido-sinasu'])) {
  header("location:../login/login_sinasu.php");
}

?>

<style>
ul li:nth-child(0) .activo {
    background: #008f5a !important;
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
<?php require ('./../layout/topbar_sinasu.php'); ?>
<!-- luego se carga el sidebar -->
<?php require ('./../layout/sidebar_sinasu.php'); ?>


<!-- inicio del contenido principal -->
<link rel="stylesheet" href="../SINASU/estilosinasu.css">
<div class="page-content">


    <h4 class="text-center text-secondery titulo-renta2">Página en mantenimiento</h4>

    <figure class="figura_gato">
        <img class="gato_404" src="img-sinasu/electrician-animate.svg" alt="">
    </figure>

</div>

<!-- por ultimo se carga el footer -->
<?php require ('./../layout/footer_sinasu.php'); ?>