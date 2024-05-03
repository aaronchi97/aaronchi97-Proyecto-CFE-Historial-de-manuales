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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="estiloinicio.css">
<!-- Select2 -->

<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<!-- <link rel="stylesheet" href="select2/select2.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<!-- Select2 -->


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- <script src="select2/select2.min.js"></script> -->
















<div class="page-content">

  <h4 style="margin-bottom: 5%;" class="text-center text-secondery"> MANUALES</h4>

  <?php
  //hacemos la conexion
  include "../modelo/conexion.php";
  //llamamos al controlador para eliminar registros
  include "../controlador/controlador_modificar_manual.php";
  include "../controlador/controlador_asignar_estatus.php";
  include "../controlador/controlador_eliminar_manual.php";
  include "../controlador/control-estadisticos/controlador_buscar_fecha_manual.php";
  ?>


  <section class="botones-manual">

    <?php

    if ($_SESSION["rol"] == '1' || $_SESSION["rol"] == '2') { ?>

      <a href="registro_manuales.php" class="btn-generar-manual"> <i class="fa-solid fa-plus"></i> GENERAR NUEVA MANUAL</a>

    <?php } else { ?>

      <a hidden href="registro_manuales.php" class="btn-generar-manual"><i class="fa-solid fa-plus"></i> GENERAR NUEVA MANUAL</a>

    <?php }  ?>

    <a data-toggle="modal" data-target="#atendidasModal" class="btn-manual-validas">VER VALIDADAS <i class="fa-solid fa-check"></i></a>

    <a data-toggle="modal" data-target="#desatendidasModal" class="btn-manual-pendiente">VER PENDIENTES <i class="fa-regular fa-circle-pause"></i></a>

  </section>


  <!-- ------------------------------------------------AREA DE MODALES POR BUSQUEDAS DE FILTROS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->



  <!-- MODAL PARA BOTON ATENDIDAS ----------------------------------------------------------------------------------------------------------------------------------------------->
  <div class="modal fade" style="width: 90%;" id="atendidasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="width: 140%;">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title w-100" id="exampleModalLabel"><img src="data:image/png;base64,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">
            SELECCIONA UNA FECHA </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!--SELECCION POR FECHAS-->


          <form class="fechas" method="post">

            <div>
              <label><input type="checkbox" name="opciones" value="fecha_personalizada_atendidas"> Buscar por fecha personalizada</label>
              <label><input type="checkbox" name="opciones" value="ver_mes_atendidas"> Ver por mes</label>
              <label><input type="checkbox" name="opciones" value="ver_semestre_atendidas"> Ver por semestre</label>
              <label><input type="checkbox" name="opciones" value="ver_anio_atendidas"> Ver por año</label>
              <label><input type="checkbox" name="opciones" value="ver_todas_atendidas"> Ver todas</label>
            </div>


            <!-- Bloques de código -->
            <div class="opciones-container fecha_personalizada_atendidas" style="display: none;">

              <div class="fl-flex-label mb-4 px-2 col-md-6">
                <label for="fechaInicio">Fecha de Inicio:</label>
                <input class="input input__text" type="date" id="fechaInicio" name="fechaInicio">
              </div>


              <div class="fl-flex-label mb-4 px-2 col-md-6">
                <label for="fechaFin">Fecha de Fin:</label>
                <input type="date" id="fechaFin" name="fechaFin" class="input input__text">
              </div>

              <div class="text-center p-3">
                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxatendidas" class="btn btn-primary btn-rounded">Asignar</button>
                <a style="margin-top: 5%;" href="estadisticos_manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>

              </div>


            </div>

            <div class="opciones-container ver_mes_atendidas" style="display: none;">
              <!-- Código para Ver por mes -->
              <div class="fl-flex-label mb-4 px-2 col-10">
                <label>Selecciona mes y año: </label>
                <input class="input input__text" type="month" name="fecha_1mes">
              </div>
              <div class="text-center p-3">
                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxatendidas" class="btn btn-primary btn-rounded">Asignar</button>
                <a style="margin-top: 5%;" href="estadisticos_manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>

              </div>
            </div>


            <div class="opciones-container ver_semestre_atendidas" style="display: none;">
              <!-- Código para Ver por semestre -->
              <div class="fl-flex-label mb-4 px-2 col-12">
                <label>Selecciona mes y año inicial: </label>
                <input class="input input__text" type="month" id="fecha_semestral_atendidas" name="fecha_6meses">
                <input hidden type="month" id="sextomes_atendidas" name="sextomes">
              </div>
              <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxatendidas" class="btn btn-primary btn-rounded" onclick="calcularMesesAtendidas()">Asignar</button>
              <a style="margin-top: 5%;" href="estadisticos_manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>
            </div>



            <div class="opciones-container ver_anio_atendidas" style="display: none;">
              <!-- Código para Ver por año -->
              <div class="fl-flex-label mb-4 px-2 col-12">
                <label>Selecciona mes y año inicial: </label>
                <input class="input input__text" type="month" id="fecha_anual_atendidas" name="fecha_anio">
                <input hidden type="month" id="mesdoce_atendidas" name="mes_doce">
              </div>


              <div class="text-center p-3">
                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxatendidas" class="btn btn-primary btn-rounded" onclick="calcularAnioAtendidas()">Asignar</button>
                <a style="margin-top: 5%;" href="estadisticos_manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>

              </div>
            </div>

            <div class="opciones-container ver_todas_atendidas" style="display: none;">

              <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxatendidas" class="btn btn-primary btn-rounded">Continuar</button>

            </div>



          </form>



        </div>
      </div>
    </div>
  </div>





  <!-- MODAL PARA BOTON NOOO ATENDIDAS ----------------------------------------------------------------------------------------------------------------------------------------------->
  <div class="modal fade" style="width: 90%;" id="desatendidasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="width: 140%;">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title w-100" id="exampleModalLabel"><img src="data:image/png;base64,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">
            SELECCIONA UNA FECHA </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!--SELECCION POR FECHAS-->


          <form class="fechas" method="post">

            <div>
              <label><input type="checkbox" name="opciones" value="fecha_personalizada_desatendidas"> Buscar por fecha personalizada</label>
              <label><input type="checkbox" name="opciones" value="ver_mes_desatendidas"> Ver por mes</label>
              <label><input type="checkbox" name="opciones" value="ver_semestre_desatendidas"> Ver por semestre</label>
              <label><input type="checkbox" name="opciones" value="ver_anio_desatendidas"> Ver por año</label>
              <label><input type="checkbox" name="opciones" value="ver_todas_desatendidas"> Ver todas</label>
            </div>


            <!-- Bloques de código -->
            <div class="opciones-container fecha_personalizada_desatendidas" style="display: none;">

              <div class="fl-flex-label mb-4 px-2 col-md-6">
                <label for="fechaInicio">Fecha de Inicio:</label>
                <input class="input input__text" type="date" id="fechaInicio" name="fechaInicio">
              </div>


              <div class="fl-flex-label mb-4 px-2 col-md-6">
                <label for="fechaFin">Fecha de Fin:</label>
                <input type="date" id="fechaFin" name="fechaFin" class="input input__text">
              </div>

              <div class="text-center p-3">
                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdesatendidas" class="btn btn-primary btn-rounded">Asignar</button>
                <a style="margin-top: 5%;" href="estadisticos_manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>

              </div>


            </div>

            <div class="opciones-container ver_mes_desatendidas" style="display: none;">
              <!-- Código para Ver por mes -->
              <div class="fl-flex-label mb-4 px-2 col-10">
                <label>Selecciona mes y año: </label>
                <input class="input input__text" type="month" name="fecha_1mes">
              </div>
              <div class="text-center p-3">
                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdesatendidas" class="btn btn-primary btn-rounded">Asignar</button>
                <a style="margin-top: 5%;" href="estadisticos_manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>

              </div>
            </div>


            <div class="opciones-container ver_semestre_desatendidas" style="display: none;">
              <!-- Código para Ver por semestre -->
              <div class="fl-flex-label mb-4 px-2 col-12">
                <label>Selecciona mes y año inicial: </label>
                <input class="input input__text" type="month" id="fecha_semestral_desatendidas" name="fecha_6meses">
                <input hidden type="month" id="sextomes_desatendidas" name="sextomes">
              </div>
              <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdesatendidas" class="btn btn-primary btn-rounded" onclick="calcularMesesDesatendidas()">Asignar</button>
              <a style="margin-top: 5%;" href="estadisticos_manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>
            </div>



            <div class="opciones-container ver_anio_desatendidas" style="display: none;">
              <!-- Código para Ver por año -->
              <div class="fl-flex-label mb-4 px-2 col-12">
                <label>Selecciona mes y año inicial: </label>
                <input class="input input__text" type="month" id="fecha_anual_desatendidas" name="fecha_anio">
                <input hidden type="month" id="mesdoce_desatendidas" name="mes_doce">
              </div>


              <div class="text-center p-3">
                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdesatendidas" class="btn btn-primary btn-rounded" onclick="calcularAnioDesatendidas()">Asignar</button>
                <a style="margin-top: 5%;" href="estadisticos_manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>

              </div>
            </div>

            <div class="opciones-container ver_todas_desatendidas" style="display: none;">

              <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdesatendidas" class="btn btn-primary btn-rounded">Continuar</button>

            </div>



          </form>



        </div>
      </div>
    </div>
  </div>


  <!-- 
    CODIGO PARA BOTON ---POR FECHAS--- REDIRIGIR A LA PAGINA CORRESPONDIENTE SEGUN LA ELECCION DE CHECKON E INPUT------------------------ -->


  <?php
  if (!empty($_POST["btn_verxfecha"])    &&      ((!empty($_POST["fechaInicio"]) && !empty($_POST["fechaFin"])) || (!empty($_POST["fecha_anio"]) && !empty($_POST["mes_doce"]))
    || (!empty($_POST["fecha_6meses"]) && !empty($_POST["sextomes"])) || (!empty($_POST["fecha_1mes"])))) { ?>

    <div style="margin-top: 3%;">
      <!-- <i class="fa-regular fa-circle-check"></i> -->
      <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

          <rect y="0" width="13" height="50" fill="#1fa2ff">
            <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
          </rect>

          <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
            <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
          </rect>

          <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
            <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
          </rect>

        </svg> </h1>


    </div>

    <script>
      setTimeout(function() {
        window.location.href = "busqueda_manuales_fecha.php";
      }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->

  <?php } else if (!empty($_POST["btn_verxatendidas"])    &&      ((!empty($_POST["fechaInicio"]) && !empty($_POST["fechaFin"])) || (!empty($_POST["fecha_anio"])
    && !empty($_POST["mes_doce"])) || (!empty($_POST["fecha_6meses"]) && !empty($_POST["sextomes"])) || (!empty($_POST["fecha_1mes"])))) {

  ?>

    <div style="margin-top: 3%;">
      <!-- <i class="fa-regular fa-circle-check"></i> -->
      <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

          <rect y="0" width="13" height="50" fill="#1fa2ff">
            <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
          </rect>

          <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
            <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
          </rect>

          <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
            <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
          </rect>

        </svg> </h1>


    </div>

    <script>
      setTimeout(function() {
        window.location.href = "manuales_atendidas.php";
      }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->




  <?php } else if (!empty($_POST["btn_verxatendidas"])) { ?>

    <div style="margin-top: 3%;">
      <!-- <i class="fa-regular fa-circle-check"></i> -->
      <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

          <rect y="0" width="13" height="50" fill="#1fa2ff">
            <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
          </rect>

          <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
            <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
          </rect>

          <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
            <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
          </rect>

        </svg> </h1>


    </div>

    <script>
      setTimeout(function() {
        window.location.href = "manuales_atendidas.php";
      }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->


  <?php } else if (!empty($_POST["btn_verxdesatendidas"])    &&      ((!empty($_POST["fechaInicio"]) && !empty($_POST["fechaFin"])) || (!empty($_POST["fecha_anio"])
    && !empty($_POST["mes_doce"])) || (!empty($_POST["fecha_6meses"]) && !empty($_POST["sextomes"])) || (!empty($_POST["fecha_1mes"])))) { ?>

    <div style="margin-top: 3%;">
      <!-- <i class="fa-regular fa-circle-check"></i> -->
      <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

          <rect y="0" width="13" height="50" fill="#1fa2ff">
            <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
          </rect>

          <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
            <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
          </rect>

          <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
            <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
          </rect>

        </svg> </h1>


    </div>

    <script>
      setTimeout(function() {
        window.location.href = "manuales_desatendidas.php";
      }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->

  <?php } else if (!empty($_POST["btn_verxdesatendidas"])) { ?>

    <div style="margin-top: 3%;">
      <!-- <i class="fa-regular fa-circle-check"></i> -->
      <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

          <rect y="0" width="13" height="50" fill="#1fa2ff">
            <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
          </rect>

          <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
            <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
          </rect>

          <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
            <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
            <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
          </rect>

        </svg> </h1>


    </div>

    <script>
      setTimeout(function() {
        window.location.href = "manuales_desatendidas.php";
      }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->


  <?php }
  ?>



















  <!-- ------------------------------------------------AREA DE VISTAS POR TABLAS Y MES ACTUAL---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


  <?php

  $mostrarTablas = false;
  if (isset($_POST['txtbuscarrpu'])) { ?>


    <!-- AQUI AGREGAMOS EL FOMR PARA BUSCAR RPU INDIVIDUAL, PERO LA PRIMERA VISTA SERA LA QUE ESTA EN EL ELSE, QUE MUESTRA 
LOS RPU QUE SE HAN REGISTRADO EN EL MES ACTUAL  -->

    <form style="margin-bottom: 4%;" action="" method="post" id="searchForm">

      <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
        <input type="text" class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpu">
      </div>
      <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
    </form>


    <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>



    <?php
    $rpu_buscar = $_POST['txtbuscarrpu'];
    // $rpu_vuelta = $_GET['id_manuales_vuelta'];
    // Modificar la consulta para incluir la cláusula WHERE
    $sql = $conexion->query("SELECT * FROM control_manuales WHERE rpu = $rpu_buscar  ");

    // Activar la visualización de las tablas
    $mostrarTablas = true;
  } else {
    date_default_timezone_set('America/Mexico_City');
    $mes_actual = date('m');

    // Realizar la consulta SQL
    $sql_mes = $conexion->query("SELECT * FROM control_manuales WHERE MONTH(fecha_captura) = $mes_actual ORDER BY fecha_captura DESC");


    if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
    ?>

      <form style="margin-bottom: 5%;" action="" method="post" id="searchForm">

        <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
          <input type="text" class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpu">
        </div>
        <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
      </form>


      <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>






      <table class="table table-bordered table-hover w-100 " id="example">
        <thead>
          <tr>


            <th scope="col"></th>
            <th scope="col">RPU</th>
            <th scope="col"><i class="fa-solid fa-list-check"></i></th>
            <th scope="col">CUENTA</th>
            <th scope="col">CICLO</th>
            <th scope="col">TARIFA</th>
            <th scope="col">MOTIVO MANUAL</th>
            <!-- <th scope="col">SIN USO</th> -->
            <th scope="col">LECTURA MANUAL</th>
            <th scope="col">KWH A RECUPERAR</th>
            <th scope="col">RESPALDO</th>
            <th scope="col">RPE_AUXILIAR</th>
            <th scope="col">OBSERVACIONES</th>
            <th scope="col">CORRECCION</th>
            <th scope="col">CUENTA2</th>
            <th scope="col">RESPONSABLE_MANUAL</th>
            <th scope="col">FECHA</th>
            <th scope="col">ACCION</th>



          </tr>
        </thead>

        <tbody>
          <?php
          while ($datos = $sql_mes->fetch_object()) { ?>

            <tr>


              <td></td>
              <?php
              if ($datos->id_estatus == '1') { ?>
                <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                  <?= $datos->rpu ?>
                </td>


                <!-- background-color: rgba(110, 149, 52, 0.7);               -->
                <td style=" text-decoration: none;" class="td-celda-icono-estatus">
                  <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_manuales ?> ">
                    ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                  </a>
                </td>

              <?php } else if (($datos->id_estatus == '2')) { ?>

                <td style="color:whitesmoke; font-weight: bold; background-color:  rgba(255, 141, 20, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                  <?= $datos->rpu ?>
                </td>

                <!-- background-color:rgba(245, 174, 22, 0.7);               -->
                <td style=" text-decoration: none;" class="td-celda-icono-estatus">

                  <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_manuales ?> ">
                    PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                </td>


              <?php } else { ?>


                <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                  <?= $datos->rpu ?>
                </td>

                <!-- style="background-color: rgba(255, 53, 53, 0.7);" -->
                <td class="td-celda-icono-estatus">

                  <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_manuales ?> ">
                    RECHAZADO <i class="fa-solid fa-circle-xmark" style="color: #ff2424;"></i> </a>

                </td>


              <?php } ?>



              <!-- <td class="id" scope="row"> -->

              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->cuenta ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->ciclo ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->tarifa ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->id_motivomanual ?>
              </td>
              <!-- <td id="celdaSinUso" onclick="copiarContenido('celdaSinUso')">
                <?= $datos->sin_uso ?>
              </td> -->
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->lectura_manual ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->kwh_recuperar ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->respaldo_man ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->rpe_auxiliar ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->observaciones ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->correccion ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->agencia ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->responsable_manual ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->fecha_captura ?>
              </td>

              <td>
                <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_control_manuales ?> " class="btn btn-success ">CORREGIR MANUAL <i class="fa-brands fa-stack-overflow"></i></a>
                <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>">HISTÓRICO <i class="fa-solid fa-file-shield"></i></a>
                <a class="btn btn-danger" href="manuales.php?id_manual_eliminar=<?= $datos->id_control_manuales ?>" onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a>
              </td>






            </tr>








          <?php

            //-- MODAL PARA CORRECCION Y CAMBIO DE ESTATUS-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->




            include "modales/modal_modificacion_manuales.php";





            //-- Modal-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

          }

          ?>
        <?php

      } else { ?>


          <form style="margin-bottom: 5%;" action="" method="post" id="searchForm">

            <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
              <input type="text" class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpu">
            </div>
            <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
          </form>


          <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>

          <table class="table table-bordered table-hover w-100 " id="example">
            <thead>
              <tr>

                <th scope="col">RPU</th>
                <th scope="col"><i class="fa-solid fa-list-check"></i></th>
                <th scope="col">CUENTA</th>
                <th scope="col">CICLO</th>
                <th scope="col">TARIFA</th>
                <th scope="col">MOTIVO MANUAL</th>
                <!-- <th scope="col">SIN USO</th> -->
                <th scope="col">LECTURA MANUAL</th>
                <th scope="col">KWH A RECUPERAR</th>
                <th scope="col">RESPALDO</th>
                <th scope="col">RPE_AUXILIAR</th>
                <th scope="col">OBSERVACIONES</th>
                <th scope="col">CORRECCION</th>
                <th scope="col">AGENCIA</th>
                <th scope="col">RESPONSABLE_MANUAL</th>
                <th scope="col">FECHA</th>
                <th scope="col">ACCION</th>

              </tr>
            </thead>

            <tbody>

              <?php
              while ($datos = $sql_mes->fetch_object()) { ?>



                <?php
                if ($datos->id_estatus == '1') { ?>
                  <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                    <?= $datos->rpu ?>
                  </td>



                  <td style=" text-decoration: none;" class="td-celda-icono-estatus">
                    <a href="#">
                      ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                    </a>
                  </td>

                <?php } else if (($datos->id_estatus == '2')) { ?>

                  <td style="color:whitesmoke; font-weight: bold; background-color: rgba(255, 141, 20, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                    <?= $datos->rpu ?>
                  </td>


                  <td style="text-decoration: none;" class="td-celda-icono-estatus">

                    <a href="#">
                      PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                  </td>


                <?php } else { ?>


                  <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                    <?= $datos->rpu ?>
                  </td>


                  <td class="td-celda-icono-estatus">

                    <a href="#">
                      RECHAZADO <i class="fa-solid fa-circle-xmark" style="color: #ff2424;"></i> </a>

                  </td>


                <?php } ?>


                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->cuenta ?>
                </td>
                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->ciclo ?>
                </td>
                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->tarifa ?>
                </td>
                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->id_motivomanual ?>
                </td>

                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->lectura_manual ?>
                </td>
                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->kwh_recuperar ?>
                </td>
                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->respaldo_man ?>
                </td>
                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->rpe_auxiliar ?>
                </td>
                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->observaciones ?>
                </td>
                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->correccion ?>
                </td>
                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->agencia ?>
                </td>
                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->responsable_manual ?>
                </td>
                <td class="celda" onclick="copiarContenido(this)">
                  <?= $datos->fecha_captura ?>
                </td>

                <td class="celda" onclick="copiarContenido(this)">
                  <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>">HISTÓRICO <i class="fa-solid fa-file-shield"></i></a>
                </td>




                </tr>
              <?php } ?>




            <?php }

            ?>

          <?php }
          ?>


























          <!-- CONDICION PARA OCULTAR O MOSTRAR LA TABLA SEGUN LOS VALORES QUE INGRESE EL USUARIO -->

          <?php if ($mostrarTablas) { ?>






            <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->
            <?php
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
            ?>


              <table class="table table-bordered table-hover w-100 " id="example">
                <thead>
                  <tr>

                    <th scope="col"></th>
                    <th scope="col">RPU</th>
                    <th scope="col"><i class="fa-solid fa-list-check"></i></th>
                    <th scope="col">CUENTA</th>
                    <th scope="col">CICLO</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MOTIVO MANUAL</th>
                    <!-- <th scope="col">SIN USO</th> -->
                    <th scope="col">LECTURA MANUAL</th>
                    <th scope="col">KWH A RECUPERAR</th>
                    <th scope="col">RESPALDO</th>
                    <th scope="col">RPE_AUXILIAR</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">CORRECCION</th>
                    <th scope="col">CUENTA2</th>
                    <th scope="col">RESPONSABLE_MANUAL</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">ACCION</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  while ($datos = $sql->fetch_object()) { ?>

                    <tr>



                      <td></td>
                      <?php
                      if ($datos->id_estatus == '1') { ?>
                        <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                          <?= $datos->rpu ?>
                        </td>



                        <td style="background-color: rgba(110, 149, 52, 0.7); text-decoration: none;" class="td-celda-icono-estatus">
                          <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_manuales ?> ">
                            ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                          </a>
                        </td>

                      <?php } else if (($datos->id_estatus == '2')) { ?>

                        <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                          <?= $datos->rpu ?>
                        </td>


                        <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;" class="td-celda-icono-estatus">

                          <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_manuales ?> ">
                            PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                        </td>


                      <?php } else { ?>


                        <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                          <?= $datos->rpu ?>
                        </td>


                        <td style="background-color: rgba(255, 53, 53, 0.7);" class="td-celda-icono-estatus">

                          <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_manuales ?> ">
                            RECHAZADO <i class="fa-solid fa-circle-xmark" style="color: #ff2424;"></i> </a>

                        </td>


                      <?php } ?>



                      <!-- <td class="id" scope="row"> -->

                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->cuenta ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->ciclo ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->tarifa ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->id_motivomanual ?>
                      </td>
                      <!-- <td id="celdaSinUso" onclick="copiarContenido('celdaSinUso')">
                <?= $datos->sin_uso ?>
              </td> -->
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->lectura_manual ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->kwh_recuperar ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->respaldo_man ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->rpe_auxiliar ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->observaciones ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->correccion ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->agencia ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->responsable_manual ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->fecha_captura ?>
                      </td>

                      <td>
                        <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_control_manuales ?> " class="btn btn-success ">CORREGIR MANUAL <i class="fa-brands fa-stack-overflow"></i></a>
                        <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>">HISTÓRICO <i class="fa-solid fa-file-shield"></i></a>
                        <a class="btn btn-danger" href="manuales.php?id_manual_eliminar=<?= $datos->id_control_manuales ?>" onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a>
                      </td>






                    </tr>




                    <!-- Modal----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                    <div class="modal fade" id="exampleModal<?= $datos->id_control_manuales  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header d-flex justify-content-between">
                            <h5 class="modal-title w-100" id="exampleModalLabel">CORREGIR MANUAL</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!--Aqui haremos la modificacion de usuario-->
                            <form action="" method="post">
                              <div hidden class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="ID" class="input input__text inputmodal input_modificado" name="txtid" value="<?= $datos->id_control_manuales ?>" readonly>
                              </div>
                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="RPU" class="input input__text inputmodal_ineditable input_modificado" name="txtrpu" value="<?= $datos->rpu ?>" readonly>
                              </div>
                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="CUENTA ACTUAL: <span class='placeholder_otrocolor'> <?= trim($datos->cuenta) ?> </span> " class="input input__text inputmodal input_modificado" name="txtcuenta" list="cuentaList" autocomplete="off" value="<?= trim($datos->cuenta) ?>">
                                <datalist id="cuentaList"></datalist>
                              </div>
                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="CICLO ACTUAL: <?= trim($datos->ciclo) ?>" class="input input__text inputmodal input_modificado" name="txtciclo" value="<?= trim($datos->ciclo) ?>">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="TARIFA ACTUAL: <?= trim($datos->tarifa) ?>" class="input input__text inputmodal input_modificado" name="txttarifa" value="<?= trim($datos->tarifa) ?>">
                              </div>


                              <div class="fl-flex-label mb-4 px-2 col-12 campo">


                                <input class="input input__text inputmodal input_modificado" name="txtidmotivomanual" type="text" placeholder="MOTIVO DE MANUAL ACTUAL: <?= $datos->id_motivomanual ?>" value="<?= trim($datos->id_motivomanual) ?>" list="motivosList" autocomplete="off">
                                <datalist id="motivosList"></datalist>



                                <!-- <select  name="txtidmotivomanual" class="input input__select inputmodal" >
                      
                                <option value="">  <?= $datos->id_motivomanual ?> </option>
                                <?php
                                $sql_mostrar_motivo_manuales = $conexion->query(" SELECT DISTINCT TRIM(id_motivomanual) AS id_motivomanual
                                FROM control_manuales ");
                                while ($datoss = $sql_mostrar_motivo_manuales->fetch_object()) { ?>
                                  <option value="<?= $datoss->id_motivomanual ?>"><?= $datoss->id_motivomanual ?></option>
                                <?php }
                                ?>
                        </select>-->
                              </div>


                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="SIN_USO: <?= trim($datos->sin_uso) ?>" class="input input__text inputmodal input_modificado" name="txtsin_uso" value="<?= trim($datos->sin_uso) ?>">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="lECTURA MANUAL ACTUAL: <?= trim($datos->lectura_manual) ?>" class="input input__text inputmodal input_modificado" name="txtlectura_manual" value="<?= trim($datos->lectura_manual) ?>">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="KWH A RECUPERAR ACTUAL: <?= trim($datos->kwh_recuperar) ?>" class="input input__text inputmodal input_modificado" name="txtkwh_recuperar" value="<?= trim($datos->kwh_recuperar) ?>">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="RESPALDO-MANUAL ACTUAL: <?= trim($datos->respaldo_man) ?>" class="input input__text inputmodal input_modificado" name="txtrespaldo_manual" list="respaldomanualList" autocomplete="off" value="<?= trim($datos->respaldo_man) ?>">
                                <datalist id="respaldomanualList"></datalist>
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="RPE-AUXILIAR ACTUAL: <?= trim($datos->rpe_auxiliar) ?>" class="input input__text inputmodal input_modificado" name="txtrpe_auxiliar" list="rpeauxiliarList" autocomplete="off" value="<?= trim($datos->rpe_auxiliar) ?>">
                                <datalist id="rpeauxiliarList"></datalist>
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="OBSERVACIÓN ACTUAL: <?= trim($datos->observaciones) ?>" class="input input__text inputmodal input_modificado" name="txtobservaciones" value="<?= trim($datos->observaciones) ?>">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="CORRECCIÓN ACTUAL: <?= trim($datos->correccion) ?>" class="input input__text inputmodal input_modificado" name="txtcorreccion" value="<?= trim($datos->correccion) ?>">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="AGENCIA ACTUAL: <?= trim($datos->agencia) ?>" class="input input__text inputmodal input_modificado" name="txtagencia" list="agenciaList" autocomplete="off" value="<?= trim($datos->agencia) ?>">
                                <datalist id="agenciaList"></datalist>
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="RESPONSABLE-MANUAL ACTUAL: <?= trim($datos->responsable_manual) ?> " class="input input__text inputmodal input_modificado" name="txtresponsable_manual" list="responsablemanualList" autocomplete="off" value="<?= trim($datos->responsable_manual) ?>">
                                <datalist id="responsablemanualList"></datalist>
                              </div>



                              <div class="fl-flex-label mb-4 px-2 col-12 campo">

                                <select name="txtmotivo" class="input input__select inputmodal input_modificado">

                                  <option value=""> SELECCIONA EL MOTIVO </option>
                                  <?php
                                  $sql_mostrar_motivo_historial_manuales = $conexion->query(" SELECT *
                                FROM motivo_historial ");
                                  while ($datos5 = $sql_mostrar_motivo_historial_manuales->fetch_object()) { ?>
                                    <option value="<?= $datos5->id_motivohistorial ?>"><?= $datos5->nombre_motivo ?></option>
                                  <?php }
                                  ?>

                                </select>

                              </div>




                              <div class="text-right p-3">
                                <a style="margin-top: 5%;" href="manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Actualizar <i class="fa-solid fa-arrows-rotate"></i></button>
                              </div>

                            </form>


                          </div>
                        </div>
                      </div>
                    </div>







                    <!-- MODAL PARA PONER LOS ESTATUS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->



                    <div class="modal fade" id="exampleModal_estatus<?= $datos->id_control_manuales  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header d-flex justify-content-between">
                            <h5 class="modal-title w-100" id="exampleModalLabel">SELECCIONAR ESTATUS <img src="data:image/png;base64,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"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!--Aqui haremos la modificacion de usuario-->
                            <form action="" method="post">

                              <div hidden class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="ID" class="input input__text inputmodal input_modificado" name="txtid_2" value="<?= $datos->id_control_manuales ?>" readonly>
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-md-6  campo">
                                <input type="text" placeholder="RPU" class="input input__text inputmodal input_modificado inputmodal_ineditable" name="txtrpu_2" value="<?= $datos->rpu ?>" readonly>
                              </div>


                              <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                                <select name="txtestatus_2" class="input input__select inputmodal">

                                  <option value=""> ESTATUS </option>
                                  <?php
                                  $sql_mostrar_motivo_status = $conexion->query(" SELECT * FROM estatus ");
                                  while ($datosestatus = $sql_mostrar_motivo_status->fetch_object()) { ?>
                                    <option value="<?= $datosestatus->id_estatus ?>"><?= $datosestatus->nombre_estatus ?></option>
                                  <?php }
                                  ?>

                                </select>

                              </div>



                              <div class="text-center p-3">
                                <a style="margin-top: 5%;" href="manuales.php" class="btn btn-danger btn-rounded">Cancelar <i class="fa-brands fa-xbox"></i></a>
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btnmodificar_estatus" class="btn btn-primary btn-rounded">Asignar <i class="fa-brands fa-playstation"></i></button>
                              </div>

                            </form>


                          </div>
                        </div>
                      </div>
                    </div>



                  <?php

                  }

                  ?>
                <?php

              } else {
                ?>

                  <table class="table table-bordered table-hover w-100 " id="example">
                    <thead>
                      <tr>

                        <th scope="col">RPU</th>
                        <th scope="col"><i class="fa-solid fa-list-check"></i></th>
                        <th scope="col">CUENTA</th>
                        <th scope="col">CICLO</th>
                        <th scope="col">TARIFA</th>
                        <th scope="col">MOTIVO MANUAL</th>
                        <!-- <th scope="col">SIN USO</th> -->
                        <th scope="col">LECTURA MANUAL</th>
                        <th scope="col">KWH A RECUPERAR</th>
                        <th scope="col">RESPALDO</th>
                        <th scope="col">RPE_AUXILIAR</th>
                        <th scope="col">OBSERVACIONES</th>
                        <th scope="col">CORRECCION</th>
                        <th scope="col">AGENCIA</th>
                        <th scope="col">RESPONSABLE_MANUAL</th>
                        <th scope="col">FECHA</th>
                        <th scope="col">ACCION</th>

                      </tr>
                    </thead>

                    <tbody>

                      <?php
                      while ($datos = $sql->fetch_object()) { ?>


                        <tr>


                          <?php
                          if ($datos->id_estatus == '1') { ?>
                            <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                              <?= $datos->rpu ?>
                            </td>



                            <td style="background-color: rgba(110, 149, 52, 0.7); text-decoration: none;" class="td-celda-icono-estatus">
                              <a href="#">
                                ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                              </a>
                            </td>

                          <?php } else if (($datos->id_estatus == '2')) { ?>

                            <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                              <?= $datos->rpu ?>
                            </td>


                            <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;" class="td-celda-icono-estatus">

                              <a href="#">
                                PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                            </td>


                          <?php } else { ?>


                            <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                              <?= $datos->rpu ?>
                            </td>


                            <td style="background-color: rgba(255, 53, 53, 0.7);" class="td-celda-icono-estatus">

                              <a href="#">
                                RECHAZADO <i class="fa-solid fa-circle-xmark" style="color: #ff2424;"></i> </a>

                            </td>


                          <?php } ?>



                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->cuenta ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->ciclo ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->tarifa ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->id_motivomanual ?>
                          </td>
                          <!-- <td>
                <?= $datos->sin_uso ?>
              </td> -->
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->lectura_manual ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->kwh_recuperar ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->respaldo_man ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->rpe_auxiliar ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->observaciones ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->correccion ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->agencia ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->responsable_manual ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->fecha_captura ?>
                          </td>


                          <td>
                            <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>"><i class="fa-solid fa-eye"></i></a>
                          </td>

                        </tr>
                      <?php } ?>




                    <?php }

                    ?>



                  <?php

                }
                  ?>




                    </tbody>
                  </table>

</div>
</div>
<!-- fin del contenido principal -->













<!-- SCRIPT PARA COPIAR CELADAS DE LA TABLA -->
<!-- <script>
  function copiarContenido(elemento) {
    // Obtener el contenido de la celda
    const contenido = elemento.innerText;

    // Crear un elemento de texto temporal
    const elementoTemporal = document.createElement('textarea');
    elementoTemporal.value = contenido;

    // Añadir el elemento al DOM
    document.body.appendChild(elementoTemporal);

    // Seleccionar el contenido del elemento temporal
    elementoTemporal.select();

    // Copiar al portapapeles
    document.execCommand('copy');

    // Eliminar el elemento temporal después de 1 segundo
    setTimeout(() => {
      document.body.removeChild(elementoTemporal);
    }, 1000);

    // Mostrar un mensaje temporal en la posición del puntero
    const mensajeCopiado = document.createElement('div');
    mensajeCopiado.innerHTML = 'Copiado';
    mensajeCopiado.style.position = 'fixed';
    mensajeCopiado.style.top = `${event.clientY}px`;
    mensajeCopiado.style.left = `${event.clientX}px`;
    mensajeCopiado.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    mensajeCopiado.style.color = '#fff';
    mensajeCopiado.style.padding = '5px';
    mensajeCopiado.style.borderRadius = '5px';

    document.body.appendChild(mensajeCopiado);

    // Eliminar el mensaje después de 1 segundo
    setTimeout(() => {
      document.body.removeChild(mensajeCopiado);
    }, 1000);
  }
</script> -->


<!-- SCRIPT PARA COPIAR CONTENIDO DEL SPAN DENTRO DEL LI -->
<script>
  function copiarContenidoSpan(spanElement) {
    // Obtener el contenido del span
    const contenido = spanElement.innerText;

    // Crear un elemento de texto temporal
    const elementoTemporal = document.createElement('textarea');
    elementoTemporal.value = contenido;

    // Añadir el elemento al DOM
    document.body.appendChild(elementoTemporal);

    // Seleccionar el contenido del elemento temporal
    elementoTemporal.select();

    // Copiar al portapapeles
    document.execCommand('copy');

    // Eliminar el elemento temporal después de 1 segundo
    setTimeout(() => {
      document.body.removeChild(elementoTemporal);
    }, 1000);

    // Mostrar un mensaje temporal en la posición del puntero
    const mensajeCopiado = document.createElement('div');
    mensajeCopiado.innerHTML = 'Copiado';
    mensajeCopiado.style.position = 'fixed';
    mensajeCopiado.style.top = `${event.clientY}px`;
    mensajeCopiado.style.left = `${event.clientX}px`;
    mensajeCopiado.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    mensajeCopiado.style.color = '#fff';
    mensajeCopiado.style.padding = '5px';
    mensajeCopiado.style.borderRadius = '5px';

    document.body.appendChild(mensajeCopiado);

    // Eliminar el mensaje después de 1 segundo
    setTimeout(() => {
      document.body.removeChild(mensajeCopiado);
    }, 1000);
  }
</script>





<script>
  function buscar() {
    var input = document.getElementById("searchInput").value;

    if (input.trim() === "") {
      // Mostrar mensaje de error si el campo está vacío
      document.getElementById("errorMessage").style.display = "block";
    } else {
      // Ocultar el mensaje de error si el campo no está vacío
      document.getElementById("errorMessage").style.display = "none";

      // Realizar la búsqueda o la acción que desees aquí
      // Puedes agregar tu lógica de búsqueda o redireccionar a otra página.
      // Ejemplo: document.getElementById("searchForm").submit();
    }
  }
</script>



<!-- FUNCION PARA HACER BUSQUEDAS A TRAVES DE SOLICITUDES AJAX EN INPUTS DATALIST, SECCION DE MODALES-->

<!-- <script>
  // $(document).ready(function() {
  //   $.getJSON("funciones_ajax/busquedas_manuales.php", function(data) {
  //     // Manejar datos de id_motivomanual
  //     $.each(data.motivo, function(key, val) {
  //       console.log(val);
  //       $('#motivosList').append("<option value='" + val + "' />");
  //     });

  //     // Manejar datos de cuenta
  //     $.each(data.cuenta, function(key, val) {
  //       console.log(val);
  //       $('#cuentaList').append("<option value='" + val + "' />");
  //     });

  //     // Manejar datos de cuenta
  //     $.each(data.respaldo, function(key, val) {
  //       console.log(val);
  //       $('#respaldomanualList').append("<option value='" + val + "' />");
  //     });

  //     // Manejar datos de rpe auxiliar
  //     $.each(data.rpeauxiliar, function(key, val) {
  //       console.log(val);
  //       $('#rpeauxiliarList').append("<option value='" + val + "' />");
  //     });

  //     // Manejar datos de responsable de la manual
  //     $.each(data.responsablemanual, function(key, val) {
  //       console.log(val);
  //       $('#responsablemanualList').append("<option value='" + val + "' />");
  //     });


  //     // Manejar datos de responsable de la agencia
  //     $.each(data.agencia, function(key, val) {
  //       console.log(val);
  //       $('#agenciaList').append("<option value='" + val + "' />");
  //     });


  //   });
  // });
  $(document).ready(function() {
    $.getJSON("funciones_ajax/busquedas_manuales.php", function(data) {
      var existingOptions = {};

      // Manejar datos de id_motivomanual
      $('#motivosList').find('option').each(function() {
        existingOptions[$(this).val()] = true;
      });
      $.each(data.motivo, function(key, val) {
        if (!existingOptions[val]) {
          $('#motivosList').append("<option value='" + val + "' />");
          existingOptions[val] = true;
        }
      });

      // Manejar datos de cuenta
      $('#cuentaList').find('option').each(function() {
        existingOptions[$(this).val()] = true;
      });
      $.each(data.cuenta, function(key, val) {
        if (!existingOptions[val]) {
          $('#cuentaList').append("<option value='" + val + "' />");
          existingOptions[val] = true;
        }
      });

      // Manejar datos de respaldo
      $('#respaldomanualList').find('option').each(function() {
        existingOptions[$(this).val()] = true;
      });
      $.each(data.respaldo, function(key, val) {
        if (!existingOptions[val]) {
          $('#respaldomanualList').append("<option value='" + val + "' />");
          existingOptions[val] = true;
        }
      });

      // Manejar datos de RPE auxiliar
      $('#rpeauxiliarList').find('option').each(function() {
        existingOptions[$(this).val()] = true;
      });
      $.each(data.rpeauxiliar, function(key, val) {
        if (!existingOptions[val]) {
          $('#rpeauxiliarList').append("<option value='" + val + "' />");
          existingOptions[val] = true;
        }
      });

      // Manejar datos de responsable de la manual
      $('#responsablemanualList').find('option').each(function() {
        existingOptions[$(this).val()] = true;
      });
      $.each(data.responsablemanual, function(key, val) {
        if (!existingOptions[val]) {
          $('#responsablemanualList').append("<option value='" + val + "' />");
          existingOptions[val] = true;
        }
      });

      // Manejar datos de responsable de la agencia
      $('#agenciaList').find('option').each(function() {
        existingOptions[$(this).val()] = true;
      });
      $.each(data.agencia, function(key, val) {
        if (!existingOptions[val]) {
          $('#agenciaList').append("<option value='" + val + "' />");
          existingOptions[val] = true;
        }
      });

    });
  });
</script> -->


<!-- //EVITAR ESPACIOS ANTES DE ESCRIBIR TEXTO EN LOS INPUTS -->
<!-- 
<script>
  function evitarEspacios(event) {
    // Obtener el valor actual del input
    var valorInput = event.target.value;

    // Verificar si la tecla presionada es un espacio y no hay texto en el input
    if (event.key === ' ' && valorInput.trim() === '') {
      // Evitar la acción por defecto (en este caso, la inserción del espacio)
      event.preventDefault();
    }
  }

  // Obtener todos los elementos con la clase 'miInput' y asignar el evento a cada uno
  var inputs = document.querySelectorAll('.input');
  inputs.forEach(function(input) {
    input.addEventListener('keydown', evitarEspacios);
  });
</script> -->






<!-- CALCULAR FECHA CADA 6 MESES-------------------------------- -->

<script>
  function calcularMeses() {
    var inputFecha = document.getElementById('fecha_semestral');
    var fechaSeleccionada = new Date(inputFecha.value);

    // Obtener el mes y año seleccionado por el usuario
    var mesSeleccionado = fechaSeleccionada.getMonth();
    var annoSeleccionado = fechaSeleccionada.getFullYear();

    // Calcular el mes después de 6 meses
    var nuevoMes = (mesSeleccionado + 6) % 12; // Utiliza el operador de módulo para manejar el cambio de año
    var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 6) / 12);

    // Formatear el resultado
    var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

    // Asignar el valor al input oculto
    document.getElementById('sextomes').value = resultado;

    // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
    console.log("Fecha después de 6 meses: " + resultado);
  }
</script>


<!-- CALCULAR FECHA POR AÑO--------------------------------  -->

<script>
  function calcularAnio() {
    var inputFecha = document.getElementById('fecha_anual');
    var fechaSeleccionada = new Date(inputFecha.value);

    // Obtener el mes y año seleccionado por el usuario
    var mesSeleccionado = fechaSeleccionada.getMonth();
    var annoSeleccionado = fechaSeleccionada.getFullYear();

    // Calcular el mes después de 6 meses
    var nuevoMes = (mesSeleccionado + 13) % 12; // Utiliza el operador de módulo para manejar el cambio de año
    var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 13) / 12);

    // Formatear el resultado
    var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

    // Asignar el valor al input oculto
    document.getElementById('mesdoce').value = resultado;

    // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
    console.log("Fecha después de 12 meses: " + resultado);
  }
