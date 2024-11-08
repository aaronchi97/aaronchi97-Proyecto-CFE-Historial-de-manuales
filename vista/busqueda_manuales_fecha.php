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



    <a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-solid fa-caret-left"></i>
        ATRAS</a>

    <?php


    // INICIO DE CONDICIONES PARA SELECCIONAR QUE TIPO DE FILTRO DE BUSQUEDA SE ESTA SELECCIONANDO (MES, 6MESES, AÑO O PERSONALIZADO)-------------------------

    if ($_SESSION["fechainicio"] != null &&  $_SESSION["fechafin"] != null) {

        $FECHAINICIO = $_SESSION["fechainicio"];
        $FECHAFIN = $_SESSION["fechafin"];






        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT control_manuales.*, motivo_historial.* FROM control_manuales LEFT JOIN motivo_historial  ON control_manuales.id_motivohistorial = motivo_historial.id_motivohistorial WHERE DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN' ORDER BY fecha_captura DESC");
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_manuales WHERE DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];


    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "FECHA SELECCIONADA: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>

        <div style="text-align: center; margin:auto; font-weight:bolder; color: #42ca07; ">
            <?php
            echo "TOTAL DE MANUALES: $total_registros";

            ?>
        </div>

    <?php



        #6
    } else if ($_SESSION["fecha_primermes"] != null &&  $_SESSION["fecha_sextomes"] != null) {

        $FECHAINICIO =  $_SESSION["fecha_primermes"];
        $FECHAFIN = $_SESSION["fecha_sextomes"];




        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT control_manuales.*, motivo_historial.* FROM control_manuales LEFT JOIN motivo_historial  ON control_manuales.id_motivohistorial = motivo_historial.id_motivohistorial WHERE DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN' ORDER BY fecha_captura DESC");
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




        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT control_manuales.*, motivo_historial.* FROM control_manuales LEFT JOIN motivo_historial  ON control_manuales.id_motivohistorial = motivo_historial.id_motivohistorial WHERE DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN' ORDER BY fecha_captura DESC");
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





        $sql_buscar_manuales_por_fecha = $conexion->query("SELECT control_manuales.*, motivo_historial.* FROM control_manuales LEFT JOIN motivo_historial  ON control_manuales.id_motivohistorial = motivo_historial.id_motivohistorial WHERE DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO' ORDER BY fecha_captura DESC");

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



                    <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->

                    <?php
                    include "tablas/tabla_cabecera_manuales_admin.php";
                    ?>



                </tr>
            </thead>

            <tbody>
                <?php
                while ($datos =  $sql_buscar_manuales_por_fecha->fetch_object()) { ?>

                    <tr>



                        <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->
                        <?php
                        include "tablas/tabla_filas_manuales_admin.php";
                        ?>



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

                            <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA PROFESIONISTAS Y CONSULTAS-->

                            <?php
                            include "tablas/tabla_cabecera_manuales_consultor.php";
                            ?>

                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        while ($datos =  $sql_buscar_manuales_por_fecha->fetch_object()) { ?>
                            <tr>


                                <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->
                                <?php
                                include "tablas/tabla_filas_manuales_consultor.php";
                                ?>



                            </tr>
                        <?php } ?>




                    <?php }

                    ?>


                    <!-- por ultimo se carga el footer -->
                    <?php require('./layout/footer.php'); ?>