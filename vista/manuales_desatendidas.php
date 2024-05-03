<?php

session_start();


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

    <h4 style="margin-bottom: 5%;" class="text-center text-secondery"> MANUALES PENDIENTES</h4>

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






        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT * FROM control_manuales WHERE DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN' AND id_estatus = '2' ORDER BY fecha_captura DESC");
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m')BETWEEN '$FECHAINICIO' AND '$FECHAFIN' AND id_estatus = '2'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];


    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "FECHA SELECCIONADA: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>

        <!-- <div style="text-align: center; margin:auto; font-weight:bolder; color: #42ca07; ">
            <?php
            echo "TOTAL DE MANUALES PENDIENTES: $total_registros";

            ?>
        </div> -->

    <?php



        #6
    } else if ($_SESSION["fecha_primermes"] != null &&  $_SESSION["fecha_sextomes"] != null) {

        $FECHAINICIO =  $_SESSION["fecha_primermes"];
        $FECHAFIN = $_SESSION["fecha_sextomes"];




        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT * FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN' AND id_estatus = '2' ORDER BY fecha_captura DESC");
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN' AND id_estatus = '2'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];


    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "SEMESTRAL: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: #42ca07; ">
            <?php
            echo "TOTAL DE MANUALES PENDIENTES: $total_registros";

            ?>
        </div>

    <?php





        #6
    } else if ($_SESSION["fecha_año"] != null &&  $_SESSION["fecha_mesdoce"] != null) {


        $FECHAINICIO =  $_SESSION["fecha_año"];
        $FECHAFIN = $_SESSION["fecha_mesdoce"];




        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT * FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN' AND id_estatus = '2' ORDER BY fecha_captura DESC");
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m')BETWEEN '$FECHAINICIO' AND '$FECHAFIN' AND id_estatus = '2'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];


    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "ANUAL: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>

        <div style="text-align: center; margin:auto; font-weight:bolder; color: #42ca07; ">
            <?php
            echo "TOTAL DE MANUALES PENDIENTES: $total_registros";

            ?>
        </div>

    <?php




        #6
    } else if ($_SESSION["fechaxmes"] != null) {

        $FECHAINICIO =  $_SESSION["fechaxmes"];





        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT * FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO' AND id_estatus = '2' ORDER BY fecha_captura DESC");

        //contador de registros para busqueda por mes
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_manuales WHERE DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO' AND id_estatus = '2'");
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
                echo "TOTAL DE MANUALES PENDIENTES: $total_registros";


                ?>
            </p>
        </div>

    <?php



        #6


    } else {
        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT * FROM control_manuales WHERE id_estatus = '2' ORDER BY fecha_captura DESC");

        //contador de registros para busqueda por mes
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_manuales WHERE id_estatus = '2'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];



    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color:gray; ">

            <p style="color:#42ca07; ">
                <?php
                echo "TOTAL DE MANUALES PENDIENTES: $total_registros";


                ?>
            </p>
        </div>

    <?php
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






                <?php




                    //-- MODAL PARA CORRECCION Y CAMBIO DE ESTATUS-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->




                    include "modales/modal_modificacion_manuales.php";





                    //-- Modal-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

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