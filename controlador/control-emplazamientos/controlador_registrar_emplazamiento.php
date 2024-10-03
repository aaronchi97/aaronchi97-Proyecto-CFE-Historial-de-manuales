<?php
if (!empty($_POST["btnregistrar"])) {
    if (
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtdireccion"])
        and !empty($_POST["txtmedidor"]) and !empty($_POST["txtgeoreferencia"]) and !empty($_POST["txtdias"])
        and !empty($_POST["txtcorreccion"]) and !empty($_POST["txtfecha_emplazamiento"]) // and !empty($_POST["txtimpresion"])
        and !empty($_POST["txtresponsable_emplazamiento"]) and !empty($_POST["txtagencia"])

    ) {

        $id_manual = $_POST["txtid_manual"];
        $rpu = $_POST["txtrpu"];
        $cuenta = $_POST["txtcuenta"];
        $ciclo = $_POST["txtciclo"];
        $medidor = $_POST["txtmedidor"];

        $nombre = $_POST["txtnombre"];

        $direccion = $_POST["txtdireccion"];
        // $direccion = json_decode($_POST['txtdireccion'], true);
        // Ahora puedes acceder a la información de la dirección:
        // $nombre = $direccion['name'];
        // $latitud = $direccion['geometry']['location']['lat'];
        // $longitud = $direccion['geometry']['location']['lng'];
        $georeferencia = $_POST["txtgeoreferencia"];
        $agencia = $_POST["txtagencia"];
        $dias = $_POST["txtdias"];
        $correccion = $_POST["txtcorreccion"];
        $impresion = $_POST["txtimpresion"];

        $responsable_emplazamiento = $_POST["txtresponsable_emplazamiento"];
        date_default_timezone_set('America/Mexico_City');
        $fecha_impresion = date("Y-m-d H:i:s");
        $fecha = $_POST["txtfecha_emplazamiento"];

        $sql_registro_emplazamientos = $conexion->query(" select count(*) as 'Total' from emplazamientos where rpu_emplazamiento=$rpu ");

        if ($sql_registro_emplazamientos->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El emplazamiento con RPU <?= $rpu ?> ya ha sido registrado ",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el RPU no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";


            $agregar = $conexion->query(" insert into emplazamientos(id_control_manuales, rpu_emplazamiento, cuenta_emplazamiento,
            ciclo_emplazamiento,
            nombre,
            medidor_emplazamiento,
            direccion,
            georeferencia,
            dias,
            correccion_emplazamiento,
            fecha_emplazamiento,
           agencia_emplazamiento,
            impresion,
            responsable_emplazamiento)values($id_manual,$rpu, '$cuenta',
            $ciclo,
            '$nombre',
            '$medidor',
     
            '$direccion',
             '$georeferencia',
             $dias,
             '$correccion',
             '$fecha',
            '$agencia',
            '$fecha_impresion',
            '$responsable_emplazamiento'
             )  ");





            if ($agregar = TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->
                <?php

                // Obtener el ID del emplazamiento recién insertado
                $id_emplazamiento = $conexion->insert_id;

                // Crear la instancia de mPDF
                // require_once 'vendor/autoload.php';
                require_once 'C:/xampp/htdocs/Proyecto-CFE/vendor/autoload.php';
                // $mpdf = new \Mpdf\Mpdf();
                $mpdf = new \mPDF();


                // Cargar la plantilla HTML
                $html = file_get_contents('../../vista/plantillas_pdf/plantilla_1.html');

                // Reemplazar las variables en la plantilla con los datos recibidos
                $html = str_replace('{{rpu}}', $rpu, $html);
                $html = str_replace('{{cuenta}}', $cuenta, $html);
                $html = str_replace('{{ciclo}}', $ciclo, $html);
                $html = str_replace('{{nombre}}', $nombre, $html);
                $html = str_replace('{{direccion}}', $direccion, $html);
                $html = str_replace('{{medidor}}', $medidor, $html);
                $html = str_replace('{{georeferencia}}', $georeferencia, $html);
                $html = str_replace('{{dias}}', $dias, $html);
                $html = str_replace('{{correccion}}', $correccion, $html);
                $html = str_replace('{{fecha}}', $fecha, $html);
                $html = str_replace('{{agencia}}', $agencia, $html);
                $html = str_replace('{{responsable}}', $responsable_emplazamiento, $html);

                // Escribir el contenido en el PDF
                $mpdf->WriteHTML($html);

                // Crear la carpeta específica para el emplazamiento
                $fecha_carpeta = date('Ymd'); // Fecha actual en formato AAAAMMDD
                $nombre_carpeta = "emplazamiento_" . $id_emplazamiento . "_" . $fecha_carpeta;
                $ruta_carpeta = "emplazamientos/" . $nombre_carpeta;

                if (!file_exists($ruta_carpeta)) {
                    mkdir($ruta_carpeta, 0777, true);
                }

                // Definir la ruta completa para el PDF
                $nombre_pdf = "reporte_emplazamiento.pdf";
                $ruta_pdf = $ruta_carpeta . "/" . $nombre_pdf;

                // Guardar el PDF en la carpeta
                $mpdf->Output($ruta_pdf, \Mpdf\Output\Destination::FILE);

                // Guardar la ruta del PDF en la base de datos
                $sql_update = "UPDATE emplazamientos SET ruta_pdf = ? WHERE id_emplazamiento = ?";
                $stmt = $conexion->prepare($sql_update);
                $stmt->bind_param('si', $ruta_pdf, $id_emplazamiento);
                $stmt->execute();

                // Mostrar un mensaje de éxito
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado emplazamiento con RPU <?= $rpu ?> correctamente",
                            styling: "bootstrap3"
                        })
                    })
                </script>

                <a href="emplazamientos.php">ver</a>

            <?php } else { ?>

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Error al generar emplazamiento con RPU <?= $rpu ?>",
                            styling: "bootstrap3"
                        })
                    })
                </script>

        <?php }
        }
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