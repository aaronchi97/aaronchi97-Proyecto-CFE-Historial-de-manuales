<?php
if (!empty($_GET["id_manual_eliminar"])) {

    $id_manual_eliminar = $_GET["id_manual_eliminar"];


    //ahora eliminaremos el registro de la bd una vez que recibamos el id 
    //que el usuario nos mande presionando el boton de eliminar
    $eliminar_manual = $conexion->query(" delete from control_manuales where id_control_manuales=$id_manual_eliminar ");








    //ahora hacemos la validacion 
    if ($sql = true) { ?>
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
