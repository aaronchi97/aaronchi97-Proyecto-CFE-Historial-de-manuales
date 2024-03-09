<?php
if (!empty($_POST["btnmodificar_estatus"])) {
    if (
        !empty($_POST["txtid_2"]) and !empty($_POST["txtrpu_2"]) and !empty($_POST["txtestatus_2"])

    ) {
        $id_negativa = $_POST["txtid_2"];
        $rpu = $_POST["txtrpu_2"];
        $estatus = $_POST["txtestatus_2"];


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
            <!--si el RPU no existe entonces se procede a modificar el estatus en el else-->
            <?php } else {

            $modificar = $conexion->query(" update control_negativas set  id_estatus = $estatus
            WHERE id_control_negativas = $id_negativa");


            //    [ AGREGAR EL MOTIVO DEL HISTORIAL EN LA TABLA DE HISTORIAL_NEGATIVAS EN ESTE CASO SERIA POR CAMBIO DE ESTATUS

            // Verificar si la consulta principal fue exitosa
            if ($modificar) {
                // Obtener el ID de la fila más reciente en la tabla historial_manuales relacionada
                $consultaIDHistorial = $conexion->query("SELECT MAX(id_historial_negativas) AS id_historial_negativas FROM historial_negativas WHERE rpu = '$rpu' AND accion_historial = 'MODIFICADO'");

                if ($consultaIDHistorial) {
                    $filaIDHistorial = $consultaIDHistorial->fetch_assoc();
                    $id_historial = $filaIDHistorial['id_historial_negativas'];

                    // Ahora, realizar la actualización en la tabla de historiales
                    $actualizarHistorial = $conexion->query("UPDATE historial_negativas SET id_motivohistorial = '4'
                    WHERE id_historial_negativas = $id_historial");

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