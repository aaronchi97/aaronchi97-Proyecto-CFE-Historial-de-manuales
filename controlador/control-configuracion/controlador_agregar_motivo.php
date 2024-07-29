<?php
if (!empty($_POST["btnregistrar_motivo_manual"])) {
    if (
        !empty($_POST["txtagregar_motivo"])

    ) {

        $motivo_manual = $_POST["txtagregar_motivo"];

        // date_default_timezone_set('America/Mexico_City');
        // $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_motivo_manual = $conexion->query(" select count(*) as 'Total' from motivo_manuales where motivo_manual='$motivo_manual' ");

        if ($sql_registro_motivo_manual->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El motivo de corrección <?= $motivo_manual ?> ya ha sido registrado ",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el motivo_manualn no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar_motivo_manual = $conexion->query(" insert into motivo_manuales( motivo_manual
           )values('$motivo_manual' )  ");






            if ($agregar_motivo_manual == TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado motivo <?= $motivo_manual ?> correctamente",
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
                            text: "Error al generar motivo <?= $motivo_manual ?>",
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