<?php
if (!empty($_POST["btnregistrar"])) {
    if (
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtmedidor"])
        and !empty($_POST["txtaa_mm"]) and !empty($_POST["txttipo_medidor"]) and !empty($_POST["txtcve"])
        and !empty($_POST["txtdice"]) and !empty($_POST["txtdebe_decir"]) and !empty($_POST["txtkwh_recuperar"])
        and !empty($_POST["txtid_justificacionnegativa"]) and !empty($_POST["txtobservaciones"]) and !empty($_POST["txtresponsable_negativa"])
        and !empty($_POST["txtestatus"]) and !empty($_POST["txtrpe_auxiliar"]) and !empty($_POST["txtagencia"]) and !empty($_POST["txtmotivo_correccion"])

    ) {

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
        $observacion = $_POST["txtobservaciones"];
        $responsable_negativa = $_POST["txtresponsable_negativa"];
        $estatus = $_POST["txtestatus"];
        $rpe_auxiliar = $_POST["txtrpe_auxiliar"];
        $agencia = $_POST["txtagencia"];
        $motivo_correccion = $_POST["txtmotivo_correccion"];
        date_default_timezone_set('America/Mexico_City');
        $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_negativa = $conexion->query(" select count(*) as 'Total' from control_negativas where rpu=$rpu ");

        if ($sql_registro_negativa->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El servicio con RPU <?= $rpu ?> ya ha sido registrado ",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el RPU no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar = $conexion->query(" insert into control_negativas(rpu, cuenta,
            ciclo,
            tarifa,
            medidor,
            aa_mm,
            tipo_medidor,
            cve,
            dice,
            debe_decir,
            kwh_recuperar,
            id_justificacionnegativas,
            observaciones,
            responsable_negativa, fecha_captura, id_estatus, rpe_auxiliar, agencia, motivo_correccion)values($rpu, '$cuenta',
            $ciclo,
            '$tarifa',
            '$medidor',
             $aa_mm,
            '$tipo_medidor',
             $cve,
             $dice,
             $debe_decir,
             $kwh_recuperar,
            '$justificacion_negativa',
            '$observacion',
            '$responsable_negativa',
            '$fecha_captura',
             $estatus,
             '$rpe_auxiliar',
             '$agencia',
             '$motivo_correccion' )  ");


            //    [ AGREGAR EL MOTIVO DEL HISTORIAL EN LA TABLA DE HISTORIAL_MANUALES]

            // Verificar si la consulta principal fue exitosa
            // if ($agregar) {
            //     // Obtener el ID de la fila más reciente en la tabla historial_manuales relacionada
            //     $consultaIDHistorial = $conexion->query("SELECT MAX(id_historial_manuales) AS id_historial_manuales FROM historial_manuales WHERE rpu = '$rpu' AND accion_historial = 'AGREGADO'");

            //     if ($consultaIDHistorial) {
            //         $filaIDHistorial = $consultaIDHistorial->fetch_assoc();
            //         $id_historial = $filaIDHistorial['id_historial_manuales'];

            //         // Ahora, realizar la actualización en la tabla de historiales
            //         $actualizarHistorial = $conexion->query("UPDATE historial_manuales SET id_motivohistorial = '5'
            // WHERE id_historial_manuales = $id_historial");

            //         // Verificar si la actualización del historial fue exitosa
            //         if ($actualizarHistorial) {
            //             echo "Actualización exitosa en la tabla historial_manuales.";
            //         } else {
            //             echo "Error al actualizar en la tabla historial_manuales: " . $conexion->error;
            //         }
            //     } else {
            //         echo "Error al obtener el ID de historial: " . $conexion->error;
            //     }
            // } else {
            //     echo "Error al modificar en la tabla control_manuales: " . $conexion->error;
            // }




            if ($agregar = TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado negativa con RPU <?= $rpu ?> correctamente",
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
                            text: "Error al generar negativa con RPU <?= $rpu ?>",
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