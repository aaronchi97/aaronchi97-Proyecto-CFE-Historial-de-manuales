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
  ul li:nth-child(2) .activo {
    background: #195a78 !important;
  }
</style>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<link rel="stylesheet" href="estiloinicio.css">
<div class="page-content">

  <h4 style="margin-bottom: 5%;" class="text-center text-secondery"> NEGATIVAS</h4>

  <?php
  //hacemos la conexion
  include "../modelo/conexion.php";
  include "../controlador/controlador_modificar_negativa.php";
  include "../controlador/controlador_asignar_estatus_negativas.php";
  include "../controlador/controlador_eliminar_negativa.php";


  ?>


  <section class="botones-manual">

    <?php

    if ($_SESSION["rol"] == '1' || $_SESSION["rol"] == '2') { ?>

      <a href="registro_negativas.php" class="btn-generar-manual"><i class="fa-solid fa-plus"></i> GENERAR NUEVA NEGATIVA</a>

    <?php } else { ?>

      <a hidden href="registro_negativas.php" class="btn-generar-manual"><i class="fa-solid fa-plus"></i> GENERAR NUEVA NEGATIVA</a>

    <?php }  ?>

    <!--  ------------------------------------------------BOTONES PARA MODALES POR BUSQUEDAS DE FILTROS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


    <a data-toggle="modal" data-target="#atendidasModal" class="btn-manual-validas">VER VALIDADAS <i class="fa-solid fa-check"></i></a>

    <a data-toggle="modal" data-target="#desatendidasModal" class="btn-manual-pendiente">VER PENDIENTES <i class="fa-regular fa-clock"></i></a>

    <a data-toggle="modal" data-target="#fechaModal" class="btn-manual-pendiente">VER POR FECHA <i class="fa-regular fa-calendar-check"></i></a>

  </section>



  <!-- ------------------------------------------------AREA DE MODALES POR BUSQUEDAS DE FILTROS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

  <?php
  include "modales/modal_filtros_busqueda_negativas.php";
  ?>




  <?php




  // <!-- ------------------------------------------------AREA DE VISTAS POR TABLAS Y MES ACTUAL---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->



  $mostrarTablas = false;
  if (isset($_POST['txtbuscarrpuN'])) { ?>


    <!-- AQUI AGREGAMOS EL FOMR PARA BUSCAR RPU INDIVIDUAL, PERO LA PRIMERA VISTA SERA LA QUE ESTA EN EL ELSE, QUE MUESTRA 
LOS RPU QUE SE HAN REGISTRADO EN EL MES ACTUAL  -->

    <form style="margin-bottom: 4%;" action="" method="post" id="searchForm">

      <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
        <input type="text" class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpuN">
      </div>
      <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
    </form>


    <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>




    <?php
    $rpu_buscar = $_POST['txtbuscarrpuN'];
    // $rpu_vuelta = $_GET['id_manuales_vuelta'];
    // Modificar la consulta para incluir la cláusula WHERE


    // $sql = $conexion->query("SELECT * FROM control_negativas WHERE rpu = $rpu_buscar  ");
    $sql = $conexion->query("SELECT * FROM control_negativas 
    WHERE control_negativas.rpu = '$rpu_buscar'
     ");

    // Activar la visualización de las tablas
    $mostrarTablas = true;
  } else {
    date_default_timezone_set('America/Mexico_City');
    $mes_actual_negativa = date('m');

    // Realizar la consulta SQL
    // $sql_mes = $conexion->query("SELECT * FROM control_negativas WHERE MONTH(fecha_captura) = $mes_actual"); 


    //  $sql_mes_negativa = $conexion->query("SELECT control_negativas.*, justificacion_negativas.justificacion_neg
    //   FROM control_negativas
    //   LEFT JOIN justificacion_negativas ON control_negativas.id_justificacionnegativas = justificacion_negativas.id_justificacionnegativas
    //   WHERE MONTH(control_negativas.fecha_captura) = $mes_actual_negativa
    //   ");  



    // $sql_mes_negativa = $conexion->query("SELECT * FROM control_negativas WHERE MONTH(fecha_captura) = $mes_actual_negativa");
    $sql_mes_negativa = $conexion->query("SELECT * FROM control_negativas WHERE MONTH(fecha_captura) = $mes_actual_negativa");





    if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
    ?>

      <form style="margin-bottom: 6%;" action="" method="post" id="searchForm">

        <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
          <input type="text" class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpuN">
        </div>
        <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
      </form>


      <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>



      <table class="table table-bordered table-hover w-100 " id="example">
        <thead>
          <tr>

            <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->

            <?php
            include "tablas/tabla_cabecera_negativas_admin.php";
            ?>

          </tr>
        </thead>

        <tbody>
          <?php
          while ($datos = $sql_mes_negativa->fetch_object()) { ?>

            <tr>

              <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->
              <?php
              include "tablas/tabla_filas_negativas_admin.php";
              ?>
            </tr>









          <?php



            //-- MODAL PARA CORRECCION Y CAMBIO DE ESTATUS-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->




            include "modales/modal_modificacion_negativas.php";





            //-- Modal-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
          }

          ?>
        <?php





        //AHORA VA LA VISTA SI EL ROL ES UN PROFESIONISTA Ó CONSULTAS QUE SE MUESTRAN EN LA PRIMERA VISTA

      } else { ?>


          <form style="margin-bottom: 4%;" action="" method="post" id="searchForm">

            <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
              <input type="text" class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpuN">
            </div>
            <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
          </form>


          <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>








          <table class="table table-bordered table-hover w-100 " id="example">
            <thead>
              <tr>

                <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA CONSULTOR Y PROFESIONISTA-->

                <?php
                include "tablas/tabla_cabecera_negativas_consultor.php";
                ?>

              </tr>
            </thead>

            <tbody>

              <?php
              while ($datos = $sql_mes_negativa->fetch_object()) { ?>


                <tr>


                  <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA CONSULTOR Y PROFESIONISTA-->
                  <?php
                  include "tablas/tabla_filas_negativas_consultor.php";
                  ?>

                  <!-- <?php echo $mostrarBoton ? 'otro' : ''; ?>  -->

                </tr>
              <?php } ?>




            <?php }

            ?>

          <?php }
          ?>















          <!-- CONDICION PARA OCULTAR O MOSTRAR LA TABLA SEGUN LOS VALORES QUE INGRESE EL USUARIO------------------------------------------------------------------------------------------------------------------------------------------ -->

          <?php if ($mostrarTablas) { ?>






            <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES--------------------------------- -->
            <?php
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
            ?>

              <table class="table table-bordered table-hover w-100 " id="example">
                <thead>
                  <tr>

                    <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->

                    <?php
                    include "tablas/tabla_cabecera_negativas_admin.php";
                    ?>


                  </tr>
                </thead>

                <tbody>
                  <?php
                  while ($datos = $sql->fetch_object()) { ?>

                    <tr>

                      <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->
                      <?php
                      include "tablas/tabla_filas_negativas_admin.php";
                      ?>

                    </tr>






                  <?php


                    //-- MODAL PARA CORRECCION Y CAMBIO DE ESTATUS-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->




                    include "modales/modal_modificacion_negativas.php";





                    //-- Modal-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                  }

                  ?>
                <?php






                //AHORA VA LA VISTA DESPUES DE QUE EL USUARIO ESCRIBE Y BUSCA UN RPU Y SI EL ROL ES UN PROFESIONISTA Ó CONSULTAS 
                //QUE SE MUESTRAN EN LA PRIMERA VISTA

              } else {
                ?>

                  <table class="table table-bordered table-hover w-100 " id="example">
                    <thead>
                      <tr>
                        <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA CONSULTOR Y PROFESIONISTA-->

                        <?php
                        include "tablas/tabla_cabecera_negativas_consultor.php";
                        ?>
                      </tr>
                    </thead>

                    <tbody>

                      <?php
                      while ($datos = $sql->fetch_object()) { ?>


                        <tr>


                          <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA CONSULTOR Y PROFESIONISTA-->
                          <?php
                          include "tablas/tabla_filas_negativas_consultor.php";
                          ?>


                        </tr>
                      <?php } ?>




                    <?php }

                    ?>



                  <?php

                }
                  ?>




                    </tbody>
                  </table>




                  <!-- //BOTON PARA QUITAR O OTORGAR EL ESTADO RESPONSIVE DE LA TABLA -->

                  <button class="btn" id="toggleResponsive"><i class="fa-solid fa-up-right-and-down-left-from-center"></i></button>

</div>
</div>
<!-- fin del contenido principal -->





<script>
  function buscar() {
    var input = document.getElementById("searchInput").value;

    if (input.trim() === "") {
      // Mostrar mensaje de error si el campo está vacío
      document.getElementById("errorMessage").style.display = "block";
    } else {
      // Ocultar el mensaje de error si el campo no está vacío
      document.getElementById("errorMessage").style.display = "none";


    }
  }
</script>







<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>