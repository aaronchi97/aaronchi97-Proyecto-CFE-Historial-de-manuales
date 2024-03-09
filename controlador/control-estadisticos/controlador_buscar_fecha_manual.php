<?php
if (!empty($_POST["btn_verxfecha"]) || !empty($_POST["btn_verxatendidas"]) || !empty($_POST["btn_verxdesatendidas"])) {


    $_SESSION["fechainicio"] = null;
    $_SESSION["fechafin"] = null;
    $_SESSION["fecha_primermes"] = null;
    $_SESSION["fecha_sextomes"] = null;
    $_SESSION["fechaxmes"] = null;
    $_SESSION["fecha_año"] = null;
    $_SESSION["fecha_mesdoce"] = null;

    if (
        !empty($_POST["fechaInicio"]) and !empty($_POST["fechaFin"])


    ) {

        // Variables para fechas personalizadas
        $fecha_inicio = $_POST["fechaInicio"];
        $fecha_fin = $_POST["fechaFin"];

        $_SESSION["fechainicio"] = $fecha_inicio;
        $_SESSION["fechafin"] = $fecha_fin;


        // echo "primer fecha:" . $_SESSION["fechainicio"] . " ";
        // echo "segunda fecha:" . $_SESSION["fechafin"];






        // $sql_buscar_manuales_por_fecha = $conexion->query("SELECT * FROM control_manuales WHERE DATE(fecha_captura) BETWEEN '$fecha_inicio' AND '$fecha_fin'");
    } else if (!empty($_POST["fecha_6meses"]) and !empty($_POST["sextomes"])) {

        //fecha de 6 mes
        //    $fecha_6meses =
        $fecha_6meses = $_POST["fecha_6meses"];
        $fecha_sextomes = $_POST["sextomes"];

        $_SESSION["fecha_primermes"] =  $fecha_6meses;
        $_SESSION["fecha_sextomes"] = $fecha_sextomes;


        // echo "primer mes:" . $_SESSION["fecha_primermes"] . " ";
        // echo "sexto mes:" . $_SESSION["fecha_sextomes"];




        // $
    } else if (!empty($_POST["fecha_1mes"])) {
        $fecha_1mes = $_POST["fecha_1mes"];

        $_SESSION["fechaxmes"] =  $fecha_1mes;


        // echo "mes:" . $_SESSION["fechaxmes"];



        // $
    } else if (!empty($_POST["fecha_anio"]) and !empty($_POST["mes_doce"])) {

        $fecha_año = $_POST["fecha_anio"];
        $doce_mes = $_POST["mes_doce"];

        $_SESSION["fecha_año"] =  $fecha_año;
        $_SESSION["fecha_mesdoce"] = $doce_mes;

        // echo "mes:" . $_SESSION["fecha_año"] . " ";
        // echo "mes:" . $_SESSION["fecha_mesdoce"];



        // $
    } else { ?>

        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR",
                    type: "error",
                    text: "Los campos estan vacios",
                    styling: "bootstrap3"
                })
            })
        </script>

    <?php } ?>



    <!--Hacemos que se refresque la pagina omitiendo los valores que se otorgaron
    en el registro en el url, evitando que se dupliquen los registros-->
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>

<?php }

?>