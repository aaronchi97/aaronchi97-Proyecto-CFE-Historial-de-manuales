<?php
session_start();
//si el nombre y apellido estan vacios entonces redirigelos a la pagina de login.php
//esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
//lo compias y lo pegas desde el inicio entonces no te dejara, hasta que pongas un usuario valido
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
  header("location:login/login.php");
}

?>

<?php require('./layout/topbar.php'); ?>
<?php require('./layout/sidebar.php'); ?>

<style>
  ul li:nth-child(4) .activo {
    background: #195a78 !important;
  }
</style>

<link rel="stylesheet" href="estiloinicio.css">

<div class="page-content">

  <!-- <h2 class="text-correct text-lg">BIENVENIDO AL SISTEMA DE ASISTENCIAS</h2> -->

  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators" style="margin-bottom: 25%;">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>

    </ol>
    <div class="carousel-inner" style="margin-top: -15%;">
      <div class="carousel-item active" style="width: 100%;">
        <img src="login/img/slide-3.jpg" style="filter: brightness(40%); " class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block" style=" margin-bottom: 25%;">
          <h5>SISTEMA DE MANUALES Y NEGATIVAS</h5>
          <p>¡Bienvenido <span class="nombres-usuarios"><?= $_SESSION["nombre"] ?></span>! Selecciona la opción acorde a sus necesidades:</p>
          <br>
          <div class="botones-inicio-sinasu">
            <a class="btn-inicio-historial" href="#">Generar manuales</a>

            <a class="btn-inicio-historial" href="#">Generar negativas</a>
          </div>
        </div>
      </div>
      <div class="carousel-item" style="width: 100%;">
        <img src="login/img/slide-1.jpeg" style="filter: brightness(40%); " class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block" style=" margin-bottom: 25%;">
          <h5>EMPECEMOS</h5>
          <p>Hola <span class="nombres-usuarios"><?= $_SESSION["nombre"] ?></span> selecciona la opción acorde a sus necesidades:</p>
          <br>
          <div class="botones-inicio-sinasu">
            <a class="btn-inicio-historial" href="#">Historial de manuales</a>

            <a class="btn-inicio-historial" href="#">Historial de negativas</a>
          </div>
        </div>
      </div>

    </div>
    <button class="carousel-control-prev" style="margin-bottom: 5%;" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" style="margin-bottom: 5%;" type="button" data-target="#carouselExampleCaptions" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </button>
  </div>

</div>





<?php require('./layout/footer.php'); ?>