<?php
if (!empty($_GET["id_negativa_eliminar"])) {

    $id_negativa_eliminar = $_GET["id_negativa_eliminar"];



    $eliminar_manual = $conexion->query(" delete from control_negativas where id_control_negativas = $id_negativa_eliminar ");








    //ahora hacemos la validacion 
    if ($sql = true) { ?>
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