</script>






<!-- CALCULAR FECHA CADA 6 MESES-------------------------------- -->

<script>
  function calcularMesesAtendidas() {
    var inputFecha = document.getElementById('fecha_semestral_atendidas');
    var fechaSeleccionada = new Date(inputFecha.value);

    // Obtener el mes y año seleccionado por el usuario
    var mesSeleccionado = fechaSeleccionada.getMonth();
    var annoSeleccionado = fechaSeleccionada.getFullYear();

    // Calcular el mes después de 6 meses
    var nuevoMes = (mesSeleccionado + 6) % 12; // Utiliza el operador de módulo para manejar el cambio de año
    var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 6) / 12);

    // Formatear el resultado
    var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

    // Asignar el valor al input oculto
    document.getElementById('sextomes_atendidas').value = resultado;

    // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
    console.log("Fecha después de 6 meses: " + resultado);
  }
</script>


<!-- CALCULAR FECHA POR AÑO--------------------------------  -->

<script>
  function calcularAnioAtendidas() {
    var inputFecha = document.getElementById('fecha_anual_atendidas');
    var fechaSeleccionada = new Date(inputFecha.value);

    // Obtener el mes y año seleccionado por el usuario
    var mesSeleccionado = fechaSeleccionada.getMonth();
    var annoSeleccionado = fechaSeleccionada.getFullYear();

    // Calcular el mes después de 6 meses
    var nuevoMes = (mesSeleccionado + 13) % 12; // Utiliza el operador de módulo para manejar el cambio de año
    var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 13) / 12);

    // Formatear el resultado
    var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

    // Asignar el valor al input oculto
    document.getElementById('mesdoce_atendidas').value = resultado;

    // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
    console.log("Fecha después de 12 meses: " + resultado);
  }
