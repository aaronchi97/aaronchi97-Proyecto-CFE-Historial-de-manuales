<?php
if (!empty($_POST["btnregistrar_tipomedidor"])) {
    if (
        !empty($_POST["txtagregar_tipomedidor"])

    ) {

        $tipo_medidor = $_POST["txtagregar_tipomedidor"];

        // date_default_timezone_set('America/Mexico_City');
        // $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_tipo_medidor = $conexion->query(" select count(*) as 'Total' from tipo_medidores where tipo_medidor='$tipo_medidor' ");

        if ($sql_registro_tipo_medidor->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "La medidorn <?= $tipo_medidor ?> ya ha sido registrada ",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el medidorn no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar_tipo_medidor = $conexion->query(" insert into tipo_medidores( tipo_medidor
           )values('$tipo_medidor' )  ");






            if ($agregar_tipo_medidor == TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado medidor <?= $tipo_medidor ?> correctamente",
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
                            text: "Error al generar medidor <?= $tipo_medidor ?>",
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