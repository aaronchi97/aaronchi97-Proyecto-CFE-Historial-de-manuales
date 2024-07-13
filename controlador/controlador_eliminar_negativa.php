<?php
if (!empty($_GET["id_negativa_eliminar"])) {

    $id_negativa_eliminar = $_GET["id_negativa_eliminar"];

    $responsable = $conexion->real_escape_string($_SESSION["nombre"] . " " .  $_SESSION["apellido"]);



    $eliminar_negativa = $conexion->query(" delete from control_negativas where id_control_negativas = $id_negativa_eliminar ");


    //    [ AGREGAR EL MOTIVO DEL HISTORIAL EN LA TABLA DE HISTORIAL_MANUALES]

    // Verificar si la consulta principal fue exitosa
    if ($eliminar_negativa) {
        // Obtener el ID de la fila más reciente en la tabla historial_manuales relacionada
        $consultaIDHistorial = $conexion->query("SELECT MAX(id_historial_negativas) AS id_historial_negativas FROM historial_negativas WHERE id_control_negativas = '$id_negativa_eliminar' AND accion_historial = 'ELIMINADO'");

        if ($consultaIDHistorial) {
            $filaIDHistorial = $consultaIDHistorial->fetch_assoc();
            $id_historial = $filaIDHistorial['id_historial_negativas'];

            // Ahora, realizar la actualización en la tabla de historiales
            $actualizarHistorial = $conexion->query("UPDATE historial_negativas SET responsable_modificacion = '$responsable'
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






    //ahora hacemos la validacion 
    if ($eliminar_negativa = true) { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "Negativa eliminada correctamente",
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
                    text: "Error al eliminar la negativa",
                    styling: "bootstrap3"
                })
            })
        </script>

    <?php } ?>


    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>


<?php }
