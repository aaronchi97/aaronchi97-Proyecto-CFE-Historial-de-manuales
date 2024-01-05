<?php

if (!empty($_POST["btnmodificar"])) {

    if (!empty($_POST["txtclaveactual"]) and !empty($_POST["txtclavenueva"]) and !empty($_POST["txtid"])) {
        $claveactual = md5($_POST["txtclaveactual"]);
        $clavenueva = md5($_POST["txtclavenueva"]);
        $id = $_POST["txtid"];

        // $verificarClaveActual = $conexion->query(" select count(*) as 'Total' from usuario where password='$claveactual' and id_usuario=$id");
        $verificarClaveActual = $conexion->query(" select password from usuario where id_usuario=$id");
        if ($verificarClaveActual->fetch_object()->password == $claveactual) {
           
            $sql = $conexion->query(" update usuario set password='$clavenueva' where id_usuario=$id ");
            if ($sql = TRUE) { ?>  <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "La contraseña ha sido modificada con exito",
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
                            text: "Error al modificar la contraseña",
                            styling: "bootstrap3"
                        })
                    })
                </script>

           <?php }
        } else {
            ?>

            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "UPS!",
                        type: "warning",
                        text: "La contraseña actual es incorrecta",
                        styling: "bootstrap3"
                    })
                })
            </script>

            <?php
        }


    } else {
        ?>

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

    <?php
    }

    ?>

    <!--Hacemos que se refresque la pagina omitiendo los valores que se otorgaron
    en el registro en el url, evitando que se dupliquen los registros-->
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>

    <?php 

}



?>