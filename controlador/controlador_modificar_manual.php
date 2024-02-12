<?php
    if (!empty($_POST["btnmodificar"])) {
       if (!empty($_POST["txtid"]) and !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
        and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"]) and !empty($_POST["txtkwh_recuperar"])
        and !empty($_POST["txtrespaldo_manual"]) and !empty($_POST["txtrpe_auxiliar"]) and !empty($_POST["txtobservaciones"])
        and !empty($_POST["txtcorreccion"]) and !empty($_POST["txtagencia"]) and !empty($_POST["txtresponsable_manual"])
    
       ) {
        $id_manual = $_POST["txtid"];
        $rpu = $_POST["txtrpu"];
        $cuenta = $_POST["txtcuenta"];
        $ciclo = $_POST["txtciclo"];
        $tarifa = $_POST["txttarifa"];
        $motivo_manual = $_POST["txtidmotivomanual"];
        $sin_uso = $_POST["txtsin_uso"];
        $lectura_manual = $_POST["txtlectura_manual"];
        $kwh_recuperar = $_POST["txtkwh_recuperar"];
        $respaldo_manual = $_POST["txtrespaldo_manual"];
        $rpe_auxiliar = $_POST["txtrpe_auxiliar"];
        $observaciones = $_POST["txtobservaciones"];
        $correccion = $_POST["txtcorreccion"];
        $agencia = $_POST["txtagencia"];
        $responsable_manual = $_POST["txtresponsable_manual"];
        
        
        $sql = $conexion->query(" select count(*) as 'Total' from control_manuales where rpu=$rpu and id_control_manuales!=$id_manual");

        if ($sql->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El RPU <?= $rpu ?> esta duplicado",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el usuario no existe entonces se procede a modificarlo en el else-->
        <?php } else {
            // echo "El usuario no existe";
            $modificar = $conexion->query(" update control_manuales set  cuenta = '$cuenta',
            ciclo = $ciclo,
            tarifa = '$tarifa',
            id_motivomanual = '$motivo_manual',
            sin_uso = '$sin_uso',
            lectura_manual = '$lectura_manual',
            kwh_recuperar = $kwh_recuperar,
            respaldo_man = '$respaldo_manual',
            rpe_auxiliar = '$rpe_auxiliar',
            observaciones = '$observaciones',
            correccion = '$correccion',
            agencia = '$agencia',
            responsable_manual = '$responsable_manual'
            WHERE id_control_manuales = $id_manual");
            

            if ($modificar = TRUE) { ?>  <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado la manual del RPU <?= $rpu ?> correctamente",
                            styling: "bootstrap3"
                        })
                    })
                </script>

            <?php } else {?>
               
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Error al generar la manual con RPU <?= $rpu ?>",
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