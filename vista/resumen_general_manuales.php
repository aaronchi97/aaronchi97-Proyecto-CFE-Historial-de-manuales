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

    <h4 style="margin-bottom: 5%;" class="text-center text-secondery">MANUALES - ESTADISTICOS GENERALES </h4>

    <?php
    //hacemos la conexion
    include "../modelo/conexion.php";
    //llamamos al controlador para eliminar registros
    // include "../controlador/controlador_modificar_manual.php";
    // include "../controlador/controlador_asignar_estatus.php";
    // include "../controlador/controlador_eliminar_manual.php";
    // include "../controlador/control-estadisticos/controlador_buscar_fecha_manual.php";

    ?>



    <a href="estadisticos_manuales.php" class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-solid fa-caret-left"></i>
        ATRAS</a>

    <a href="solicitud_mismo_servicio_manuales.php" class="btn btn-info btn-rounded mb-3 otro">
        VER POR SOLICITUDES DOBLES <i class="fa-solid fa-repeat"></i></a>

    <?php










    // ----------INICIO DE CONDICIONES PARA SELECCIONAR QUE TIPO DE FILTRO DE BUSQUEDA SE ESTA SELECCIONANDO (MES, 6MESES, AÑO O PERSONALIZADO)------------------------------------------------------------------------------------------------------------------------------------------

    if ($_SESSION["fechainicio"] != null &&  $_SESSION["fechafin"] != null) {

        $FECHAINICIO = $_SESSION["fechainicio"];
        $FECHAFIN = $_SESSION["fechafin"];




        //SE HACE LA CONSULTA PARA SABER EL TOTAL DE VECES QUE UNA AGENCIA PARTICIPA EN UN MOTIVO EN ESPECIFICO EN UN INTERVALO DE TIEMPO ESPECIFICO





        // Suponiendo que ya tienes tu conexión a la base de datos establecida

        // Array con las agencias de interés
        $agencias = array('A', 'B', 'C', 'D', 'E', 'G', 'H', 'J', 'K', 'M');

        // Inicializar variable para el total general de agencias--------------------------------------------
        $total_agencias = 0;
        $total_agenciasLR = 0;
        $total_agenciasASA = 0;
        $total_agenciasMSR = 0;
        $total_agenciasECA = 0;
        $total_agenciasMD = 0;
        $total_agenciasCDFP = 0;
        $total_agenciasCD = 0;
        $total_agenciasELT = 0;
        $total_agenciasMQ = 0;
        //para la suma individual de las agencias
        $suma_total_agencias = 0;


        // Inicializar un array para almacenar los totales de cada agencia---------------------------------
        $totales_por_agencia = array();
        $totales_por_agenciaLR = array();
        $totales_por_agenciaASA = array();
        $totales_por_agenciaMSR = array();
        $totales_por_agenciaECA = array();
        $totales_por_agenciaMD = array();
        $totales_por_agenciaCDFP = array();
        $totales_por_agenciaCD = array();
        $totales_por_agenciaELT = array();
        $totales_por_agenciaMQ = array();
        // Inicializar un array para almacenar los totales por agencia
        $total_por_agencia_global = array();
        //Array para rpe auxiliar
        $rpe_por_agencia = array();






        // Consulta SQL para obtener el número de veces que cada agencia aparece-------------------------------------
        foreach ($agencias as $agencia) {


            //CONSULTA PARA  EN ERROR EN TOMA DE LECTURA
            $sql = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR EN TOMA DE LECTURA')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR EN TOMA DE LECTURA
            $sql_rpe = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_manuales
            WHERE 
                TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR EN TOMA DE LECTURA')) 
                AND DATE(fecha_captura) BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";

            //CONSULTA PARA LECTURA DE RETIRO

            $sql_LR = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('LECTURA DE RETIRO')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //ANOMALIA SIN ATENCION

            $sql_ASA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ANOMALIA SIN ATENCION')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //ANOMALIA MEDIDOR SIN RETROALIMENTAR


            $sql_MSR = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR SIN RETROALIMENTAR')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //ANOMALIA ESTIMACION EN CERO CON ANOMALIA


            $sql_ECA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ESTIMACION EN CERO CON ANOMALIA')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            // MEDIDOR DESPROGRAMADO


            $sql_MD = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR DESPROGRAMADO')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            // CORRECCION DEMANDA Y/O FP


            $sql_CDFP = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('CORRECCION DEMANDA Y/O FP')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            // CORREGIR DEMANDA


            $sql_CD = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('CORREGIR DEMANDA')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            // ERROR LECTURA TELEMEDIDA

            $sql_ELT = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR LECTURA TELEMEDIDA')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";




            // MEDIDOR QUITAPON

            $sql_MQ = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR QUITAPON')) 
                        AND DATE(fecha_captura) BETWEEN ' $FECHAINICIO ' AND '$FECHAFIN'
                        AND agencia = '$agencia'";








            //--------------------------------------------ESCRIBIR VARIABLES POR CADA NUEVA CONSULTA-------------------------------------------------


            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);
            $resultado_rpe = mysqli_query($conexion, $sql_rpe);
            $resultado_LR = mysqli_query($conexion, $sql_LR);
            $resultado_ASA = mysqli_query($conexion, $sql_ASA);
            $resultado_MSR = mysqli_query($conexion, $sql_MSR);
            $resultado_ECA = mysqli_query($conexion, $sql_ECA);
            $resultado_MD = mysqli_query($conexion, $sql_MD);
            $resultado_CDFP = mysqli_query($conexion, $sql_CDFP);
            $resultado_CD = mysqli_query($conexion, $sql_CD);
            $resultado_ELT = mysqli_query($conexion, $sql_ELT);
            $resultado_MQ = mysqli_query($conexion, $sql_MQ);










            // Verificar si la consulta fue exitosa
            if ($resultado) {

                //----------------------------------------------Motivo ERROR EN TOMA DE LECTURA-------------------------------------------------

                // Obtener el resultado
                $fila = mysqli_fetch_assoc($resultado);
                $total_veces = $fila['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agencia[$agencia] = $total_veces;

                // Sumar al total general
                $total_agencias += $total_veces;

                // Asignar el valor a una variable dinámicamente
                ${"total_" . $agencia} = $total_veces;




                //----------------------------------------------RPE AUXILIARES PARA ERROR EN TOMA DE LECTURA-------------------------------------------------



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



                // Almacenar el total de veces para esta agencia
                $totales_por_agencia[$agencia] = $total_agencia;
                // $total_agencias_rpe += $total_agencia;

                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia[$agencia] = $rpe_agencia;


                //----------------------------------------------Motivo Lectura Retiro-------------------------------------------------


                // Obtener el resultado
                $filaLR = mysqli_fetch_assoc($resultado_LR);
                $total_vecesLR = $filaLR['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaLR[$agencia] = $total_vecesLR;

                // Sumar al total general
                $total_agenciasLR += $total_vecesLR;

                // Asignar el valor a una variable dinámicamente
                ${"total_LR" . $agencia} = $total_vecesLR;


                //fin consulta 2


                //----------------------------------------------Motivo ANOMALIA SIN ATENCION-------------------------------------------------

                // Obtener el resultado
                $filaASA = mysqli_fetch_assoc($resultado_ASA);
                $total_vecesASA = $filaASA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaASA[$agencia] = $total_vecesASA;

                // Sumar al total general
                $total_agenciasASA += $total_vecesASA;

                // Asignar el valor a una variable dinámicamente
                ${"total_ASA" . $agencia} = $total_vecesASA;


                //fin consulta 3


                //----------------------------------------------Motivo MEDIDOR SIN RETROALIMENTAR-------------------------------------------------

                // Obtener el resultado
                $filaMSR = mysqli_fetch_assoc($resultado_MSR);
                $total_vecesMSR = $filaMSR['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMSR[$agencia] = $total_vecesMSR;

                // Sumar al total general
                $total_agenciasMSR += $total_vecesMSR;

                // Asignar el valor a una variable dinámicamente
                ${"total_MSR" . $agencia} = $total_vecesMSR;


                //fin consulta 3



                //----------------------------------------------Motivo ESTIMACION EN CERO CON ANOMALIA-------------------------------------------------

                // Obtener el resultado
                $filaECA = mysqli_fetch_assoc($resultado_ECA);
                $total_vecesECA = $filaECA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaECA[$agencia] = $total_vecesECA;

                // Sumar al total general
                $total_agenciasECA += $total_vecesECA;

                // Asignar el valor a una variable dinámicamente
                ${"total_ECA" . $agencia} = $total_vecesECA;


                //fin consulta 3


                //----------------------------------------------Motivo MEDIDOR DESPROGRAMADO-------------------------------------------------

                // Obtener el resultado
                $filaMD = mysqli_fetch_assoc($resultado_MD);
                $total_vecesMD = $filaMD['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMD[$agencia] = $total_vecesMD;

                // Sumar al total general
                $total_agenciasMD += $total_vecesMD;

                // Asignar el valor a una variable dinámicamente
                ${"total_MD" . $agencia} = $total_vecesMD;


                //fin consulta 3


                //----------------------------------------------Motivo CORRECCION DEMANDA Y/O FP-------------------------------------------------

                // Obtener el resultado
                $filaCDFP = mysqli_fetch_assoc($resultado_CDFP);
                $total_vecesCDFP = $filaCDFP['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCDFP[$agencia] = $total_vecesCDFP;

                // Sumar al total general
                $total_agenciasCDFP += $total_vecesCDFP;

                // Asignar el valor a una variable dinámicamente
                ${"total_CDFP" . $agencia} = $total_vecesCDFP;


                //fin consulta 3



                //----------------------------------------------Motivo CORREGIR DEMANDA-------------------------------------------------

                // Obtener el resultado
                $filaCD = mysqli_fetch_assoc($resultado_CD);
                $total_vecesCD = $filaCD['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCD[$agencia] = $total_vecesCD;

                // Sumar al total general
                $total_agenciasCD += $total_vecesCD;

                // Asignar el valor a una variable dinámicamente
                ${"total_CD" . $agencia} = $total_vecesCD;


                //fin consulta 8



                //----------------------------------------------Motivo ERROR LECTURA TELEMEDIDA-------------------------------------------------

                // Obtener el resultado
                $filaELT = mysqli_fetch_assoc($resultado_ELT);
                $total_vecesELT = $filaELT['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaELT[$agencia] = $total_vecesELT;

                // Sumar al total general
                $total_agenciasELT += $total_vecesELT;

                // Asignar el valor a una variable dinámicamente
                ${"total_ELT" . $agencia} = $total_vecesELT;


                //fin consulta 9




                //----------------------------------------------Motivo MEDIDOR QUITAPON-------------------------------------------------

                // Obtener el resultado
                $filaMQ = mysqli_fetch_assoc($resultado_MQ);
                $total_vecesMQ = $filaMQ['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMQ[$agencia] = $total_vecesMQ;

                // Sumar al total general
                $total_agenciasMQ += $total_vecesMQ;

                // Asignar el valor a una variable dinámicamente
                ${"total_MQ" . $agencia} = $total_vecesMQ;


                //fin consulta 9





                // SUMAS TOTALES POR AGENCIA (NO POR MOTIVO)---------------------------------------------------------------------------------------

                // $suma_total_agencias = 0;
                // // Inicializar un array para almacenar los totales por agencia
                // $total_por_agencia_global = array();

                // Consulta SQL para obtener el número de veces que cada agencia aparece

                // Aquí va tu consulta SQL

                // Ejemplo hipotético para la variable total_agencia_por_motivo_A
                $total_agencia_por_motivo = $totales_por_agencia[$agencia] + $totales_por_agenciaLR[$agencia] + $totales_por_agenciaASA[$agencia] + $totales_por_agenciaMSR[$agencia] + $totales_por_agenciaECA[$agencia] + $totales_por_agenciaMD[$agencia] + $totales_por_agenciaCDFP[$agencia] + $totales_por_agenciaCD[$agencia] + $totales_por_agenciaELT[$agencia] + $totales_por_agenciaMQ[$agencia];

                // Sumar al total global por agencia
                $total_por_agencia_global[$agencia] = $total_agencia_por_motivo;


                // Sumar al total global de todas las agencias
                $suma_total_agencias += $total_agencia_por_motivo;






                // Aquí podrías imprimir el total de esta agencia si lo necesitas para depuración
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





        // Suponiendo que ya tienes tu conexión a la base de datos establecida

        // Array con las agencias de interés
        $agencias = array('A', 'B', 'C', 'D', 'E', 'G', 'H', 'J', 'K', 'M');

        // Inicializar variable para el total general de agencias--------------------------------------------
        $total_agencias = 0;
        $total_agenciasLR = 0;
        $total_agenciasASA = 0;
        $total_agenciasMSR = 0;
        $total_agenciasECA = 0;
        $total_agenciasMD = 0;
        $total_agenciasCDFP = 0;
        $total_agenciasCD = 0;
        $total_agenciasELT = 0;
        $total_agenciasMQ = 0;
        //para la suma individual de las agencias
        $suma_total_agencias = 0;


        // Inicializar un array para almacenar los totales de cada agencia---------------------------------
        $totales_por_agencia = array();
        $totales_por_agenciaLR = array();
        $totales_por_agenciaASA = array();
        $totales_por_agenciaMSR = array();
        $totales_por_agenciaECA = array();
        $totales_por_agenciaMD = array();
        $totales_por_agenciaCDFP = array();
        $totales_por_agenciaCD = array();
        $totales_por_agenciaELT = array();
        $totales_por_agenciaMQ = array();
        // Inicializar un array para almacenar los totales por agencia
        $total_por_agencia_global = array();
        //Array para rpe auxiliar
        $rpe_por_agencia = array();




        // Consulta SQL para obtener el número de veces que cada agencia aparece-------------------------------------
        foreach ($agencias as $agencia) {

            //CONSULTA PARA ERROR EN TOMA DE LECTURA
            $sql = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR EN TOMA DE LECTURA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR EN TOMA DE LECTURA
            $sql_rpe = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_manuales
            WHERE 
                TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR EN TOMA DE LECTURA')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CONSULTA PARA LECTURA DE RETIRO

            $sql_LR = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('LECTURA DE RETIRO')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //ANOMALIA SIN ATENCION

            $sql_ASA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ANOMALIA SIN ATENCION')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //ANOMALIA MEDIDOR SIN RETROALIMENTAR


            $sql_MSR = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR SIN RETROALIMENTAR')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //ANOMALIA ESTIMACION EN CERO CON ANOMALIA


            $sql_ECA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ESTIMACION EN CERO CON ANOMALIA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            // MEDIDOR DESPROGRAMADO


            $sql_MD = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR DESPROGRAMADO')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            // CORRECCION DEMANDA Y/O FP


            $sql_CDFP = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('CORRECCION DEMANDA Y/O FP')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            // CORREGIR DEMANDA


            $sql_CD = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('CORREGIR DEMANDA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            // ERROR LECTURA TELEMEDIDA

            $sql_ELT = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR LECTURA TELEMEDIDA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";




            // MEDIDOR QUITAPON

            $sql_MQ = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR QUITAPON')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            //--------------------------------------------ESCRIBIR VARIABLES POR CADA NUEVA CONSULTA-------------------------------------------------


            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);
            $resultado_rpe = mysqli_query($conexion, $sql_rpe);
            $resultado_LR = mysqli_query($conexion, $sql_LR);
            $resultado_ASA = mysqli_query($conexion, $sql_ASA);
            $resultado_MSR = mysqli_query($conexion, $sql_MSR);
            $resultado_ECA = mysqli_query($conexion, $sql_ECA);
            $resultado_MD = mysqli_query($conexion, $sql_MD);
            $resultado_CDFP = mysqli_query($conexion, $sql_CDFP);
            $resultado_CD = mysqli_query($conexion, $sql_CD);
            $resultado_ELT = mysqli_query($conexion, $sql_ELT);
            $resultado_MQ = mysqli_query($conexion, $sql_MQ);





            //----------------------------------------------Motivo Lectura Retiro-------------------------------------------------

            // Verificar si la consulta fue exitosa
            if ($resultado) {
                //----------------------------------------------Motivo ERROR EN TOMA DE LECTURA-------------------------------------------------

                // Obtener el resultado
                $fila = mysqli_fetch_assoc($resultado);
                $total_veces = $fila['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agencia[$agencia] = $total_veces;

                // Sumar al total general
                $total_agencias += $total_veces;

                // Asignar el valor a una variable dinámicamente
                ${"total_" . $agencia} = $total_veces;




                //----------------------------------------------RPE AUXILIARES PARA ERROR EN TOMA DE LECTURA-------------------------------------------------



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



                // Almacenar el total de veces para esta agencia
                $totales_por_agencia[$agencia] = $total_agencia;
                // $total_agencias_rpe += $total_agencia;

                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia[$agencia] = $rpe_agencia;


                //----------------------------------------------Motivo Lectura Retiro-------------------------------------------------


                // Obtener el resultado
                $filaLR = mysqli_fetch_assoc($resultado_LR);
                $total_vecesLR = $filaLR['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaLR[$agencia] = $total_vecesLR;

                // Sumar al total general
                $total_agenciasLR += $total_vecesLR;

                // Asignar el valor a una variable dinámicamente
                ${"total_LR" . $agencia} = $total_vecesLR;


                //fin consulta 2


                //----------------------------------------------Motivo ANOMALIA SIN ATENCION-------------------------------------------------

                // Obtener el resultado
                $filaASA = mysqli_fetch_assoc($resultado_ASA);
                $total_vecesASA = $filaASA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaASA[$agencia] = $total_vecesASA;

                // Sumar al total general
                $total_agenciasASA += $total_vecesASA;

                // Asignar el valor a una variable dinámicamente
                ${"total_ASA" . $agencia} = $total_vecesASA;


                //fin consulta 3


                //----------------------------------------------Motivo MEDIDOR SIN RETROALIMENTAR-------------------------------------------------

                // Obtener el resultado
                $filaMSR = mysqli_fetch_assoc($resultado_MSR);
                $total_vecesMSR = $filaMSR['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMSR[$agencia] = $total_vecesMSR;

                // Sumar al total general
                $total_agenciasMSR += $total_vecesMSR;

                // Asignar el valor a una variable dinámicamente
                ${"total_MSR" . $agencia} = $total_vecesMSR;


                //fin consulta 3



                //----------------------------------------------Motivo ESTIMACION EN CERO CON ANOMALIA-------------------------------------------------

                // Obtener el resultado
                $filaECA = mysqli_fetch_assoc($resultado_ECA);
                $total_vecesECA = $filaECA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaECA[$agencia] = $total_vecesECA;

                // Sumar al total general
                $total_agenciasECA += $total_vecesECA;

                // Asignar el valor a una variable dinámicamente
                ${"total_ECA" . $agencia} = $total_vecesECA;


                //fin consulta 3


                //----------------------------------------------Motivo MEDIDOR DESPROGRAMADO-------------------------------------------------

                // Obtener el resultado
                $filaMD = mysqli_fetch_assoc($resultado_MD);
                $total_vecesMD = $filaMD['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMD[$agencia] = $total_vecesMD;

                // Sumar al total general
                $total_agenciasMD += $total_vecesMD;

                // Asignar el valor a una variable dinámicamente
                ${"total_MD" . $agencia} = $total_vecesMD;


                //fin consulta 3


                //----------------------------------------------Motivo CORRECCION DEMANDA Y/O FP-------------------------------------------------

                // Obtener el resultado
                $filaCDFP = mysqli_fetch_assoc($resultado_CDFP);
                $total_vecesCDFP = $filaCDFP['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCDFP[$agencia] = $total_vecesCDFP;

                // Sumar al total general
                $total_agenciasCDFP += $total_vecesCDFP;

                // Asignar el valor a una variable dinámicamente
                ${"total_CDFP" . $agencia} = $total_vecesCDFP;


                //fin consulta 3



                //----------------------------------------------Motivo CORREGIR DEMANDA-------------------------------------------------

                // Obtener el resultado
                $filaCD = mysqli_fetch_assoc($resultado_CD);
                $total_vecesCD = $filaCD['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCD[$agencia] = $total_vecesCD;

                // Sumar al total general
                $total_agenciasCD += $total_vecesCD;

                // Asignar el valor a una variable dinámicamente
                ${"total_CD" . $agencia} = $total_vecesCD;


                //fin consulta 8



                //----------------------------------------------Motivo ERROR LECTURA TELEMEDIDA-------------------------------------------------

                // Obtener el resultado
                $filaELT = mysqli_fetch_assoc($resultado_ELT);
                $total_vecesELT = $filaELT['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaELT[$agencia] = $total_vecesELT;

                // Sumar al total general
                $total_agenciasELT += $total_vecesELT;

                // Asignar el valor a una variable dinámicamente
                ${"total_ELT" . $agencia} = $total_vecesELT;


                //fin consulta 9




                //----------------------------------------------Motivo MEDIDOR QUITAPON-------------------------------------------------

                // Obtener el resultado
                $filaMQ = mysqli_fetch_assoc($resultado_MQ);
                $total_vecesMQ = $filaMQ['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMQ[$agencia] = $total_vecesMQ;

                // Sumar al total general
                $total_agenciasMQ += $total_vecesMQ;

                // Asignar el valor a una variable dinámicamente
                ${"total_MQ" . $agencia} = $total_vecesMQ;


                //fin consulta 9




                // SUMAS TOTALES POR AGENCIA (NO POR MOTIVO)---------------------------------------------------------------------------------------

                // $suma_total_agencias = 0;
                // // Inicializar un array para almacenar los totales por agencia
                // $total_por_agencia_global = array();

                // Consulta SQL para obtener el número de veces que cada agencia aparece

                // Aquí va tu consulta SQL

                // Ejemplo hipotético para la variable total_agencia_por_motivo_A
                $total_agencia_por_motivo = $totales_por_agencia[$agencia] + $totales_por_agenciaLR[$agencia] + $totales_por_agenciaASA[$agencia] + $totales_por_agenciaMSR[$agencia] + $totales_por_agenciaECA[$agencia] + $totales_por_agenciaMD[$agencia] + $totales_por_agenciaCDFP[$agencia] + $totales_por_agenciaCD[$agencia] + $totales_por_agenciaELT[$agencia] + $totales_por_agenciaMQ[$agencia];

                // Sumar al total global por agencia
                $total_por_agencia_global[$agencia] = $total_agencia_por_motivo;


                // Sumar al total global de todas las agencias
                $suma_total_agencias += $total_agencia_por_motivo;
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





        // Suponiendo que ya tienes tu conexión a la base de datos establecida

        // Array con las agencias de interés
        $agencias = array('A', 'B', 'C', 'D', 'E', 'G', 'H', 'J', 'K', 'M');

        // Inicializar variable para el total general de agencias--------------------------------------------
        $total_agencias = 0;
        $total_agenciasLR = 0;
        $total_agenciasASA = 0;
        $total_agenciasMSR = 0;
        $total_agenciasECA = 0;
        $total_agenciasMD = 0;
        $total_agenciasCDFP = 0;
        $total_agenciasCD = 0;
        $total_agenciasELT = 0;
        $total_agenciasMQ = 0;
        //para la suma individual de las agencias
        $suma_total_agencias = 0;


        // Inicializar un array para almacenar los totales de cada agencia---------------------------------
        $totales_por_agencia = array();
        $totales_por_agenciaLR = array();
        $totales_por_agenciaASA = array();
        $totales_por_agenciaMSR = array();
        $totales_por_agenciaECA = array();
        $totales_por_agenciaMD = array();
        $totales_por_agenciaCDFP = array();
        $totales_por_agenciaCD = array();
        $totales_por_agenciaELT = array();
        $totales_por_agenciaMQ = array();
        // Inicializar un array para almacenar los totales por agencia
        $total_por_agencia_global = array();
        //Array para rpe auxiliar
        $rpe_por_agencia = array();




        // Consulta SQL para obtener el número de veces que cada agencia aparece-------------------------------------
        foreach ($agencias as $agencia) {

            //CONSULTA PARA ERROR EN TOMA DE LECTURA
            $sql = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR EN TOMA DE LECTURA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR EN TOMA DE LECTURA
            $sql_rpe = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_manuales
            WHERE 
                TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR EN TOMA DE LECTURA')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CONSULTA PARA LECTURA DE RETIRO

            $sql_LR = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('LECTURA DE RETIRO')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //ANOMALIA SIN ATENCION

            $sql_ASA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ANOMALIA SIN ATENCION')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //ANOMALIA MEDIDOR SIN RETROALIMENTAR


            $sql_MSR = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR SIN RETROALIMENTAR')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            //ANOMALIA ESTIMACION EN CERO CON ANOMALIA


            $sql_ECA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ESTIMACION EN CERO CON ANOMALIA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            // MEDIDOR DESPROGRAMADO


            $sql_MD = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR DESPROGRAMADO')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            // CORRECCION DEMANDA Y/O FP


            $sql_CDFP = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('CORRECCION DEMANDA Y/O FP')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";


            // CORREGIR DEMANDA


            $sql_CD = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('CORREGIR DEMANDA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            // ERROR LECTURA TELEMEDIDA

            $sql_ELT = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR LECTURA TELEMEDIDA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";




            // MEDIDOR QUITAPON

            $sql_MQ = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR QUITAPON')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') BETWEEN '$FECHAINICIO' AND '$FECHAFIN'
                        AND agencia = '$agencia'";



            //--------------------------------------------ESCRIBIR VARIABLES POR CADA NUEVA CONSULTA-------------------------------------------------


            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);
            $resultado_rpe = mysqli_query($conexion, $sql_rpe);
            $resultado_LR = mysqli_query($conexion, $sql_LR);
            $resultado_ASA = mysqli_query($conexion, $sql_ASA);
            $resultado_MSR = mysqli_query($conexion, $sql_MSR);
            $resultado_ECA = mysqli_query($conexion, $sql_ECA);
            $resultado_MD = mysqli_query($conexion, $sql_MD);
            $resultado_CDFP = mysqli_query($conexion, $sql_CDFP);
            $resultado_CD = mysqli_query($conexion, $sql_CD);
            $resultado_ELT = mysqli_query($conexion, $sql_ELT);
            $resultado_MQ = mysqli_query($conexion, $sql_MQ);





            //----------------------------------------------Motivo Lectura Retiro-------------------------------------------------

            // Verificar si la consulta fue exitosa
            if ($resultado) {
                //----------------------------------------------Motivo ERROR EN TOMA DE LECTURA-------------------------------------------------

                // Obtener el resultado
                $fila = mysqli_fetch_assoc($resultado);
                $total_veces = $fila['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agencia[$agencia] = $total_veces;

                // Sumar al total general
                $total_agencias += $total_veces;

                // Asignar el valor a una variable dinámicamente
                ${"total_" . $agencia} = $total_veces;




                //----------------------------------------------RPE AUXILIARES PARA ERROR EN TOMA DE LECTURA-------------------------------------------------



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



                // Almacenar el total de veces para esta agencia
                $totales_por_agencia[$agencia] = $total_agencia;
                // $total_agencias_rpe += $total_agencia;

                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia[$agencia] = $rpe_agencia;


                //----------------------------------------------Motivo Lectura Retiro-------------------------------------------------


                // Obtener el resultado
                $filaLR = mysqli_fetch_assoc($resultado_LR);
                $total_vecesLR = $filaLR['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaLR[$agencia] = $total_vecesLR;

                // Sumar al total general
                $total_agenciasLR += $total_vecesLR;

                // Asignar el valor a una variable dinámicamente
                ${"total_LR" . $agencia} = $total_vecesLR;


                //fin consulta 2


                //----------------------------------------------Motivo ANOMALIA SIN ATENCION-------------------------------------------------

                // Obtener el resultado
                $filaASA = mysqli_fetch_assoc($resultado_ASA);
                $total_vecesASA = $filaASA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaASA[$agencia] = $total_vecesASA;

                // Sumar al total general
                $total_agenciasASA += $total_vecesASA;

                // Asignar el valor a una variable dinámicamente
                ${"total_ASA" . $agencia} = $total_vecesASA;


                //fin consulta 3


                //----------------------------------------------Motivo MEDIDOR SIN RETROALIMENTAR-------------------------------------------------

                // Obtener el resultado
                $filaMSR = mysqli_fetch_assoc($resultado_MSR);
                $total_vecesMSR = $filaMSR['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMSR[$agencia] = $total_vecesMSR;

                // Sumar al total general
                $total_agenciasMSR += $total_vecesMSR;

                // Asignar el valor a una variable dinámicamente
                ${"total_MSR" . $agencia} = $total_vecesMSR;


                //fin consulta 3



                //----------------------------------------------Motivo ESTIMACION EN CERO CON ANOMALIA-------------------------------------------------

                // Obtener el resultado
                $filaECA = mysqli_fetch_assoc($resultado_ECA);
                $total_vecesECA = $filaECA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaECA[$agencia] = $total_vecesECA;

                // Sumar al total general
                $total_agenciasECA += $total_vecesECA;

                // Asignar el valor a una variable dinámicamente
                ${"total_ECA" . $agencia} = $total_vecesECA;


                //fin consulta 3


                //----------------------------------------------Motivo MEDIDOR DESPROGRAMADO-------------------------------------------------

                // Obtener el resultado
                $filaMD = mysqli_fetch_assoc($resultado_MD);
                $total_vecesMD = $filaMD['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMD[$agencia] = $total_vecesMD;

                // Sumar al total general
                $total_agenciasMD += $total_vecesMD;

                // Asignar el valor a una variable dinámicamente
                ${"total_MD" . $agencia} = $total_vecesMD;


                //fin consulta 3


                //----------------------------------------------Motivo CORRECCION DEMANDA Y/O FP-------------------------------------------------

                // Obtener el resultado
                $filaCDFP = mysqli_fetch_assoc($resultado_CDFP);
                $total_vecesCDFP = $filaCDFP['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCDFP[$agencia] = $total_vecesCDFP;

                // Sumar al total general
                $total_agenciasCDFP += $total_vecesCDFP;

                // Asignar el valor a una variable dinámicamente
                ${"total_CDFP" . $agencia} = $total_vecesCDFP;


                //fin consulta 3



                //----------------------------------------------Motivo CORREGIR DEMANDA-------------------------------------------------

                // Obtener el resultado
                $filaCD = mysqli_fetch_assoc($resultado_CD);
                $total_vecesCD = $filaCD['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCD[$agencia] = $total_vecesCD;

                // Sumar al total general
                $total_agenciasCD += $total_vecesCD;

                // Asignar el valor a una variable dinámicamente
                ${"total_CD" . $agencia} = $total_vecesCD;


                //fin consulta 8



                //----------------------------------------------Motivo ERROR LECTURA TELEMEDIDA-------------------------------------------------

                // Obtener el resultado
                $filaELT = mysqli_fetch_assoc($resultado_ELT);
                $total_vecesELT = $filaELT['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaELT[$agencia] = $total_vecesELT;

                // Sumar al total general
                $total_agenciasELT += $total_vecesELT;

                // Asignar el valor a una variable dinámicamente
                ${"total_ELT" . $agencia} = $total_vecesELT;


                //fin consulta 9




                //----------------------------------------------Motivo MEDIDOR QUITAPON-------------------------------------------------

                // Obtener el resultado
                $filaMQ = mysqli_fetch_assoc($resultado_MQ);
                $total_vecesMQ = $filaMQ['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMQ[$agencia] = $total_vecesMQ;

                // Sumar al total general
                $total_agenciasMQ += $total_vecesMQ;

                // Asignar el valor a una variable dinámicamente
                ${"total_MQ" . $agencia} = $total_vecesMQ;


                //fin consulta 9




                // SUMAS TOTALES POR AGENCIA (NO POR MOTIVO)---------------------------------------------------------------------------------------

                // $suma_total_agencias = 0;
                // // Inicializar un array para almacenar los totales por agencia
                // $total_por_agencia_global = array();

                // Consulta SQL para obtener el número de veces que cada agencia aparece

                // Aquí va tu consulta SQL

                // Ejemplo hipotético para la variable total_agencia_por_motivo_A
                $total_agencia_por_motivo = $totales_por_agencia[$agencia] + $totales_por_agenciaLR[$agencia] + $totales_por_agenciaASA[$agencia] + $totales_por_agenciaMSR[$agencia] + $totales_por_agenciaECA[$agencia] + $totales_por_agenciaMD[$agencia] + $totales_por_agenciaCDFP[$agencia] + $totales_por_agenciaCD[$agencia] + $totales_por_agenciaELT[$agencia] + $totales_por_agenciaMQ[$agencia];

                // Sumar al total global por agencia
                $total_por_agencia_global[$agencia] = $total_agencia_por_motivo;


                // Sumar al total global de todas las agencias
                $suma_total_agencias += $total_agencia_por_motivo;
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





        // Suponiendo que ya tienes tu conexión a la base de datos establecida

        // Array con las agencias de interés
        $agencias = array('A', 'B', 'C', 'D', 'E', 'G', 'H', 'J', 'K', 'M');

        // Inicializar variable para el total general de agencias--------------------------------------------
        $total_agencias = 0;
        $total_agenciasLR = 0;
        $total_agenciasASA = 0;
        $total_agenciasMSR = 0;
        $total_agenciasECA = 0;
        $total_agenciasMD = 0;
        $total_agenciasCDFP = 0;
        $total_agenciasCD = 0;
        $total_agenciasELT = 0;
        $total_agenciasMQ = 0;
        //para la suma individual de las agencias
        $suma_total_agencias = 0;


        // Inicializar un array para almacenar los totales de cada agencia---------------------------------
        $totales_por_agencia = array();
        $totales_por_agenciaLR = array();
        $totales_por_agenciaASA = array();
        $totales_por_agenciaMSR = array();
        $totales_por_agenciaECA = array();
        $totales_por_agenciaMD = array();
        $totales_por_agenciaCDFP = array();
        $totales_por_agenciaCD = array();
        $totales_por_agenciaELT = array();
        $totales_por_agenciaMQ = array();
        // Inicializar un array para almacenar los totales por agencia
        $total_por_agencia_global = array();
        //Array para rpe auxiliar
        $rpe_por_agencia = array();




        // Consulta SQL para obtener el número de veces que cada agencia aparece-------------------------------------
        foreach ($agencias as $agencia) {

            //CONSULTA PARA ERROR EN TOMA DE LECTURA
            $sql = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR EN TOMA DE LECTURA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR EN TOMA DE LECTURA
            $sql_rpe = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_manuales
            WHERE 
                TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR EN TOMA DE LECTURA')) 
                AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CONSULTA PARA LECTURA DE RETIRO

            $sql_LR = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('LECTURA DE RETIRO')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                        AND agencia = '$agencia'";


            //ANOMALIA SIN ATENCION

            $sql_ASA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ANOMALIA SIN ATENCION')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                        AND agencia = '$agencia'";


            //ANOMALIA MEDIDOR SIN RETROALIMENTAR


            $sql_MSR = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR SIN RETROALIMENTAR')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                        AND agencia = '$agencia'";


            //ANOMALIA ESTIMACION EN CERO CON ANOMALIA


            $sql_ECA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ESTIMACION EN CERO CON ANOMALIA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                        AND agencia = '$agencia'";



            // MEDIDOR DESPROGRAMADO


            $sql_MD = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR DESPROGRAMADO')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                        AND agencia = '$agencia'";


            // CORRECCION DEMANDA Y/O FP


            $sql_CDFP = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('CORRECCION DEMANDA Y/O FP')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                        AND agencia = '$agencia'";


            // CORREGIR DEMANDA


            $sql_CD = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('CORREGIR DEMANDA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                        AND agencia = '$agencia'";



            // ERROR LECTURA TELEMEDIDA

            $sql_ELT = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR LECTURA TELEMEDIDA')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                        AND agencia = '$agencia'";




            // MEDIDOR QUITAPON

            $sql_MQ = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR QUITAPON')) 
                        AND DATE_FORMAT(fecha_captura, '%Y-%m') = '$FECHAINICIO'
                        AND agencia = '$agencia'";



            //--------------------------------------------ESCRIBIR VARIABLES POR CADA NUEVA CONSULTA-------------------------------------------------


            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);
            $resultado_rpe = mysqli_query($conexion, $sql_rpe);
            $resultado_LR = mysqli_query($conexion, $sql_LR);
            $resultado_ASA = mysqli_query($conexion, $sql_ASA);
            $resultado_MSR = mysqli_query($conexion, $sql_MSR);
            $resultado_ECA = mysqli_query($conexion, $sql_ECA);
            $resultado_MD = mysqli_query($conexion, $sql_MD);
            $resultado_CDFP = mysqli_query($conexion, $sql_CDFP);
            $resultado_CD = mysqli_query($conexion, $sql_CD);
            $resultado_ELT = mysqli_query($conexion, $sql_ELT);
            $resultado_MQ = mysqli_query($conexion, $sql_MQ);





            //----------------------------------------------Motivo Lectura Retiro-------------------------------------------------

            // Verificar si la consulta fue exitosa
            if ($resultado) {
                //----------------------------------------------Motivo ERROR EN TOMA DE LECTURA-------------------------------------------------

                // Obtener el resultado
                $fila = mysqli_fetch_assoc($resultado);
                $total_veces = $fila['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agencia[$agencia] = $total_veces;

                // Sumar al total general
                $total_agencias += $total_veces;

                // Asignar el valor a una variable dinámicamente
                ${"total_" . $agencia} = $total_veces;




                //----------------------------------------------RPE AUXILIARES PARA ERROR EN TOMA DE LECTURA-------------------------------------------------



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



                // Almacenar el total de veces para esta agencia
                $totales_por_agencia[$agencia] = $total_agencia;
                // $total_agencias_rpe += $total_agencia;

                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia[$agencia] = $rpe_agencia;


                //----------------------------------------------Motivo Lectura Retiro-------------------------------------------------


                // Obtener el resultado
                $filaLR = mysqli_fetch_assoc($resultado_LR);
                $total_vecesLR = $filaLR['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaLR[$agencia] = $total_vecesLR;

                // Sumar al total general
                $total_agenciasLR += $total_vecesLR;

                // Asignar el valor a una variable dinámicamente
                ${"total_LR" . $agencia} = $total_vecesLR;


                //fin consulta 2


                //----------------------------------------------Motivo ANOMALIA SIN ATENCION-------------------------------------------------

                // Obtener el resultado
                $filaASA = mysqli_fetch_assoc($resultado_ASA);
                $total_vecesASA = $filaASA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaASA[$agencia] = $total_vecesASA;

                // Sumar al total general
                $total_agenciasASA += $total_vecesASA;

                // Asignar el valor a una variable dinámicamente
                ${"total_ASA" . $agencia} = $total_vecesASA;


                //fin consulta 3


                //----------------------------------------------Motivo MEDIDOR SIN RETROALIMENTAR-------------------------------------------------

                // Obtener el resultado
                $filaMSR = mysqli_fetch_assoc($resultado_MSR);
                $total_vecesMSR = $filaMSR['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMSR[$agencia] = $total_vecesMSR;

                // Sumar al total general
                $total_agenciasMSR += $total_vecesMSR;

                // Asignar el valor a una variable dinámicamente
                ${"total_MSR" . $agencia} = $total_vecesMSR;


                //fin consulta 3



                //----------------------------------------------Motivo ESTIMACION EN CERO CON ANOMALIA-------------------------------------------------

                // Obtener el resultado
                $filaECA = mysqli_fetch_assoc($resultado_ECA);
                $total_vecesECA = $filaECA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaECA[$agencia] = $total_vecesECA;

                // Sumar al total general
                $total_agenciasECA += $total_vecesECA;

                // Asignar el valor a una variable dinámicamente
                ${"total_ECA" . $agencia} = $total_vecesECA;


                //fin consulta 3


                //----------------------------------------------Motivo MEDIDOR DESPROGRAMADO-------------------------------------------------

                // Obtener el resultado
                $filaMD = mysqli_fetch_assoc($resultado_MD);
                $total_vecesMD = $filaMD['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMD[$agencia] = $total_vecesMD;

                // Sumar al total general
                $total_agenciasMD += $total_vecesMD;

                // Asignar el valor a una variable dinámicamente
                ${"total_MD" . $agencia} = $total_vecesMD;


                //fin consulta 3


                //----------------------------------------------Motivo CORRECCION DEMANDA Y/O FP-------------------------------------------------

                // Obtener el resultado
                $filaCDFP = mysqli_fetch_assoc($resultado_CDFP);
                $total_vecesCDFP = $filaCDFP['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCDFP[$agencia] = $total_vecesCDFP;

                // Sumar al total general
                $total_agenciasCDFP += $total_vecesCDFP;

                // Asignar el valor a una variable dinámicamente
                ${"total_CDFP" . $agencia} = $total_vecesCDFP;


                //fin consulta 3



                //----------------------------------------------Motivo CORREGIR DEMANDA-------------------------------------------------

                // Obtener el resultado
                $filaCD = mysqli_fetch_assoc($resultado_CD);
                $total_vecesCD = $filaCD['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCD[$agencia] = $total_vecesCD;

                // Sumar al total general
                $total_agenciasCD += $total_vecesCD;

                // Asignar el valor a una variable dinámicamente
                ${"total_CD" . $agencia} = $total_vecesCD;


                //fin consulta 8



                //----------------------------------------------Motivo ERROR LECTURA TELEMEDIDA-------------------------------------------------

                // Obtener el resultado
                $filaELT = mysqli_fetch_assoc($resultado_ELT);
                $total_vecesELT = $filaELT['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaELT[$agencia] = $total_vecesELT;

                // Sumar al total general
                $total_agenciasELT += $total_vecesELT;

                // Asignar el valor a una variable dinámicamente
                ${"total_ELT" . $agencia} = $total_vecesELT;


                //fin consulta 9




                //----------------------------------------------Motivo MEDIDOR QUITAPON-------------------------------------------------

                // Obtener el resultado
                $filaMQ = mysqli_fetch_assoc($resultado_MQ);
                $total_vecesMQ = $filaMQ['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMQ[$agencia] = $total_vecesMQ;

                // Sumar al total general
                $total_agenciasMQ += $total_vecesMQ;

                // Asignar el valor a una variable dinámicamente
                ${"total_MQ" . $agencia} = $total_vecesMQ;


                //fin consulta 9




                // SUMAS TOTALES POR AGENCIA (NO POR MOTIVO)---------------------------------------------------------------------------------------

                // $suma_total_agencias = 0;
                // // Inicializar un array para almacenar los totales por agencia
                // $total_por_agencia_global = array();

                // Consulta SQL para obtener el número de veces que cada agencia aparece

                // Aquí va tu consulta SQL

                // Ejemplo hipotético para la variable total_agencia_por_motivo_A
                $total_agencia_por_motivo = $totales_por_agencia[$agencia] + $totales_por_agenciaLR[$agencia] + $totales_por_agenciaASA[$agencia] + $totales_por_agenciaMSR[$agencia] + $totales_por_agenciaECA[$agencia] + $totales_por_agenciaMD[$agencia] + $totales_por_agenciaCDFP[$agencia] + $totales_por_agenciaCD[$agencia] + $totales_por_agenciaELT[$agencia] + $totales_por_agenciaMQ[$agencia];

                // Sumar al total global por agencia
                $total_por_agencia_global[$agencia] = $total_agencia_por_motivo;


                // Sumar al total global de todas las agencias
                $suma_total_agencias += $total_agencia_por_motivo;
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





        // Suponiendo que ya tienes tu conexión a la base de datos establecida

        // Array con las agencias de interés
        $agencias = array('A', 'B', 'C', 'D', 'E', 'G', 'H', 'J', 'K', 'M');

        // Inicializar variable para el total general de agencias--------------------------------------------
        $total_agencias = 0;
        $total_agenciasLR = 0;
        $total_agenciasASA = 0;
        $total_agenciasMSR = 0;
        $total_agenciasECA = 0;
        $total_agenciasMD = 0;
        $total_agenciasCDFP = 0;
        $total_agenciasCD = 0;
        $total_agenciasELT = 0;
        $total_agenciasMQ = 0;
        //para la suma individual de las agencias
        $suma_total_agencias = 0;


        // Inicializar un array para almacenar los totales de cada agencia---------------------------------
        $totales_por_agencia = array();
        $totales_por_agenciaLR = array();
        $totales_por_agenciaASA = array();
        $totales_por_agenciaMSR = array();
        $totales_por_agenciaECA = array();
        $totales_por_agenciaMD = array();
        $totales_por_agenciaCDFP = array();
        $totales_por_agenciaCD = array();
        $totales_por_agenciaELT = array();
        $totales_por_agenciaMQ = array();
        // Inicializar un array para almacenar los totales por agencia
        $total_por_agencia_global = array();
        //Array para rpe auxiliar
        $rpe_por_agencia = array();




        // Consulta SQL para obtener el número de veces que cada agencia aparece-------------------------------------
        foreach ($agencias as $agencia) {

            //CONSULTA PARA ERROR EN TOMA DE LECTURA
            $sql = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR EN TOMA DE LECTURA')) 
                      
                        AND agencia = '$agencia'";


            //CONSULTA PARA RPE AUXILIARES EN ERROR EN TOMA DE LECTURA
            $sql_rpe = "SELECT 
                rpe_auxiliar,
                COUNT(*) AS total_veces
            FROM 
                control_manuales
            WHERE 
                TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR EN TOMA DE LECTURA')) 
             
                AND agencia = '$agencia'
            GROUP BY 
                rpe_auxiliar";


            //CONSULTA PARA LECTURA DE RETIRO

            $sql_LR = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('LECTURA DE RETIRO')) 
                        
                        AND agencia = '$agencia'";


            //ANOMALIA SIN ATENCION

            $sql_ASA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ANOMALIA SIN ATENCION')) 
                       
                        AND agencia = '$agencia'";


            //ANOMALIA MEDIDOR SIN RETROALIMENTAR


            $sql_MSR = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR SIN RETROALIMENTAR')) 
                      
                        AND agencia = '$agencia'";


            //ANOMALIA ESTIMACION EN CERO CON ANOMALIA


            $sql_ECA = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ESTIMACION EN CERO CON ANOMALIA')) 
                       
                        AND agencia = '$agencia'";



            // MEDIDOR DESPROGRAMADO


            $sql_MD = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR DESPROGRAMADO')) 
                       
                        AND agencia = '$agencia'";


            // CORRECCION DEMANDA Y/O FP


            $sql_CDFP = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('CORRECCION DEMANDA Y/O FP')) 
                      
                        AND agencia = '$agencia'";


            // CORREGIR DEMANDA


            $sql_CD = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('CORREGIR DEMANDA')) 
                       
                        AND agencia = '$agencia'";



            // ERROR LECTURA TELEMEDIDA

            $sql_ELT = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('ERROR LECTURA TELEMEDIDA')) 
                       
                        AND agencia = '$agencia'";




            // MEDIDOR QUITAPON

            $sql_MQ = "SELECT 
                        COUNT(*) AS total_veces
                    FROM 
                        control_manuales
                    WHERE 
                        TRIM(UPPER(id_motivomanual)) = TRIM(UPPER('MEDIDOR QUITAPON')) 
                     
                        AND agencia = '$agencia'";



            //--------------------------------------------ESCRIBIR VARIABLES POR CADA NUEVA CONSULTA-------------------------------------------------


            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);
            $resultado_rpe = mysqli_query($conexion, $sql_rpe);
            $resultado_LR = mysqli_query($conexion, $sql_LR);
            $resultado_ASA = mysqli_query($conexion, $sql_ASA);
            $resultado_MSR = mysqli_query($conexion, $sql_MSR);
            $resultado_ECA = mysqli_query($conexion, $sql_ECA);
            $resultado_MD = mysqli_query($conexion, $sql_MD);
            $resultado_CDFP = mysqli_query($conexion, $sql_CDFP);
            $resultado_CD = mysqli_query($conexion, $sql_CD);
            $resultado_ELT = mysqli_query($conexion, $sql_ELT);
            $resultado_MQ = mysqli_query($conexion, $sql_MQ);





            //----------------------------------------------Motivo Lectura Retiro-------------------------------------------------

            // Verificar si la consulta fue exitosa
            if ($resultado) {
                //----------------------------------------------Motivo ERROR EN TOMA DE LECTURA-------------------------------------------------

                // Obtener el resultado
                $fila = mysqli_fetch_assoc($resultado);
                $total_veces = $fila['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agencia[$agencia] = $total_veces;

                // Sumar al total general
                $total_agencias += $total_veces;

                // Asignar el valor a una variable dinámicamente
                ${"total_" . $agencia} = $total_veces;




                //----------------------------------------------RPE AUXILIARES PARA ERROR EN TOMA DE LECTURA-------------------------------------------------



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



                // Almacenar el total de veces para esta agencia
                $totales_por_agencia[$agencia] = $total_agencia;
                // $total_agencias_rpe += $total_agencia;

                // Almacenar los RPE auxiliares y la cantidad de veces que aparecen por agencia
                $rpe_por_agencia[$agencia] = $rpe_agencia;


                //----------------------------------------------Motivo Lectura Retiro-------------------------------------------------


                // Obtener el resultado
                $filaLR = mysqli_fetch_assoc($resultado_LR);
                $total_vecesLR = $filaLR['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaLR[$agencia] = $total_vecesLR;

                // Sumar al total general
                $total_agenciasLR += $total_vecesLR;

                // Asignar el valor a una variable dinámicamente
                ${"total_LR" . $agencia} = $total_vecesLR;


                //fin consulta 2


                //----------------------------------------------Motivo ANOMALIA SIN ATENCION-------------------------------------------------

                // Obtener el resultado
                $filaASA = mysqli_fetch_assoc($resultado_ASA);
                $total_vecesASA = $filaASA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaASA[$agencia] = $total_vecesASA;

                // Sumar al total general
                $total_agenciasASA += $total_vecesASA;

                // Asignar el valor a una variable dinámicamente
                ${"total_ASA" . $agencia} = $total_vecesASA;


                //fin consulta 3


                //----------------------------------------------Motivo MEDIDOR SIN RETROALIMENTAR-------------------------------------------------

                // Obtener el resultado
                $filaMSR = mysqli_fetch_assoc($resultado_MSR);
                $total_vecesMSR = $filaMSR['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMSR[$agencia] = $total_vecesMSR;

                // Sumar al total general
                $total_agenciasMSR += $total_vecesMSR;

                // Asignar el valor a una variable dinámicamente
                ${"total_MSR" . $agencia} = $total_vecesMSR;


                //fin consulta 3



                //----------------------------------------------Motivo ESTIMACION EN CERO CON ANOMALIA-------------------------------------------------

                // Obtener el resultado
                $filaECA = mysqli_fetch_assoc($resultado_ECA);
                $total_vecesECA = $filaECA['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaECA[$agencia] = $total_vecesECA;

                // Sumar al total general
                $total_agenciasECA += $total_vecesECA;

                // Asignar el valor a una variable dinámicamente
                ${"total_ECA" . $agencia} = $total_vecesECA;


                //fin consulta 3


                //----------------------------------------------Motivo MEDIDOR DESPROGRAMADO-------------------------------------------------

                // Obtener el resultado
                $filaMD = mysqli_fetch_assoc($resultado_MD);
                $total_vecesMD = $filaMD['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMD[$agencia] = $total_vecesMD;

                // Sumar al total general
                $total_agenciasMD += $total_vecesMD;

                // Asignar el valor a una variable dinámicamente
                ${"total_MD" . $agencia} = $total_vecesMD;


                //fin consulta 3


                //----------------------------------------------Motivo CORRECCION DEMANDA Y/O FP-------------------------------------------------

                // Obtener el resultado
                $filaCDFP = mysqli_fetch_assoc($resultado_CDFP);
                $total_vecesCDFP = $filaCDFP['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCDFP[$agencia] = $total_vecesCDFP;

                // Sumar al total general
                $total_agenciasCDFP += $total_vecesCDFP;

                // Asignar el valor a una variable dinámicamente
                ${"total_CDFP" . $agencia} = $total_vecesCDFP;


                //fin consulta 3



                //----------------------------------------------Motivo CORREGIR DEMANDA-------------------------------------------------

                // Obtener el resultado
                $filaCD = mysqli_fetch_assoc($resultado_CD);
                $total_vecesCD = $filaCD['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaCD[$agencia] = $total_vecesCD;

                // Sumar al total general
                $total_agenciasCD += $total_vecesCD;

                // Asignar el valor a una variable dinámicamente
                ${"total_CD" . $agencia} = $total_vecesCD;


                //fin consulta 8



                //----------------------------------------------Motivo ERROR LECTURA TELEMEDIDA-------------------------------------------------

                // Obtener el resultado
                $filaELT = mysqli_fetch_assoc($resultado_ELT);
                $total_vecesELT = $filaELT['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaELT[$agencia] = $total_vecesELT;

                // Sumar al total general
                $total_agenciasELT += $total_vecesELT;

                // Asignar el valor a una variable dinámicamente
                ${"total_ELT" . $agencia} = $total_vecesELT;


                //fin consulta 9




                //----------------------------------------------Motivo MEDIDOR QUITAPON-------------------------------------------------

                // Obtener el resultado
                $filaMQ = mysqli_fetch_assoc($resultado_MQ);
                $total_vecesMQ = $filaMQ['total_veces'];

                // Almacenar el valor en el array de totales por agencia
                $totales_por_agenciaMQ[$agencia] = $total_vecesMQ;

                // Sumar al total general
                $total_agenciasMQ += $total_vecesMQ;

                // Asignar el valor a una variable dinámicamente
                ${"total_MQ" . $agencia} = $total_vecesMQ;


                //fin consulta 9




                // SUMAS TOTALES POR AGENCIA (NO POR MOTIVO)---------------------------------------------------------------------------------------

                // $suma_total_agencias = 0;
                // // Inicializar un array para almacenar los totales por agencia
                // $total_por_agencia_global = array();

                // Consulta SQL para obtener el número de veces que cada agencia aparece

                // Aquí va tu consulta SQL

                // Ejemplo hipotético para la variable total_agencia_por_motivo_A
                $total_agencia_por_motivo = $totales_por_agencia[$agencia] + $totales_por_agenciaLR[$agencia] + $totales_por_agenciaASA[$agencia] + $totales_por_agenciaMSR[$agencia] + $totales_por_agenciaECA[$agencia] + $totales_por_agenciaMD[$agencia] + $totales_por_agenciaCDFP[$agencia] + $totales_por_agenciaCD[$agencia] + $totales_por_agenciaELT[$agencia] + $totales_por_agenciaMQ[$agencia];

                // Sumar al total global por agencia
                $total_por_agencia_global[$agencia] = $total_agencia_por_motivo;


                // Sumar al total global de todas las agencias
                $suma_total_agencias += $total_agencia_por_motivo;
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
                <th>ERROR EN TOMA DE LECTURA

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
            <tr id="rpe-lectura-1" class="fila-rpe-auxiliares" style="display: none;">
                <th>RPE AUXILIAR</th>
                <td>
                    <i class="fa-solid fa-arrow-right-from-arc"></i>
                </td>
                <!-- Agrega las celdas para los RPE auxiliares -->
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?php
                        if (isset($rpe_por_agencia[$agencia])) {
                            foreach ($rpe_por_agencia[$agencia] as $rpe_auxiliar => $total_veces_ETL_RPE) {
                                echo "<strong>$rpe_auxiliar:</strong> $total_veces_ETL_RPE<br>";
                            }
                        } else {
                            echo "0";
                        }
                        ?>
                    </td>
                <?php endforeach; ?>
                <!-- Agrega una celda vacía para el total -->
                <td style="color: greenyellow; text-align: center; background: #294835b2" class="celda"></td>
            </tr>
            <!-- Añadir más filas para LECTURA RETIRO -->
            <tr id="fila2">
                <th>LECTURA DE RETIRO</th>
                <td>
                    <i class="fa-solid fa-circle-chevron-down"></i>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_LR" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasLR ?>
                </td>
            </tr>

            <!-- Añadir más filas para ANOMALIA SIN ATENCION -->
            <tr id="fila3">
                <th>ANOMALIA SIN ATENCIÓN</th>
                <td>
                    <i class="fa-solid fa-circle-chevron-down"></i></a>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_ASA" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasASA ?>
                </td>
            </tr>

            <!-- Añadir más filas para MEDIDOR SIN RETROALIMENTAR-->
            <tr id="fila4">
                <th>MEDIDOR SIN RETROALIMENTAR</th>
                <td>
                    <i class="fa-solid fa-circle-chevron-down"></i>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_MSR" . $agencia} ?>
                    </td>
                <?php endforeach; ?>

                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasMSR ?>
                </td>
            </tr>

            <!-- Añadir más filas para ESTIMACION EN CERO CON ANOMALIA-->
            <tr id="fila5">
                <th>MESTIMACION EN CERO CON ANOMALÍA</th>
                <td>
                    <i class="fa-solid fa-circle-chevron-down"></i>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_ECA" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasECA ?>
                </td>
            </tr>


            <!-- Añadir más filas para MEDIDOR DESPROGRAMADO-->
            <tr id="fila6">
                <th>MEDIDOR DESPROGRAMADO</th>
                <td>
                    <i class="fa-solid fa-circle-chevron-down"></i>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_MD" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasMD ?>
                </td>
            </tr>

            <!-- Añadir más filas para CORRECCION DEMANDA Y/O FP-->
            <tr id="fila7">
                <th>CORRECCION DEMANDA Y/O FP</th>
                <td>
                    <i class="fa-solid fa-circle-chevron-down">
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_CDFP" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasCDFP ?>
                </td>
            </tr>

            <!-- Añadir más filas para CORREGIR DEMANDA-->
            <tr id="fila8">
                <th>CORREGIR DEMANDA</th>
                <td>
                    <i class="fa-solid fa-circle-chevron-down">
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_CD" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasCD ?>
                </td>
            </tr>


            <!-- Añadir más filas para ERROR LECTURA TELEMEDIDA-->
            <tr id="fila9">
                <th>ERROR LECTURA TELEMEDIDA</th>
                <td>
                    <i class="fa-solid fa-circle-chevron-down">
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_ELT" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasELT ?>
                </td>
            </tr>


            <!-- Añadir más filas para MEDIDOR QUITAPON-->
            <tr id="fila10">
                <th>MEDIDOR QUITAPON</th>
                <td>
                    <i class="fa-solid fa-circle-chevron-down"></i>
                </td>
                <?php foreach ($agencias as $agencia) : ?>
                    <td style="text-align: center;" class="celda columna-resumen" onclick="copiarContenido(this)">
                        <?= ${"total_MQ" . $agencia} ?>
                    </td>
                <?php endforeach; ?>
                <td style="color: greenyellow;   text-align: center;  background: #294835b2" class="celda" onclick="copiarContenido(this)">
                    <?= $total_agenciasMQ ?>
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
    </script>

    <!-- por ultimo se carga el footer -->
    <?php require('./layout/footer.php'); ?>