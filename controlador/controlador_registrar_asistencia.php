<?php
    if (!empty($_POST["btnregistrar"])) {
       if (!empty($_POST["txtid_asig"]) and !empty($_POST["txtid_pres"]) ) {
        $id = $_POST["txtid_asig"];
        $presencia = $_POST["txtid_pres"];
        date_default_timezone_set('America/Mexico_City');
        $fecha = date("Y-m-d");
        
        // $fecha = $_POST["txtfecha"];

       
        $sql_registro_asistencia = $conexion->query(" select count(*) as 'Total' from asistencia_docentes where id_asignacion=$id and fecha_captura='$fecha' ");

        if ($sql_registro_asistencia->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "UPS!",
                        type: "error",
                        text: "Docente registrado con fecha <?= $fecha ?>",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el registro no existe entonces se procede a crearlo en el else-->
        <?php } else {
            // echo "El registro no se ha efectuado";
            $registrar = $conexion->query(" insert into asistencia_docentes(id_asignacion, id_presencia, fecha_captura)values('$id', '$presencia', '$fecha')");

            if ($registrar = TRUE) { ?>  <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "El registro de asistencia se ha guardado con exito",
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
                            text: "Error al registrar a asistencia del docente<?= $nombre ?>",
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


    <!-- <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script> -->

<?php }

?>