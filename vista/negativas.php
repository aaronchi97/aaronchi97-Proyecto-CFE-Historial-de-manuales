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

      <a href="registro_negativas.php" class="btn-generar-manual">GENERAR NUEVA NEGATIVA</a>

    <?php } else { ?>

      <a hidden href="registro_negativas.php" class="btn-generar-manual">GENERAR NUEVA NEGATIVA</a>

    <?php }  ?>


    <a class="btn-manual-validas">VER VALIDADAS</a>

    <a class="btn-manual-pendiente">VER PENDIENTES</a>

  </section>


  <?php












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

            <th scope="col"></th>

            <th scope="col">RPU</th>
            <th scope="col">ESTATUS</th>
            <th scope="col">CUENTA</th>
            <th scope="col">CICLO</th>
            <th scope="col">TARIFA</th>
            <th scope="col">MEDIDOR</th>
            <!-- <th scope="col">SIN USO</th> -->
            <th scope="col">AA_MM</th>
            <th scope="col">TIPO MEDIDOR</th>
            <th scope="col">CVE</th>
            <th scope="col">DICE</th>
            <th scope="col">DEBE DECIR</th>
            <th scope="col">KWH_A_RECUPERAR</th>
            <th scope="col">JUSTIFICACION_NEGATIVA</th>
            <th scope="col">OBSERVACIONES</th>
            <th scope="col">RESPONSABLE</th>
            <th scope="col">FECHA</th>
            <th scope="col">ACCION</th>

          </tr>
        </thead>

        <tbody>
          <?php
          while ($datos = $sql_mes_negativa->fetch_object()) { ?>

            <tr>

              <td></td>

              <?php
              if ($datos->id_estatus == '1') { ?>
                <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                  <?= $datos->rpu ?>
                </td>



                <td style="background-color: rgba(110, 149, 52, 0.7); text-decoration: none;" class="td-celda-icono-estatus">
                  <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                    ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                  </a>
                </td>

              <?php } else if (($datos->id_estatus == '2')) { ?>

                <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                  <?= $datos->rpu ?>
                </td>


                <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;" class="td-celda-icono-estatus">

                  <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                    PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                </td>


              <?php } else { ?>


                <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                  <?= $datos->rpu ?>
                </td>


                <td style="background-color: rgba(255, 53, 53, 0.7);" class="td-celda-icono-estatus">

                  <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
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
                <?= $datos->medidor ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->aa_mm ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->tipo_medidor ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->cve ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->dice ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->debe_decir ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->kwh_recuperar ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->id_justificacionnegativas ?>
              </td>

              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->observaciones ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->responsable_negativa ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->fecha_captura ?>
              </td>
              <td>
                <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_control_negativas ?> " class="btn btn-success ">CORREGIR NEGATIVA <i class="fa-brands fa-stack-overflow"></i></a>

                <a class="btn btn-warning" href="historial_negativas.php?id_negativas=<?= $datos->id_control_negativas ?>">HISTÓRICO <i class="fa-solid fa-eye"></i></a>

                <a class="btn btn-danger" href="negativas.php?id_negativa_eliminar=<?= $datos->id_control_negativas ?>" onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a>
              </td>

            </tr>




            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?= $datos->id_control_negativas  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title w-100" id="exampleModalLabel">GENERAR NEGATIVA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Aqui haremos la modificacion de usuario-->
                    <form action="" method="post">
                      <div hidden class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="ID" class="input input__text inputmodal" name="txtid" value=" <?= $datos->id_control_negativas ?>" readonly>
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="RPU ACTUAL: <?= $datos->rpu ?>" class="input input__text inputmodal_ineditable" name="txtrpu" value=" <?= $datos->rpu ?>" readonly>
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="CUENTA ACTUAL: <?= $datos->cuenta ?>" class="input input__text inputmodal" name="txtcuenta" value=" <?= $datos->cuenta ?>" autocomplete="off">
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="CICLO ACTUAL: <?= $datos->ciclo ?>" class="input input__text inputmodal" name="txtciclo" value=" <?= $datos->ciclo ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                      </div>

                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="TARIFA ACTUAL: <?= $datos->tarifa ?>" class="input input__text inputmodal" name="txttarifa" value=" <?= $datos->tarifa ?>" autocomplete="off">
                      </div>

                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="MEDIDOR ACTUAL: <?= $datos->medidor ?>" class="input input__text inputmodal" name="txtmedidor" value=" <?= $datos->medidor ?>" autocomplete="off">
                      </div>

                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="AA_MM ACTUAL: <?= $datos->aa_mm ?>" class="input input__text inputmodal" name="txtaa_mm" value=" <?= $datos->aa_mm ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                      </div>

                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="TIPO-MEDIDOR ACTUAL: <?= $datos->tipo_medidor ?>" class="input input__text inputmodal" name="txttipo_medidor" value=" <?= $datos->tipo_medidor ?>" autocomplete="off">
                      </div>

                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="CVE ACTUAL: <?= $datos->cve ?>" class="input input__text inputmodal" name="txtcve" value=" <?= $datos->cve ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                      </div>

                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="DICE:  <?= $datos->dice ?>" class="input input__text inputmodal" name="txtdice" value=" <?= $datos->dice ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                      </div>

                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="DEBE DECIR: <?= $datos->debe_decir ?>" class="input input__text inputmodal" name="txtdebe_decir" value=" <?= $datos->debe_decir ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                      </div>

                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="KWH A RECUPERAR: <?= $datos->kwh_recuperar ?>" class="input input__text inputmodal" name="txtkwh_recuperar" value=" <?= $datos->kwh_recuperar ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                      </div>





                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="JUSTIFICACION ACTUAL:  <?= $datos->id_justificacionnegativas ?> " class="input input__text inputmodal" name="txtid_justificacionnegativa" value=" <?= $datos->id_justificacionnegativas ?>" autocomplete="off">
                      </div>




                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="OBSERVACIÓN ACTUAL:  <?= $datos->observaciones ?> " class="input input__text inputmodal" name="txtobservaciones" value=" <?= $datos->observaciones ?>" autocomplete="off">
                      </div>

                      <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="RESPONSABLE DE CAPTURA: <?= $datos->responsable_negativa ?> " class="input input__text inputmodal" name="txtresponsable_negativa" value=" <?= $datos->responsable_negativa ?>" autocomplete="off">
                      </div>


                      <div class="fl-flex-label mb-4 px-2 col-12 campo">

                        <select name="txtmotivo" class="input input__select inputmodal input_modificado">

                          <option value=""> SELECCIONA EL MOTIVO </option>
                          <?php
                          $sql_mostrar_motivo_historial_negativas = $conexion->query(" SELECT *FROM motivo_historial ");
                          while ($datos6 = $sql_mostrar_motivo_historial_negativas->fetch_object()) { ?>
                            <option value="<?= $datos6->id_motivohistorial ?>"><?= $datos6->nombre_motivo ?></option>
                          <?php }
                          ?>

                        </select>

                      </div>








                      <div class="text-right p-3">
                        <a href="negativas.php" class="btn btn-secondary btn-rounded">Atras</a>
                        <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Actualizar</button>
                      </div>

                    </form>


                  </div>
                </div>
              </div>
            </div>




            <!-- MODAL PARA PONER LOS ESTATUS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->



            <div class="modal fade" id="exampleModal_estatus<?= $datos->id_control_negativas  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title w-100" id="exampleModalLabel"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAAcTUlEQVR4nO19eVST574u5873j3vWXev8cdY5d93dvXd3924ZMzIFCFMgc0ICCRlJCPMgDkUFBUGpA6KIA4qiSB3qiFass8WJRLdax9pqta2VxCnBqbV12s9Z7xvl1AknEG3zrPVbJF++L/m+3/P+pnfCz88HH3zwwQcffPDBBx988MEHH3zwwQcffPDBBx/eKKwA/uu+yy6O3eMc7nA72+0e5wmH29XtcDvv2t2uW+S13eP80uFxrXF4nNWOy+djN+DU/xzo+34jkfy3v/1RFc5dJGczu4WB/vcUHKZHFc6dHx8Y+K/PutZx6dx7drdzFlW+x4UXErfrit3tarJfcrJez5O+BUgODkhWcJg3Pp5Rd6fru+O49ctlkL+t0yfflrMZN5ID34940nWO7nPBpLXb3c57L0zEE8lxbtxzpYvh93uGIPivfyJkfPnFHty7e+UxOXpgJxRc9tVEf/8/PLjmAPDfHW5XBXVDfUHEw6TccXhc9R3fffe//H6PIG6KWMaTyLh3X+ZPnXBbyeU0J3/wQbSWH3VUxmL8Q85hotCkR2v76r4l5L7Y3a7DxBX6/d6g4DC7iXvqjZDvvzkMYaD/HUM8/+auTW24cbULP15zYs+WtbCIkzF+Uk2/kOJwuzydnq5Iv98qhAEB76rCQ9ulTMYNCSP4J1UEd0NygP+9n3+60Cshd267UVc27F735W8f++yq5yx0cTH9ZikOj/OG3X0+1O+3SIaczepeNm/GHffFM7joPInWGZPvCgMD/tH1fe8Wcu8ZsnPDahSZ9f1ECHVfl39z7ksVxmlbMrv+7qPKPHv6MG79fAlLZk9DS8MkrJw/64UJIS5MzmX3GyH3g/1R+w8//G+/txmCgL/J1BGhB8UhQbfEIUF3PZcedzlEPmmaTtPcey9hHeS61a1zIGEGo8hixKINn/YjMc6pfm8rlGGcqRpe+M8kCJMAfPuW+yFFrlrQiJZpEzF3cg2ap4x/KTIcn6/HivmzcO3KOZD4srltCfTxfNQ11PWXldx9K+sUYhmEDBJwn6TIv+/chAN7Nr9S3Lh39wqWzml47BghRp8Yh2XbN/ZTPHF+5ve2gbgpYhm/VhTJpBbPmkoCOZpqx9HM6VUJufcU+bx9Ba1R+omQf3Re6WL6vU2QhAT9QtzUo635QtfJfiPh3q/EfeEM5BxWfwb42X5vOyEkZrwOMu7dvYLrV8/1b9bldnUfx/H/4fe2QB0RdoBU0c+jvG9PfoGplSNhECRAzAhGcsAHAyLCoABIOWwYJUK0rnt2kWnvdvH93hYkBbwvNcTxf3xaUCdy9043FjfWIzkwAOLIcKSPqYJp9hxohg2FiMuGrqYG5uZmKDNsCFdUgi+wIqVoGD1mbGiAQGJEsHwaGOKPIEhOh65mPBQpSqjMJnoOEYkmAyGyenqeRGulx+RyKbQjR/ac80DIb+sqx0AcxqX3VGgxofNyV28pcJXf2wQllz05jRf+M6miSeH2KCGLGqeS/iloy8sgjePDPHceBp2/RCVzzVpI+NHIP3IMg5wXICupwh+yT4BpbEH6zBZ6jm7GPPzF1EGP/yH7S8SkVyJry+cQR0Yg/+BhFHedB980ln7+TtZxpIyqpddphgyhBDz4raLT38G6YiV9nbVtJ6SmfOgnTkJygD8Kek8M2vzeJnQA/62+acbaQrOeBtjH3ERgAETJCogyhyPXsQ+y5GSkV1RikPM8VY5x5kzIFXIUn3PBNKsR7+c5qHI56dNh3dABW9sahApHIEDdgvf0G/FO9lEk6j+Erroa6RUVyN7VieD0BfSaP1n3QzNpFv1eYonG6TN6yJCpNcjeso2+F1uHIXXCDBT/4ISQEQxhkD8Wrl/ztGzruN/bAgD/5PC45j+tdaUL4iGOCEPauDq8a9kNYWY58vb9HaqMDCg1GuQdOEQVpMrMhGHKFOQfOoqo7NlUue8ZNkIYGQ2pIBESjRkKSy5EiUlI5oYjVD4OytKxEIdykTa1Ge+avRb0rnkndLMW0u/UlpXB1Dgb1tVrkWQeDkXeEHrcunEbeKJiZG3roBaqTNdCFseHQSp8CiGuy35vCxwe1/TeAqKEGQJJKBdZn20Cw7ICf7QdRqxmJKxrN8A0axZ1O4bJk5Fr30uJK/zyayRkjkWgfhmEEZHIaGmlSrRt3AxxfgUiLLMQkNoKQZwSAr4YcpkUkszB1FURQv6c0QltvdclphYPglBhAsu2DJHZ85D9+U4Un3MiKWMk+KaP6GvN4MEwNc6hliYN4z4t0/rF722Aw+MSPytDIbFDzGKg4MRJJOVPvB8HToClmwtxThmytmyDymCgbkOWJIDKaoFIqoGIF0UVSNxaWnUtuNb59Lo/Zh7En8278EfbISTEKCBJSIRQou353ndsh6GqnEwJkaj18E9bgneyjkI5tJoeSykbj/fMWyEtraXuShwehoLjX9JALwwO7C393WPv7pIRj+D3JmKv2/3Pdrfrh2cRQmKITiyErX09Uisn4B3bkR7l/VXfjqSIWCikEhgm18GyeAnNikjmlWffS4O8orgc71u34m/mLUiwjkFKxWRoG+ZBYB6O99PbkMwIQTI/CbykAiSFRiI5jAdxYjKyNm1Bcmg4/pyxB5HGOuTt/wKWNevB1s3G+8Z2+pr8XorJQIkiwZ/c6zNTYI9r8+5uZ88Q8xsDu9tZ/jyFFXnID/NyYaioRM4eO6Jy51AyguXTkcQJh3FWE4q/PQvdnIWQ5FdAzIuk5FGXU12HAGMbotPHQDtlNgq//gbqmhlIzB6LBEsVkhKUEAhSkBwUQJMEw+wWGOe3IqP1Y5q5JbHD8a5lF1SjJqLg6HHwjdX0t2P1o2lmpkxVwbqqzUvIvHnPRYiXFOe1zu7zUr83aU6Uw+06+7yENEypgzIhDoNcF5E2ZgLCJSMgjBXQlFU/fwni9KMQrJqD+AQNtOXl3nR40zZEplZDnD2SBnrT4pWIMYzDny17eyzs3YzdSIrgQ5SQjHDdFLxn2IwP9KshsZWi4MhxiPlxEKTkIP/IcQj0w6g7I9erKqfAtm49ZGIRtULyewqt5rkJ8bow5x2725Xh9ybA4XGJnvfGyUO2ftwKnTAJOR07oR9XA5lMisITJyEfPAb8JCtEuRVIq6iBKIyLwlOnvamoQAZV+XiaCqtrGsAyLaLKTjSPgnzYR1AMHw++oRqJiSqEKaqRlDMWkoIxCDEswV/MO5BSORmZbWsgk4iRZCqlsYeQGJU+FoUnvoZCqYR12QpKhqG2FpL42BcjxEvKXaKLN4GQ8S9KSNOcRmgMBkgFCSj8+hTktiJIDHk0e5IUViIuwQDtGG/gNbe0wjCjyZsOV05GoGEFYnSV0Dcvplb2oNDL2bEHQkYIjE0Le1yPdtpcBJpWIVo/FkVnvoOIFwFBRBwSwwXwT/0YqjFTaN2j1Onod5E4IuHHwDit/sUJ8dYoV+0Xf/jLQBOy7UUJOersov1XmWs/hXXVGhg/XoGMtvWISR8Df/1KCMMjvYGcKPu+0tMmzgRD20xriPxjX/Z8RmKMZtgwGKbWQyZMgiSci5SocBgqK7zZVV4ZAjQfw/bZJqQNHUoThowFLRByuLBt2EhTbVL/ZK5aA3E0D7n2fdBWVr8UIfcD/ZbXTgJJ9/ZePh9v97imOTyumy9KyDb7HqQmJfa0bt2sFkSoxiAhYzR09Y2QREX2fEaLt/ZNCFeNQ3LGMBSe/pYes3yyDLJYPhRR4VDyI5EcFAgRkwGLmI9slQAqPo+2+MKvTiFKWQrttHkw1k+DNEVLK/W04mKIw0ORuWo1rJ8sh5gXAUPjXOrqBOEv4bJ+TUp3l+y1kUH8JJ1M9hI3+oCQWQ3TYK72uiTdjAVISEhF2qRGmu0QBaUYveknERJH4lOHINkwiL4mQT1Fq4E8MgwWcQzyUpOQk5IIaSgbGeIY+jpHGgurhA95VASKvj0LaX4ZNJNnwzitATzZMMhKqpF/9DjEYWHQlo+GkM1GvLoEgfqleN/UDmV2wQsR8vPdO3gCTvUrEWS2OJ3Y/JKt5teElJYMgnXJUljXbYZIqEDe/kO01RJXQvqxtKNH9xAiLx6N+NTBtJjMWr8RYg4bGh4Hw9QJKFbEUkIeSK48FrWZEpxeOBijtAnQCfjImNeM3H0HYF66CtpRo5AotSJcXUOPpWTaEM8T04qeVvaZ+yArroB53txXsxC38x/7LnX9td/IIHNq7R7Xp69Cxq8JsaSpaeVtbfsURafOQDtuEkRhYUjNyYY6LxfGyd7qOrdzHwS8RNi2dMCycCFEjGCMSkuA85MPcWfzGNSYRV4yFPGwCHiYma+gx4lcObARNlECdBmmHnIVchmyO3bR9Dd1XD11e1FxFi8ZFjvtLSg+2/VYYfgUC3gM5LxHzu8fKyFDl08z1Qc38SKEpMRE0bojZ/sOiGOiEcXPAD9lKIrPnqP9SCRAEwVKMwppV4l18WKIQ4LQsagJl1ePxO1NlVTpjQVKZCvjYUsIQ44gsuf47SPtuHXpMhZNqYOCH30/C9tFxzz0tbXI7uiE1JCDgsPHIODwEGBcSS2j6Mz33p7hUaNeyUK8wd25sn/I8LjExARf1Tp+TYgsjAtLSysdoDLPX4AEcyXt1pAUjvEOWDVMpy1Vrjcjd3cnpGwGHJ99hlsXL+D0olLMzJOje00ZOmptMMWFYcM4M062DKZkfLtqIg59vp0Scvn0aci4HJqNaY0GaCK5SI0KpTWJsbkFefsPQBQWDl1TKz2HdDDqq6ogjwh7IiEPWv7V27881iCf14pe2Wocbteh3kz3ZSxEzGRAFROFufPno7BhGh1gijNV4X3dWohkWuhramjVXHD0SyhjeNAXFaGofBQO7d6NOweW49qn5ZieK8PXC0owUh1Pibi0aiTmDVLj06bp+MnpwtWzP6BixAjIIiOQMbUeNoUM+SI+7NOyoYqNogmEuXE2HbiiPchr10EpTMLQwgLMm9v06hbSH930dndXYl9YxqOEDMnOQuexIzhz/Rp2HDyIoooK5Gz9HCLbCEQm5EOZVejtMqkoh02UjA8HlaBkZRsKp07F1lWLvTFibTk2jM2Au20kTi4oQVOREtf3rqSWsaP9MwyvrYWhfhpEbCbS42JRakhDU6ECzYNUyBVGwfZpOx0cI+5RYzQgXSjEui2b6T2Re3yZLOuhxul23nllAog5PY/NXb9zq1eTfZrVPCCEPPSv5cSli6ium4yc1o+hraiGIl1H09KUUDbOHjqM+gl1WNS2Bfl5g5A1qRYrG8opKdfXjaJ/t0204vaWsfh2vwOjR4+GKa8AFePGQ58kQGpUJOzt66Fkh6BIEo2fN1RiSakGSomIkqVIkSOjsABDGxpQXj8V9TOmvzAhTxS3q9uvr+Fwu77oDwt5lJCjXedQU12NksICaJRK2submp+HNF4YbfFLG5swZXwdhg0eDZs+C5bsTCyszsa84hQcaizA94uHYeLoYmikEqhlZhQOnojd37hRPagEXceOYVLJIOijuSiUxeHmZxUolvLpvWS0eEcTaUa3/XMMqa7Cxh0dfUKI3eM62WdEPLCUn+/cufsywevmC1rImevXsG3vXhSNGA7LnCY6BiLjsqCO4OD0/gNoqZ2EiSXFmF9ThfnDrRidmQ5VdATqMmVYU2GAPDwUWUopxpbkY/KIQWiaMB4zPppIr71+rgspYWzYJLFoGleF9ZNLoJEkQ51lo3EqZ8sWFFSMRvMnS3H66pWXclmvLcvq67V8vRFy5vo1nL52FUvWrUNKQjwK1EJU2VLQNreJWsna2dNxqmUwtk6woLlEhUWlGlxdW44ra8qwf2Y+Fg5Ro3VoKlqGpGJBeQ5GmtKxek4T1jY3Y6hWhe0rlqO99WPIIsJga2xEQW0tSquqsLy9vYeIB9IXhOz1uD7se0I8Ttczg1cfEnLmvmzt3IPWRa0YatGiQK2ghBzduRN7phX0FH63NlViWo4UNzdW4XbHlJ4ahMixuUXYs2oZvc6WnIi60lIY42NhUCmR3TgbepkEOw4ceOrv9wUh/VKp2z3O/a/TQs48IdgbYqOxbfly/HLhIlpGZvUo/fLqEdDx2Di3qho3D6zpOU5kwXArbnQ5cXDrVqRwWJSQCYNLYDLo8NHMGWjbuhknLl7oN0Lsbtcuv/4AWagykIScuX4Nu744iPQoHupHDMfCsSPx4/rRVOkXV41EhTYREzPE6KjN7SHD01aGJROrcHLvXmQkxmHb8k+opXzaPB81I4c/12/2ASHmfiGEzGMdaELOXL+GQrUSRQoRcmUiLBtt8XaPbKqkNcXHw1KxvCydujByvLUsE2vmzoWCzUD7gnmUDCKblyxFVUkh/b4tu3dhzswZNLvrF5fldp4+cOnSv/U5IQD+S1+mvi9LSHp0JM4dO4ZMQQxUXAZONBffr85HQBfBRFOhkr7/cv5gjDSmQ8VlodIg6yGDyM62NozKsWD65ElID2WhJpYNNZeF5rlz8M2V7j6PIQ6P6yDplO1zUva6nUmvi5BvrnajfdsWTKiqQKY4CUouC2U5mRAHB+Hm+QsokCfDnMRDCjsYmz7K6AngP60fjQsrhiOdF4q0SA5qjEJsnVf3ECGbly6BKoyD4TFcdKWy8WM6BydTWCiJ4iA/RYa9J77EKY8bGzs+R8XQIX1BCJFhfv0Bu8fV0FeEFGpTsf+bU5SAtnVrMdhkoO8Xty6gLbYgJgxTE1hIZwRgBj8Ik/ghUHI4VKnN4ypRblLBJuMjLZSJmblSHJiZj+2TMpHCCYEuLgJDlHFoLFDgp7NnesjYsXI5UsO4qIhh4YaWQ8l4IOT93HgGdBEcpHGZGMJjoTQssI8IcV7fc/ny/+mXCdQOt2tdXxBSxguBmstEeVE+0jgMNCaw6Hs5IxBtySFYIWTBFMFAKsMf1pgIGHihUIWyqGIXfFSFc0ePokARj0HyWDQVp6BUwUdqKBm6jUG+JAad9TnYPHUIPf/GD9+hfnAO0sPYsMSG4ZsU1kNkEEupjQ5GSog/MjiBOKbwft6WFNJXFgJHt8vY54Q8IOX+GPorEUIe9gs5C8pgf3RKmXClcaBlBCAzgok2IQs5iZFQMINQLImm3SIj1PEw8iOpgls+qqR/JxSYUGMW9mRWZZpE5ElicGh2IRpyZLh1dAt+2LEKecJoWPmhdFi3IJaLThkT0+OZqIxlwRbBgCTIH+boUBREseBM87qxSxo26mK8C4j6yFX37/KF+z3AB1+WkOWCEGSxA7AkIQQT41hIYwbCzGMjJzwEeQnhMMeHo9roVTbJnHJFUTDxebh13okFVcNx69sj2FWfi3GGZHoOGT3MFkRiR10WFpSo0PXJh3A05CMtlIGMhIie4d1sUQxsohg67q5kBiE9nEkHt/JjuTipYmOfnIkxsSxKnDaaS+91fO1HdIUXWQtvFgvpsuvd579/oWd+LcsXSPbV2e2KsbudUxwe598dHpfz/kSxZxJSwg1AHicQ+XGhMCTyoAwOQK4qERmxYchRJULFYVClEmWfXTQUWaJoaMLZuLNjKhaMyMKdjim4sLwUrUNSaepbKORh+yQbPq00YG9DDj4ZkQ5NGBOZUv7D4+0qAXQxoZCFBMIo4HknR0j4qOYFYwSfhexkckxAj+viI0F2HRqVl4Wvjtjx043zOHlsLyoKc5BvSMee82efnxCP85rfQOFZpBBCpIH+VBHZKQmQh/jDymP1KC0jLhwTrNKe4u/grDxYRDEQB/lT5bdXm3F+RSlutI/Gog/TMN6YTMdElg7XYNsEK8bokpARzUG2MuEhMjJlcdQNaiJY1H09OG4ljSA5+qFziagjuSi1GB9fjnfbQ0mpGF2G0pJCqHjhdJHpkPxsrD+876mBfeAI8Thv9EaIMPADpPI49KE1kWyURgTBJvPOHCHWIWcEo6VETccryDDtjFw5rFI+1NwQmtaS+qOzPhtfzCpAmToOx5uK0ZAtpWSYornIToxA7iPKJdYgDQ6APj7S67oUCcgSP2w9jwpJj786an/iGslvTuynLmzJnAZccp3CJdc3+GTudKTF8LD56yNPeu6vBpAQV1dvhKQwQ6CJDqWT2TSMAFTwmchJDIeNBN/4cGQJeCiU8VGRLsDhxkIcml2AYco4mPmh6JyajW3jrciM5aJaJ7jfs6vGBLMQckYQcoQPt3TiBrURbCjZwdRCctVJyIsLRQYnCDm0EQh6LIl8po/nUTdFKnyyjqW3raN+vO56fHeJpgZ8WJz3JJe1esAIsbtdu3sjxCJOgowRCDUrGNvFDJg4QZgQEwKLJAapoUzkKOJhlcYiU8KHPoaLJcO1NLAXCXlozJejY1ImdUul6ngUyfgwxHBpkWglsxWTeMiKDfW6KGkclKwgaKO4yFULKDkl0Sx0SlmUlNz4cAyJZCArPhw5KgEMUVyMzDTRFk+2jyKb2pDVwi+yRp5YiiKU8/r6tZ6TkKbeCCHrwIUB/jSod2vZWJbEQJuQCUtCBCzxEbBJY5ERG4rtEzJxtKkQXzUXo2OSDXumZuHInEJsmWDFOEMScsXRSI/m0EypKJqNujgGdoqZyIsPgykhErKQAJjvWwyJGYOjmLiYxkF5NAODolg4nsLGIgED2ggupIwgSEOCcPn86ZfesICQ17ltHZ2qNMhmwWfHDnif2e260nHlu/87kISYn5V1lJh1EAZ8gHlxwbiq5WCNkAFLTCgykqKQRzIjSQztVu9aOoxOZFgwWE27Rkqk0TAlRcGYyIOCFQxTKAPtov+svCfGMWGMYlPLyJTFe12XWoBB0SxcSGPDrWFjRGQQPFoOvlezoeEysaxpGm3Zj+5Y9KJC9vw6vK8D358+Qnc60sbFUFLIPsIDRoaXkB/+37PmcJFF+YQUUeAHMDD8MSoiCOKgAIzVJ2PZCC1WjdJhSWkaVo/SYaxegBVl6WivMmJthR76KDbEwf7IDwtCmyCEFplEFsQHQx7sDyU7iHaf6BMivRLBwty44J7zHkhRFAdLZ9f32ZYeq1pmP/R+2bwZGJxju/JG7HDqcDt3PE9+TtaBZ4gFSGGFQBTk/1q30xAzgqhl9OsmOGzmDb83Ac/jtgZa5Fx2vxJCkgNJSPBNvzcB9zc7fq41hwMlQ/KzaZraX4QsaZx6RxXG2ej3psDudtoGWumOXoRU1aSQI6T0paUQyyBkyJgh1xI/+ODN2c30/kijfaAV7+hFSFVNCjlSO/QWbywiAVX2qLxM+pcMnBEhr40JsTcfik0hQT+nhHI3vFFkPABZ/Eg61gZa8Y5XFJI12j3n0/x+C7B7zmv6aimD48UVec/ucbY8Ty90b9/h6HYV+P2WYHe7hgwQIUXk9/d2n5e8lKW6XVccbpfa77cIQsrrshQ7sQy3s/jXv++4cOFfHW7nnPv/kuIZRBCLci78u6fr//v9lkHcFxkb6FcyPM5rDrdL9bR72HP57L87ul35drdzPf23SN7hgptk4xxyjMzHJb0Nfr8XkI3tydZG/WMZrt17r5z/00A/41sHuuucu8tqdzu/6xMy3M7vOz1O3Ru7d9XbAlLR773sMtk9zs9f+H9Jkf++5nFuJ+lov8wO/L3jwKVL/0bmL90PvKRzsots5PKf2Y7ze7vH2eHwuGbYu52Gfde6/mWg79kHH3zwwQcffPDBBx988MEHH3zwwQcffPDBBx/8HsN/AHqtyXbTB8hWAAAAAElFTkSuQmCC">
                      SELECCIONAR ESTATUS </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!--Aqui haremos la modificacion de usuario-->
                    <form action="" method="post">


                      <div hidden class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="ID" class="input input__text inputmodal input_modificado" name="txtid_2" value="<?= $datos->id_control_negativas ?>" readonly>
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
                        <a href="manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>
                        <button type="submit" value="ok" name="btnmodificar_estatus" class="btn btn-primary btn-rounded">Asignar <i class="fa-brands fa-playstation"></i></button>
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

                <th scope="col"></th>

                <th scope="col">RPU</th>
                <th scope="col">ESTATUS</th>
                <th scope="col">CUENTA</th>
                <th scope="col">CICLO</th>
                <th scope="col">TARIFA</th>
                <th scope="col">MEDIDOR</th>
                <!-- <th scope="col">SIN USO</th> -->
                <th scope="col">AA_MM</th>
                <th scope="col">TIPO MEDIDOR</th>
                <th scope="col">CVE</th>
                <th scope="col">DICE</th>
                <th scope="col">DEBE DECIR</th>
                <th scope="col">KWH_A_RECUPERAR</th>
                <th scope="col">JUSTIFICACION_NEGATIVA</th>
                <th scope="col">OBSERVACIONES</th>
                <th scope="col">RESPONSABLE</th>
                <th scope="col">FECHA</th>
                <th scope="col">ACCION</th>

              </tr>
            </thead>

            <tbody>

              <?php
              while ($datos = $sql_mes_negativa->fetch_object()) { ?>


                <tr>


                  <td></td>

                  <?php
                  if ($datos->id_estatus == '1') { ?>
                    <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                      <?= $datos->rpu ?>
                    </td>



                    <td style="background-color: rgba(110, 149, 52, 0.7); text-decoration: none;" class="td-celda-icono-estatus">
                      <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                        ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                      </a>
                    </td>

                  <?php } else if (($datos->id_estatus == '2')) { ?>

                    <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                      <?= $datos->rpu ?>
                    </td>


                    <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;" class="td-celda-icono-estatus">

                      <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                        PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                    </td>


                  <?php } else { ?>


                    <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                      <?= $datos->rpu ?>
                    </td>


                    <td style="background-color: rgba(255, 53, 53, 0.7);" class="td-celda-icono-estatus">

                      <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
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
                    <?= $datos->medidor ?>
                  </td>
                  <td class="celda" onclick="copiarContenido(this)">
                    <?= $datos->aa_mm ?>
                  </td>
                  <td class="celda" onclick="copiarContenido(this)">
                    <?= $datos->tipo_medidor ?>
                  </td>
                  <td class="celda" onclick="copiarContenido(this)">
                    <?= $datos->cve ?>
                  </td>
                  <td class="celda" onclick="copiarContenido(this)">
                    <?= $datos->dice ?>
                  </td>
                  <td class="celda" onclick="copiarContenido(this)">
                    <?= $datos->debe_decir ?>
                  </td>
                  <td class="celda" onclick="copiarContenido(this)">
                    <?= $datos->kwh_recuperar ?>
                  </td>
                  <td class="celda" onclick="copiarContenido(this)">
                    <?= $datos->id_justificacionnegativas ?>
                  </td>

                  <td class="celda" onclick="copiarContenido(this)">
                    <?= $datos->observaciones ?>
                  </td>
                  <td class="celda" onclick="copiarContenido(this)">
                    <?= $datos->responsable_negativa ?>
                  </td>
                  <td class="celda" onclick="copiarContenido(this)">
                    <?= $datos->fecha_captura ?>
                  </td>
                  <td>


                    <a class="btn btn-warning" href="historial_negativas.php?id_negativas=<?= $datos->id_control_negativas ?>">HISTÓRICO <i class="fa-solid fa-eye"></i></a>


                  </td>


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
                    <th scope="col"></th>

                    <th scope="col">RPU</th>
                    <th scope="col">ESTATUS</th>
                    <th scope="col">CUENTA</th>
                    <th scope="col">CICLO</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MEDIDOR</th>
                    <!-- <th scope="col">SIN USO</th> -->
                    <th scope="col">AA_MM</th>
                    <th scope="col">TIPO MEDIDOR</th>
                    <th scope="col">CVE</th>
                    <th scope="col">DICE</th>
                    <th scope="col">DEBE DECIR</th>
                    <th scope="col">KWH_A_RECUPERAR</th>
                    <th scope="col">JUSTIFICACION_NEGATIVA</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">RESPONSABLE</th>
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
                          <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                            ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                          </a>
                        </td>

                      <?php } else if (($datos->id_estatus == '2')) { ?>

                        <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                          <?= $datos->rpu ?>
                        </td>


                        <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;" class="td-celda-icono-estatus">

                          <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                            PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                        </td>


                      <?php } else { ?>


                        <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                          <?= $datos->rpu ?>
                        </td>


                        <td style="background-color: rgba(255, 53, 53, 0.7);" class="td-celda-icono-estatus">

                          <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
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
                        <?= $datos->medidor ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->aa_mm ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->tipo_medidor ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->cve ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->dice ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->debe_decir ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->kwh_recuperar ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->id_justificacionnegativas ?>
                      </td>

                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->observaciones ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->responsable_negativa ?>
                      </td>
                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->fecha_captura ?>
                      </td>
                      <td>
                        <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_control_negativas ?> " class="btn btn-success ">CORREGIR NEGATIVA <i class="fa-brands fa-stack-overflow"></i></a>

                        <a class="btn btn-warning" href="historial_negativas.php?id_negativas=<?= $datos->id_control_negativas ?>">HISTÓRICO <i class="fa-solid fa-eye"></i></a>

                        <a class="btn btn-danger" href="negativas.php?id_negativa_eliminar=<?= $datos->id_control_negativas ?>" onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a>
                      </td>

                    </tr>




                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $datos->id_control_negativas  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header d-flex justify-content-between">
                            <h5 class="modal-title w-100" id="exampleModalLabel">GENERAR NEGATIVA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!--Aqui haremos la modificacion de usuario-->
                            <form action="" method="post">
                              <div hidden class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="ID" class="input input__text inputmodal" name="txtid" value=" <?= $datos->id_control_negativas ?>" readonly>
                              </div>
                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="RPU ACTUAL: <?= $datos->rpu ?>" class="input input__text inputmodal_ineditable" name="txtrpu" value=" <?= $datos->rpu ?>" readonly>
                              </div>
                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="CUENTA ACTUAL: <?= $datos->cuenta ?>" class="input input__text inputmodal" name="txtcuenta" value=" <?= $datos->cuenta ?>" autocomplete="off">
                              </div>
                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="CICLO ACTUAL: <?= $datos->ciclo ?>" class="input input__text inputmodal" name="txtciclo" value=" <?= $datos->ciclo ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="TARIFA ACTUAL: <?= $datos->tarifa ?>" class="input input__text inputmodal" name="txttarifa" value=" <?= $datos->tarifa ?>" autocomplete="off">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="MEDIDOR ACTUAL: <?= $datos->medidor ?>" class="input input__text inputmodal" name="txtmedidor" value=" <?= $datos->medidor ?>" autocomplete="off">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="AA_MM ACTUAL: <?= $datos->aa_mm ?>" class="input input__text inputmodal" name="txtaa_mm" value=" <?= $datos->aa_mm ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="TIPO-MEDIDOR ACTUAL: <?= $datos->tipo_medidor ?>" class="input input__text inputmodal" name="txttipo_medidor" value=" <?= $datos->tipo_medidor ?>" autocomplete="off">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="CVE ACTUAL: <?= $datos->cve ?>" class="input input__text inputmodal" name="txtcve" value=" <?= $datos->cve ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="DICE:  <?= $datos->dice ?>" class="input input__text inputmodal" name="txtdice" value=" <?= $datos->dice ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="DEBE DECIR: <?= $datos->debe_decir ?>" class="input input__text inputmodal" name="txtdebe_decir" value=" <?= $datos->debe_decir ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="KWH A RECUPERAR: <?= $datos->kwh_recuperar ?>" class="input input__text inputmodal" name="txtkwh_recuperar" value=" <?= $datos->kwh_recuperar ?>" autocomplete="off" onkeypress="return validarNumeros(event)">
                              </div>





                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="JUSTIFICACION ACTUAL:  <?= $datos->id_justificacionnegativas ?> " class="input input__text inputmodal" name="txtid_justificacionnegativa" value=" <?= $datos->id_justificacionnegativas ?>" autocomplete="off">
                              </div>




                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="OBSERVACIÓN ACTUAL:  <?= $datos->observaciones ?> " class="input input__text inputmodal" name="txtobservaciones" value=" <?= $datos->observaciones ?>" autocomplete="off">
                              </div>

                              <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                <input type="text" placeholder="RESPONSABLE DE CAPTURA: <?= $datos->responsable_negativa ?> " class="input input__text inputmodal" name="txtresponsable_negativa" value=" <?= $datos->responsable_negativa ?>" autocomplete="off">
                              </div>


                              <div class="fl-flex-label mb-4 px-2 col-12 campo">

                                <select name="txtmotivo" class="input input__select inputmodal input_modificado">

                                  <option value=""> SELECCIONA EL MOTIVO </option>
                                  <?php
                                  $sql_mostrar_motivo_historial_negativas = $conexion->query(" SELECT *FROM motivo_historial ");
                                  while ($datos6 = $sql_mostrar_motivo_historial_negativas->fetch_object()) { ?>
                                    <option value="<?= $datos6->id_motivohistorial ?>"><?= $datos6->nombre_motivo ?></option>
                                  <?php }
                                  ?>

                                </select>

                              </div>








                              <div class="text-right p-3">
                                <a href="negativas.php" class="btn btn-secondary btn-rounded">Atras</a>
                                <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Actualizar</button>
                              </div>

                            </form>


                          </div>
                        </div>
                      </div>
                    </div>




                    <!-- MODAL PARA PONER LOS ESTATUS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->



                    <div class="modal fade" id="exampleModal_estatus<?= $datos->id_control_negativas  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                <input type="text" placeholder="ID" class="input input__text inputmodal input_modificado" name="txtid_2" value="<?= $datos->id_control_negativas ?>" readonly>
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
                                <a href="manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>
                                <button type="submit" value="ok" name="btnmodificar_estatus" class="btn btn-primary btn-rounded">Asignar <i class="fa-brands fa-playstation"></i></button>
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






                //AHORA VA LA VISTA DESPUES DE QUE EL USUARIO ESCRIBE Y BUSCA UN RPU Y SI EL ROL ES UN PROFESIONISTA Ó CONSULTAS 
                //QUE SE MUESTRAN EN LA PRIMERA VISTA

              } else {
                ?>

                  <table class="table table-bordered table-hover w-100 " id="example">
                    <thead>
                      <tr>
                        <th scope="col"></th>

                        <th scope="col">RPU</th>
                        <th scope="col">ESTATUS</th>
                        <th scope="col">CUENTA</th>
                        <th scope="col">CICLO</th>
                        <th scope="col">TARIFA</th>
                        <th scope="col">MEDIDOR</th>
                        <!-- <th scope="col">SIN USO</th> -->
                        <th scope="col">AA_MM</th>
                        <th scope="col">TIPO MEDIDOR</th>
                        <th scope="col">CVE</th>
                        <th scope="col">DICE</th>
                        <th scope="col">DEBE DECIR</th>
                        <th scope="col">KWH_A_RECUPERAR</th>
                        <th scope="col">JUSTIFICACION_NEGATIVA</th>
                        <th scope="col">OBSERVACIONES</th>
                        <th scope="col">RESPONSABLE</th>
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
                              <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                                ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                              </a>
                            </td>

                          <?php } else if (($datos->id_estatus == '2')) { ?>

                            <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                              <?= $datos->rpu ?>
                            </td>


                            <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;" class="td-celda-icono-estatus">

                              <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                                PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                            </td>


                          <?php } else { ?>


                            <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                              <?= $datos->rpu ?>
                            </td>


                            <td style="background-color: rgba(255, 53, 53, 0.7);" class="td-celda-icono-estatus">

                              <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
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
                            <?= $datos->medidor ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->aa_mm ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->tipo_medidor ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->cve ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->dice ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->debe_decir ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->kwh_recuperar ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->id_justificacionnegativas ?>
                          </td>

                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->observaciones ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->responsable_negativa ?>
                          </td>
                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->fecha_captura ?>
                          </td>
                          <td>


                            <a class="btn btn-warning" href="historial_negativas.php?id_negativas=<?= $datos->id_control_negativas ?>">HISTÓRICO <i class="fa-solid fa-eye"></i></a>


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
<script>
  function copiarContenido(idCelda) {
    // Obtener el contenido de la celda
    const contenido = document.getElementById(idCelda).innerText;

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


    }
  }
</script>

<!-- //EVITAR ESPACIOS ANTES DE ESCRIBIR TEXTO EN LOS INPUTS -->

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
</script>

<!-- SCRIPT PARA COPIAR CELADAS DE LA TABLA -->
<script>
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
</script>




<!-- Función para validar la entrada y permitir solo números -->
<script>
  function validarNumeros(e) {
    // Obtener el código de la tecla presionada
    let codigoTecla = e.which ? e.which : e.keyCode;

    // Permitir teclas de control como Enter, Backspace y Delete
    if (codigoTecla == 13 || codigoTecla == 8 || codigoTecla == 46) {
      return true;
    }

    // Verificar si la tecla presionada es un número
    if (codigoTecla < 48 || codigoTecla > 57) {
      e.preventDefault();
    }
  }
</script>




<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>