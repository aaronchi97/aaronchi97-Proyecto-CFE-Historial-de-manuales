<?php
if (!empty($_POST["btnregistrar"])) {
    //controlar que los datos no esten ni viajes vacios
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"]) and !empty($_POST["txtpassword"]) and !empty($_POST["txtid_rol"])) {
        //si los campos de registro estan llenos entonces:
        //creamos las variables que alamcenaran los valores:  
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $usuario = $_POST["txtusuario"];
        $rol = $_POST["txtid_rol"];
        $password = md5($_POST["txtpassword"]);

        // date_default_timezone_set('America/Mexico_City');
        // $fecha = date("Y-m-d");

        //evitemos que los atributos o nombres de mis tablas se dupliquen
        //para eso hacemos una conslta y le pedimos que me diga cuantos usuarios hay 
        //con el mismo nombre:
        $sql = $conexion->query(" select count(*) as 'Total' from usuario where usuario='$usuario' ");

        //como la consulta nos da valores numericos de cuantos usuarios hay, si
        //hay un usuario entonces $sql vale 1, por lo tanto, si queremos hacer
        //un post y $sql es mayor a 0, nos debe salir que el usuario ya existe:
        if ($sql->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El usuario <?= $usuario ?> ya esta registrado",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el usuario no existe entonces se procede a registrarlo en el else-->
        <?php } else {
            // echo "El usuario no existe";
            $registro = $conexion->query(" insert into usuario(nombre, apellido, usuario, password, id_rol)values('$nombre', '$apellido', '$usuario', '$password', '$rol') ");

            if ($registro = TRUE) { ?>  <!--si el registro es 1 o true entonces-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "El usuario <?= $usuario ?> se ha registrado con exito",
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
                            text: "Error al registrar a usuario <?= $usuario ?>",
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