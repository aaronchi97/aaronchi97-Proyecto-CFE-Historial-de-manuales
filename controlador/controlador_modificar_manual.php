<?php
if (!empty($_POST["btnmodificar"])) {
    if ( //CONSULTA PARA ESTIMACION EN CERO CON ANOMALIA -LISTO
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
        and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"]) and !empty($_POST["txtkwh_recuperar"])
        and !empty($_POST["txtrespaldo_manual"]) and !empty($_POST["txtobservaciones"])
        and !empty($_POST["txtagencia"]) and !empty($_POST["txtmotivo"])
        and $_POST["txtidmotivomanual"] == 'ESTIMACION EN CERO CON ANOMALIA'

    ) {

        //Si existe el input "txtrespaldo_manual" entonces se debe incluir el input "txtno_ordenservicio"
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
        // $rpe_auxiliar = $_POST["txtrpe_auxiliar"];
        $observaciones = $_POST["txtobservaciones"];
        // $correccion = $_POST["txtcorreccion"];
        $agencia = $_POST["txtagencia"];
        $responsable_manual = $_POST["txtresponsable_manual"];
        $no_ordenservicio = $_POST["txtno_ordenservicio"];
        $motivo_correccion = $_POST["txtmotivo"];

        //Responsable de modificar manual
        $responsable_modificacion = $_POST["txtresponsable_modificacion"];


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
            rpe_auxiliar = NULL,
            observaciones = '$observaciones',
      
            agencia = '$agencia',
            responsable_manual = '$responsable_manual',
            no_ordenservicio = '$no_ordenservicio',
            id_motivohistorial = $motivo_correccion,
            responsable_modificacion = '$responsable_modificacion'
            WHERE id_control_manuales = $id_manual");




            //EL CODIGO COMENTADO DE ABAJO ASIGNA UN ID DEL MOTIVO DE LA MODIFICACION DE LA MANUAL PERO LO ASIGNA AL REGISTRO ANTERIOR
            //ES DECIR SI UN USUARIO MODIFICA UNA MANUAL, EL MOTIVO DE ESA MODIFICACION SE IMPREGNARA JUNTO CON LOS VALORES DE ESA MANUAL
            //ANTES DE SER MODIFICADA, SI SE QUIERE SEGUIR CON ESE PROCESO DESCOMENTAR EL CODIGO:


            // //    [ AGREGAR EL MOTIVO DEL HISTORIAL EN LA TABLA DE HISTORIAL_MANUALES]

            // // Verificar si la consulta principal fue exitosa
            // if ($modificar) {
            //     // Obtener el ID de la fila más reciente en la tabla historial_manuales relacionada
            //     $consultaIDHistorial = $conexion->query("SELECT MAX(id_historial_manuales) AS id_historial_manuales FROM historial_manuales WHERE rpu = '$rpu' AND accion_historial = 'MODIFICADO'");

            //     if ($consultaIDHistorial) {
            //         $filaIDHistorial = $consultaIDHistorial->fetch_assoc();
            //         $id_historial = $filaIDHistorial['id_historial_manuales'];

            //         // Ahora, realizar la actualización en la tabla de historiales agregando el motivo de la modificacion y el responsable
            //         //tener en cuenta que esta informacion se pasara a los datos antiguos 
            //         $actualizarHistorial = $conexion->query("UPDATE historial_manuales SET id_motivohistorial = '$motivo_correccion', responsable_modificacion = '$responsable_modificacion'
            // WHERE id_historial_manuales = $id_historial");

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
                            text: "Se ha modificado la manual del RPU <?= $rpu ?>, con motivo: <?= $motivo_manual ?>, correctamente",
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
                            text: "Error al modificar la manual con RPU <?= $rpu ?>",
                            styling: "bootstrap3"
                        })
                    })
                </script>

            <?php }
        }


        //FIN  ESTIMACION EN CERO CON ANOMALIA






    } else if ( //ERROR EN TOMA DE LECTURA - LISTO
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
        and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"])
        and !empty($_POST["txtrespaldo_manual"]) and !empty($_POST["txtrpe_auxiliar"]) and !empty($_POST["txtobservaciones"])
        and !empty($_POST["txtagencia"]) and !empty($_POST["txtmotivo"])
        and $_POST["txtidmotivomanual"] == 'ERROR EN TOMA DE LECTURA'
    ) {

        $id_manual = $_POST["txtid"];
        $rpu = $_POST["txtrpu"];
        $cuenta = $_POST["txtcuenta"];
        $ciclo = $_POST["txtciclo"];
        $tarifa = $_POST["txttarifa"];
        $motivo_manual = $_POST["txtidmotivomanual"];
        $sin_uso = $_POST["txtsin_uso"];
        $lectura_manual = $_POST["txtlectura_manual"];
        // $kwh_recuperar = $_POST["txtkwh_recuperar"];
        $respaldo_manual = $_POST["txtrespaldo_manual"];
        $rpe_auxiliar = $_POST["txtrpe_auxiliar"];
        $observaciones = $_POST["txtobservaciones"];
        // $correccion = $_POST["txtcorreccion"];
        $agencia = $_POST["txtagencia"];
        $responsable_manual = $_POST["txtresponsable_manual"];
        $no_ordenservicio = $_POST["txtno_ordenservicio"];
        $motivo_correccion = $_POST["txtmotivo"];

        //Responsable de modificar manual
        $responsable_modificacion = $_POST["txtresponsable_modificacion"];



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
            <!--si la manual no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "Manual no existe";
            $modificar = $conexion->query(" update control_manuales set  cuenta = '$cuenta',
            ciclo = $ciclo,
            tarifa = '$tarifa',
            id_motivomanual = '$motivo_manual',
            sin_uso = '$sin_uso',
            lectura_manual = '$lectura_manual',
            kwh_recuperar = NULL,
            respaldo_man = '$respaldo_manual',
            rpe_auxiliar = '$rpe_auxiliar',
            observaciones = '$observaciones',
        
            agencia = '$agencia',
            responsable_manual = '$responsable_manual',
            no_ordenservicio = '$no_ordenservicio',
            id_motivohistorial = $motivo_correccion,
            responsable_modificacion = '$responsable_modificacion'
            WHERE id_control_manuales = $id_manual");


            // //    [ AGREGAR EL MOTIVO DEL HISTORIAL EN LA TABLA DE HISTORIAL_MANUALES]

            // // Verificar si la consulta principal fue exitosa
            // if ($modificar) {
            //     // Obtener el ID de la fila más reciente en la tabla historial_manuales relacionada
            //     $consultaIDHistorial = $conexion->query("SELECT MAX(id_historial_manuales) AS id_historial_manuales FROM historial_manuales WHERE rpu = '$rpu' AND accion_historial = 'MODIFICADO'");

            //     if ($consultaIDHistorial) {
            //         $filaIDHistorial = $consultaIDHistorial->fetch_assoc();
            //         $id_historial = $filaIDHistorial['id_historial_manuales'];

            //         // Ahora, realizar la actualización en la tabla de historiales
            //         $actualizarHistorial = $conexion->query("UPDATE historial_manuales SET id_motivohistorial = '$motivo_correccion', responsable_modificacion = '$responsable_modificacion'
            // WHERE id_historial_manuales = $id_historial");

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
                            text: "Se ha modificado la manual del RPU <?= $rpu ?>, con motivo: <?= $motivo_manual ?>, correctamente",
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
                            text: "Error al modificar la manual con RPU <?= $rpu ?>",
                            styling: "bootstrap3"
                        })
                    })
                </script>

            <?php }
        }



        //FIN ERROR EN TOMA DE LECTURA







    } else if (
        //CONSULTA PARA LECTURA DE RETIRO - LISTO
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
        and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"]) and !empty($_POST["txtkwh_recuperar"])
        and !empty($_POST["txtobservaciones"])
        and !empty($_POST["txtagencia"]) and !empty($_POST["txtmotivo"])
        and $_POST["txtidmotivomanual"] == 'LECTURA DE RETIRO'
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
        // $respaldo_manual = $_POST["txtrespaldo_manual"];
        // $rpe_auxiliar = $_POST["txtrpe_auxiliar"];
        $observaciones = $_POST["txtobservaciones"];
        // $correccion = $_POST["txtcorreccion"];
        $agencia = $_POST["txtagencia"];
        $responsable_manual = $_POST["txtresponsable_manual"];
        $motivo_correccion = $_POST["txtmotivo"];

        //Responsable de modificar manual
        $responsable_modificacion = $_POST["txtresponsable_modificacion"];



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
            respaldo_man = NULL,
            rpe_auxiliar = NULL,
       
            observaciones = '$observaciones',
     
            agencia = '$agencia',
            responsable_manual = '$responsable_manual',
            id_motivohistorial = $motivo_correccion,
            responsable_modificacion = '$responsable_modificacion'
     
            WHERE id_control_manuales = $id_manual");


            // //    [ AGREGAR EL MOTIVO DEL HISTORIAL EN LA TABLA DE HISTORIAL_MANUALES] ---------------------------------------------

            // // Verificar si la consulta principal fue exitosa
            // if ($modificar) {
            //     // Obtener el ID de la fila más reciente en la tabla historial_manuales relacionada
            //     $consultaIDHistorial = $conexion->query("SELECT MAX(id_historial_manuales) AS id_historial_manuales FROM historial_manuales WHERE rpu = '$rpu' AND accion_historial = 'MODIFICADO'");

            //     if ($consultaIDHistorial) {
            //         $filaIDHistorial = $consultaIDHistorial->fetch_assoc();
            //         $id_historial = $filaIDHistorial['id_historial_manuales'];

            //         // Ahora, realizar la actualización en la tabla de historiales
            //         $actualizarHistorial = $conexion->query("UPDATE historial_manuales SET id_motivohistorial = '$motivo_correccion', responsable_modificacion = '$responsable_modificacion'
            // WHERE id_historial_manuales = $id_historial");

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
                            text: "Se ha modificado la manual del RPU <?= $rpu ?>, con motivo: <?= $motivo_manual ?>, correctamente",
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
                            text: "Error al modificar la manual con RPU <?= $rpu ?>",
                            styling: "bootstrap3"
                        })
                    })
                </script>

            <?php }
        }




        //FIN LECTURA DE RETIRO







    } else if (
        //CONSULTA PARA MEDIDOR SIN RETROALIMENTAR  - LISTO
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
        and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"])
        and !empty($_POST["txtobservaciones"])
        and !empty($_POST["txtagencia"]) and !empty($_POST["txtmotivo"])
        and $_POST["txtidmotivomanual"] == 'MEDIDOR SIN RETROALIMENTAR'

    ) {


        $id_manual = $_POST["txtid"];
        $rpu = $_POST["txtrpu"];
        $cuenta = $_POST["txtcuenta"];
        $ciclo = $_POST["txtciclo"];
        $tarifa = $_POST["txttarifa"];
        $motivo_manual = $_POST["txtidmotivomanual"];
        $sin_uso = $_POST["txtsin_uso"];
        $lectura_manual = $_POST["txtlectura_manual"];
        // $kwh_recuperar = $_POST["txtkwh_recuperar"];
        // $respaldo_manual = $_POST["txtrespaldo_manual"];
        // $rpe_auxiliar = $_POST["txtrpe_auxiliar"];
        $observaciones = $_POST["txtobservaciones"];
        // $correccion = $_POST["txtcorreccion"];
        $agencia = $_POST["txtagencia"];
        $responsable_manual = $_POST["txtresponsable_manual"];
        $motivo_correccion = $_POST["txtmotivo"];

        //Responsable de modificar manual
        $responsable_modificacion = $_POST["txtresponsable_modificacion"];





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
            kwh_recuperar = NULL,
            respaldo_man = NULL,
            rpe_auxiliar = NULL,
         
            observaciones = '$observaciones',
          
            agencia = '$agencia',
            responsable_manual = '$responsable_manual',
            id_motivohistorial = $motivo_correccion,
            responsable_modificacion = '$responsable_modificacion'
      
            WHERE id_control_manuales = $id_manual");


            // //    [ AGREGAR EL MOTIVO DEL HISTORIAL EN LA TABLA DE HISTORIAL_MANUALES]

            // // Verificar si la consulta principal fue exitosa
            // if ($modificar) {
            //     // Obtener el ID de la fila más reciente en la tabla historial_manuales relacionada
            //     $consultaIDHistorial = $conexion->query("SELECT MAX(id_historial_manuales) AS id_historial_manuales FROM historial_manuales WHERE rpu = '$rpu' AND accion_historial = 'MODIFICADO'");

            //     if ($consultaIDHistorial) {
            //         $filaIDHistorial = $consultaIDHistorial->fetch_assoc();
            //         $id_historial = $filaIDHistorial['id_historial_manuales'];

            //         // Ahora, realizar la actualización en la tabla de historiales
            //         $actualizarHistorial = $conexion->query("UPDATE historial_manuales SET id_motivohistorial = '$motivo_correccion', responsable_modificacion = '$responsable_modificacion'
            // WHERE id_historial_manuales = $id_historial");

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
                            text: "Se ha modificado la manual del RPU <?= $rpu ?>, con motivo: <?= $motivo_manual ?>, correctamente",
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
                            text: "Error al modificar la manual con RPU <?= $rpu ?>",
                            styling: "bootstrap3"
                        })
                    })
                </script>

            <?php }
        }




        //CONSULTA PARA MEDIDOR SIN RETROALIMENTAR









    } else if (
        //CONSULTAS PARA LOS DEMAS MOTIVOS DE MANUALES - LISTO
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
        and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"])
        and !empty($_POST["txtobservaciones"]) and !empty($_POST["txtrespaldo_manual"])
        and !empty($_POST["txtagencia"]) and !empty($_POST["txtmotivo"])
        and ($_POST["txtidmotivomanual"] == 'MEDIDOR DESPROGRAMADO' || $_POST["txtidmotivomanual"] == 'ANOMALIA SIN ATENCION'
            || $_POST["txtidmotivomanual"] == 'MEDIDOR QUITAPON' || $_POST["txtidmotivomanual"] == 'LECTURA ACUMULADA'
            || $_POST["txtidmotivomanual"] == 'ERROR LOTE 23NU' || $_POST["txtidmotivomanual"] == 'MEDIDOR INTERIOR'
            || $_POST["txtidmotivomanual"] == 'ERROR LECTURA TELEMEDIDA' || $_POST["txtidmotivomanual"] == 'CORRECCION DEMANDA Y/O FP')
    ) {


        $id_manual = $_POST["txtid"];
        $rpu = $_POST["txtrpu"];
        $cuenta = $_POST["txtcuenta"];
        $ciclo = $_POST["txtciclo"];
        $tarifa = $_POST["txttarifa"];
        $motivo_manual = $_POST["txtidmotivomanual"];
        $sin_uso = $_POST["txtsin_uso"];
        $lectura_manual = $_POST["txtlectura_manual"];
        // $kwh_recuperar = $_POST["txtkwh_recuperar"];
        $respaldo_manual = $_POST["txtrespaldo_manual"];
        // $rpe_auxiliar = $_POST["txtrpe_auxiliar"];
        $observaciones = $_POST["txtobservaciones"];
        // $correccion = $_POST["txtcorreccion"];
        $agencia = $_POST["txtagencia"];
        $responsable_manual = $_POST["txtresponsable_manual"];
        $no_ordenservicio = $_POST["txtno_ordenservicio"];
        $motivo_correccion = $_POST["txtmotivo"];

        //Responsable de modificar manual
        $responsable_modificacion = $_POST["txtresponsable_modificacion"];






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
            kwh_recuperar = NULL,
            respaldo_man = '$respaldo_manual',
            rpe_auxiliar = NULL,
            observaciones = '$observaciones',
    
            agencia = '$agencia',
            responsable_manual = '$responsable_manual',
            no_ordenservicio = '$no_ordenservicio',
            id_motivohistorial = $motivo_correccion,
            responsable_modificacion = '$responsable_modificacion'
            WHERE id_control_manuales = $id_manual");


            // //    [ AGREGAR EL MOTIVO DEL HISTORIAL EN LA TABLA DE HISTORIAL_MANUALES]

            // // Verificar si la consulta principal fue exitosa
            // if ($modificar) {
            //     // Obtener el ID de la fila más reciente en la tabla historial_manuales relacionada
            //     $consultaIDHistorial = $conexion->query("SELECT MAX(id_historial_manuales) AS id_historial_manuales FROM historial_manuales WHERE rpu = '$rpu' AND accion_historial = 'MODIFICADO'");

            //     if ($consultaIDHistorial) {
            //         $filaIDHistorial = $consultaIDHistorial->fetch_assoc();
            //         $id_historial = $filaIDHistorial['id_historial_manuales'];

            //         // Ahora, realizar la actualización en la tabla de historiales
            //         $actualizarHistorial = $conexion->query("UPDATE historial_manuales SET id_motivohistorial = '$motivo_correccion', responsable_modificacion = '$responsable_modificacion'
            // WHERE id_historial_manuales = $id_historial");

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
                            text: "Se ha modificado la manual del RPU <?= $rpu ?>, con motivo: <?= $motivo_manual ?>, correctamente",
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
                            text: "Error al modificar la manual con RPU <?= $rpu ?>",
                            styling: "bootstrap3"
                        })
                    })
                </script>

        <?php }
        }



        //FIN CONSULTAS PARA LOS DEMAS MOTIVOS DE MANUALES







        // ULTIMO ELSE EN CASO DE QUE HAYA ALGUN INPUT VACIO


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