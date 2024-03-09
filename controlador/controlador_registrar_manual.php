<?php
if (!empty($_POST["btnregistrar"])) {
    if (

        // !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        // and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
        // and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"]) and !empty($_POST["txtkwh_recuperar"])
        // and !empty($_POST["txtrespaldo_manual"]) and !empty($_POST["txtrpe_auxiliar"]) and !empty($_POST["txtobservaciones"])
        // and !empty($_POST["txtcorreccion"]) and !empty($_POST["txtagencia"]) and !empty($_POST["txtresponsable_manual"])
        // and !empty($_POST["txtestatus"])

        //CONSULTA PARA ESTIMACION EN CERO CON ANOMALIA
        (!empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
            and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
            and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"]) and !empty($_POST["txtkwh_recuperar"])
            and !empty($_POST["txtrespaldo_manual"]) and !empty($_POST["txtobservaciones"])
            and !empty($_POST["txtagencia"]) and !empty($_POST["txtresponsable_manual"])
            and !empty($_POST["txtestatus"]))


    ) {

        $rpu = $_POST["txtrpu"];
        $cuenta = $_POST["txtcuenta"];
        $ciclo = $_POST["txtciclo"];
        $tarifa = $_POST["txttarifa"];
        $motivo_manual = $_POST["txtidmotivomanual"];
        $sin_uso = $_POST["txtsin_uso"];
        $lectura_manual = $_POST["txtlectura_manual"];
        $kwh_recuperar = $_POST["txtkwh_recuperar"];
        $respaldo_manual = $_POST["txtrespaldo_manual"];

        $observaciones = $_POST["txtobservaciones"];
        // $correccion = $_POST["txtcorreccion"];
        $agencia = $_POST["txtagencia"];
        $responsable_manual = $_POST["txtresponsable_manual"];
        $estatus = $_POST["txtestatus"];
        $no_ordenservicio = $_POST["txtno_ordenservicio"];
        date_default_timezone_set('America/Mexico_City');
        $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_manual = $conexion->query(" select count(*) as 'Total' from control_manuales where rpu=$rpu ");

        if ($sql_registro_manual->fetch_object()->Total > 0) { ?>
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
            <!--si el usuario no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar = $conexion->query(" insert into control_manuales(rpu, cuenta,
            ciclo,
            tarifa,
            id_motivomanual,
            sin_uso,
            lectura_manual,
            kwh_recuperar,
            respaldo_man,
            
            observaciones,
            no_ordenservicio,	
            agencia,
            responsable_manual, id_estatus, fecha_captura)values($rpu, '$cuenta',
            $ciclo,
            '$tarifa',
            '$motivo_manual',
            '$sin_uso',
            '$lectura_manual',
            $kwh_recuperar,
            '$respaldo_manual',
           
            '$observaciones',
            '$no_ordenservicio',
            '$agencia',
            '$responsable_manual',
             $estatus,
            '$fecha_captura' )  ");




            if ($agregar = TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado la manual del RPU <?= $rpu ?> con motivo: ESTIMACION EN CERO CON ANOMALIA, correctamente",
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
                            text: "Error al generar la manual con RPU <?= $rpu ?>",
                            styling: "bootstrap3"
                        })
                    })
                </script>

            <?php }
        }
    } else if (  //ERROR EN TOMA DE LECTURA
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
        and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"])
        and !empty($_POST["txtrespaldo_manual"]) and !empty($_POST["txtrpe_auxiliar"]) and !empty($_POST["txtobservaciones"])
        and !empty($_POST["txtagencia"]) and !empty($_POST["txtresponsable_manual"])
        and !empty($_POST["txtestatus"])
    ) {



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
        $estatus = $_POST["txtestatus"];
        date_default_timezone_set('America/Mexico_City');
        $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_manual = $conexion->query(" select count(*) as 'Total' from control_manuales where rpu=$rpu ");

        if ($sql_registro_manual->fetch_object()->Total > 0) { ?>
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
            <!--si el usuario no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar = $conexion->query(" insert into control_manuales(rpu, cuenta,
            ciclo,
            tarifa,
            id_motivomanual,
            sin_uso,
            lectura_manual,
        
            respaldo_man,
            rpe_auxiliar,
            observaciones,
            no_ordenservicio,
            agencia,
            responsable_manual, id_estatus, fecha_captura)values($rpu, '$cuenta',
            $ciclo,
            '$tarifa',
            '$motivo_manual',
            '$sin_uso',
            '$lectura_manual',
            
            '$respaldo_manual',
            '$rpe_auxiliar',
            '$observaciones',
            '$no_ordenservicio',
            '$agencia',
            '$responsable_manual',
             $estatus,
            '$fecha_captura' )  ");




            if ($agregar = TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado la manual del RPU <?= $rpu ?> con motivo: ERROR EN TOMA DE LECTURA correctamente",
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
                            text: "Error al generar la manual con RPU <?= $rpu ?>",
                            styling: "bootstrap3"
                        })
                    })
                </script>

            <?php }
        }

        //termina 2da consulta
    } else if (
        //CONSULTA PARA LECTURA DE RETIRO
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
        and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"]) and !empty($_POST["txtkwh_recuperar"])
        and !empty($_POST["txtobservaciones"])
        and !empty($_POST["txtagencia"]) and !empty($_POST["txtresponsable_manual"])
        and !empty($_POST["txtestatus"])
    ) {





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
        $estatus = $_POST["txtestatus"];
        date_default_timezone_set('America/Mexico_City');
        $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_manual = $conexion->query(" select count(*) as 'Total' from control_manuales where rpu=$rpu ");

        if ($sql_registro_manual->fetch_object()->Total > 0) { ?>
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
            <!--si el usuario no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar = $conexion->query(" insert into control_manuales(rpu, cuenta,
            ciclo,
            tarifa,
            id_motivomanual,
            sin_uso,
            lectura_manual,
            kwh_recuperar,
          
       
            observaciones,
        
            agencia,
            responsable_manual, id_estatus, fecha_captura)values($rpu, '$cuenta',
            $ciclo,
            '$tarifa',
            '$motivo_manual',
            '$sin_uso',
            '$lectura_manual',
            $kwh_recuperar,
          
        
            '$observaciones',

            '$agencia',
            '$responsable_manual',
             $estatus,
            '$fecha_captura' )  ");




            if ($agregar = TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado la manual del RPU <?= $rpu ?> con motivo: LECTURA DE RETIRO, correctamente",
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
                            text: "Error al generar la manual con RPU <?= $rpu ?>",
                            styling: "bootstrap3"
                        })
                    })
                </script>

            <?php }
        }


        //termina 3ra consulta
    } else if (
        //CONSULTA PARA MEDIDOR SIN RETROALIMENTAR
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
        and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"])
        and !empty($_POST["txtobservaciones"])
        and !empty($_POST["txtagencia"]) and !empty($_POST["txtresponsable_manual"])
        and !empty($_POST["txtestatus"])
    ) {







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
        $estatus = $_POST["txtestatus"];
        date_default_timezone_set('America/Mexico_City');
        $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_manual = $conexion->query(" select count(*) as 'Total' from control_manuales where rpu=$rpu ");

        if ($sql_registro_manual->fetch_object()->Total > 0) { ?>
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
            <!--si el usuario no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar = $conexion->query(" insert into control_manuales(rpu, cuenta,
            ciclo,
            tarifa,
            id_motivomanual,
            sin_uso,
            lectura_manual,
           
            observaciones,
          
            agencia,
            responsable_manual, id_estatus, fecha_captura)values($rpu, '$cuenta',
            $ciclo,
            '$tarifa',
            '$motivo_manual',
            '$sin_uso',
            '$lectura_manual',
           
            '$observaciones',
       
            '$agencia',
            '$responsable_manual',
             $estatus,
            '$fecha_captura' )  ");




            if ($agregar = TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado la manual del RPU <?= $rpu ?> con motivo: MEDIDOR SIN RETROALIMENTAR, correctamente",
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
                            text: "Error al generar la manual con RPU <?= $rpu ?>",
                            styling: "bootstrap3"
                        })
                    })
                </script>

            <?php }
        }


        //termina 4ta consulta





    } else if (

        //CONSULTAS PARA LOS DEMAS MOTIVOS DE MANUALES
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
        and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
        and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"])
        and !empty($_POST["txtobservaciones"]) and !empty($_POST["txtrespaldo_manual"])
        and !empty($_POST["txtagencia"]) and !empty($_POST["txtresponsable_manual"])
        and !empty($_POST["txtestatus"])
    ) {





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
        $estatus = $_POST["txtestatus"];
        $no_ordenservicio = $_POST["txtno_ordenservicio"];
        date_default_timezone_set('America/Mexico_City');
        $fecha_captura = date("Y-m-d H:i:s");




        $sql_registro_manual = $conexion->query(" select count(*) as 'Total' from control_manuales where rpu=$rpu ");

        if ($sql_registro_manual->fetch_object()->Total > 0) { ?>
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
            <!--si el usuario no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";
            $agregar = $conexion->query(" insert into control_manuales(rpu, cuenta,
            ciclo,
            tarifa,
            id_motivomanual,
            sin_uso,
            lectura_manual,
        
            respaldo_man,
      
            observaciones,
            no_ordenservicio,
            agencia,
            responsable_manual, id_estatus, fecha_captura)values($rpu, '$cuenta',
            $ciclo,
            '$tarifa',
            '$motivo_manual',
            '$sin_uso',
            '$lectura_manual',
     
            '$respaldo_manual',
        
            '$observaciones',

            '$no_ordenservicio',
            '$agencia',
            '$responsable_manual',
             $estatus,
            '$fecha_captura' )  ");




            if ($agregar = TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

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

            <?php } else { ?>

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


        //termina 5ta consulta




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



<!-- 
//ERROR EN TOMA DE LECTURA
        (!empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
            and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
            and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"])
            and !empty($_POST["txtrespaldo_manual"]) and !empty($_POST["txtrpe_auxiliar"]) and !empty($_POST["txtobservaciones"])
            and !empty($_POST["txtagencia"]) and !empty($_POST["txtresponsable_manual"])
            and !empty($_POST["txtestatus"])) || LISTO


        //CONSULTA PARA LECTURA DE RETIRO
        (!empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
            and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
            and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"]) and !empty($_POST["txtkwh_recuperar"])
            and !empty($_POST["txtobservaciones"])
            and !empty($_POST["txtagencia"]) and !empty($_POST["txtresponsable_manual"])
            and !empty($_POST["txtestatus"])) || LISTO


        //CONSULTA PARA MEDIDOR SIN RETROALIMENTAR
        (!empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
            and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
            and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"])
            and !empty($_POST["txtobservaciones"])
            and !empty($_POST["txtagencia"]) and !empty($_POST["txtresponsable_manual"])
            and !empty($_POST["txtestatus"])) || LISTO


        //CONSULTA PARA 'MEDIDOR DESPROGRAMADO ANOMALIA SIN ATENCION MEDIDOR QUITAPON LECTURA ACUMULADA, ERROR LOTE 23NU, MEDIDOR INTERIOR, ERROR LECTURA TELEMEDIDA, CORRECCION DEMANDA Y/O FP
        (!empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])
            and !empty($_POST["txtciclo"]) and !empty($_POST["txttarifa"]) and !empty($_POST["txtidmotivomanual"])
            and !empty($_POST["txtsin_uso"]) and !empty($_POST["txtlectura_manual"])
            and !empty($_POST["txtobservaciones"]) and !empty($_POST["txtrespaldo_manual"])
            and !empty($_POST["txtagencia"]) and !empty($_POST["txtresponsable_manual"])
            and !empty($_POST["txtestatus"]))  LISTO -->