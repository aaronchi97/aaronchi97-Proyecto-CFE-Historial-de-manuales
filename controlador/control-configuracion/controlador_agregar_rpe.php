<?php
if (!empty($_POST["btnregistrar_rpe"])) {
    if (
        !empty($_POST["txtagregar_rpe"])

    ) {

        $rpe_auxiliar = $_POST["txtagregar_rpe"];

        // date_default_timezone_set('America/Mexico_City');
        // $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_rpe_auxiliar = $conexion->query(" select count(*) as 'Total' from rpe_auxiliar where rpe_auxiliar='$rpe_auxiliar' ");

        if ($sql_registro_rpe_auxiliar->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El rpe auxiliar '<?= $rpe_auxiliar ?>' ya ha sido registrado ",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el rpe_auxiliarn no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar_rpe_auxiliar = $conexion->query(" insert into rpe_auxiliar( rpe_auxiliar
           )values('$rpe_auxiliar' )  ");






            if ($agregar_rpe_auxiliar == TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado rpe auxiliar '<?= $rpe_auxiliar ?>' correctamente",
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
                            text: "Error al generar rpe auxiliar '<?= $rpe_auxiliar ?>'",
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