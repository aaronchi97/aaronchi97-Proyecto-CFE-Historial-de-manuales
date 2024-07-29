<?php
if (!empty($_POST["btnregistrar_respaldo_manual"])) {
    if (
        !empty($_POST["txtagregar_respaldo_manual"])

    ) {

        $respaldo_man = $_POST["txtagregar_respaldo_manual"];

        // date_default_timezone_set('America/Mexico_City');
        // $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_respaldo_man = $conexion->query(" select count(*) as 'Total' from respaldo_manuales where respaldo_man='$respaldo_man' ");

        if ($sql_registro_respaldo_man->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El respaldo '<?= $respaldo_man ?>' ya ha sido registrado ",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el respaldo_mann no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar_respaldo_man = $conexion->query(" insert into respaldo_manuales( respaldo_man
           )values('$respaldo_man' )  ");






            if ($agregar_respaldo_man == TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado respaldo '<?= $respaldo_man ?>' correctamente",
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
                            text: "Error al generar respaldo '<?= $respaldo_man ?>'",
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