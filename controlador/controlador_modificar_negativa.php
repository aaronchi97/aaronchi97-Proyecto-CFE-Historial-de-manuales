<?php
if (!empty($_POST["btnmodificar"])) {
    if (
        !empty($_POST["txtid"]) and !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtmedidor"])
        and !empty($_POST["txtaa_mm"]) and !empty($_POST["txttipo_medidor"]) and !empty($_POST["txtcve"])
        and !empty($_POST["txtdice"]) and !empty($_POST["txtdebe_decir"]) and !empty($_POST["txtkwh_recuperar"])
        and !empty($_POST["txtid_justificacionnegativa"]) and !empty($_POST["txtobservaciones"])
        and !empty($_POST["txtmotivo"]) and !empty($_POST["txtrpe_auxiliar"]) and !empty($_POST["txtagencia"]) and !empty($_POST["txtmotivo_correccion"])

    ) {
        $id_negativa = $_POST["txtid"];
        $rpu = $_POST["txtrpu"];
        $cuenta = $_POST["txtcuenta"];
        $ciclo = $_POST["txtciclo"];
        $tarifa = $_POST["txttarifa"];
        $medidor = $_POST["txtmedidor"];
        $aa_mm = $_POST["txtaa_mm"];
        $tipo_medidor = $_POST["txttipo_medidor"];
        $cve = $_POST["txtcve"];
        $dice = $_POST["txtdice"];
        $debe_decir = $_POST["txtdebe_decir"];
        $kwh_recuperar = $_POST["txtkwh_recuperar"];
        $justificacion_negativa = $_POST["txtid_justificacionnegativa"];
        $obervacion = $_POST["txtobservaciones"];
        $responsable_negativa = $_POST["txtresponsable_negativa"];
        $motivo_correccion = $_POST["txtmotivo"];
        $rpe_auxiliar = $_POST["txtrpe_auxiliar"];
        $agencia = $_POST["txtagencia"];
        $motivo_negativa = $_POST["txtmotivo_correccion"];
        //la fecha de modificacion se agrega automaticamente con el trigger en la tabla principal


        //Responsable de modificar manual
        $responsable_modificacion = $_POST["txtresponsable_modificacion"];



        $sql = $conexion->query(" select count(*) as 'Total' from control_negativas where rpu=$rpu and id_control_negativas != $id_negativa");

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
            $modificar = $conexion->query(" update control_negativas set  cuenta = '$cuenta',
            ciclo = $ciclo,
            tarifa = '$tarifa',
            medidor = '$medidor',
            aa_mm = $aa_mm,
            tipo_medidor = '$tipo_medidor',
            cve = $cve,
            dice = $dice,
            debe_decir = $debe_decir,
            kwh_recuperar = $kwh_recuperar,
            id_justificacionnegativas= '$justificacion_negativa',
            observaciones = '$obervacion',
            responsable_negativa = '$responsable_negativa',
            rpe_auxiliar = '$rpe_auxiliar',
            agencia= '$agencia',
            motivo_correccion= '$motivo_negativa',
            id_motivohistorial = $motivo_correccion,
            responsable_modificacion = '$responsable_modificacion'
            WHERE id_control_negativas = $id_negativa");



            //EL CODIGO COMENTADO DE ABAJO ASIGNA UN ID DEL MOTIVO DE LA MODIFICACION DE LA MANUAL PERO LO ASIGNA AL REGISTRO ANTERIOR
            //ES DECIR SI UN USUARIO MODIFICA UNA MANUAL, EL MOTIVO DE ESA MODIFICACION SE IMPREGNARA JUNTO CON LOS VALORES DE ESA MANUAL
            //ANTES DE SER MODIFICADA, SI SE QUIERE SEGUIR CON ESE PROCESO DESCOMENTAR EL CODIGO:


            // //    [ AGREGAR EL MOTIVO DEL HISTORIAL EN LA TABLA DE HISTORIAL_MANUALES]

            // // Verificar si la consulta principal fue exitosa
            // if ($modificar) {
            //     // Obtener el ID de la fila más reciente en la tabla historial_manuales relacionada
            //     $consultaIDHistorial = $conexion->query("SELECT MAX(id_historial_negativas) AS id_historial_negativas FROM historial_negativas WHERE rpu = '$rpu' AND accion_historial = 'MODIFICADO'");

            //     if ($consultaIDHistorial) {
            //         $filaIDHistorial = $consultaIDHistorial->fetch_assoc();
            //         $id_historial = $filaIDHistorial['id_historial_negativas'];

            //         // Ahora, realizar la actualización en la tabla de historiales
            //         $actualizarHistorial = $conexion->query("UPDATE historial_negativas SET id_motivohistorial = '$motivo_correccion'
            // WHERE id_historial_negativas = $id_historial");

            //         // Verificar si la actualización del historial fue exitosa
            //         if ($actualizarHistorial) {
            //         } else {
            //             echo $conexion->error;
            //         }
            //     } else {
            //         echo  $conexion->error;
            //     }
            // } else {
            //     echo  $conexion->error;
            // }




            if ($modificar = TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha modificado la negativa con RPU <?= $rpu ?> correctamente",
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
                            text: "Error al modificar la negativa con RPU <?= $rpu ?>",
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