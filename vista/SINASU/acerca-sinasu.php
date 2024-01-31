
<?php
session_start();
//si el nombre y apellido estan vacios entonces redirigelos a la pagina de login.php
//esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
//lo compias y lo pegas desde el inicio entonces no te dejara, hasta que pongas un usuario valido

if (empty($_SESSION['nombre-sinasu']) and empty($_SESSION['apellido-sinasu'])) {
  header("location:../login/login_sinasu.php");
}

$id_agencia_filtro_usuario = $_SESSION["id-agencia-sinasu"];
echo "id_agencia: $id_agencia_filtro_usuario ";
?>

<?php require('./../layout/topbar_sinasu.php'); ?>
<?php require('./../layout/sidebar_sinasu.php'); ?>

<style>
  ul li:nth-child(5) .activo {
    background: #9889fe !important;
  }
</style>

 <link rel="stylesheet" href="../estiloinicio.css">
 

<div class="page-content">

    <!-- <h2 class="text-correct text-lg">BIENVENIDO AL SISTEMA DE ASISTENCIAS</h2> -->
    
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators" style="margin-bottom: 25%;">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
   
  </ol>
  <div class="carousel-inner" style="margin-top: -15%;">
    <div class="carousel-item active" style="width: 100%;" >
      <img src="../login/img/sinasu/slide-sinasu.jpg" style="filter: brightness(30%); " 
      class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block" style=" margin-bottom: 25%;" >
      <!-- <figure>

        <img src="../login/img/CFE-icono.svg" alt="">
      </figure> -->
      <h5>SISTEMA DE GESTIÓN Y VERIFICACIÓN DE ARCHIVOS SINASU</h5>
        <p>Seleccione la opción acorde a sus necesidades:</p>
        <br>
        <div class="botones-inicio-sinasu">
          <a class="btn-inicio-sinasu" href="#">Subir documentación</a>

          <a class="btn-inicio-sinasu" href="#">Ver status de documeto</a>
         </div>

      </div>
    </div>
    <div class="carousel-item" style="width: 100%;">
      <img src="../login/img/sinasu/slide-sinasu2.jpg" style="filter: brightness(50%); " class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block" style=" margin-bottom: 25%;">
      

      <h5>SISTEMA DE GESTIÓN Y VERIFICACIÓN DE ARCHIVOS SINASU</h5>
        <p>Seleccione la opción acorde a sus necesidades:</p>
        <br>
         <div class="botones-inicio-sinasu">
          <a class="btn-inicio-sinasu" href="#">Especificaciones y formatos</a>

         
         </div>

      </div>
    </div>
    
  </div>
  <button class="carousel-control-prev" style="margin-bottom: 0;" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" style="margin-bottom: 0;" type="button" data-target="#carouselExampleCaptions" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</div>

</div>





<?php require('./../layout/footer_sinasu.php'); ?>