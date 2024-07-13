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

    <h4 style="margin-bottom: 5%;" class="text-center text-secondery">NEGATIVAS - ESTADISTICOS GENERALES </h4>

    <?php
    //hacemos la conexion
    include "../modelo/conexion.php";


    ?>



    <a href="estadisticos_negativas.php" class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-solid fa-caret-left"></i>
        ATRAS</a>

    <!-- <a href="solicitud_mismo_servicio_manuales.php" class="btn btn-info btn-rounded mb-3 otro">
        VER POR SOLICITUDES DOBLES <i class="fa-solid fa-repeat"></i></a> -->

    <?php










    // ----------INICIO DE CONDICIONES PARA SELECCIONAR QUE TIPO DE FILTRO DE BUSQUEDA SE ESTA SELECCIONANDO (MES, 6MESES, AÑO O PERSONALIZADO)------------------------------------------------------------------------------------------------------------------------------------------

    if ($_SESSION["fechainicio"] != null &&  $_SESSION["fechafin"] != null) {

        $FECHAINICIO = $_SESSION["fechainicio"];
        $FECHAFIN = $_SESSION["fechafin"];




        //SE HACE LA CONSULTA PARA SABER EL TOTAL DE VECES QUE UNA AGENCIA PARTICIPA EN UN MOTIVO DE CORRECCION EN ESPECIFICO EN UN INTERVALO DE TIEMPO ESPECIFICO







        // Array con las agencias de interés
        $agencias = array('A', 'B', 'C', 'D', 'E', 'G', 'H', 'J', 'K', 'M');

        // Inicializar variable para el total general de agencias--------------------------------------------
        $total_agencias = 0;
        $total_agenciasOMA = 0;
        $total_agenciasEMFA = 0;
        $total_agenciasEL2 = 0;
        $total_agenciasCM = 0;
        $total_agenciasEAMA = 0;
        $total_agenciasLANG = 0;
        $total_agenciasFAE = 0;
        $total_agenciasTEFA = 0;

        //para la suma individual de las agencias
        $suma_total_agencias = 0;


        // Inicializar un array para almacenar los totales de cada agencia---------------------------------
        $totales_por_agencia = array();
        $totales_por_agenciaOMA = array();
        $totales_por_agenciaEMFA = array();
        $totales_por_agenciaEL2 = array();
        $totales_por_agenciaCM = array();
        $totales_por_agenciaEAMA = array();
        $totales_por_agenciaLANG = array();
        $totales_por_agenciaFAE = array();
        $totales_por_agenciaTEFA = array();

        // Inicializar un array para almacenar los totales por agencia
        $total_por_agencia_global = array();
        //ARRAYS PARA LOS RPE AUXILIARES
        $rpe_por_agencia = array();
        $rpe_por_agencia_OMA = array();
        $rpe_por_agencia_EMFA = array();
        $rpe_por_agencia_EL2 = array();
        $rpe_por_agencia_CM = array();
        $rpe_por_agencia_EAMA = array();
        $rpe_por_agencia_LANG = array();
        $rpe_por_agencia_FAE = array();
        $rpe_por_agencia_TEFA = array();






        // CONSULTAS SQL para obtener el número de veces que cada agencia aparece-------------------------------------------------------------------------------
        foreach ($agencias as $agencia) {


            //CONSULTA PARA  ERROR EN LA TOMA DE LECTURA ANTERIOR------------------------------------------------
            $sql = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN LA TOMA DE LECTURA ANTERIOR')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN  ERROR EN LA TOMA DE LECTURA ANTERIOR -
            $sql_rpe = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN LA TOMA DE LECTURA ANTERIOR')) 
                AND DATE(fecha_captura) BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";

            //CONSULTA PARA ORDEN DE MEDICION ATENDIDA -----------------------------------------------------
            // $sql_LR 
            $sql_OMA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ORDEN DE MEDICION ATENDIDA')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";

            //CONSULTA PARA RPE AUXILIARES EN ORDEN DE MEDICION ATENDIDA -
            $sql_rpe_OMA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ORDEN DE MEDICION ATENDIDA')) 
                AND DATE(fecha_captura) BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CONSULTA ESTIMACION MAYOR EN FACT ANTERIOR ---------------------------------------------------
            // $sql_ASA
            $sql_EMFA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                       control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ESTIMACION MAYOR EN FACT ANTERIOR')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";

            //CONSULTA PARA RPE AUXILIARES EN ESTIMACION MAYOR EN FACT ANTERIOR-
            $sql_rpe_EMFA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ESTIMACION MAYOR EN FACT ANTERIOR')) 
                AND DATE(fecha_captura) BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CONSULTA ERROR LOTE 23NU ---------------------------------------------------------------------
            // $sql_MSR

            $sql_EL2 = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                       control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR LOTE 23NU')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR LOTE 23NU-
            $sql_rpe_EL2 = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR LOTE 23NU')) 
                AND DATE(fecha_captura) BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CAMBIO DE MEDIDOR ----------------------------------------------------------------------------
            // $sql_ECA

            $sql_CM = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('CAMBIO DE MEDIDOR')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN CAMBIO DE MEDIDOR-
            $sql_rpe_CM = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('CAMBIO DE MEDIDOR')) 
                AND DATE(fecha_captura) BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";



            // ERROR EN ANALISIS DE MANUAL ANTERIOR ----------------------------------------------------------
            // $sql_MD

            $sql_EAMA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN ANALISIS DE MANUAL ANTERIOR')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR EN ANALISIS DE MANUAL ANTERIOR-
            $sql_rpe_EAMA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN ANALISIS DE MANUAL ANTERIOR')) 
                AND DATE(fecha_captura) BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            // LECTURA ACUMULADA CON NA GENERADA --------------------------------------------------------------
            // $sql_CDFP

            $sql_LANG = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('LECTURA ACUMULADA CON NA GENERADA')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN LECTURA ACUMULADA CON NA GENERADA-
            $sql_rpe_LANG = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('LECTURA ACUMULADA CON NA GENERADA')) 
                AND DATE(fecha_captura) BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            // FINIQUITO ANTERIOR ERRONEO -----------------------------------------------------------------------
            // $sql_CD

            $sql_FAE = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('FINIQUITO ANTERIOR ERRONEO')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN FINIQUITO ANTERIOR ERRONEO-
            $sql_rpe_FAE = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('FINIQUITO ANTERIOR ERRONEO')) 
                AND DATE(fecha_captura) BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";



            // TELEMEDICION ERRONEA FACT ANTERIOR ---------------------------------------------------------------------
            // $sql_ELT

            $sql_TEFA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('TELEMEDICION ERRONEA FACT ANTERIOR')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN TELEMEDICION ERRONEA FACT ANTERIOR-
            $sql_rpe_TEFA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('TELEMEDICION ERRONEA FACT ANTERIOR')) 
                AND DATE(fecha_captura) BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";









            //--------------------------------------------ESCRIBIR VARIABLES POR CADA NUEVA CONSULTA-------------------------------------------------


            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);
            $resultado_OMA = mysqli_query($conexion, $sql_OMA);
            $resultado_EMFA = mysqli_query($conexion, $sql_EMFA);
            $resultado_EL2 = mysqli_query($conexion, $sql_EL2);
            $resultado_CM = mysqli_query($conexion, $sql_CM);
            $resultado_EAMA = mysqli_query($conexion, $sql_EAMA);
            $resultado_LANG = mysqli_query($conexion, $sql_LANG);
            $resultado_FAE = mysqli_query($conexion, $sql_FAE);
            $resultado_TEFA = mysqli_query($conexion, $sql_TEFA);
            // Ejecutar la consulta RPE AUXILIARES
            $resultado_rpe = mysqli_query($conexion, $sql_rpe);
            $resultado_rpe_OMA = mysqli_query($conexion, $sql_rpe_OMA);
            $resultado_rpe_EMFA = mysqli_query($conexion, $sql_rpe_EMFA);
            $resultado_rpe_EL2 = mysqli_query($conexion, $sql_rpe_EL2);
            $resultado_rpe_CM = mysqli_query($conexion, $sql_rpe_CM);
            $resultado_rpe_EAMA = mysqli_query($conexion, $sql_rpe_EAMA);
            $resultado_rpe_LANG = mysqli_query($conexion, $sql_rpe_LANG);
            $resultado_rpe_FAE = mysqli_query($conexion, $sql_rpe_FAE);
            $resultado_rpe_TEFA = mysqli_query($conexion, $sql_rpe_TEFA);












            // Verificar si la consulta fue exitosa
            if ($resultado) {

                //----------------------------------------------Motivo ERROR EN LA TOMA DE LECTURA ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $fila = mysqli_fetch_assoc($resultado);
                $total_veces = $fila['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agencia[$agencia] = $total_veces;

                // Sumar al total general
                $total_agencias += $total_veces;

                // Asignar el valor a una variable dinámicamente
                ${"total_" . $agencia} = $total_veces;




                //----------------------------------------------RPE AUXILIARES PARA ERROR EN LA TOMA DE LECTURA ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar = $fila['rpe_auxiliar'];
                    $total_veces_ETL_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia += $total_veces_ETL_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia[$rpe_auxiliar] = $total_veces_ETL_RPE;
                }



                // // Almacenar el total de veces para esta agencia
                // $totales_por_agencia[$agencia] = $total_agencia;
                // // $total_agencias_rpe += $total_agencia;

                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia[$agencia] = $rpe_agencia;


                //----------------------------------------------Motivo ORDEN DE MEDICION ATENDIDA ------------------------------------------------


                // Obtener el resultado
                $filaOMA = mysqli_fetch_assoc($resultado_OMA);
                $total_vecesOMA = $filaOMA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaOMA[$agencia] = $total_vecesOMA;

                // Sumar al total general
                $total_agenciasOMA += $total_vecesOMA;

                // Asignar el valor a una variable dinámicamente
                ${"total_OMA" . $agencia} = $total_vecesOMA;



                //----------------------------------------------RPE AUXILIARES PARA ERROR EN ORDEN DE MEDICION ATENDIDA 



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeOMA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_OMA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_OMA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_OMA = $fila['rpe_auxiliar'];
                    $total_veces_OMA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeOMA += $total_veces_OMA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_OMA[$rpe_auxiliar_OMA] = $total_veces_OMA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_OMA[$agencia] = $rpe_agencia_OMA;


                //fin consulta 2


                //----------------------------------------------Motivo  ESTIMACION MAYOR EN FACT ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaEMFA = mysqli_fetch_assoc($resultado_EMFA);
                $total_vecesEMFA = $filaEMFA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEMFA[$agencia] = $total_vecesEMFA;

                // Sumar al total general
                $total_agenciasEMFA += $total_vecesEMFA;

                // Asignar el valor a una variable dinámicamente
                ${"total_EMFA" . $agencia} = $total_vecesEMFA;


                //----------------------------------------------RPE AUXILIARES PARA ESTIMACION MAYOR EN FACT ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEMFA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EMFA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EMFA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EMFA = $fila['rpe_auxiliar'];
                    $total_veces_EMFA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEMFA += $total_veces_EMFA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EMFA[$rpe_auxiliar_EMFA] = $total_veces_EMFA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EMFA[$agencia] = $rpe_agencia_EMFA;


                //fin consulta 3


                //----------------------------------------------Motivo ERROR LOTE 23NU-------------------------------------------------

                // Obtener el resultado
                $filaEL2 = mysqli_fetch_assoc($resultado_EL2);
                $total_vecesEL2 = $filaEL2['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEL2[$agencia] = $total_vecesEL2;

                // Sumar al total general
                $total_agenciasEL2 += $total_vecesEL2;

                // Asignar el valor a una variable dinámicamente
                ${"total_EL2" . $agencia} = $total_vecesEL2;


                //----------------------------------------------RPE AUXILIARES PARA ERROR LOTE 23NU



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEL2 = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EL2 = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EL2)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EL2 = $fila['rpe_auxiliar'];
                    $total_veces_EL2_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEL2 += $total_veces_EL2_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EL2[$rpe_auxiliar_EL2] = $total_veces_EL2_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EL2[$agencia] = $rpe_agencia_EL2;


                //fin consulta 4



                //----------------------------------------------Motivo CAMBIO DE MEDIDOR -------------------------------------------------

                // Obtener el resultado
                $filaCM = mysqli_fetch_assoc($resultado_CM);
                $total_vecesCM = $filaCM['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCM[$agencia] = $total_vecesCM;

                // Sumar al total general
                $total_agenciasCM += $total_vecesCM;

                // Asignar el valor a una variable dinámicamente
                ${"total_CM" . $agencia} = $total_vecesCM;


                //----------------------------------------------RPE AUXILIARES PARA CAMBIO DE MEDIDOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeCM = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_CM = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_CM)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_CM = $fila['rpe_auxiliar'];
                    $total_veces_CM_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeCM += $total_veces_CM_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_CM[$rpe_auxiliar_CM] = $total_veces_CM_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_CM[$agencia] = $rpe_agencia_CM;


                //fin consulta 5


                //----------------------------------------------Motivo ERROR EN ANALISIS DE MANUAL ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaEAMA = mysqli_fetch_assoc($resultado_EAMA);
                $total_vecesEAMA = $filaEAMA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEAMA[$agencia] = $total_vecesEAMA;

                // Sumar al total general
                $total_agenciasEAMA += $total_vecesEAMA;

                // Asignar el valor a una variable dinámicamente
                ${"total_EAMA" . $agencia} = $total_vecesEAMA;



                //----------------------------------------------RPE AUXILIARES PARA ANALISIS DE MANUAL ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEAMA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EAMA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EAMA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EAMA = $fila['rpe_auxiliar'];
                    $total_veces_EAMA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEAMA += $total_veces_EAMA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EAMA[$rpe_auxiliar_EAMA] = $total_veces_EAMA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EAMA[$agencia] = $rpe_agencia_EAMA;


                //fin consulta 6


                //----------------------------------------------Motivo LECTURA ACUMULADA CON NA GENERADA-------------------------------------------------

                // Obtener el resultado
                $filaLANG = mysqli_fetch_assoc($resultado_LANG);
                $total_vecesLANG = $filaLANG['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaLANG[$agencia] = $total_vecesLANG;

                // Sumar al total general
                $total_agenciasLANG += $total_vecesLANG;

                // Asignar el valor a una variable dinámicamente
                ${"total_LANG" . $agencia} = $total_vecesLANG;

                //----------------------------------------------RPE AUXILIARES PARA LECTURA ACUMULADA CON NA GENERADA



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeLANG = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_LANG = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_LANG)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_LANG = $fila['rpe_auxiliar'];
                    $total_veces_LANG_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeLANG += $total_veces_LANG_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_LANG[$rpe_auxiliar_LANG] = $total_veces_LANG_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_LANG[$agencia] = $rpe_agencia_LANG;





                //fin consulta 7



                //----------------------------------------------Motivo FINIQUITO ANTERIOR ERRONEO-------------------------------------------------

                // Obtener el resultado
                $filaFAE = mysqli_fetch_assoc($resultado_FAE);
                $total_vecesFAE = $filaFAE['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaFAE[$agencia] = $total_vecesFAE;

                // Sumar al total general
                $total_agenciasFAE += $total_vecesFAE;

                // Asignar el valor a una variable dinámicamente
                ${"total_FAE" . $agencia} = $total_vecesFAE;

                //----------------------------------------------RPE AUXILIARES PARA FINIQUITO ANTERIOR ERRONEO



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeFAE = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_FAE = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_FAE)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_FAE = $fila['rpe_auxiliar'];
                    $total_veces_FAE_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeFAE += $total_veces_FAE_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_FAE[$rpe_auxiliar_FAE] = $total_veces_FAE_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_FAE[$agencia] = $rpe_agencia_FAE;


                //fin consulta 8



                //----------------------------------------------Motivo TELEMEDICION ERRONEA FACT ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaTEFA = mysqli_fetch_assoc($resultado_TEFA);
                $total_vecesTEFA = $filaTEFA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaTEFA[$agencia] = $total_vecesTEFA;

                // Sumar al total general
                $total_agenciasTEFA += $total_vecesTEFA;

                // Asignar el valor a una variable dinámicamente
                ${"total_TEFA" . $agencia} = $total_vecesTEFA;



                //----------------------------------------------RPE AUXILIARES PARA TELEMEDICION ERRONEA FACT ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeTEFA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_TEFA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_TEFA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_TEFA = $fila['rpe_auxiliar'];
                    $total_veces_TEFA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeTEFA += $total_veces_TEFA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_TEFA[$rpe_auxiliar_TEFA] = $total_veces_TEFA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_TEFA[$agencia] = $rpe_agencia_TEFA;


                //fin consulta 9










                // SUMAS TOTALES POR AGENCIA (NO POR MOTIVO)---------------------------------------------------------------------------------------



                // Ejemplo hipotético para la variable total_agencia_por_motivo_A
                $total_agencia_por_motivo = $totales_por_agencia[$agencia] + $totales_por_agenciaOMA[$agencia] + $totales_por_agenciaEMFA[$agencia] + $totales_por_agenciaEL2[$agencia] + $totales_por_agenciaCM[$agencia] + $totales_por_agenciaEAMA[$agencia] + $totales_por_agenciaLANG[$agencia] + $totales_por_agenciaFAE[$agencia] + $totales_por_agenciaTEFA[$agencia];



                // Sumar al total global por agencia
                $total_por_agencia_global[$agencia] = $total_agencia_por_motivo;


                // Sumar al total global de todas las agencias
                $suma_total_agencias += $total_agencia_por_motivo;







                // echo $total_por_agencia_global['M'];
            } else {
                // Manejar el caso en el que la consulta falle
                echo "Error al ejecutar la consulta para la agencia $agencia: " . mysqli_error($conexion);
            }
        }

        // Ahora puedes utilizar el array $totales_por_agencia para acceder al número de veces que aparece cada agencia,
        // y la variable $total_agencias para obtener el total de todas las agencias.

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);








    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "FECHA SELECCIONADA: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>



    <?php



        #6
    } else if ($_SESSION["fecha_primermes"] != null &&  $_SESSION["fecha_sextomes"] != null) {

        $FECHAINICIO =  $_SESSION["fecha_primermes"];
        $FECHAFIN = $_SESSION["fecha_sextomes"];



        //SE HACE LA CONSULTA PARA SABER EL TOTAL DE VECES QUE UNA AGENCIA PARTICIPA EN UN MOTIVO EN ESPECIFICO EN UN INTERVALO DE TIEMPO ESPECIFICO




        // Array con las agencias de interés
        $agencias = array('A', 'B', 'C', 'D', 'E', 'G', 'H', 'J', 'K', 'M');

        // Inicializar variable para el total general de agencias--------------------------------------------
        $total_agencias = 0;
        $total_agenciasOMA = 0;
        $total_agenciasEMFA = 0;
        $total_agenciasEL2 = 0;
        $total_agenciasCM = 0;
        $total_agenciasEAMA = 0;
        $total_agenciasLANG = 0;
        $total_agenciasFAE = 0;
        $total_agenciasTEFA = 0;

        //para la suma individual de las agencias
        $suma_total_agencias = 0;


        // Inicializar un array para almacenar los totales de cada agencia---------------------------------
        $totales_por_agencia = array();
        $totales_por_agenciaOMA = array();
        $totales_por_agenciaEMFA = array();
        $totales_por_agenciaEL2 = array();
        $totales_por_agenciaCM = array();
        $totales_por_agenciaEAMA = array();
        $totales_por_agenciaLANG = array();
        $totales_por_agenciaFAE = array();
        $totales_por_agenciaTEFA = array();

        // Inicializar un array para almacenar los totales por agencia
        $total_por_agencia_global = array();
        //ARRAYS PARA LOS RPE AUXILIARES
        $rpe_por_agencia = array();
        $rpe_por_agencia_OMA = array();
        $rpe_por_agencia_EMFA = array();
        $rpe_por_agencia_EL2 = array();
        $rpe_por_agencia_CM = array();
        $rpe_por_agencia_EAMA = array();
        $rpe_por_agencia_LANG = array();
        $rpe_por_agencia_FAE = array();
        $rpe_por_agencia_TEFA = array();






        // CONSULTAS SQL para obtener el número de veces que cada agencia aparece-------------------------------------------------------------------------------
        foreach ($agencias as $agencia) {


            //CONSULTA PARA  ERROR EN LA TOMA DE LECTURA ANTERIOR------------------------------------------------
            $sql = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN LA TOMA DE LECTURA ANTERIOR')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                 AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN  ERROR EN LA TOMA DE LECTURA ANTERIOR -
            $sql_rpe = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN LA TOMA DE LECTURA ANTERIOR')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
         AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";

            //CONSULTA PARA ORDEN DE MEDICION ATENDIDA -----------------------------------------------------
            // $sql_LR 
            $sql_OMA = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ORDEN DE MEDICION ATENDIDA')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                 AND agencia = '$agencia'";

            //CONSULTA PARA RPE AUXILIARES EN ORDEN DE MEDICION ATENDIDA -
            $sql_rpe_OMA = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ORDEN DE MEDICION ATENDIDA')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
         AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";


            //CONSULTA ESTIMACION MAYOR EN FACT ANTERIOR ---------------------------------------------------
            // $sql_ASA
            $sql_EMFA = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ESTIMACION MAYOR EN FACT ANTERIOR')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                 AND agencia = '$agencia'";

            //CONSULTA PARA RPE AUXILIARES EN ESTIMACION MAYOR EN FACT ANTERIOR-
            $sql_rpe_EMFA = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ESTIMACION MAYOR EN FACT ANTERIOR')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
         AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";


            //CONSULTA ERROR LOTE 23NU ---------------------------------------------------------------------
            // $sql_MSR

            $sql_EL2 = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR LOTE 23NU')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                 AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR LOTE 23NU-
            $sql_rpe_EL2 = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR LOTE 23NU')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
         AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";


            //CAMBIO DE MEDIDOR ----------------------------------------------------------------------------
            // $sql_ECA

            $sql_CM = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('CAMBIO DE MEDIDOR')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                 AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN CAMBIO DE MEDIDOR-
            $sql_rpe_CM = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('CAMBIO DE MEDIDOR')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
         AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";



            // ERROR EN ANALISIS DE MANUAL ANTERIOR ----------------------------------------------------------
            // $sql_MD

            $sql_EAMA = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN ANALISIS DE MANUAL ANTERIOR')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                 AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR EN ANALISIS DE MANUAL ANTERIOR-
            $sql_rpe_EAMA = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN ANALISIS DE MANUAL ANTERIOR')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
         AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";


            // LECTURA ACUMULADA CON NA GENERADA --------------------------------------------------------------
            // $sql_CDFP

            $sql_LANG = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('LECTURA ACUMULADA CON NA GENERADA')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                 AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN LECTURA ACUMULADA CON NA GENERADA-
            $sql_rpe_LANG = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('LECTURA ACUMULADA CON NA GENERADA')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
         AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";


            // FINIQUITO ANTERIOR ERRONEO -----------------------------------------------------------------------
            // $sql_CD

            $sql_FAE = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('FINIQUITO ANTERIOR ERRONEO')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                 AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN FINIQUITO ANTERIOR ERRONEO-
            $sql_rpe_FAE = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('FINIQUITO ANTERIOR ERRONEO')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
         AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";



            // TELEMEDICION ERRONEA FACT ANTERIOR ---------------------------------------------------------------------
            // $sql_ELT

            $sql_TEFA = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('TELEMEDICION ERRONEA FACT ANTERIOR')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                 AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN TELEMEDICION ERRONEA FACT ANTERIOR-
            $sql_rpe_TEFA = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('TELEMEDICION ERRONEA FACT ANTERIOR')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
         AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";









            //--------------------------------------------ESCRIBIR VARIABLES POR CADA NUEVA CONSULTA-------------------------------------------------


            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);
            $resultado_OMA = mysqli_query($conexion, $sql_OMA);
            $resultado_EMFA = mysqli_query($conexion, $sql_EMFA);
            $resultado_EL2 = mysqli_query($conexion, $sql_EL2);
            $resultado_CM = mysqli_query($conexion, $sql_CM);
            $resultado_EAMA = mysqli_query($conexion, $sql_EAMA);
            $resultado_LANG = mysqli_query($conexion, $sql_LANG);
            $resultado_FAE = mysqli_query($conexion, $sql_FAE);
            $resultado_TEFA = mysqli_query($conexion, $sql_TEFA);
            // Ejecutar la consulta RPE AUXILIARES
            $resultado_rpe = mysqli_query($conexion, $sql_rpe);
            $resultado_rpe_OMA = mysqli_query($conexion, $sql_rpe_OMA);
            $resultado_rpe_EMFA = mysqli_query($conexion, $sql_rpe_EMFA);
            $resultado_rpe_EL2 = mysqli_query($conexion, $sql_rpe_EL2);
            $resultado_rpe_CM = mysqli_query($conexion, $sql_rpe_CM);
            $resultado_rpe_EAMA = mysqli_query($conexion, $sql_rpe_EAMA);
            $resultado_rpe_LANG = mysqli_query($conexion, $sql_rpe_LANG);
            $resultado_rpe_FAE = mysqli_query($conexion, $sql_rpe_FAE);
            $resultado_rpe_TEFA = mysqli_query($conexion, $sql_rpe_TEFA);












            // Verificar si la consulta fue exitosa
            if ($resultado) {

                //----------------------------------------------Motivo ERROR EN LA TOMA DE LECTURA ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $fila = mysqli_fetch_assoc($resultado);
                $total_veces = $fila['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agencia[$agencia] = $total_veces;

                // Sumar al total general
                $total_agencias += $total_veces;

                // Asignar el valor a una variable dinámicamente
                ${"total_" . $agencia} = $total_veces;




                //----------------------------------------------RPE AUXILIARES PARA ERROR EN LA TOMA DE LECTURA ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar = $fila['rpe_auxiliar'];
                    $total_veces_ETL_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia += $total_veces_ETL_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia[$rpe_auxiliar] = $total_veces_ETL_RPE;
                }



                // // Almacenar el total de veces para esta agencia
                // $totales_por_agencia[$agencia] = $total_agencia;
                // // $total_agencias_rpe += $total_agencia;

                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia[$agencia] = $rpe_agencia;


                //----------------------------------------------Motivo ORDEN DE MEDICION ATENDIDA ------------------------------------------------


                // Obtener el resultado
                $filaOMA = mysqli_fetch_assoc($resultado_OMA);
                $total_vecesOMA = $filaOMA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaOMA[$agencia] = $total_vecesOMA;

                // Sumar al total general
                $total_agenciasOMA += $total_vecesOMA;

                // Asignar el valor a una variable dinámicamente
                ${"total_OMA" . $agencia} = $total_vecesOMA;



                //----------------------------------------------RPE AUXILIARES PARA ERROR EN ORDEN DE MEDICION ATENDIDA 



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeOMA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_OMA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_OMA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_OMA = $fila['rpe_auxiliar'];
                    $total_veces_OMA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeOMA += $total_veces_OMA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_OMA[$rpe_auxiliar_OMA] = $total_veces_OMA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_OMA[$agencia] = $rpe_agencia_OMA;


                //fin consulta 2


                //----------------------------------------------Motivo  ESTIMACION MAYOR EN FACT ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaEMFA = mysqli_fetch_assoc($resultado_EMFA);
                $total_vecesEMFA = $filaEMFA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEMFA[$agencia] = $total_vecesEMFA;

                // Sumar al total general
                $total_agenciasEMFA += $total_vecesEMFA;

                // Asignar el valor a una variable dinámicamente
                ${"total_EMFA" . $agencia} = $total_vecesEMFA;


                //----------------------------------------------RPE AUXILIARES PARA ESTIMACION MAYOR EN FACT ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEMFA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EMFA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EMFA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EMFA = $fila['rpe_auxiliar'];
                    $total_veces_EMFA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEMFA += $total_veces_EMFA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EMFA[$rpe_auxiliar_EMFA] = $total_veces_EMFA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EMFA[$agencia] = $rpe_agencia_EMFA;


                //fin consulta 3


                //----------------------------------------------Motivo ERROR LOTE 23NU-------------------------------------------------

                // Obtener el resultado
                $filaEL2 = mysqli_fetch_assoc($resultado_EL2);
                $total_vecesEL2 = $filaEL2['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEL2[$agencia] = $total_vecesEL2;

                // Sumar al total general
                $total_agenciasEL2 += $total_vecesEL2;

                // Asignar el valor a una variable dinámicamente
                ${"total_EL2" . $agencia} = $total_vecesEL2;


                //----------------------------------------------RPE AUXILIARES PARA ERROR LOTE 23NU



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEL2 = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EL2 = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EL2)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EL2 = $fila['rpe_auxiliar'];
                    $total_veces_EL2_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEL2 += $total_veces_EL2_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EL2[$rpe_auxiliar_EL2] = $total_veces_EL2_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EL2[$agencia] = $rpe_agencia_EL2;


                //fin consulta 4



                //----------------------------------------------Motivo CAMBIO DE MEDIDOR -------------------------------------------------

                // Obtener el resultado
                $filaCM = mysqli_fetch_assoc($resultado_CM);
                $total_vecesCM = $filaCM['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCM[$agencia] = $total_vecesCM;

                // Sumar al total general
                $total_agenciasCM += $total_vecesCM;

                // Asignar el valor a una variable dinámicamente
                ${"total_CM" . $agencia} = $total_vecesCM;


                //----------------------------------------------RPE AUXILIARES PARA CAMBIO DE MEDIDOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeCM = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_CM = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_CM)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_CM = $fila['rpe_auxiliar'];
                    $total_veces_CM_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeCM += $total_veces_CM_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_CM[$rpe_auxiliar_CM] = $total_veces_CM_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_CM[$agencia] = $rpe_agencia_CM;


                //fin consulta 5


                //----------------------------------------------Motivo ERROR EN ANALISIS DE MANUAL ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaEAMA = mysqli_fetch_assoc($resultado_EAMA);
                $total_vecesEAMA = $filaEAMA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEAMA[$agencia] = $total_vecesEAMA;

                // Sumar al total general
                $total_agenciasEAMA += $total_vecesEAMA;

                // Asignar el valor a una variable dinámicamente
                ${"total_EAMA" . $agencia} = $total_vecesEAMA;



                //----------------------------------------------RPE AUXILIARES PARA ANALISIS DE MANUAL ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEAMA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EAMA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EAMA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EAMA = $fila['rpe_auxiliar'];
                    $total_veces_EAMA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEAMA += $total_veces_EAMA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EAMA[$rpe_auxiliar_EAMA] = $total_veces_EAMA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EAMA[$agencia] = $rpe_agencia_EAMA;


                //fin consulta 6


                //----------------------------------------------Motivo LECTURA ACUMULADA CON NA GENERADA-------------------------------------------------

                // Obtener el resultado
                $filaLANG = mysqli_fetch_assoc($resultado_LANG);
                $total_vecesLANG = $filaLANG['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaLANG[$agencia] = $total_vecesLANG;

                // Sumar al total general
                $total_agenciasLANG += $total_vecesLANG;

                // Asignar el valor a una variable dinámicamente
                ${"total_LANG" . $agencia} = $total_vecesLANG;

                //----------------------------------------------RPE AUXILIARES PARA LECTURA ACUMULADA CON NA GENERADA



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeLANG = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_LANG = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_LANG)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_LANG = $fila['rpe_auxiliar'];
                    $total_veces_LANG_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeLANG += $total_veces_LANG_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_LANG[$rpe_auxiliar_LANG] = $total_veces_LANG_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_LANG[$agencia] = $rpe_agencia_LANG;





                //fin consulta 7



                //----------------------------------------------Motivo FINIQUITO ANTERIOR ERRONEO-------------------------------------------------

                // Obtener el resultado
                $filaFAE = mysqli_fetch_assoc($resultado_FAE);
                $total_vecesFAE = $filaFAE['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaFAE[$agencia] = $total_vecesFAE;

                // Sumar al total general
                $total_agenciasFAE += $total_vecesFAE;

                // Asignar el valor a una variable dinámicamente
                ${"total_FAE" . $agencia} = $total_vecesFAE;

                //----------------------------------------------RPE AUXILIARES PARA FINIQUITO ANTERIOR ERRONEO



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeFAE = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_FAE = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_FAE)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_FAE = $fila['rpe_auxiliar'];
                    $total_veces_FAE_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeFAE += $total_veces_FAE_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_FAE[$rpe_auxiliar_FAE] = $total_veces_FAE_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_FAE[$agencia] = $rpe_agencia_FAE;


                //fin consulta 8



                //----------------------------------------------Motivo TELEMEDICION ERRONEA FACT ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaTEFA = mysqli_fetch_assoc($resultado_TEFA);
                $total_vecesTEFA = $filaTEFA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaTEFA[$agencia] = $total_vecesTEFA;

                // Sumar al total general
                $total_agenciasTEFA += $total_vecesTEFA;

                // Asignar el valor a una variable dinámicamente
                ${"total_TEFA" . $agencia} = $total_vecesTEFA;



                //----------------------------------------------RPE AUXILIARES PARA TELEMEDICION ERRONEA FACT ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeTEFA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_TEFA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_TEFA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_TEFA = $fila['rpe_auxiliar'];
                    $total_veces_TEFA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeTEFA += $total_veces_TEFA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_TEFA[$rpe_auxiliar_TEFA] = $total_veces_TEFA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_TEFA[$agencia] = $rpe_agencia_TEFA;


                //fin consulta 9










                // SUMAS TOTALES POR AGENCIA (NO POR MOTIVO)---------------------------------------------------------------------------------------



                // Ejemplo hipotético para la variable total_agencia_por_motivo_A
                $total_agencia_por_motivo = $totales_por_agencia[$agencia] + $totales_por_agenciaOMA[$agencia] + $totales_por_agenciaEMFA[$agencia] + $totales_por_agenciaEL2[$agencia] + $totales_por_agenciaCM[$agencia] + $totales_por_agenciaEAMA[$agencia] + $totales_por_agenciaLANG[$agencia] + $totales_por_agenciaFAE[$agencia] + $totales_por_agenciaTEFA[$agencia];



                // Sumar al total global por agencia
                $total_por_agencia_global[$agencia] = $total_agencia_por_motivo;


                // Sumar al total global de todas las agencias
                $suma_total_agencias += $total_agencia_por_motivo;







                // echo $total_por_agencia_global['M'];
            } else {
                // Manejar el caso en el que la consulta falle
                echo "Error al ejecutar la consulta para la agencia $agencia: " . mysqli_error($conexion);
            }
        }

        // Ahora puedes utilizar el array $totales_por_agencia para acceder al número de veces que aparece cada agencia,
        // y la variable $total_agencias para obtener el total de todas las agencias.

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);






    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "SEMESTRAL: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>


    <?php





        #6
    } else if ($_SESSION["fecha_año"] != null &&  $_SESSION["fecha_mesdoce"] != null) {


        $FECHAINICIO =  $_SESSION["fecha_año"];
        $FECHAFIN = $_SESSION["fecha_mesdoce"];




        //SE HACE LA CONSULTA PARA SABER EL TOTAL DE VECES QUE UNA AGENCIA PARTICIPA EN UN MOTIVO EN ESPECIFICO EN UN INTERVALO DE TIEMPO ESPECIFICO





        // Array con las agencias de interés
        $agencias = array('A', 'B', 'C', 'D', 'E', 'G', 'H', 'J', 'K', 'M');

        // Inicializar variable para el total general de agencias--------------------------------------------
        $total_agencias = 0;
        $total_agenciasOMA = 0;
        $total_agenciasEMFA = 0;
        $total_agenciasEL2 = 0;
        $total_agenciasCM = 0;
        $total_agenciasEAMA = 0;
        $total_agenciasLANG = 0;
        $total_agenciasFAE = 0;
        $total_agenciasTEFA = 0;

        //para la suma individual de las agencias
        $suma_total_agencias = 0;


        // Inicializar un array para almacenar los totales de cada agencia---------------------------------
        $totales_por_agencia = array();
        $totales_por_agenciaOMA = array();
        $totales_por_agenciaEMFA = array();
        $totales_por_agenciaEL2 = array();
        $totales_por_agenciaCM = array();
        $totales_por_agenciaEAMA = array();
        $totales_por_agenciaLANG = array();
        $totales_por_agenciaFAE = array();
        $totales_por_agenciaTEFA = array();

        // Inicializar un array para almacenar los totales por agencia
        $total_por_agencia_global = array();
        //ARRAYS PARA LOS RPE AUXILIARES
        $rpe_por_agencia = array();
        $rpe_por_agencia_OMA = array();
        $rpe_por_agencia_EMFA = array();
        $rpe_por_agencia_EL2 = array();
        $rpe_por_agencia_CM = array();
        $rpe_por_agencia_EAMA = array();
        $rpe_por_agencia_LANG = array();
        $rpe_por_agencia_FAE = array();
        $rpe_por_agencia_TEFA = array();






        // CONSULTAS SQL para obtener el número de veces que cada agencia aparece-------------------------------------------------------------------------------
        foreach ($agencias as $agencia) {


            //CONSULTA PARA  ERROR EN LA TOMA DE LECTURA ANTERIOR------------------------------------------------
            $sql = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN LA TOMA DE LECTURA ANTERIOR')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN  ERROR EN LA TOMA DE LECTURA ANTERIOR -
            $sql_rpe = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN LA TOMA DE LECTURA ANTERIOR')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";

            //CONSULTA PARA ORDEN DE MEDICION ATENDIDA -----------------------------------------------------
            // $sql_LR 
            $sql_OMA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ORDEN DE MEDICION ATENDIDA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";

            //CONSULTA PARA RPE AUXILIARES EN ORDEN DE MEDICION ATENDIDA -
            $sql_rpe_OMA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ORDEN DE MEDICION ATENDIDA')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CONSULTA ESTIMACION MAYOR EN FACT ANTERIOR ---------------------------------------------------
            // $sql_ASA
            $sql_EMFA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                       control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ESTIMACION MAYOR EN FACT ANTERIOR')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";

            //CONSULTA PARA RPE AUXILIARES EN ESTIMACION MAYOR EN FACT ANTERIOR-
            $sql_rpe_EMFA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ESTIMACION MAYOR EN FACT ANTERIOR')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CONSULTA ERROR LOTE 23NU ---------------------------------------------------------------------
            // $sql_MSR

            $sql_EL2 = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                       control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR LOTE 23NU')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR LOTE 23NU-
            $sql_rpe_EL2 = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR LOTE 23NU')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CAMBIO DE MEDIDOR ----------------------------------------------------------------------------
            // $sql_ECA

            $sql_CM = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('CAMBIO DE MEDIDOR')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN CAMBIO DE MEDIDOR-
            $sql_rpe_CM = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('CAMBIO DE MEDIDOR')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";



            // ERROR EN ANALISIS DE MANUAL ANTERIOR ----------------------------------------------------------
            // $sql_MD

            $sql_EAMA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN ANALISIS DE MANUAL ANTERIOR')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR EN ANALISIS DE MANUAL ANTERIOR-
            $sql_rpe_EAMA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN ANALISIS DE MANUAL ANTERIOR')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            // LECTURA ACUMULADA CON NA GENERADA --------------------------------------------------------------
            // $sql_CDFP

            $sql_LANG = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('LECTURA ACUMULADA CON NA GENERADA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN LECTURA ACUMULADA CON NA GENERADA-
            $sql_rpe_LANG = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('LECTURA ACUMULADA CON NA GENERADA')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            // FINIQUITO ANTERIOR ERRONEO -----------------------------------------------------------------------
            // $sql_CD

            $sql_FAE = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('FINIQUITO ANTERIOR ERRONEO')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN FINIQUITO ANTERIOR ERRONEO-
            $sql_rpe_FAE = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('FINIQUITO ANTERIOR ERRONEO')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";



            // TELEMEDICION ERRONEA FACT ANTERIOR ---------------------------------------------------------------------
            // $sql_ELT

            $sql_TEFA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('TELEMEDICION ERRONEA FACT ANTERIOR')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN TELEMEDICION ERRONEA FACT ANTERIOR-
            $sql_rpe_TEFA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('TELEMEDICION ERRONEA FACT ANTERIOR')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";









            //--------------------------------------------ESCRIBIR VARIABLES POR CADA NUEVA CONSULTA-------------------------------------------------


            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);
            $resultado_OMA = mysqli_query($conexion, $sql_OMA);
            $resultado_EMFA = mysqli_query($conexion, $sql_EMFA);
            $resultado_EL2 = mysqli_query($conexion, $sql_EL2);
            $resultado_CM = mysqli_query($conexion, $sql_CM);
            $resultado_EAMA = mysqli_query($conexion, $sql_EAMA);
            $resultado_LANG = mysqli_query($conexion, $sql_LANG);
            $resultado_FAE = mysqli_query($conexion, $sql_FAE);
            $resultado_TEFA = mysqli_query($conexion, $sql_TEFA);
            // Ejecutar la consulta RPE AUXILIARES
            $resultado_rpe = mysqli_query($conexion, $sql_rpe);
            $resultado_rpe_OMA = mysqli_query($conexion, $sql_rpe_OMA);
            $resultado_rpe_EMFA = mysqli_query($conexion, $sql_rpe_EMFA);
            $resultado_rpe_EL2 = mysqli_query($conexion, $sql_rpe_EL2);
            $resultado_rpe_CM = mysqli_query($conexion, $sql_rpe_CM);
            $resultado_rpe_EAMA = mysqli_query($conexion, $sql_rpe_EAMA);
            $resultado_rpe_LANG = mysqli_query($conexion, $sql_rpe_LANG);
            $resultado_rpe_FAE = mysqli_query($conexion, $sql_rpe_FAE);
            $resultado_rpe_TEFA = mysqli_query($conexion, $sql_rpe_TEFA);












            // Verificar si la consulta fue exitosa
            if ($resultado) {

                //----------------------------------------------Motivo ERROR EN LA TOMA DE LECTURA ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $fila = mysqli_fetch_assoc($resultado);
                $total_veces = $fila['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agencia[$agencia] = $total_veces;

                // Sumar al total general
                $total_agencias += $total_veces;

                // Asignar el valor a una variable dinámicamente
                ${"total_" . $agencia} = $total_veces;




                //----------------------------------------------RPE AUXILIARES PARA ERROR EN LA TOMA DE LECTURA ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar = $fila['rpe_auxiliar'];
                    $total_veces_ETL_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia += $total_veces_ETL_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia[$rpe_auxiliar] = $total_veces_ETL_RPE;
                }



                // // Almacenar el total de veces para esta agencia
                // $totales_por_agencia[$agencia] = $total_agencia;
                // // $total_agencias_rpe += $total_agencia;

                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia[$agencia] = $rpe_agencia;


                //----------------------------------------------Motivo ORDEN DE MEDICION ATENDIDA ------------------------------------------------


                // Obtener el resultado
                $filaOMA = mysqli_fetch_assoc($resultado_OMA);
                $total_vecesOMA = $filaOMA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaOMA[$agencia] = $total_vecesOMA;

                // Sumar al total general
                $total_agenciasOMA += $total_vecesOMA;

                // Asignar el valor a una variable dinámicamente
                ${"total_OMA" . $agencia} = $total_vecesOMA;



                //----------------------------------------------RPE AUXILIARES PARA ERROR EN ORDEN DE MEDICION ATENDIDA 



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeOMA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_OMA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_OMA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_OMA = $fila['rpe_auxiliar'];
                    $total_veces_OMA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeOMA += $total_veces_OMA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_OMA[$rpe_auxiliar_OMA] = $total_veces_OMA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_OMA[$agencia] = $rpe_agencia_OMA;


                //fin consulta 2


                //----------------------------------------------Motivo  ESTIMACION MAYOR EN FACT ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaEMFA = mysqli_fetch_assoc($resultado_EMFA);
                $total_vecesEMFA = $filaEMFA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEMFA[$agencia] = $total_vecesEMFA;

                // Sumar al total general
                $total_agenciasEMFA += $total_vecesEMFA;

                // Asignar el valor a una variable dinámicamente
                ${"total_EMFA" . $agencia} = $total_vecesEMFA;


                //----------------------------------------------RPE AUXILIARES PARA ESTIMACION MAYOR EN FACT ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEMFA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EMFA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EMFA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EMFA = $fila['rpe_auxiliar'];
                    $total_veces_EMFA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEMFA += $total_veces_EMFA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EMFA[$rpe_auxiliar_EMFA] = $total_veces_EMFA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EMFA[$agencia] = $rpe_agencia_EMFA;


                //fin consulta 3


                //----------------------------------------------Motivo ERROR LOTE 23NU-------------------------------------------------

                // Obtener el resultado
                $filaEL2 = mysqli_fetch_assoc($resultado_EL2);
                $total_vecesEL2 = $filaEL2['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEL2[$agencia] = $total_vecesEL2;

                // Sumar al total general
                $total_agenciasEL2 += $total_vecesEL2;

                // Asignar el valor a una variable dinámicamente
                ${"total_EL2" . $agencia} = $total_vecesEL2;


                //----------------------------------------------RPE AUXILIARES PARA ERROR LOTE 23NU



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEL2 = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EL2 = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EL2)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EL2 = $fila['rpe_auxiliar'];
                    $total_veces_EL2_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEL2 += $total_veces_EL2_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EL2[$rpe_auxiliar_EL2] = $total_veces_EL2_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EL2[$agencia] = $rpe_agencia_EL2;


                //fin consulta 4



                //----------------------------------------------Motivo CAMBIO DE MEDIDOR -------------------------------------------------

                // Obtener el resultado
                $filaCM = mysqli_fetch_assoc($resultado_CM);
                $total_vecesCM = $filaCM['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCM[$agencia] = $total_vecesCM;

                // Sumar al total general
                $total_agenciasCM += $total_vecesCM;

                // Asignar el valor a una variable dinámicamente
                ${"total_CM" . $agencia} = $total_vecesCM;


                //----------------------------------------------RPE AUXILIARES PARA CAMBIO DE MEDIDOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeCM = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_CM = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_CM)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_CM = $fila['rpe_auxiliar'];
                    $total_veces_CM_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeCM += $total_veces_CM_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_CM[$rpe_auxiliar_CM] = $total_veces_CM_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_CM[$agencia] = $rpe_agencia_CM;


                //fin consulta 5


                //----------------------------------------------Motivo ERROR EN ANALISIS DE MANUAL ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaEAMA = mysqli_fetch_assoc($resultado_EAMA);
                $total_vecesEAMA = $filaEAMA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEAMA[$agencia] = $total_vecesEAMA;

                // Sumar al total general
                $total_agenciasEAMA += $total_vecesEAMA;

                // Asignar el valor a una variable dinámicamente
                ${"total_EAMA" . $agencia} = $total_vecesEAMA;



                //----------------------------------------------RPE AUXILIARES PARA ANALISIS DE MANUAL ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEAMA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EAMA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EAMA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EAMA = $fila['rpe_auxiliar'];
                    $total_veces_EAMA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEAMA += $total_veces_EAMA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EAMA[$rpe_auxiliar_EAMA] = $total_veces_EAMA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EAMA[$agencia] = $rpe_agencia_EAMA;


                //fin consulta 6


                //----------------------------------------------Motivo LECTURA ACUMULADA CON NA GENERADA-------------------------------------------------

                // Obtener el resultado
                $filaLANG = mysqli_fetch_assoc($resultado_LANG);
                $total_vecesLANG = $filaLANG['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaLANG[$agencia] = $total_vecesLANG;

                // Sumar al total general
                $total_agenciasLANG += $total_vecesLANG;

                // Asignar el valor a una variable dinámicamente
                ${"total_LANG" . $agencia} = $total_vecesLANG;

                //----------------------------------------------RPE AUXILIARES PARA LECTURA ACUMULADA CON NA GENERADA



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeLANG = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_LANG = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_LANG)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_LANG = $fila['rpe_auxiliar'];
                    $total_veces_LANG_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeLANG += $total_veces_LANG_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_LANG[$rpe_auxiliar_LANG] = $total_veces_LANG_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_LANG[$agencia] = $rpe_agencia_LANG;





                //fin consulta 7



                //----------------------------------------------Motivo FINIQUITO ANTERIOR ERRONEO-------------------------------------------------

                // Obtener el resultado
                $filaFAE = mysqli_fetch_assoc($resultado_FAE);
                $total_vecesFAE = $filaFAE['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaFAE[$agencia] = $total_vecesFAE;

                // Sumar al total general
                $total_agenciasFAE += $total_vecesFAE;

                // Asignar el valor a una variable dinámicamente
                ${"total_FAE" . $agencia} = $total_vecesFAE;

                //----------------------------------------------RPE AUXILIARES PARA FINIQUITO ANTERIOR ERRONEO



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeFAE = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_FAE = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_FAE)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_FAE = $fila['rpe_auxiliar'];
                    $total_veces_FAE_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeFAE += $total_veces_FAE_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_FAE[$rpe_auxiliar_FAE] = $total_veces_FAE_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_FAE[$agencia] = $rpe_agencia_FAE;


                //fin consulta 8



                //----------------------------------------------Motivo TELEMEDICION ERRONEA FACT ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaTEFA = mysqli_fetch_assoc($resultado_TEFA);
                $total_vecesTEFA = $filaTEFA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaTEFA[$agencia] = $total_vecesTEFA;

                // Sumar al total general
                $total_agenciasTEFA += $total_vecesTEFA;

                // Asignar el valor a una variable dinámicamente
                ${"total_TEFA" . $agencia} = $total_vecesTEFA;



                //----------------------------------------------RPE AUXILIARES PARA TELEMEDICION ERRONEA FACT ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeTEFA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_TEFA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_TEFA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_TEFA = $fila['rpe_auxiliar'];
                    $total_veces_TEFA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeTEFA += $total_veces_TEFA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_TEFA[$rpe_auxiliar_TEFA] = $total_veces_TEFA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_TEFA[$agencia] = $rpe_agencia_TEFA;


                //fin consulta 9










                // SUMAS TOTALES POR AGENCIA (NO POR MOTIVO)---------------------------------------------------------------------------------------



                // Ejemplo hipotético para la variable total_agencia_por_motivo_A
                $total_agencia_por_motivo = $totales_por_agencia[$agencia] + $totales_por_agenciaOMA[$agencia] + $totales_por_agenciaEMFA[$agencia] + $totales_por_agenciaEL2[$agencia] + $totales_por_agenciaCM[$agencia] + $totales_por_agenciaEAMA[$agencia] + $totales_por_agenciaLANG[$agencia] + $totales_por_agenciaFAE[$agencia] + $totales_por_agenciaTEFA[$agencia];



                // Sumar al total global por agencia
                $total_por_agencia_global[$agencia] = $total_agencia_por_motivo;


                // Sumar al total global de todas las agencias
                $suma_total_agencias += $total_agencia_por_motivo;







                // echo $total_por_agencia_global['M'];
            } else {
                // Manejar el caso en el que la consulta falle
                echo "Error al ejecutar la consulta para la agencia $agencia: " . mysqli_error($conexion);
            }
        }

        // Ahora puedes utilizar el array $totales_por_agencia para acceder al número de veces que aparece cada agencia,
        // y la variable $total_agencias para obtener el total de todas las agencias.

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);






    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "ANUAL: $FECHAINICIO  -  $FECHAFIN";

            ?>
        </div>



    <?php




        #6
    } else if ($_SESSION["fechaxmes"] != null) {

        $FECHAINICIO =  $_SESSION["fechaxmes"];





        //SE HACE LA CONSULTA PARA SABER EL TOTAL DE VECES QUE UNA AGENCIA PARTICIPA EN UN MOTIVO EN ESPECIFICO EN UN INTERVALO DE TIEMPO ESPECIFICO




        // Array con las agencias de interés
        $agencias = array('A', 'B', 'C', 'D', 'E', 'G', 'H', 'J', 'K', 'M');

        // Inicializar variable para el total general de agencias--------------------------------------------
        $total_agencias = 0;
        $total_agenciasOMA = 0;
        $total_agenciasEMFA = 0;
        $total_agenciasEL2 = 0;
        $total_agenciasCM = 0;
        $total_agenciasEAMA = 0;
        $total_agenciasLANG = 0;
        $total_agenciasFAE = 0;
        $total_agenciasTEFA = 0;

        //para la suma individual de las agencias
        $suma_total_agencias = 0;


        // Inicializar un array para almacenar los totales de cada agencia---------------------------------
        $totales_por_agencia = array();
        $totales_por_agenciaOMA = array();
        $totales_por_agenciaEMFA = array();
        $totales_por_agenciaEL2 = array();
        $totales_por_agenciaCM = array();
        $totales_por_agenciaEAMA = array();
        $totales_por_agenciaLANG = array();
        $totales_por_agenciaFAE = array();
        $totales_por_agenciaTEFA = array();

        // Inicializar un array para almacenar los totales por agencia
        $total_por_agencia_global = array();
        //ARRAYS PARA LOS RPE AUXILIARES
        $rpe_por_agencia = array();
        $rpe_por_agencia_OMA = array();
        $rpe_por_agencia_EMFA = array();
        $rpe_por_agencia_EL2 = array();
        $rpe_por_agencia_CM = array();
        $rpe_por_agencia_EAMA = array();
        $rpe_por_agencia_LANG = array();
        $rpe_por_agencia_FAE = array();
        $rpe_por_agencia_TEFA = array();






        // CONSULTAS SQL para obtener el número de veces que cada agencia aparece-------------------------------------------------------------------------------
        foreach ($agencias as $agencia) {


            //CONSULTA PARA  ERROR EN LA TOMA DE LECTURA ANTERIOR------------------------------------------------
            $sql = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN LA TOMA DE LECTURA ANTERIOR')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                 AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN  ERROR EN LA TOMA DE LECTURA ANTERIOR -
            $sql_rpe = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN LA TOMA DE LECTURA ANTERIOR')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'        AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";

            //CONSULTA PARA ORDEN DE MEDICION ATENDIDA -----------------------------------------------------
            // $sql_LR 
            $sql_OMA = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ORDEN DE MEDICION ATENDIDA')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                 AND agencia = '$agencia'";

            //CONSULTA PARA RPE AUXILIARES EN ORDEN DE MEDICION ATENDIDA -
            $sql_rpe_OMA = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ORDEN DE MEDICION ATENDIDA')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'        AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";


            //CONSULTA ESTIMACION MAYOR EN FACT ANTERIOR ---------------------------------------------------
            // $sql_ASA
            $sql_EMFA = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ESTIMACION MAYOR EN FACT ANTERIOR')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                 AND agencia = '$agencia'";

            //CONSULTA PARA RPE AUXILIARES EN ESTIMACION MAYOR EN FACT ANTERIOR-
            $sql_rpe_EMFA = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ESTIMACION MAYOR EN FACT ANTERIOR')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'        AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";


            //CONSULTA ERROR LOTE 23NU ---------------------------------------------------------------------
            // $sql_MSR

            $sql_EL2 = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR LOTE 23NU')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                 AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR LOTE 23NU-
            $sql_rpe_EL2 = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR LOTE 23NU')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'        AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";


            //CAMBIO DE MEDIDOR ----------------------------------------------------------------------------
            // $sql_ECA

            $sql_CM = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('CAMBIO DE MEDIDOR')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                 AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN CAMBIO DE MEDIDOR-
            $sql_rpe_CM = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('CAMBIO DE MEDIDOR')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'        AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";



            // ERROR EN ANALISIS DE MANUAL ANTERIOR ----------------------------------------------------------
            // $sql_MD

            $sql_EAMA = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN ANALISIS DE MANUAL ANTERIOR')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                 AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR EN ANALISIS DE MANUAL ANTERIOR-
            $sql_rpe_EAMA = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN ANALISIS DE MANUAL ANTERIOR')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'        AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";


            // LECTURA ACUMULADA CON NA GENERADA --------------------------------------------------------------
            // $sql_CDFP

            $sql_LANG = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('LECTURA ACUMULADA CON NA GENERADA')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                 AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN LECTURA ACUMULADA CON NA GENERADA-
            $sql_rpe_LANG = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('LECTURA ACUMULADA CON NA GENERADA')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'        AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";


            // FINIQUITO ANTERIOR ERRONEO -----------------------------------------------------------------------
            // $sql_CD

            $sql_FAE = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('FINIQUITO ANTERIOR ERRONEO')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                 AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN FINIQUITO ANTERIOR ERRONEO-
            $sql_rpe_FAE = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('FINIQUITO ANTERIOR ERRONEO')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'        AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";



            // TELEMEDICION ERRONEA FACT ANTERIOR ---------------------------------------------------------------------
            // $sql_ELT

            $sql_TEFA = "SELECT 
                 COUNT(*) AS total_veces
             FROM 
                 control_negativas
             WHERE 
                 TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('TELEMEDICION ERRONEA FACT ANTERIOR')) 
                 AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                 AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN TELEMEDICION ERRONEA FACT ANTERIOR-
            $sql_rpe_TEFA = "SELECT 
         rpe_auxiliar,
         COUNT(*) AS total_veces
     FROM 
         control_negativas
     WHERE 
         TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('TELEMEDICION ERRONEA FACT ANTERIOR')) 
         AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'        AND agencia = '$agencia'
     GROUP BY 
         rpe_auxiliar";









            //--------------------------------------------ESCRIBIR VARIABLES POR CADA NUEVA CONSULTA-------------------------------------------------


            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);
            $resultado_OMA = mysqli_query($conexion, $sql_OMA);
            $resultado_EMFA = mysqli_query($conexion, $sql_EMFA);
            $resultado_EL2 = mysqli_query($conexion, $sql_EL2);
            $resultado_CM = mysqli_query($conexion, $sql_CM);
            $resultado_EAMA = mysqli_query($conexion, $sql_EAMA);
            $resultado_LANG = mysqli_query($conexion, $sql_LANG);
            $resultado_FAE = mysqli_query($conexion, $sql_FAE);
            $resultado_TEFA = mysqli_query($conexion, $sql_TEFA);
            // Ejecutar la consulta RPE AUXILIARES
            $resultado_rpe = mysqli_query($conexion, $sql_rpe);
            $resultado_rpe_OMA = mysqli_query($conexion, $sql_rpe_OMA);
            $resultado_rpe_EMFA = mysqli_query($conexion, $sql_rpe_EMFA);
            $resultado_rpe_EL2 = mysqli_query($conexion, $sql_rpe_EL2);
            $resultado_rpe_CM = mysqli_query($conexion, $sql_rpe_CM);
            $resultado_rpe_EAMA = mysqli_query($conexion, $sql_rpe_EAMA);
            $resultado_rpe_LANG = mysqli_query($conexion, $sql_rpe_LANG);
            $resultado_rpe_FAE = mysqli_query($conexion, $sql_rpe_FAE);
            $resultado_rpe_TEFA = mysqli_query($conexion, $sql_rpe_TEFA);












            // Verificar si la consulta fue exitosa
            if ($resultado) {

                //----------------------------------------------Motivo ERROR EN LA TOMA DE LECTURA ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $fila = mysqli_fetch_assoc($resultado);
                $total_veces = $fila['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agencia[$agencia] = $total_veces;

                // Sumar al total general
                $total_agencias += $total_veces;

                // Asignar el valor a una variable dinámicamente
                ${"total_" . $agencia} = $total_veces;




                //----------------------------------------------RPE AUXILIARES PARA ERROR EN LA TOMA DE LECTURA ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar = $fila['rpe_auxiliar'];
                    $total_veces_ETL_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia += $total_veces_ETL_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia[$rpe_auxiliar] = $total_veces_ETL_RPE;
                }



                // // Almacenar el total de veces para esta agencia
                // $totales_por_agencia[$agencia] = $total_agencia;
                // // $total_agencias_rpe += $total_agencia;

                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia[$agencia] = $rpe_agencia;


                //----------------------------------------------Motivo ORDEN DE MEDICION ATENDIDA ------------------------------------------------


                // Obtener el resultado
                $filaOMA = mysqli_fetch_assoc($resultado_OMA);
                $total_vecesOMA = $filaOMA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaOMA[$agencia] = $total_vecesOMA;

                // Sumar al total general
                $total_agenciasOMA += $total_vecesOMA;

                // Asignar el valor a una variable dinámicamente
                ${"total_OMA" . $agencia} = $total_vecesOMA;



                //----------------------------------------------RPE AUXILIARES PARA ERROR EN ORDEN DE MEDICION ATENDIDA 



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeOMA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_OMA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_OMA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_OMA = $fila['rpe_auxiliar'];
                    $total_veces_OMA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeOMA += $total_veces_OMA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_OMA[$rpe_auxiliar_OMA] = $total_veces_OMA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_OMA[$agencia] = $rpe_agencia_OMA;


                //fin consulta 2


                //----------------------------------------------Motivo  ESTIMACION MAYOR EN FACT ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaEMFA = mysqli_fetch_assoc($resultado_EMFA);
                $total_vecesEMFA = $filaEMFA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEMFA[$agencia] = $total_vecesEMFA;

                // Sumar al total general
                $total_agenciasEMFA += $total_vecesEMFA;

                // Asignar el valor a una variable dinámicamente
                ${"total_EMFA" . $agencia} = $total_vecesEMFA;


                //----------------------------------------------RPE AUXILIARES PARA ESTIMACION MAYOR EN FACT ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEMFA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EMFA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EMFA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EMFA = $fila['rpe_auxiliar'];
                    $total_veces_EMFA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEMFA += $total_veces_EMFA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EMFA[$rpe_auxiliar_EMFA] = $total_veces_EMFA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EMFA[$agencia] = $rpe_agencia_EMFA;


                //fin consulta 3


                //----------------------------------------------Motivo ERROR LOTE 23NU-------------------------------------------------

                // Obtener el resultado
                $filaEL2 = mysqli_fetch_assoc($resultado_EL2);
                $total_vecesEL2 = $filaEL2['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEL2[$agencia] = $total_vecesEL2;

                // Sumar al total general
                $total_agenciasEL2 += $total_vecesEL2;

                // Asignar el valor a una variable dinámicamente
                ${"total_EL2" . $agencia} = $total_vecesEL2;


                //----------------------------------------------RPE AUXILIARES PARA ERROR LOTE 23NU



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEL2 = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EL2 = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EL2)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EL2 = $fila['rpe_auxiliar'];
                    $total_veces_EL2_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEL2 += $total_veces_EL2_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EL2[$rpe_auxiliar_EL2] = $total_veces_EL2_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EL2[$agencia] = $rpe_agencia_EL2;


                //fin consulta 4



                //----------------------------------------------Motivo CAMBIO DE MEDIDOR -------------------------------------------------

                // Obtener el resultado
                $filaCM = mysqli_fetch_assoc($resultado_CM);
                $total_vecesCM = $filaCM['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCM[$agencia] = $total_vecesCM;

                // Sumar al total general
                $total_agenciasCM += $total_vecesCM;

                // Asignar el valor a una variable dinámicamente
                ${"total_CM" . $agencia} = $total_vecesCM;


                //----------------------------------------------RPE AUXILIARES PARA CAMBIO DE MEDIDOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeCM = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_CM = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_CM)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_CM = $fila['rpe_auxiliar'];
                    $total_veces_CM_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeCM += $total_veces_CM_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_CM[$rpe_auxiliar_CM] = $total_veces_CM_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_CM[$agencia] = $rpe_agencia_CM;


                //fin consulta 5


                //----------------------------------------------Motivo ERROR EN ANALISIS DE MANUAL ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaEAMA = mysqli_fetch_assoc($resultado_EAMA);
                $total_vecesEAMA = $filaEAMA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEAMA[$agencia] = $total_vecesEAMA;

                // Sumar al total general
                $total_agenciasEAMA += $total_vecesEAMA;

                // Asignar el valor a una variable dinámicamente
                ${"total_EAMA" . $agencia} = $total_vecesEAMA;



                //----------------------------------------------RPE AUXILIARES PARA ANALISIS DE MANUAL ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEAMA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EAMA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EAMA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EAMA = $fila['rpe_auxiliar'];
                    $total_veces_EAMA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEAMA += $total_veces_EAMA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EAMA[$rpe_auxiliar_EAMA] = $total_veces_EAMA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EAMA[$agencia] = $rpe_agencia_EAMA;


                //fin consulta 6


                //----------------------------------------------Motivo LECTURA ACUMULADA CON NA GENERADA-------------------------------------------------

                // Obtener el resultado
                $filaLANG = mysqli_fetch_assoc($resultado_LANG);
                $total_vecesLANG = $filaLANG['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaLANG[$agencia] = $total_vecesLANG;

                // Sumar al total general
                $total_agenciasLANG += $total_vecesLANG;

                // Asignar el valor a una variable dinámicamente
                ${"total_LANG" . $agencia} = $total_vecesLANG;

                //----------------------------------------------RPE AUXILIARES PARA LECTURA ACUMULADA CON NA GENERADA



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeLANG = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_LANG = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_LANG)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_LANG = $fila['rpe_auxiliar'];
                    $total_veces_LANG_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeLANG += $total_veces_LANG_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_LANG[$rpe_auxiliar_LANG] = $total_veces_LANG_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_LANG[$agencia] = $rpe_agencia_LANG;





                //fin consulta 7



                //----------------------------------------------Motivo FINIQUITO ANTERIOR ERRONEO-------------------------------------------------

                // Obtener el resultado
                $filaFAE = mysqli_fetch_assoc($resultado_FAE);
                $total_vecesFAE = $filaFAE['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaFAE[$agencia] = $total_vecesFAE;

                // Sumar al total general
                $total_agenciasFAE += $total_vecesFAE;

                // Asignar el valor a una variable dinámicamente
                ${"total_FAE" . $agencia} = $total_vecesFAE;

                //----------------------------------------------RPE AUXILIARES PARA FINIQUITO ANTERIOR ERRONEO



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeFAE = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_FAE = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_FAE)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_FAE = $fila['rpe_auxiliar'];
                    $total_veces_FAE_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeFAE += $total_veces_FAE_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_FAE[$rpe_auxiliar_FAE] = $total_veces_FAE_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_FAE[$agencia] = $rpe_agencia_FAE;


                //fin consulta 8



                //----------------------------------------------Motivo TELEMEDICION ERRONEA FACT ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaTEFA = mysqli_fetch_assoc($resultado_TEFA);
                $total_vecesTEFA = $filaTEFA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaTEFA[$agencia] = $total_vecesTEFA;

                // Sumar al total general
                $total_agenciasTEFA += $total_vecesTEFA;

                // Asignar el valor a una variable dinámicamente
                ${"total_TEFA" . $agencia} = $total_vecesTEFA;



                //----------------------------------------------RPE AUXILIARES PARA TELEMEDICION ERRONEA FACT ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeTEFA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_TEFA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_TEFA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_TEFA = $fila['rpe_auxiliar'];
                    $total_veces_TEFA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeTEFA += $total_veces_TEFA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_TEFA[$rpe_auxiliar_TEFA] = $total_veces_TEFA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_TEFA[$agencia] = $rpe_agencia_TEFA;


                //fin consulta 9










                // SUMAS TOTALES POR AGENCIA (NO POR MOTIVO)---------------------------------------------------------------------------------------



                // Ejemplo hipotético para la variable total_agencia_por_motivo_A
                $total_agencia_por_motivo = $totales_por_agencia[$agencia] + $totales_por_agenciaOMA[$agencia] + $totales_por_agenciaEMFA[$agencia] + $totales_por_agenciaEL2[$agencia] + $totales_por_agenciaCM[$agencia] + $totales_por_agenciaEAMA[$agencia] + $totales_por_agenciaLANG[$agencia] + $totales_por_agenciaFAE[$agencia] + $totales_por_agenciaTEFA[$agencia];



                // Sumar al total global por agencia
                $total_por_agencia_global[$agencia] = $total_agencia_por_motivo;


                // Sumar al total global de todas las agencias
                $suma_total_agencias += $total_agencia_por_motivo;







                // echo $total_por_agencia_global['M'];
            } else {
                // Manejar el caso en el que la consulta falle
                echo "Error al ejecutar la consulta para la agencia $agencia: " . mysqli_error($conexion);
            }
        }

        // Ahora puedes utilizar el array $totales_por_agencia para acceder al número de veces que aparece cada agencia,
        // y la variable $total_agencias para obtener el total de todas las agencias.

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);




    ?>
        <div style="text-align: center; margin:auto; font-weight:bolder; color: grey; ">
            <?php
            echo "FECHA POR MES: $FECHAINICIO";

            ?>
        </div>

        <?php


        ?>


    <?php



        #6


    } else {


        //ESTE ELSE ES PARA HACER LA BUSQUEDA DE ESTADISTICOS GENERAL, ES DECIR MOSTRARME TODA LA CANTIDAD DE 
        //REGISTROS, CANTIDADES Y LOS RESPONSABLES, TODO ESO EN TOTAL






        //SE HACE LA CONSULTA PARA SABER EL TOTAL DE VECES QUE UNA AGENCIA PARTICIPA EN UN MOTIVO EN ESPECIFICO EN UN INTERVALO DE TIEMPO ESPECIFICO





        // Array con las agencias de interés
        $agencias = array('A', 'B', 'C', 'D', 'E', 'G', 'H', 'J', 'K', 'M');

        // Inicializar variable para el total general de agencias--------------------------------------------
        $total_agencias = 0;
        $total_agenciasOMA = 0;
        $total_agenciasEMFA = 0;
        $total_agenciasEL2 = 0;
        $total_agenciasCM = 0;
        $total_agenciasEAMA = 0;
        $total_agenciasLANG = 0;
        $total_agenciasFAE = 0;
        $total_agenciasTEFA = 0;

        //para la suma individual de las agencias
        $suma_total_agencias = 0;


        // Inicializar un array para almacenar los totales de cada agencia---------------------------------
        $totales_por_agencia = array();
        $totales_por_agenciaOMA = array();
        $totales_por_agenciaEMFA = array();
        $totales_por_agenciaEL2 = array();
        $totales_por_agenciaCM = array();
        $totales_por_agenciaEAMA = array();
        $totales_por_agenciaLANG = array();
        $totales_por_agenciaFAE = array();
        $totales_por_agenciaTEFA = array();

        // Inicializar un array para almacenar los totales por agencia
        $total_por_agencia_global = array();
        //ARRAYS PARA LOS RPE AUXILIARES
        $rpe_por_agencia = array();
        $rpe_por_agencia_OMA = array();
        $rpe_por_agencia_EMFA = array();
        $rpe_por_agencia_EL2 = array();
        $rpe_por_agencia_CM = array();
        $rpe_por_agencia_EAMA = array();
        $rpe_por_agencia_LANG = array();
        $rpe_por_agencia_FAE = array();
        $rpe_por_agencia_TEFA = array();






        // CONSULTAS SQL para obtener el número de veces que cada agencia aparece-------------------------------------------------------------------------------
        foreach ($agencias as $agencia) {


            //CONSULTA PARA  ERROR EN LA TOMA DE LECTURA ANTERIOR------------------------------------------------
            $sql = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN LA TOMA DE LECTURA ANTERIOR')) 
                        
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN  ERROR EN LA TOMA DE LECTURA ANTERIOR -
            $sql_rpe = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN LA TOMA DE LECTURA ANTERIOR')) 
                
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";

            //CONSULTA PARA ORDEN DE MEDICION ATENDIDA -----------------------------------------------------
            // $sql_LR 
            $sql_OMA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ORDEN DE MEDICION ATENDIDA')) 
                       
                        AND agencia = '$agencia'";

            //CONSULTA PARA RPE AUXILIARES EN ORDEN DE MEDICION ATENDIDA -
            $sql_rpe_OMA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ORDEN DE MEDICION ATENDIDA')) 
                
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CONSULTA ESTIMACION MAYOR EN FACT ANTERIOR ---------------------------------------------------
            // $sql_ASA
            $sql_EMFA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                       control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ESTIMACION MAYOR EN FACT ANTERIOR')) 
                        
                        AND agencia = '$agencia'";

            //CONSULTA PARA RPE AUXILIARES EN ESTIMACION MAYOR EN FACT ANTERIOR-
            $sql_rpe_EMFA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ESTIMACION MAYOR EN FACT ANTERIOR')) 
                               AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CONSULTA ERROR LOTE 23NU ---------------------------------------------------------------------
            // $sql_MSR

            $sql_EL2 = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                       control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR LOTE 23NU')) 
                        
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR LOTE 23NU-
            $sql_rpe_EL2 = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR LOTE 23NU')) 
                               AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CAMBIO DE MEDIDOR ----------------------------------------------------------------------------
            // $sql_ECA

            $sql_CM = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('CAMBIO DE MEDIDOR')) 
                        
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN CAMBIO DE MEDIDOR-
            $sql_rpe_CM = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('CAMBIO DE MEDIDOR')) 
                               AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";



            // ERROR EN ANALISIS DE MANUAL ANTERIOR ----------------------------------------------------------
            // $sql_MD

            $sql_EAMA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN ANALISIS DE MANUAL ANTERIOR')) 
                        
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR EN ANALISIS DE MANUAL ANTERIOR-
            $sql_rpe_EAMA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('ERROR EN ANALISIS DE MANUAL ANTERIOR')) 
                               AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            // LECTURA ACUMULADA CON NA GENERADA --------------------------------------------------------------
            // $sql_CDFP

            $sql_LANG = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('LECTURA ACUMULADA CON NA GENERADA')) 
                        
                        AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN LECTURA ACUMULADA CON NA GENERADA-
            $sql_rpe_LANG = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('LECTURA ACUMULADA CON NA GENERADA')) 
                               AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            // FINIQUITO ANTERIOR ERRONEO -----------------------------------------------------------------------
            // $sql_CD

            $sql_FAE = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('FINIQUITO ANTERIOR ERRONEO')) 
                        
                        AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN FINIQUITO ANTERIOR ERRONEO-
            $sql_rpe_FAE = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('FINIQUITO ANTERIOR ERRONEO')) 
                               AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";



            // TELEMEDICION ERRONEA FACT ANTERIOR ---------------------------------------------------------------------
            // $sql_ELT

            $sql_TEFA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_negativas
                    WHERE 
                        TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('TELEMEDICION ERRONEA FACT ANTERIOR')) 
                        
                        AND agencia = '$agencia'";



            //CONSULTA PARA RPE AUXILIARES EN TELEMEDICION ERRONEA FACT ANTERIOR-
            $sql_rpe_TEFA = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_negativas
            WHERE 
                TRIM(UPPER(motivo_correccion)) = TRIM(UPPER('TELEMEDICION ERRONEA FACT ANTERIOR')) 
                               AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";









            //--------------------------------------------ESCRIBIR VARIABLES POR CADA NUEVA CONSULTA-------------------------------------------------


            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);
            $resultado_OMA = mysqli_query($conexion, $sql_OMA);
            $resultado_EMFA = mysqli_query($conexion, $sql_EMFA);
            $resultado_EL2 = mysqli_query($conexion, $sql_EL2);
            $resultado_CM = mysqli_query($conexion, $sql_CM);
            $resultado_EAMA = mysqli_query($conexion, $sql_EAMA);
            $resultado_LANG = mysqli_query($conexion, $sql_LANG);
            $resultado_FAE = mysqli_query($conexion, $sql_FAE);
            $resultado_TEFA = mysqli_query($conexion, $sql_TEFA);
            // Ejecutar la consulta RPE AUXILIARES
            $resultado_rpe = mysqli_query($conexion, $sql_rpe);
            $resultado_rpe_OMA = mysqli_query($conexion, $sql_rpe_OMA);
            $resultado_rpe_EMFA = mysqli_query($conexion, $sql_rpe_EMFA);
            $resultado_rpe_EL2 = mysqli_query($conexion, $sql_rpe_EL2);
            $resultado_rpe_CM = mysqli_query($conexion, $sql_rpe_CM);
            $resultado_rpe_EAMA = mysqli_query($conexion, $sql_rpe_EAMA);
            $resultado_rpe_LANG = mysqli_query($conexion, $sql_rpe_LANG);
            $resultado_rpe_FAE = mysqli_query($conexion, $sql_rpe_FAE);
            $resultado_rpe_TEFA = mysqli_query($conexion, $sql_rpe_TEFA);












            // Verificar si la consulta fue exitosa
            if ($resultado) {

                //----------------------------------------------Motivo ERROR EN LA TOMA DE LECTURA ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $fila = mysqli_fetch_assoc($resultado);
                $total_veces = $fila['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agencia[$agencia] = $total_veces;

                // Sumar al total general
                $total_agencias += $total_veces;

                // Asignar el valor a una variable dinámicamente
                ${"total_" . $agencia} = $total_veces;




                //----------------------------------------------RPE AUXILIARES PARA ERROR EN LA TOMA DE LECTURA ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar = $fila['rpe_auxiliar'];
                    $total_veces_ETL_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia += $total_veces_ETL_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia[$rpe_auxiliar] = $total_veces_ETL_RPE;
                }



                // // Almacenar el total de veces para esta agencia
                // $totales_por_agencia[$agencia] = $total_agencia;
                // // $total_agencias_rpe += $total_agencia;

                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia[$agencia] = $rpe_agencia;


                //----------------------------------------------Motivo ORDEN DE MEDICION ATENDIDA ------------------------------------------------


                // Obtener el resultado
                $filaOMA = mysqli_fetch_assoc($resultado_OMA);
                $total_vecesOMA = $filaOMA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaOMA[$agencia] = $total_vecesOMA;

                // Sumar al total general
                $total_agenciasOMA += $total_vecesOMA;

                // Asignar el valor a una variable dinámicamente
                ${"total_OMA" . $agencia} = $total_vecesOMA;



                //----------------------------------------------RPE AUXILIARES PARA ERROR EN ORDEN DE MEDICION ATENDIDA 



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeOMA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_OMA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_OMA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_OMA = $fila['rpe_auxiliar'];
                    $total_veces_OMA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeOMA += $total_veces_OMA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_OMA[$rpe_auxiliar_OMA] = $total_veces_OMA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_OMA[$agencia] = $rpe_agencia_OMA;


                //fin consulta 2


                //----------------------------------------------Motivo  ESTIMACION MAYOR EN FACT ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaEMFA = mysqli_fetch_assoc($resultado_EMFA);
                $total_vecesEMFA = $filaEMFA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEMFA[$agencia] = $total_vecesEMFA;

                // Sumar al total general
                $total_agenciasEMFA += $total_vecesEMFA;

                // Asignar el valor a una variable dinámicamente
                ${"total_EMFA" . $agencia} = $total_vecesEMFA;


                //----------------------------------------------RPE AUXILIARES PARA ESTIMACION MAYOR EN FACT ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEMFA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EMFA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EMFA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EMFA = $fila['rpe_auxiliar'];
                    $total_veces_EMFA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEMFA += $total_veces_EMFA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EMFA[$rpe_auxiliar_EMFA] = $total_veces_EMFA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EMFA[$agencia] = $rpe_agencia_EMFA;


                //fin consulta 3


                //----------------------------------------------Motivo ERROR LOTE 23NU-------------------------------------------------

                // Obtener el resultado
                $filaEL2 = mysqli_fetch_assoc($resultado_EL2);
                $total_vecesEL2 = $filaEL2['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEL2[$agencia] = $total_vecesEL2;

                // Sumar al total general
                $total_agenciasEL2 += $total_vecesEL2;

                // Asignar el valor a una variable dinámicamente
                ${"total_EL2" . $agencia} = $total_vecesEL2;


                //----------------------------------------------RPE AUXILIARES PARA ERROR LOTE 23NU



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEL2 = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EL2 = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EL2)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EL2 = $fila['rpe_auxiliar'];
                    $total_veces_EL2_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEL2 += $total_veces_EL2_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EL2[$rpe_auxiliar_EL2] = $total_veces_EL2_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EL2[$agencia] = $rpe_agencia_EL2;


                //fin consulta 4



                //----------------------------------------------Motivo CAMBIO DE MEDIDOR -------------------------------------------------

                // Obtener el resultado
                $filaCM = mysqli_fetch_assoc($resultado_CM);
                $total_vecesCM = $filaCM['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCM[$agencia] = $total_vecesCM;

                // Sumar al total general
                $total_agenciasCM += $total_vecesCM;

                // Asignar el valor a una variable dinámicamente
                ${"total_CM" . $agencia} = $total_vecesCM;


                //----------------------------------------------RPE AUXILIARES PARA CAMBIO DE MEDIDOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeCM = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_CM = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_CM)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_CM = $fila['rpe_auxiliar'];
                    $total_veces_CM_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeCM += $total_veces_CM_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_CM[$rpe_auxiliar_CM] = $total_veces_CM_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_CM[$agencia] = $rpe_agencia_CM;


                //fin consulta 5


                //----------------------------------------------Motivo ERROR EN ANALISIS DE MANUAL ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaEAMA = mysqli_fetch_assoc($resultado_EAMA);
                $total_vecesEAMA = $filaEAMA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaEAMA[$agencia] = $total_vecesEAMA;

                // Sumar al total general
                $total_agenciasEAMA += $total_vecesEAMA;

                // Asignar el valor a una variable dinámicamente
                ${"total_EAMA" . $agencia} = $total_vecesEAMA;



                //----------------------------------------------RPE AUXILIARES PARA ANALISIS DE MANUAL ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeEAMA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_EAMA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_EAMA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_EAMA = $fila['rpe_auxiliar'];
                    $total_veces_EAMA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeEAMA += $total_veces_EAMA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_EAMA[$rpe_auxiliar_EAMA] = $total_veces_EAMA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_EAMA[$agencia] = $rpe_agencia_EAMA;


                //fin consulta 6


                //----------------------------------------------Motivo LECTURA ACUMULADA CON NA GENERADA-------------------------------------------------

                // Obtener el resultado
                $filaLANG = mysqli_fetch_assoc($resultado_LANG);
                $total_vecesLANG = $filaLANG['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaLANG[$agencia] = $total_vecesLANG;

                // Sumar al total general
                $total_agenciasLANG += $total_vecesLANG;

                // Asignar el valor a una variable dinámicamente
                ${"total_LANG" . $agencia} = $total_vecesLANG;

                //----------------------------------------------RPE AUXILIARES PARA LECTURA ACUMULADA CON NA GENERADA



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeLANG = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_LANG = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_LANG)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_LANG = $fila['rpe_auxiliar'];
                    $total_veces_LANG_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeLANG += $total_veces_LANG_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_LANG[$rpe_auxiliar_LANG] = $total_veces_LANG_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_LANG[$agencia] = $rpe_agencia_LANG;





                //fin consulta 7



                //----------------------------------------------Motivo FINIQUITO ANTERIOR ERRONEO-------------------------------------------------

                // Obtener el resultado
                $filaFAE = mysqli_fetch_assoc($resultado_FAE);
                $total_vecesFAE = $filaFAE['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaFAE[$agencia] = $total_vecesFAE;

                // Sumar al total general
                $total_agenciasFAE += $total_vecesFAE;

                // Asignar el valor a una variable dinámicamente
                ${"total_FAE" . $agencia} = $total_vecesFAE;

                //----------------------------------------------RPE AUXILIARES PARA FINIQUITO ANTERIOR ERRONEO



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeFAE = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_FAE = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_FAE)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_FAE = $fila['rpe_auxiliar'];
                    $total_veces_FAE_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeFAE += $total_veces_FAE_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_FAE[$rpe_auxiliar_FAE] = $total_veces_FAE_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_FAE[$agencia] = $rpe_agencia_FAE;


                //fin consulta 8



                //----------------------------------------------Motivo TELEMEDICION ERRONEA FACT ANTERIOR-------------------------------------------------

                // Obtener el resultado
                $filaTEFA = mysqli_fetch_assoc($resultado_TEFA);
                $total_vecesTEFA = $filaTEFA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaTEFA[$agencia] = $total_vecesTEFA;

                // Sumar al total general
                $total_agenciasTEFA += $total_vecesTEFA;

                // Asignar el valor a una variable dinámicamente
                ${"total_TEFA" . $agencia} = $total_vecesTEFA;



                //----------------------------------------------RPE AUXILIARES PARA TELEMEDICION ERRONEA FACT ANTERIOR



                // Inicializar el total de veces para esta agencia
                // $total_agencias_rpe = 0;
                $total_agencia_rpeTEFA = 0;

                // Array para almacenar los RPE auxiliares y la cantidad de veces que aparecen
                $rpe_agencia_TEFA = array();

                // Recorrer los resultados de la consulta
                while ($fila = mysqli_fetch_assoc($resultado_rpe_TEFA)) {

                    // Obtener los datos de la fila
                    $rpe_auxiliar_TEFA = $fila['rpe_auxiliar'];
                    $total_veces_TEFA_RPE = $fila['total_veces'];


                    // Almacenar el total de veces para esta agencia
                    $total_agencia_rpeTEFA += $total_veces_TEFA_RPE;
                    // Almacenar los RPE auxiliares y la cantidad de veces que aparecen
                    $rpe_agencia_TEFA[$rpe_auxiliar_TEFA] = $total_veces_TEFA_RPE;
                }


                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia_TEFA[$agencia] = $rpe_agencia_TEFA;


                //fin consulta 9










                // SUMAS TOTALES POR AGENCIA (NO POR MOTIVO)---------------------------------------------------------------------------------------



                // Ejemplo hipotético para la variable total_agencia_por_motivo_A
                $total_agencia_por_motivo = $totales_por_agencia[$agencia] + $totales_por_agenciaOMA[$agencia] + $totales_por_agenciaEMFA[$agencia] + $totales_por_agenciaEL2[$agencia] + $totales_por_agenciaCM[$agencia] + $totales_por_agenciaEAMA[$agencia] + $totales_por_agenciaLANG[$agencia] + $totales_por_agenciaFAE[$agencia] + $totales_por_agenciaTEFA[$agencia];



                // Sumar al total global por agencia
                $total_por_agencia_global[$agencia] = $total_agencia_por_motivo;


                // Sumar al total global de todas las agencias
                $suma_total_agencias += $total_agencia_por_motivo;







                // echo $total_por_agencia_global['M'];
            } else {
                // Manejar el caso en el que la consulta falle
                echo "Error al ejecutar la consulta para la agencia $agencia: " . mysqli_error($conexion);
            }
        }

        // Ahora puedes utilizar el array $totales_por_agencia para acceder al número de veces que aparece cada agencia,
        // y la variable $total_agencias para obtener el total de todas las agencias.

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    }

    ?>



    <table class="table table-bordered table-hover w-100 " id="example">
        <thead>
            <tr>


                <th scope="col"></th>
                <th scope="col"></th>
                <th class="columna-resumen-color" class="columna-resumen" scope="col">A</th>
                <th class="columna-resumen-color" scope="col">B</th>
                <th class="columna-resumen-color" scope="col">C</th>
                <th class="columna-resumen-color" scope="col">D</th>
                <th class="columna-resumen-color" scope="col">E</th>
                <th class="columna-resumen-color" scope="col">G</th>
                <th class="columna-resumen-color" scope="col">H</th>
                <th class="columna-resumen-color" scope="col">J</th>
                <th class="columna-resumen-color" scope="col">K</th>
                <th class="columna-resumen-color" scope="col">M</th>
                <th class="columna-resumen-color" scope="col">TOTAL</th>

            </tr>
        </thead>



        <tbody>
            <!-- Filas para ERROR EN TOMA DE LECTURA -->
            <tr id="fila1">
                <th>ERROR EN LA TOMA DE LECTURA ANTERIOR

                </th>
                <td>
                    <a class="expandir-rpe" data-target="rpe-lectura-1"><i class="fa-solid fa-circle-chevron-down"></i></a>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;  text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agencias ?>
                </td>
            </tr>
            <!-- Filas para los RPE auxiliares de ERROR EN TOMA DE LECTURA -->
            <!-- Este será el código de la tabla a agregar -->
            <tr id="rpe-lectura-1-clonado" class="fila-rpe-auxiliares" style="display: none;">
                <td colspan="<?= count($agencias) + 2 ?>"> <!-- Colspan para que ocupe todas las columnas -->
                    <table class="table table-bordered table-hover w-100 ">

                        <tr id="header-row">
                            <th>RPE AUXILIAR</th>
                            <?php foreach ($agencias as $agencia) : ?>
                                <th><?= $agencia ?></th>
                            <?php endforeach; ?>
                            <th>TOTAL</th> <!-- Nueva columna para la suma total -->
                        </tr>

                        <tbody>
                            <?php
                            // Obtener todos los RPE auxiliares únicos
                            $rpes_unicos = [];
                            foreach ($rpe_por_agencia as $agencia_rpes) {
                                foreach ($agencia_rpes as $rpe_auxiliar => $total_veces) {
                                    $rpes_unicos[$rpe_auxiliar] = true;
                                }
                            }

                            // Mostrar los valores de participación para cada RPE auxiliar único
                            foreach ($rpes_unicos as $rpe_auxiliar => $_) {
                                echo "<tr><td>$rpe_auxiliar</td>";
                                $total_rpe = 0; // Inicializar la suma total para este RPE auxiliar
                                foreach ($agencias as $agencia) {
                                    // Obtener los valores de participación para esta agencia y este RPE auxiliar
                                    $participacion = isset($rpe_por_agencia[$agencia][$rpe_auxiliar]) ? $rpe_por_agencia[$agencia][$rpe_auxiliar] : 0;
                                    $total_rpe += $participacion; // Sumar al total del RPE
                                    echo "<td>$participacion</td>";
                                }
                                echo "<td style='color: greenyellow;  text-align: center;  background: #294835b2' class='celda'>$total_rpe</td>"; // Mostrar la suma total de participación para este RPE auxiliar
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- Añadir más filas para ORDEN DE MEDICION ATENDIDA -->
            <tr id="fila2">
                <th>ORDEN DE MEDICION ATENDIDA</th>
                <td>
                    <a class="expandir-rpe" data-target="rpe-lectura-2"><i class="fa-solid fa-circle-chevron-down"></i></a>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_OMA" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasOMA ?>
                </td>
            </tr>
            <!-- Filas para los RPE auxiliares de ORDEN DE MEDICION ATENDIDA-->
            <!-- Este será el código de la tabla a agregar -->
            <tr id="rpe-lectura-2-clonado" class="fila-rpe-auxiliares" style="display: none;">
                <td colspan="<?= count($agencias) + 2 ?>"> <!-- Colspan para que ocupe todas las columnas -->
                    <table class="table table-bordered table-hover w-100 ">

                        <tr id="header-row">
                            <th>RPE AUXILIAR</th>
                            <?php foreach ($agencias as $agencia) : ?>
                                <th><?= $agencia ?></th>
                            <?php endforeach; ?>
                            <th>TOTAL</th> <!-- Nueva columna para la suma total -->
                        </tr>

                        <tbody>
                            <?php
                            // Obtener todos los RPE auxiliares únicos
                            $rpes_unicos_OMA = [];
                            foreach ($rpe_por_agencia_OMA as $agencia_rpes_OMA) {
                                foreach ($agencia_rpes_OMA as $rpe_auxiliar_OMA => $total_vecesOMA) {
                                    $rpes_unicos_OMA[$rpe_auxiliar_OMA] = true;
                                }
                            }

                            // Mostrar los valores de participación para cada RPE auxiliar único
                            foreach ($rpes_unicos_OMA as $rpe_auxiliar_OMA => $_) {
                                echo "<tr><td>$rpe_auxiliar_OMA</td>";
                                $total_rpe_OMA = 0; // Inicializar la suma total para este RPE auxiliar
                                foreach ($agencias as $agencia) {
                                    // Obtener los valores de participación para esta agencia y este RPE auxiliar
                                    $participacion_OMA = isset($rpe_por_agencia_OMA[$agencia][$rpe_auxiliar_OMA]) ? $rpe_por_agencia_OMA[$agencia][$rpe_auxiliar_OMA] : 0;
                                    $total_rpe_OMA += $participacion_OMA; // Sumar al total del RPE
                                    echo "<td>$participacion_OMA</td>";
                                }
                                echo "<td style='color: greenyellow;  text-align: center;  background: #294835b2' class='celda'>$total_rpe_OMA</td>"; // Mostrar la suma total de participación para este RPE auxiliar
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Añadir más filas para ESTIMACION MAYOR EN FACT ANTERIOR-->
            <tr id="fila3">
                <th>ESTIMACION MAYOR EN FACT ANTERIOR</th>
                <td>
                    <a class="expandir-rpe" data-target="rpe-lectura-3"><i class="fa-solid fa-circle-chevron-down"></i></a>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_EMFA" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasEMFA ?>
                </td>
            </tr>

            <!-- Filas para los RPE auxiliares de ESTIMACION MAYOR EN FACT ANTERIOR-->
            <!-- Este será el código de la tabla a agregar -->
            <tr id="rpe-lectura-3-clonado" class="fila-rpe-auxiliares" style="display: none;">
                <td colspan="<?= count($agencias) + 2 ?>"> <!-- Colspan para que ocupe todas las columnas -->
                    <table class="table table-bordered table-hover w-100 ">

                        <tr id="header-row">
                            <th>RPE AUXILIAR</th>
                            <?php foreach ($agencias as $agencia) : ?>
                                <th><?= $agencia ?></th>
                            <?php endforeach; ?>
                            <th>TOTAL</th> <!-- Nueva columna para la suma total -->
                        </tr>

                        <tbody>
                            <?php
                            // Obtener todos los RPE auxiliares únicos
                            $rpes_unicos_EMFA = [];
                            foreach ($rpe_por_agencia_EMFA as $agencia_rpes_EMFA) {
                                foreach ($agencia_rpes_EMFA as $rpe_auxiliar_EMFA => $total_vecesEMFA) {
                                    $rpes_unicos_EMFA[$rpe_auxiliar_EMFA] = true;
                                }
                            }

                            // Mostrar los valores de participación para cada RPE auxiliar único
                            foreach ($rpes_unicos_EMFA as $rpe_auxiliar_EMFA => $_) {
                                echo "<tr><td>$rpe_auxiliar_EMFA</td>";
                                $total_rpe_EMFA = 0; // Inicializar la suma total para este RPE auxiliar
                                foreach ($agencias as $agencia) {
                                    // Obtener los valores de participación para esta agencia y este RPE auxiliar
                                    $participacion_EMFA = isset($rpe_por_agencia_EMFA[$agencia][$rpe_auxiliar_EMFA]) ? $rpe_por_agencia_EMFA[$agencia][$rpe_auxiliar_EMFA] : 0;
                                    $total_rpe_EMFA += $participacion_EMFA; // Sumar al total del RPE
                                    echo "<td>$participacion_EMFA</td>";
                                }
                                echo "<td style='color: greenyellow;  text-align: center;  background: #294835b2' class='celda'>$total_rpe_EMFA</td>"; // Mostrar la suma total de participación para este RPE auxiliar
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Añadir más filas para ERROR LOTE 23NU-->
            <tr id="fila4">
                <th>ERROR LOTE 23NU</th>
                <td>
                    <a class="expandir-rpe" data-target="rpe-lectura-4"><i class="fa-solid fa-circle-chevron-down"></i></a>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_EL2" . $agencia} ?>
                    </td>
                <?php endforeach; ?>

                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasEL2 ?>
                </td>
            </tr>

            <!-- Filas para los RPE auxiliares de ERROR LOTE 23NU-->
            <!-- Este será el código de la tabla a agregar -->
            <tr id="rpe-lectura-4-clonado" class="fila-rpe-auxiliares" style="display: none;">
                <td colspan="<?= count($agencias) + 2 ?>"> <!-- Colspan para que ocupe todas las columnas -->
                    <table class="table table-bordered table-hover w-100 ">

                        <tr id="header-row">
                            <th>RPE AUXILIAR</th>
                            <?php foreach ($agencias as $agencia) : ?>
                                <th><?= $agencia ?></th>
                            <?php endforeach; ?>
                            <th>TOTAL</th> <!-- Nueva columna para la suma total -->
                        </tr>

                        <tbody>
                            <?php
                            // Obtener todos los RPE auxiliares únicos
                            $rpes_unicos_EL2 = [];
                            foreach ($rpe_por_agencia_EL2 as $agencia_rpes_EL2) {
                                foreach ($agencia_rpes_EL2 as $rpe_auxiliar_EL2 => $total_vecesEL2) {
                                    $rpes_unicos_EL2[$rpe_auxiliar_EL2] = true;
                                }
                            }

                            // Mostrar los valores de participación para cada RPE auxiliar único
                            foreach ($rpes_unicos_EL2 as $rpe_auxiliar_EL2 => $_) {
                                echo "<tr><td>$rpe_auxiliar_EL2</td>";
                                $total_rpe_EL2 = 0; // Inicializar la suma total para este RPE auxiliar
                                foreach ($agencias as $agencia) {
                                    // Obtener los valores de participación para esta agencia y este RPE auxiliar
                                    $participacion_EL2 = isset($rpe_por_agencia_EL2[$agencia][$rpe_auxiliar_EL2]) ? $rpe_por_agencia_EL2[$agencia][$rpe_auxiliar_EL2] : 0;
                                    $total_rpe_EL2 += $participacion_EL2; // Sumar al total del RPE
                                    echo "<td>$participacion_EL2</td>";
                                }
                                echo "<td style='color: greenyellow;  text-align: center;  background: #294835b2' class='celda'>$total_rpe_EL2</td>"; // Mostrar la suma total de participación para este RPE auxiliar
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>


            <!-- Añadir más filas para CAMBIO DE MEDIDOR-->
            <tr id="fila5">
                <th>CAMBIO DE MEDIDOR</th>
                <td>
                    <a class="expandir-rpe" data-target="rpe-lectura-5"><i class="fa-solid fa-circle-chevron-down"></i></a>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_CM" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasCM ?>
                </td>
            </tr>

            <!-- Filas para los RPE auxiliares de CAMBIO DE MEDIDOR-->
            <!-- Este será el código de la tabla a agregar -->
            <tr id="rpe-lectura-5-clonado" class="fila-rpe-auxiliares" style="display: none;">
                <td colspan="<?= count($agencias) + 2 ?>"> <!-- Colspan para que ocupe todas las columnas -->
                    <table class="table table-bordered table-hover w-100 ">

                        <tr id="header-row">
                            <th>RPE AUXILIAR</th>
                            <?php foreach ($agencias as $agencia) : ?>
                                <th><?= $agencia ?></th>
                            <?php endforeach; ?>
                            <th>TOTAL</th> <!-- Nueva columna para la suma total -->
                        </tr>

                        <tbody>
                            <?php
                            // Obtener todos los RPE auxiliares únicos
                            $rpes_unicos_CM = [];
                            foreach ($rpe_por_agencia_CM as $agencia_rpes_CM) {
                                foreach ($agencia_rpes_CM as $rpe_auxiliar_CM => $total_vecesCM) {
                                    $rpes_unicos_CM[$rpe_auxiliar_CM] = true;
                                }
                            }

                            // Mostrar los valores de participación para cada RPE auxiliar único
                            foreach ($rpes_unicos_CM as $rpe_auxiliar_CM => $_) {
                                echo "<tr><td>$rpe_auxiliar_CM</td>";
                                $total_rpe_CM = 0; // Inicializar la suma total para este RPE auxiliar
                                foreach ($agencias as $agencia) {
                                    // Obtener los valores de participación para esta agencia y este RPE auxiliar
                                    $participacion_CM = isset($rpe_por_agencia_CM[$agencia][$rpe_auxiliar_CM]) ? $rpe_por_agencia_CM[$agencia][$rpe_auxiliar_CM] : 0;
                                    $total_rpe_CM += $participacion_CM; // Sumar al total del RPE
                                    echo "<td>$participacion_CM</td>";
                                }
                                echo "<td style='color: greenyellow;  text-align: center;  background: #294835b2' class='celda'>$total_rpe_CM</td>"; // Mostrar la suma total de participación para este RPE auxiliar
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>


            <!-- Añadir más filas para ERROR EN ANALISIS DE MANUAL ANTERIOR -->
            <tr id="fila6">
                <th>ERROR EN ANALISIS DE MANUAL ANTERIOR</th>
                <td>
                    <a class="expandir-rpe" data-target="rpe-lectura-6"><i class="fa-solid fa-circle-chevron-down"></i></a>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_EAMA" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasEAMA ?>
                </td>
            </tr>

            <!-- Filas para los RPE auxiliares de ERROR EN ANALISIS DE MANUAL ANTERIOR-->
            <!-- Este será el código de la tabla a agregar -->
            <tr id="rpe-lectura-6-clonado" class="fila-rpe-auxiliares" style="display: none;">
                <td colspan="<?= count($agencias) + 2 ?>"> <!-- Colspan para que ocupe todas las columnas -->
                    <table class="table table-bordered table-hover w-100 ">

                        <tr id="header-row">
                            <th>RPE AUXILIAR</th>
                            <?php foreach ($agencias as $agencia) : ?>
                                <th><?= $agencia ?></th>
                            <?php endforeach; ?>
                            <th>TOTAL</th> <!-- Nueva columna para la suma total -->
                        </tr>

                        <tbody>
                            <?php
                            // Obtener todos los RPE auxiliares únicos
                            $rpes_unicos_EAMA = [];
                            foreach ($rpe_por_agencia_EAMA as $agencia_rpes_EAMA) {
                                foreach ($agencia_rpes_EAMA as $rpe_auxiliar_EAMA => $total_vecesEAMA) {
                                    $rpes_unicos_EAMA[$rpe_auxiliar_EAMA] = true;
                                }
                            }

                            // Mostrar los valores de participación para cada RPE auxiliar único
                            foreach ($rpes_unicos_EAMA as $rpe_auxiliar_EAMA => $_) {
                                echo "<tr><td>$rpe_auxiliar_EAMA</td>";
                                $total_rpe_EAMA = 0; // Inicializar la suma total para este RPE auxiliar
                                foreach ($agencias as $agencia) {
                                    // Obtener los valores de participación para esta agencia y este RPE auxiliar
                                    $participacion_EAMA = isset($rpe_por_agencia_EAMA[$agencia][$rpe_auxiliar_EAMA]) ? $rpe_por_agencia_EAMA[$agencia][$rpe_auxiliar_EAMA] : 0;
                                    $total_rpe_EAMA += $participacion_EAMA; // Sumar al total del RPE
                                    echo "<td>$participacion_EAMA</td>";
                                }
                                echo "<td style='color: greenyellow;  text-align: center;  background: #294835b2' class='celda'>$total_rpe_EAMA</td>"; // Mostrar la suma total de participación para este RPE auxiliar
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Añadir más filas para LECTURA ACUMULADA CON NA GENERADA -->
            <tr id="fila7">
                <th>LECTURA ACUMULADA CON NA GENERADA</th>
                <td>
                    <a class="expandir-rpe" data-target="rpe-lectura-7"><i class="fa-solid fa-circle-chevron-down"></i></a>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_LANG" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasLANG ?>
                </td>
            </tr>

            <!-- Filas para los RPE auxiliares de LECTURA ACUMULADA CON NA GENERADA -->
            <!-- Este será el código de la tabla a agregar -->
            <tr id="rpe-lectura-7-clonado" class="fila-rpe-auxiliares" style="display: none;">
                <td colspan="<?= count($agencias) + 2 ?>"> <!-- Colspan para que ocupe todas las columnas -->
                    <table class="table table-bordered table-hover w-100 ">

                        <tr id="header-row">
                            <th>RPE AUXILIAR</th>
                            <?php foreach ($agencias as $agencia) : ?>
                                <th><?= $agencia ?></th>
                            <?php endforeach; ?>
                            <th>TOTAL</th> <!-- Nueva columna para la suma total -->
                        </tr>

                        <tbody>
                            <?php
                            // Obtener todos los RPE auxiliares únicos
                            $rpes_unicos_LANG = [];
                            foreach ($rpe_por_agencia_LANG as $agencia_rpes_LANG) {
                                foreach ($agencia_rpes_LANG as $rpe_auxiliar_LANG => $total_vecesLANG) {
                                    $rpes_unicos_LANG[$rpe_auxiliar_LANG] = true;
                                }
                            }

                            // Mostrar los valores de participación para cada RPE auxiliar único
                            foreach ($rpes_unicos_LANG as $rpe_auxiliar_LANG => $_) {
                                echo "<tr><td>$rpe_auxiliar_LANG</td>";
                                $total_rpe_LANG = 0; // Inicializar la suma total para este RPE auxiliar
                                foreach ($agencias as $agencia) {
                                    // Obtener los valores de participación para esta agencia y este RPE auxiliar
                                    $participacion_LANG = isset($rpe_por_agencia_LANG[$agencia][$rpe_auxiliar_LANG]) ? $rpe_por_agencia_LANG[$agencia][$rpe_auxiliar_LANG] : 0;
                                    $total_rpe_LANG += $participacion_LANG; // Sumar al total del RPE
                                    echo "<td>$participacion_LANG</td>";
                                }
                                echo "<td style='color: greenyellow;  text-align: center;  background: #294835b2' class='celda'>$total_rpe_LANG</td>"; // Mostrar la suma total de participación para este RPE auxiliar
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- Añadir más filas para FINIQUITO ANTERIOR ERRONEO-->
            <tr id="fila8">
                <th>FINIQUITO ANTERIOR ERRONEO</th>
                <td>
                    <a class="expandir-rpe" data-target="rpe-lectura-8"><i class="fa-solid fa-circle-chevron-down"></i></a>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_FAE" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasFAE ?>
                </td>
            </tr>

            <!-- Filas para los RPE auxiliares de FINIQUITO ANTERIOR ERRONEO -->
            <!-- Este será el código de la tabla a agregar -->
            <tr id="rpe-lectura-8-clonado" class="fila-rpe-auxiliares" style="display: none;">
                <td colspan="<?= count($agencias) + 2 ?>"> <!-- Colspan para que ocupe todas las columnas -->
                    <table class="table table-bordered table-hover w-100 ">

                        <tr id="header-row">
                            <th>RPE AUXILIAR</th>
                            <?php foreach ($agencias as $agencia) : ?>
                                <th><?= $agencia ?></th>
                            <?php endforeach; ?>
                            <th>TOTAL</th> <!-- Nueva columna para la suma total -->
                        </tr>

                        <tbody>
                            <?php
                            // Obtener todos los RPE auxiliares únicos
                            $rpes_unicos_FAE = [];
                            foreach ($rpe_por_agencia_FAE as $agencia_rpes_FAE) {
                                foreach ($agencia_rpes_FAE as $rpe_auxiliar_FAE => $total_vecesFAE) {
                                    $rpes_unicos_FAE[$rpe_auxiliar_FAE] = true;
                                }
                            }

                            // Mostrar los valores de participación para cada RPE auxiliar único
                            foreach ($rpes_unicos_FAE as $rpe_auxiliar_FAE => $_) {
                                echo "<tr><td>$rpe_auxiliar_FAE</td>";
                                $total_rpe_FAE = 0; // Inicializar la suma total para este RPE auxiliar
                                foreach ($agencias as $agencia) {
                                    // Obtener los valores de participación para esta agencia y este RPE auxiliar
                                    $participacion_FAE = isset($rpe_por_agencia_FAE[$agencia][$rpe_auxiliar_FAE]) ? $rpe_por_agencia_FAE[$agencia][$rpe_auxiliar_FAE] : 0;
                                    $total_rpe_FAE += $participacion_FAE; // Sumar al total del RPE
                                    echo "<td>$participacion_FAE</td>";
                                }
                                echo "<td style='color: greenyellow;  text-align: center;  background: #294835b2' class='celda'>$total_rpe_FAE</td>"; // Mostrar la suma total de participación para este RPE auxiliar
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>


            <!-- Añadir más filas para TELEMEDICION ERRONEA FACT ANTERIOR-->
            <tr id="fila9">
                <th>TELEMEDICION ERRONEA FACT ANTERIOR</th>
                <td>
                    <a class="expandir-rpe" data-target="rpe-lectura-9"><i class="fa-solid fa-circle-chevron-down"></i></a>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_TEFA" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasTEFA ?>
                </td>
            </tr>


            <!-- Filas para los RPE auxiliares de FINIQUITO ANTERIOR ERRONEO -->
            <!-- Este será el código de la tabla a agregar -->
            <tr id="rpe-lectura-9-clonado" class="fila-rpe-auxiliares" style="display: none;">
                <td colspan="<?= count($agencias) + 2 ?>"> <!-- Colspan para que ocupe todas las columnas -->
                    <table class="table table-bordered table-hover w-100 ">

                        <tr id="header-row">
                            <th>RPE AUXILIAR</th>
                            <?php foreach ($agencias as $agencia) : ?>
                                <th><?= $agencia ?></th>
                            <?php endforeach; ?>
                            <th>TOTAL</th> <!-- Nueva columna para la suma total -->
                        </tr>

                        <tbody>
                            <?php
                            // Obtener todos los RPE auxiliares únicos
                            $rpes_unicos_TEFA = [];
                            foreach ($rpe_por_agencia_TEFA as $agencia_rpes_TEFA) {
                                foreach ($agencia_rpes_TEFA as $rpe_auxiliar_TEFA => $total_vecesTEFA) {
                                    $rpes_unicos_TEFA[$rpe_auxiliar_TEFA] = true;
                                }
                            }

                            // Mostrar los valores de participación para cada RPE auxiliar único
                            foreach ($rpes_unicos_TEFA as $rpe_auxiliar_TEFA => $_) {
                                echo "<tr><td>$rpe_auxiliar_TEFA</td>";
                                $total_rpe_TEFA = 0; // Inicializar la suma total para este RPE auxiliar
                                foreach ($agencias as $agencia) {
                                    // Obtener los valores de participación para esta agencia y este RPE auxiliar
                                    $participacion_TEFA = isset($rpe_por_agencia_TEFA[$agencia][$rpe_auxiliar_TEFA]) ? $rpe_por_agencia_TEFA[$agencia][$rpe_auxiliar_TEFA] : 0;
                                    $total_rpe_TEFA += $participacion_TEFA; // Sumar al total del RPE
                                    echo "<td>$participacion_TEFA</td>";
                                }
                                echo "<td style='color: greenyellow;  text-align: center;  background: #294835b2' class='celda'>$total_rpe_TEFA</td>"; // Mostrar la suma total de participación para este RPE auxiliar
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>





            <!-- Añadir más filas para TOTALES POR AGENCIA INDIVIDUAL-->
            <tr id="fila11">
                <th>TOTAL</th>
                <td></td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="color: greenyellow;   text-align: center; background: #294835b2;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= $total_por_agencia_global[$agencia] ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: white; font-weight: 600; text-align: center; background:#358151b2;" style="color: greenyellow; text-align: center;" class="celda" onclick="copiarContenido(this)">
                    <?= $suma_total_agencias ?>
                </td>
            </tr>




        </tbody>
    </table>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtén todos los botones de expansión
            var botonesExpandir = document.querySelectorAll('.expandir-rpe');

            // Agrega un controlador de eventos a cada botón de expansión
            botonesExpandir.forEach(function(boton) {
                boton.addEventListener('click', function() {
                    // Obtiene el id del objetivo de la expansión desde el atributo data-target
                    var idObjetivo = boton.getAttribute('data-target');
                    // Encuentra el elemento con el id del objetivo
                    var objetivo = document.getElementById(idObjetivo + '-clonado'); // Agregamos '-clonado' al ID

                    // Encuentra el elemento de la fila debajo de la fila actual con el mismo nivel de anidamiento
                    var filaSiguiente = boton.closest('tr').nextElementSibling;

                    // Inserta el nuevo código de tabla debajo de la fila actual
                    if (filaSiguiente) {
                        filaSiguiente.parentNode.insertBefore(objetivo, filaSiguiente);
                    } else {
                        // Si no hay una fila siguiente con el mismo nivel de anidamiento, simplemente añádela al final del tbody
                        boton.closest('tbody').appendChild(objetivo);
                    }

                    // Alternar la visibilidad del elemento objetivo
                    objetivo.style.display = objetivo.style.display === 'none' ? 'table-row' : 'none';
                });
            });
        });
    </script>



    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtén todos los botones de expansión
            var botonesExpandir = document.querySelectorAll('.expandir-rpe');

            // Agrega un controlador de eventos a cada botón de expansión
            botonesExpandir.forEach(function(boton) {
                boton.addEventListener('click', function() {
                    // Obtiene el id del objetivo de la expansión desde el atributo data-target
                    var idObjetivo = boton.getAttribute('data-target');
                    // Encuentra el elemento con el id del objetivo
                    var objetivo = document.getElementById(idObjetivo);

                    // Encuentra el elemento de la fila debajo de la fila actual con el mismo nivel de anidamiento
                    var filaSiguiente = boton.closest('tr').nextElementSibling;

                    // Inserta la fila de RPE auxiliares debajo de la fila actual
                    if (filaSiguiente) {
                        filaSiguiente.parentNode.insertBefore(objetivo, filaSiguiente);
                    } else {
                        // Si no hay una fila siguiente con el mismo nivel de anidamiento, simplemente añádela al final del tbody
                        boton.closest('tbody').appendChild(objetivo);
                    }

                    // Alternar la visibilidad del elemento objetivo
                    objetivo.style.display = objetivo.style.display === 'none' ? 'table-row' : 'none';
                });
            });
        });
    </script> -->

    <!-- por ultimo se carga el footer -->
    <?php require('./layout/footer.php'); ?>