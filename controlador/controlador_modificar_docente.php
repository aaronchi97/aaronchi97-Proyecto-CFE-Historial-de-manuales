<?php
    if (!empty($_POST["btnmodificar"])) {
       if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtexpediente"])) {
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $expediente = $_POST["txtexpediente"];
        $id = $_POST["txtid"];
        
        $sql = $conexion->query(" select count(*) as 'Total' from docentes where expediente=$expediente and id_docente!=$id");

        if ($sql->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El docente con expediente <?= $expediente ?> ya esta registrado",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el usuario no existe entonces se procede a modificarlo en el else-->
        <?php } else {
            // echo "El usuario no existe";
            $modificar = $conexion->query(" update docentes set nombre='$nombre', apellido='$apellido', expediente='$expediente' where id_docente=$id ");

            if ($modificar = TRUE) { ?>  <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "El docente <?= $nombre ?>. " " .<?= $apellido ?> se ha modificado con exito",
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
                            text: "Error al modificar al docente <?= $nombre ?>. " " .<?= $apellido ?>",
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