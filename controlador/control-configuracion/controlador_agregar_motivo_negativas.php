<?php
if (!empty($_POST["btnregistrar_motivo_negativa"])) {
    if (
        !empty($_POST["txtagregar_motivo_correccion"])

    ) {

        $motivo_correccion = $_POST["txtagregar_motivo_correccion"];

        // date_default_timezone_set('America/Mexico_City');
        // $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_motivo_correccion = $conexion->query(" select count(*) as 'Total' from motivo_correccion_neg where motivo_correccion='$motivo_correccion' ");

        if ($sql_registro_motivo_correccion->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El motivo de corrección <?= $motivo_correccion ?> ya ha sido registrado ",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el motivo_correccionn no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar_motivo_correccion = $conexion->query(" insert into motivo_correccion_neg( motivo_correccion
           )values('$motivo_correccion' )  ");






            if ($agregar_motivo_correccion == TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado motivo de corrección <?= $motivo_correccion ?> correctamente",
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
                            text: "Error al generar motivo de corrección<?= $motivo_correccion ?>",
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