<?php
if (!empty($_GET["id_manual_eliminar"])) {

    $id_manual_eliminar = $_GET["id_manual_eliminar"];

    $responsable = $conexion->real_escape_string($_SESSION["nombre"] . " " .  $_SESSION["apellido"]);


    //ahora eliminaremos el registro de la bd una vez que recibamos el id 
    //que el usuario nos mande presionando el boton de eliminar
    $eliminar_manual = $conexion->query(" delete from control_manuales where id_control_manuales=$id_manual_eliminar ");


    //    [ AGREGAR INFORMACION DE MANUAL ELIMINADA EN HISTORIAL EN LA TABLA DE HISTORIAL_MANUALES]

    // Verificar si la consulta principal fue exitosa
    if ($eliminar_manual = true) {
        // Obtener el ID de la fila más reciente en la tabla historial_manuales relacionada
        $consultaIDHistorial = $conexion->query("SELECT MAX(id_historial_manuales) AS id_historial_manuales FROM historial_manuales WHERE id_control_manuales = '$id_manual_eliminar' AND accion_historial = 'ELIMINADO'");

        if ($consultaIDHistorial) {
            $filaIDHistorial = $consultaIDHistorial->fetch_assoc();
            $id_historial = $filaIDHistorial['id_historial_manuales'];

            // Ahora, realizar la actualización en la tabla de historiales
            $actualizarHistorial = $conexion->query("UPDATE historial_manuales SET responsable_modificacion = '$responsable'
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





    //ahora hacemos la validacion 
    if ($eliminar_manual = true) { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "Manual eliminada correctamente",
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
                    text: "Error al eliminar la manual",
                    styling: "bootstrap3"
                })
            })
        </script>

    <?php } ?>

    <!--ahora eliminaremos el id que aparece en la barra del navegador
    esto hace que la ruta se actualice y regrese a su config original-->
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>


<?php }
