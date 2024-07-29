<?php
if (!empty($_POST["btnregistrar_justi"])) {
    if (
        !empty($_POST["txtagregar_justificacion"])

    ) {

        $justificacionn = $_POST["txtagregar_justificacion"];

        // date_default_timezone_set('America/Mexico_City');
        // $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_justificacion = $conexion->query(" select count(*) as 'Total' from respaldo_negativas where respaldo_negativa='$justificacionn' ");

        if ($sql_registro_justificacion->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "La justificacionn <?= $justificacionn ?> ya ha sido registrada ",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el justificacionn no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar_justificacion = $conexion->query(" insert into respaldo_negativas( respaldo_negativa
           )values('$justificacionn' )  ");






            if ($agregar_justificacion == TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado la justificacion <?= $justificacionn ?> correctamente",
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
                            text: "Error al generar la justificacion <?= $justificacionn ?>",
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