</script>


<!-- CALCULAR FECHA CADA 6 MESES-------------------------------- -->

<script>
  function calcularMesesDesatendidas() {
    var inputFecha = document.getElementById('fecha_semestral_desatendidas');
    var fechaSeleccionada = new Date(inputFecha.value);

    // Obtener el mes y año seleccionado por el usuario
    var mesSeleccionado = fechaSeleccionada.getMonth();
    var annoSeleccionado = fechaSeleccionada.getFullYear();

    // Calcular el mes después de 6 meses
    var nuevoMes = (mesSeleccionado + 6) % 12; // Utiliza el operador de módulo para manejar el cambio de año
    var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 6) / 12);

    // Formatear el resultado
    var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

    // Asignar el valor al input oculto
    document.getElementById('sextomes_desatendidas').value = resultado;

    // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
    console.log("Fecha después de 6 meses: " + resultado);
  }
</script>


<!-- CALCULAR FECHA POR AÑO--------------------------------  -->

<script>
  function calcularAnioDesatendidas() {
    var inputFecha = document.getElementById('fecha_anual_desatendidas');
    var fechaSeleccionada = new Date(inputFecha.value);

    // Obtener el mes y año seleccionado por el usuario
    var mesSeleccionado = fechaSeleccionada.getMonth();
    var annoSeleccionado = fechaSeleccionada.getFullYear();

    // Calcular el mes después de 6 meses
    var nuevoMes = (mesSeleccionado + 13) % 12; // Utiliza el operador de módulo para manejar el cambio de año
    var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 13) / 12);

    // Formatear el resultado
    var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

    // Asignar el valor al input oculto
    document.getElementById('mesdoce_desatendidas').value = resultado;

    // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
    console.log("Fecha después de 12 meses: " + resultado);
  }
</script>



<!-- SCRIPTS PARA LOS CHECKBOX-------------------------------------------------------- -->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Obtener todos los checkboxes
    var checkboxes = document.querySelectorAll('input[name="opciones"]');

    // Agregar un evento de cambio a cada checkbox
    checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        // Ocultar todos los bloques de código y limpiar el contenido
        document.querySelectorAll('.opciones-container').forEach(function(container) {
          container.style.display = 'none';
          container.querySelectorAll('input').forEach(function(input) {
            input.value = ''; // Limpiar el contenido de los inputs
          });
        });

        // Mostrar el bloque de código correspondiente al checkbox seleccionado
        var option = this.value;
        var containerToShow = document.querySelector('.' + option);

        // Mostrar el bloque de código solo si el checkbox está seleccionado
        if (this.checked && containerToShow) {
          containerToShow.style.display = 'block';
        }
      });
    });
  });
</script>











<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>