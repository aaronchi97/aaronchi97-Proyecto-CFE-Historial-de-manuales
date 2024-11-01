<?php
if (!empty($_POST["btnregistrar_tarifa"])) {
    if (
        !empty($_POST["txtagregar_tarifa"])

    ) {

        $tarifa = $_POST["txtagregar_tarifa"];

        // date_default_timezone_set('America/Mexico_City');
        // $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_tarifa = $conexion->query(" select count(*) as 'Total' from tarifas where tarifa='$tarifa' ");

        if ($sql_registro_tarifa->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "La tarifa <?= $tarifa ?> ya ha sido registrada ",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si la tarifa no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar_tarifa = $conexion->query(" insert into tarifas( tarifa
           )values('$tarifa' )  ");






            if ($agregar_tarifa == TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado tarifa <?= $tarifa ?> correctamente",
                            styling: "bootstrap3"
                        })
                    })
                </script>

            <?php } else { ?>

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Error al generar tarifa <?= $tarifa ?>",
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