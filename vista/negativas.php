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
            <th scope="col">AGENCIA</th>
            <th scope="col">TARIFA</th>
            <th scope="col">MEDIDOR</th>
            <!-- <th scope="col">SIN USO</th> -->
            <th scope="col">AA_MM</th>
            <th scope="col">TIPO MEDIDOR</th>
            <th scope="col">CVE</th>
            <th scope="col">DICE</th>
            <th scope="col">DEBE DECIR</th>
            <th scope="col">KWH_A_RECUPERAR</th>
            <th scope="col">RESPALDO_NEGATIVA</th>
            <th scope="col">MOTIVO_CORRECCION</th>
            <th scope="col">RPE AUXILIAR</th>
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



                <td style=" text-decoration: none;" class="td-celda-icono-estatus">
                  <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                    ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                  </a>
                </td>

              <?php } else if (($datos->id_estatus == '2')) { ?>

                <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                  <?= $datos->rpu ?>
                </td>


                <td style=" text-decoration: none;" class="td-celda-icono-estatus">

                  <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                    PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                </td>


              <?php } else { ?>


                <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                  <?= $datos->rpu ?>
                </td>


                <td class="td-celda-icono-estatus">

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
                <?= $datos->agencia ?>
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
                <?= $datos->motivo_correccion ?>
              </td>
              <td class="celda" onclick="copiarContenido(this)">
                <?= $datos->rpe_auxiliar ?>
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

                <th scope="col"></th>

                <th scope="col">RPU</th>
                <th scope="col">ESTATUS</th>
                <th scope="col">CUENTA</th>
                <th scope="col">CICLO</th>
                <th scope="col">AGENCIA</th>
                <th scope="col">TARIFA</th>
                <th scope="col">MEDIDOR</th>
                <!-- <th scope="col">SIN USO</th> -->
                <th scope="col">AA_MM</th>
                <th scope="col">TIPO MEDIDOR</th>
                <th scope="col">CVE</th>
                <th scope="col">DICE</th>
                <th scope="col">DEBE DECIR</th>
                <th scope="col">KWH_A_RECUPERAR</th>
                <th scope="col">RESPALDO_NEGATIVA</th>
                <th scope="col">MOTIVO_CORRECCION</th>
                <th scope="col">RPE AUXILIAR</th>
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



                    <td style=" text-decoration: none;" class="td-celda-icono-estatus">
                      <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                        ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                      </a>
                    </td>

                  <?php } else if (($datos->id_estatus == '2')) { ?>

                    <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                      <?= $datos->rpu ?>
                    </td>


                    <td style=" text-decoration: none;" class="td-celda-icono-estatus">

                      <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                        PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                    </td>


                  <?php } else { ?>


                    <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                      <?= $datos->rpu ?>
                    </td>


                    <td class="td-celda-icono-estatus">

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
                    <?= $datos->agencia ?>
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
                    <?= $datos->motivo_correccion ?>
                  </td>
                  <td class="celda" onclick="copiarContenido(this)">
                    <?= $datos->rpe_auxiliar ?>
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
                    <th scope="col">AGENCIA</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MEDIDOR</th>
                    <!-- <th scope="col">SIN USO</th> -->
                    <th scope="col">AA_MM</th>
                    <th scope="col">TIPO MEDIDOR</th>
                    <th scope="col">CVE</th>
                    <th scope="col">DICE</th>
                    <th scope="col">DEBE DECIR</th>
                    <th scope="col">KWH_A_RECUPERAR</th>
                    <th scope="col">RESPALDO_NEGATIVA</th>
                    <th scope="col">MOTIVO_CORRECCION</th>
                    <th scope="col">RPE AUXILIAR</th>
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



                        <td style="text-decoration: none;" class="td-celda-icono-estatus">
                          <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                            ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                          </a>
                        </td>

                      <?php } else if (($datos->id_estatus == '2')) { ?>

                        <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                          <?= $datos->rpu ?>
                        </td>


                        <td style="text-decoration: none;" class="td-celda-icono-estatus">

                          <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                            PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                        </td>


                      <?php } else { ?>


                        <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                          <?= $datos->rpu ?>
                        </td>


                        <td class="td-celda-icono-estatus">

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
                        <?= $datos->agencia ?>
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
                        <?= $datos->motivo_correccion ?>
                      </td>

                      <td class="celda" onclick="copiarContenido(this)">
                        <?= $datos->rpe_auxiliar ?>
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
                        <th scope="col"></th>

                        <th scope="col">RPU</th>
                        <th scope="col">ESTATUS</th>
                        <th scope="col">CUENTA</th>
                        <th scope="col">CICLO</th>
                        <th scope="col">AGENCIA</th>
                        <th scope="col">TARIFA</th>
                        <th scope="col">MEDIDOR</th>
                        <!-- <th scope="col">SIN USO</th> -->
                        <th scope="col">AA_MM</th>
                        <th scope="col">TIPO MEDIDOR</th>
                        <th scope="col">CVE</th>
                        <th scope="col">DICE</th>
                        <th scope="col">DEBE DECIR</th>
                        <th scope="col">KWH_A_RECUPERAR</th>
                        <th scope="col">RESPALDO_NEGATIVA</th>
                        <th scope="col">MOTIVO_CORRECCION</th>
                        <th scope="col">RPE AUXILIAR</th>
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



                            <td style="text-decoration: none;" class="td-celda-icono-estatus">
                              <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                                ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                              </a>
                            </td>

                          <?php } else if (($datos->id_estatus == '2')) { ?>

                            <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                              <?= $datos->rpu ?>
                            </td>


                            <td style="text-decoration: none;" class="td-celda-icono-estatus">

                              <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
                                PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                            </td>


                          <?php } else { ?>


                            <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                              <?= $datos->rpu ?>
                            </td>


                            <td class="td-celda-icono-estatus">

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
                            <?= $datos->agencia ?>
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
                            <?= $datos->motivo_correccion ?>
                          </td>

                          <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->rpe_auxiliar ?>
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







<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>