<?php
if (!empty($_POST["txtverificar_contraseña"])) { ?>


    <!-- <input type="password" name="txtverificar_contraseña" placeholder="Por favor <?= $_SESSION["nombre"] ?>, escribe tu contraseña" class="input input__text inputmodal_ineditable" autocomplete="off"> -->

    <?php


    if ($_POST["txtverificar_contraseña"] ===  $_SESSION["contraseña"]) {

        // $id_historial_negativa_regresar = $_GET["id_historial_negativa_regresar"];


        $id_negativa = $_POST["txtid"];
        $id_negativa_antigua = $_POST["txtid_antigua"];
        $rpu = $_POST["txtrpu"];
        $cuenta = $_POST["txtcuenta_antigua"];
        $ciclo = $_POST["txtciclo_antigua"];
        $tarifa = $_POST["txttarifa_antigua"];
        $medidor = $_POST["txtmedidor_antigua"];
        $aa_mm = $_POST["txtaa_mm_antigua"];
        $tipo_medidor = $_POST["txttipo_medidor_antigua"];
        $cve = $_POST["txtcve_antigua"];
        $dice = $_POST["txtdice_antigua"];
        $debe_decir = $_POST["txtdebe_decir_antigua"];
        $kwh_recuperar = $_POST["txtkwh_recuperar_antigua"];
        $justificacion_negativa = $_POST["txtid_justificacionnegativa_antigua"];
        $obervacion = $_POST["txtobservaciones_antigua"];
        $responsable_negativa = $_POST["txtresponsable_negativa_antigua"];

        $rpe_auxiliar = $_POST["txtrpe_auxiliar_antigua"];
        $agencia = $_POST["txtagencia_antigua"];
        $motivo_negativa = $_POST["txtmotivo_correccion_antigua"];
        //la fecha de modificacion se agrega automaticamente con el trigger en la tabla principal


        //Responsable de regresar negativa del historial 
        $responsable_historico_regresar_negativa = $_POST["txtresponsable_historial_regresar_negativa"];


        //MOTIVO PARA ESPECIFICAR QUE LA NEGATIVA SE ESTA RESTAURANDO DESDE EL HISTORIAL
        $motivo_correccion = $_POST["txtmotivo"];



        // $sql_cantidad_historico = $conexion->query(" select count(*) as 'Total' from historial_negativas where rpu=$rpu and id_historial_negativas =   $id_negativa_antigua");

        $sql_cantidad_historico = $conexion->query("SELECT count(*) as Total FROM historial_negativas WHERE rpu=$rpu AND id_historial_negativas = $id_negativa_antigua");
        $total_historico = $sql_cantidad_historico->fetch_object()->Total;


        if ($total_historico < 1) { ?>
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
            <!--SI HAY UN UNICO REGISTRO EN EL HISTORIAL QUE SEA IGUAL AL RPU DEL MODAL Y AL ID DE SU HISTORICO ENTONCES -->
            <?php } else if ($total_historico == 1) {

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
            responsable_modificacion = '$responsable_historico_regresar_negativa'
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




            if ($modificar) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha regresado la negativa con RPU <?= $rpu ?> correctamente",
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
                            text: "Error al regresar la negativa, con RPU <?= $rpu ?>, del historial",
                            styling: "bootstrap3"
                        })
                    })
                </script>

        <?php }
        }
    } else { ?>
        <!-- //ELSE PARA NOTIFICAR QUE LA CONTRASEÑA NO COINCIDE -->

        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR",
                    type: "error",
                    text: "La contraseña no coincide, intentalo de nuevo",
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



<?php  }



?>