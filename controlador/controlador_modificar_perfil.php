<?php
    if (!empty($_POST["btnmodificar"])) {
       if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"])) {
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $usuario = $_POST["txtusuario"];
        $id = $_POST["txtid"];
        
        $sql = $conexion->query(" select count(*) as 'Total' from usuario where usuario='$usuario' and id_usuario!=$id");

        if ($sql->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El perfil del usuario <?= $usuario ?> ya esta registrado",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el usuario no existe entonces se procede a modificarlo en el else-->
        <?php } else {
            // echo "El usuario no existe";
            $modificar = $conexion->query(" update usuario set nombre='$nombre', apellido='$apellido', usuario='$usuario' where id_usuario=$id ");

            if ($modificar = TRUE) { ?>  <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "El perfil <?= $usuario ?> se ha modificado con exito",
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
                            text: "Error al modificar perfil <?= $usuario ?>",
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