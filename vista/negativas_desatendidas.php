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

    <h4 style="margin-bottom: 5%;" class="text-center text-secondery"> NEGATIVAS DESATENDIDAS</h4>

    <?php
    //hacemos la conexion
    include "../modelo/conexion.php";
    //llamamos al controlador para eliminar registros
    include "../controlador/controlador_modificar_negativa.php";
    include "../controlador/controlador_asignar_estatus_negativas.php";
    include "../controlador/controlador_eliminar_negativa.php";
    // include "../controlador/control-estadisticos/controlador_buscar_fecha_manual.php";




    ?>



    <a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-solid fa-caret-left"></i>
        ATRAS</a>

    <?php


    // INICIO DE CONDICIONES PARA SELECCIONAR QUE TIPO DE FILTRO DE BUSQUEDA SE ESTA SELECCIONANDO (MES, 6MESES, AÑO O PERSONALIZADO)-------------------------

    if ($_SESSION["fechainicio"] != null &&  $_SESSION["fechafin"] != null) {

        $FECHAINICIO = $_SESSION["fechainicio"];
        $FECHAFIN = $_SESSION["fechafin"];






        $sql_buscar_NEGATIVAS_por_fecha = $conexion->query("SELECT * FROM control_negativas WHERE DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN' AND id_estatus = '2' ORDER BY fecha_captura DESC");
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_negativas WHERE DATE(fecha_captura)BETWEEN '$FECHAINICIO' AND '$FECHAFIN' AND id_estatus = '2'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];


    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "FECHA SELECCIONADA: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>

        <div style="text-align: center; margin:auto; font-weight:bolder; color: #42ca07; ">
            <?php
            echo "TOTAL DE NEGATIVAS: $total_registros";

            ?>
        </div>

    <?php



        #6
    } else if ($_SESSION["fecha_primermes"] != null &&  $_SESSION["fecha_sextomes"] != null) {

        $FECHAINICIO =  $_SESSION["fecha_primermes"];
        $FECHAFIN = $_SESSION["fecha_sextomes"];




        $sql_buscar_NEGATIVAS_por_fecha = $conexion->query("SELECT * FROM control_negativas WHERE DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN' AND id_estatus = '2' ORDER BY fecha_captura DESC");
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_negativas WHERE DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN' AND id_estatus = '2'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];


    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "SEMESTRAL: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: #42ca07; ">
            <?php
            echo "TOTAL DE NEGATIVAS: $total_registros";

            ?>
        </div>

    <?php





        #6
    } else if ($_SESSION["fecha_año"] != null &&  $_SESSION["fecha_mesdoce"] != null) {


        $FECHAINICIO =  $_SESSION["fecha_año"];
        $FECHAFIN = $_SESSION["fecha_mesdoce"];




        $sql_buscar_NEGATIVAS_por_fecha = $conexion->query("SELECT * FROM control_negativas WHERE DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN' AND id_estatus = '2' ORDER BY fecha_captura DESC");
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_negativas WHERE DATE_FORMAT(fecha_captura, '%Y-%m')BETWEEN '$FECHAINICIO' AND '$FECHAFIN' AND id_estatus = '2'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];


    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "ANUAL: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>

        <div style="text-align: center; margin:auto; font-weight:bolder; color: #42ca07; ">
            <?php
            echo "TOTAL DE NEGATIVAS: $total_registros";

            ?>
        </div>

    <?php




        #6
    } else if ($_SESSION["fechaxmes"] != null) {

        $FECHAINICIO =  $_SESSION["fechaxmes"];





        $sql_buscar_NEGATIVAS_por_fecha = $conexion->query("SELECT * FROM control_negativas WHERE DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO' AND id_estatus = '2' ORDER BY fecha_captura DESC");

        //contador de registros para busqueda por mes
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_negativas WHERE DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO' AND id_estatus = '2'");
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
                echo "TOTAL DE NEGATIVAS: $total_registros";


                ?>
            </p>
        </div>

    <?php



        #6


    } else {
        $sql_buscar_NEGATIVAS_por_fecha = $conexion->query("SELECT * FROM control_negativas WHERE id_estatus = '2' ORDER BY fecha_captura DESC");

        //contador de registros para busqueda por mes
        $sql_total_registros = $conexion->query("SELECT COUNT(*) AS total_registros FROM control_negativas WHERE id_estatus = '2'");
        $total_registros = $sql_total_registros->fetch_assoc()['total_registros'];



    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color:gray; ">

            <p style="color:#42ca07; ">
                <?php
                echo "TOTAL DE NEGATIVAS: $total_registros";


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


                    <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->

                    <?php
                    include "tablas/tabla_cabecera_negativas_admin.php";
                    ?>




                </tr>
            </thead>

            <tbody>
                <?php
                while ($datos =  $sql_buscar_NEGATIVAS_por_fecha->fetch_object()) { ?>

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

        } else { ?>
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
                        while ($datos =  $sql_buscar_NEGATIVAS_por_fecha->fetch_object()) { ?>



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


                    <!-- por ultimo se carga el footer -->
                    <?php require('./layout/footer.php'); ?>