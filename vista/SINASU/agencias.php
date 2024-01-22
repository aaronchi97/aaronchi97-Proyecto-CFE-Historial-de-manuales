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


  <section class="continer-agencias">


    <!-- <form action="">
           <input type="text" placeholder="DNI del maestro" name="txtdni">
       </form> -->

    <a class="boton-sinasu-agencias" href="agencia1.php">


      <div class="parte-sinasu-agencias">

        <figure>
          <img src="img-sinasu/Yucatan.webp" alt="">
        </figure>

        <div class="fondo-agencias-2"></div>

        <i class="fa-regular fa-folder-open"></i>

        <h1>Agencia 1</h1>

      </div>

    </a>


    <a class="boton-sinasu-agencias" href="vista/login/login.php">


      <div class="parte-sinasu-agencias">

        <figure>
          <img src="img-sinasu/Campeche.jpg" alt="">
        </figure>

        <div class="fondo-agencias-2"></div>

        <i class="fa-solid fa-list-check"></i>

        <h1>Agencia 2</h1>

      </div>
    </a>


    <a class="boton-sinasu-agencias" href="vista/login/login.php">


      <div class="parte-sinasu-agencias">

        <figure>
          <img src="img-sinasu/Cancun.jpeg" alt="">
        </figure>

        <div class="fondo-agencias-2"></div>

        <i class="fa-solid fa-list-check"></i>

        <h1>Agencia 3</h1>

      </div>
    </a>


    <a class="boton-sinasu-agencias" href="vista/login/login_sinasu.php">


      <div class="parte-sinasu-agencias">

        <figure>
          <img src="img-sinasu/Yucatan.webp" alt="">
        </figure>

        <div class="fondo-agencias-2"></div>

        <i class="fa-regular fa-folder-open"></i>

        <h1>Agencia 4</h1>

      </div>

    </a>


    <a class="boton-sinasu-agencias" href="vista/login/login.php">


      <div class="parte-sinasu-agencias">

        <figure>
          <img src="img-sinasu/Campeche.jpg" alt="">
        </figure>

        <div class="fondo-agencias-2"></div>

        <i class="fa-solid fa-list-check"></i>

        <h1>Agencia 5</h1>

      </div>
    </a>


    <a class="boton-sinasu-agencias" href="vista/login/login.php">


      <div class="parte-sinasu-agencias">

        <figure>
          <img src="img-sinasu/Cancun.jpeg" alt="">
        </figure>

        <div class="fondo-agencias-2"></div>

        <i class="fa-solid fa-list-check"></i>

        <h1>Agencia 6</h1>

      </div>
    </a>


    <a class="boton-sinasu-agencias" href="vista/login/login_sinasu.php">


      <div class="parte-sinasu-agencias">

        <figure>
          <img src="img-sinasu/Yucatan.webp" alt="">
        </figure>

        <div class="fondo-agencias-2"></div>

        <i class="fa-regular fa-folder-open"></i>

        <h1>Agencia 7</h1>

      </div>

    </a>


    <a class="boton-sinasu-agencias" href="vista/login/login.php">


      <div class="parte-sinasu-agencias">

        <figure>
          <img src="img-sinasu/Campeche.jpg" alt="">
        </figure>

        <div class="fondo-agencias-2"></div>

        <i class="fa-solid fa-list-check"></i>

        <h1>Agencia 8</h1>

      </div>
    </a>


    <a class="boton-sinasu-agencias" href="vista/login/login.php">


      <div class="parte-sinasu-agencias">

        <figure>
          <img src="img-sinasu/Cancun.jpeg" alt="">
        </figure>

        <div class="fondo-agencias-2"></div>

        <i class="fa-solid fa-list-check"></i>

        <h1>Agencia 9</h1>

      </div>
    </a>




  </section>



  <!-- por ultimo se carga el footer -->
  <?php require('./../layout/footer_sinasu.php'); ?>