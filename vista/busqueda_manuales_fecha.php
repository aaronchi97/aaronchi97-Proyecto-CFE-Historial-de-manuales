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








<div class="page-content">

    <h4 style="margin-bottom: 5%;" class="text-center text-secondery"> MANUALES POR FECHA</h4>

    <?php
    //hacemos la conexion
    include "../modelo/conexion.php";
    //llamamos al controlador para eliminar registros
    include "../controlador/controlador_modificar_manual.php";
    include "../controlador/controlador_asignar_estatus.php";
    include "../controlador/controlador_eliminar_manual.php";
    // include "../controlador/control-estadisticos/controlador_buscar_fecha_manual.php";

    ?>



    <a href="estadisticos_manuales.php" class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-solid fa-caret-left"></i>
        ATRAS</a>

    <?php


    // INICIO DE CONDICIONES PARA SELECCIONAR QUE TIPO DE FILTRO DE BUSQUEDA SE ESTA SELECCIONANDO (MES, 6MESES, AÑO O PERSONALIZADO)-------------------------

    if ($_SESSION["fechainicio"] != null &&  $_SESSION["fechafin"] != null) {

        $FECHAINICIO = $_SESSION["fechainicio"];
        $FECHAFIN = $_SESSION["fechafin"];






        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT * FROM control_manuales WHERE DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN' ORDER BY fecha_captura DESC");
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m')BETWEEN '$FECHAINICIO' AND '$FECHAFIN'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];


    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "FECHA SELECCIONADA: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>

        <!-- <div style="text-align: center; margin:auto; font-weight:bolder; color: #42ca07; ">
            <?php
            echo "TOTAL DE MANUALES: $total_registros";

            ?>
        </div> -->

    <?php



        #6
    } else if ($_SESSION["fecha_primermes"] != null &&  $_SESSION["fecha_sextomes"] != null) {

        $FECHAINICIO =  $_SESSION["fecha_primermes"];
        $FECHAFIN = $_SESSION["fecha_sextomes"];




        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT * FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN' ORDER BY fecha_captura DESC");
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];


    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "SEMESTRAL: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: #42ca07; ">
            <?php
            echo "TOTAL DE MANUALES: $total_registros";

            ?>
        </div>

    <?php





        #6
    } else if ($_SESSION["fecha_año"] != null &&  $_SESSION["fecha_mesdoce"] != null) {


        $FECHAINICIO =  $_SESSION["fecha_año"];
        $FECHAFIN = $_SESSION["fecha_mesdoce"];




        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT * FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN' ORDER BY fecha_captura DESC");
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m')BETWEEN '$FECHAINICIO' AND '$FECHAFIN'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];


    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "ANUAL: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>

        <div style="text-align: center; margin:auto; font-weight:bolder; color: #42ca07; ">
            <?php
            echo "TOTAL DE MANUALES: $total_registros";

            ?>
        </div>

    <?php




        #6
    } else if ($_SESSION["fechaxmes"] != null) {

        $FECHAINICIO =  $_SESSION["fechaxmes"];





        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT * FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO' ORDER BY fecha_captura DESC");

        //contador de registros para busqueda por mes
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];


    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "FECHA POR MES: $FECHAINICIO";

            ?>
        </div>

        <?php


        ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color:gray; ">

            <p style="color:#42ca07; ">
                <?php
                echo "TOTAL DE MANUALES: $total_registros";


                ?>
            </p>
        </div>

    <?php



        #6


    }


    ?>






    <?php
    if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
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
                while ($datos =  $sql_buscar_manuales_por_fecha->fetch_object()) { ?>

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
                                            <a href="busqueda_manuales_fecha.php" class="btn btn-danger btn-rounded">Cancelar</a>
                                            <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Actualizar <i class="fa-solid fa-arrows-rotate"></i></button>
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
                                    <h5 class="modal-title w-100" id="exampleModalLabel"><img src="data:image/png;base64,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">
                                        SELECCIONAR ESTATUS </h5>
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
                                            <a href="busqueda_manuales_fecha.php" class="btn btn-danger btn-rounded">Cancelar</a>
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

        } else { ?>
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
                        while ($datos =  $sql_buscar_manuales_por_fecha->fetch_object()) { ?>



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


                    <!-- por ultimo se carga el footer -->
                    <?php require('./layout/footer.php'); ?>