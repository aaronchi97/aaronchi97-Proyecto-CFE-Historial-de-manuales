<?php
if (!empty($_POST["btnregistrar"])) {
    if (
        !empty($_POST["txtagregar_cuenta"])

    ) {

        $cuenta = $_POST["txtagregar_cuenta"];

        // date_default_timezone_set('America/Mexico_City');
        // $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_cuentas = $conexion->query(" select count(*) as 'Total' from cuentas where cuenta='$cuenta' ");

        if ($sql_registro_cuentas->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "La cuenta <?= $cuenta ?> ya ha sido registrada ",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el cuenta no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar_cuenta = $conexion->query(" insert into cuentas( cuenta
           )values('$cuenta' )  ");






            if ($agregar_cuenta = TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado la cuenta <?= $cuenta ?> correctamente",
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
                            text: "Error al generar la cuenta <?= $cuenta ?>",
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