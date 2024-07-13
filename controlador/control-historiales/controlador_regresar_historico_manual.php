<?php
if (!empty($_POST["txtverificar_contraseña"])) { ?>



    <?php


    if ($_POST["txtverificar_contraseña"] ===  $_SESSION["contraseña"]) {

        // $id_historial_negativa_regresar = $_GET["id_historial_negativa_regresar"];


        $id_manual = $_POST["txtid"];
        $id_manual_antigua = $_POST["txtid_historial"];
        $rpu = $_POST["txtrpu"];
        $cuenta = $_POST["txtcuenta_antigua"];
        $ciclo = $_POST["txtciclo_antigua"];
        $tarifa = $_POST["txttarifa_antigua"];
        $motivo_manual = $_POST["txtidmotivomanual_antigua"];
        $sin_uso = $_POST["txtsin_uso_antigua"];
        $lectura_manual = $_POST["txtlectura_manual_antigua"];
        $kwh_recuperar = $_POST["txtkwh_recuperar_antigua"];
        $respaldo_manual = $_POST["txtrespaldo_manual_antigua"];
        $rpe_auxiliar = $_POST["txtrpe_auxiliar_antigua"];
        $observaciones = $_POST["txtobservaciones_antigua"];
        // $correccion = $_POST["txtcorreccion"];
        $agencia = $_POST["txtagencia_antigua"];
        $responsable_manual = $_POST["txtresponsable_manual_antigua"];
        $no_ordenservicio = $_POST["txtno_ordenservicio_antigua"];

        // //Responsable de modificar manual
        // $responsable_modificacion = $_POST["txtresponsable_modificacion"];
        //la fecha de modificacion se agrega automaticamente con el trigger en la tabla principal


        //Responsable de regresar negativa del historial 
        $responsable_historico_regresar_manual = $_POST["txtresponsable_historial_regresar_manual"];


        //MOTIVO PARA ESPECIFICAR QUE LA NEGATIVA SE ESTA RESTAURANDO DESDE EL HISTORIAL
        $motivo_correccion = $_POST["txtmotivo"];

        echo  $motivo_manual;
        echo  $lectura_manual;
        echo  $no_ordenservicio;
        echo  $id_manual;
        echo   $ciclo;
        echo  $agencia;

        // $sql_cantidad_historico = $conexion->query(" select count(*) as 'Total' from historial_negativas where rpu=$rpu and id_historial_negativas =   $id_negativa_antigua");


        $sql_cantidad_historico = $conexion->query("SELECT count(*) as Total FROM historial_manuales WHERE rpu=$rpu AND id_historial_manuales = $id_manual_antigua");
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

            echo  $motivo_manual;
            echo  $lectura_manual;
            echo  $no_ordenservicio;
            echo  $id_manual;
            echo   $ciclo;
            echo  $agencia;

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
      
            agencia = '$agencia',
            responsable_manual = '$responsable_manual',
            no_ordenservicio = '$no_ordenservicio',
            id_motivohistorial = $motivo_correccion,
            responsable_modificacion = '$responsable_historico_regresar_manual'
            WHERE id_control_manuales = $id_manual");



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
                            text: "Se ha regresado la manual con RPU <?= $rpu ?> correctamente",
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
                            text: "Error al regresar la manual, con RPU <?= $rpu ?>, del historial",
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