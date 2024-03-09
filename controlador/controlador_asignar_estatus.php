<?php
if (!empty($_POST["btnmodificar_estatus"])) {
    if (
        !empty($_POST["txtid_2"]) and !empty($_POST["txtrpu_2"]) and !empty($_POST["txtestatus_2"])

    ) {
        $id_manual = $_POST["txtid_2"];
        $rpu = $_POST["txtrpu_2"];
        $estatus = $_POST["txtestatus_2"];


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
            $modificar = $conexion->query(" update control_manuales set  id_estatus = $estatus
            WHERE id_control_manuales = $id_manual");


            //    [ AGREGAR EL MOTIVO DEL HISTORIAL EN LA TABLA DE HISTORIAL_MANUALES EN ESTE CASO SERIA POR CAMBIO DE ESTATUS]

            // Verificar si la consulta principal fue exitosa
            if ($modificar) {
                // Obtener el ID de la fila más reciente en la tabla historial_manuales relacionada
                $consultaIDHistorial = $conexion->query("SELECT MAX(id_historial_manuales) AS id_historial_manuales FROM historial_manuales WHERE rpu = '$rpu' AND accion_historial = 'MODIFICADO'");

                if ($consultaIDHistorial) {
                    $filaIDHistorial = $consultaIDHistorial->fetch_assoc();
                    $id_historial = $filaIDHistorial['id_historial_manuales'];

                    // Ahora, realizar la actualización en la tabla de historiales
                    $actualizarHistorial = $conexion->query("UPDATE historial_manuales SET id_motivohistorial = '4'
                    WHERE id_historial_manuales = $id_historial");

                    // Verificar si la actualización del historial fue exitosa
                    if ($actualizarHistorial) {
                    } else {
                        echo $conexion->error;
                    }
                } else {
                    echo  $conexion->error;
                }
            } else {
                echo  $conexion->error;
            }




            if ($modificar = TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Estatus asignado a RPU: <?= $rpu ?> correctamente",
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
                            text: "Error al asignar estatus a RPU <?= $rpu ?>",
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