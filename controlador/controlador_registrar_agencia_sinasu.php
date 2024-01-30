<?php
if (!empty($_POST["btnregistrar"])) {
    //controlar que los datos no esten ni viajes vacios
    // if (!empty($_POST["txtnombreagencia"]) and !empty($_POST["txtid_usuario"]) and !empty($_POST["txtresponsable"]) and !empty($_POST["txtdescripcion"]) and !empty($_POST["txtzona"])) {
        if (!empty($_POST["txtnombreagencia"]) and !empty($_POST["txtid_usuario"]) and !empty($_POST["txtdescripcion"]) and !empty($_POST["txtzona"])) {
        //si los campos de registro estan llenos entonces:
        //creamos las variables que alamcenaran los valores:txtrol
        $agencia = $_POST["txtnombreagencia"];
        $usuario = $_POST["txtid_usuario"];
        // $responsable = $_POST["txtresponsable"];
        $descripcion = $_POST["txtdescripcion"];
        $zona = $_POST["txtzona"];
        // $password = md5($_POST["txtpassword"]);
        // $password = $_POST["txtpassword"];

        //evitemos que los atributos o nombres de mis tablas se dupliquen
        //para eso hacemos una conslta y le pedimos que me diga cuantos usuarios hay 
        //con el mismo nombre:
        // $sql_registro_agencias = $conexionSINASU->query(" select count(*) as 'Total' from agencias where nombre_agencia='$agencia' OR (id_usuario = '$usuario' AND nombre_agencia ='$agencia')  ");
        $sql_registro_agencias = $conexionSINASU->query("SELECT COUNT(*) AS 'Total' FROM agencias WHERE nombre_agencia = '$agencia' OR (id_usuario = '$usuario' AND nombre_agencia = '$agencia')");
      
      
        if ($sql_registro_agencias->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "La Agencia: <?= $agencia ?> o Usuario: <?= $usuario ?> ya han sido registrados o asignados",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el usuario o Agencia no existe entonces se procede a registrarlo en el else-->
        <?php } else {
            //obetener el nombre y apellido del usuario
            $nombre_responsable = $conexionSINASU->query("SELECT nombre, apellido FROM usuario WHERE id_usuario = $usuario");
            //concatenar el nombre y apellido en un array
            $fila = $nombre_responsable->fetch_assoc();
            // Concatenar nombre y apellido en una sola cadena
           $nombre_responsable_completo = $fila['nombre'] . ' ' . $fila['apellido'];




            // echo "El usuario o Agencia no existe";
            $registro_agencia = $conexionSINASU->query(" insert into agencias(id_usuario, nombre_agencia, descripcion, zona, responsable_agencia)values('$usuario', '$agencia', '$descripcion', '$zona', '$nombre_responsable_completo') ");
            
            // Obtener el último ID insertado
            $id_agencia_nueva = $conexionSINASU->insert_id;

            //la siguiente consulta es para agregar la documentacion de la nueva agencia, al final hay un
            //limit 93, que significa que quiero que se dupliquen las primeras 93 fila de mi tabla "sinasu_guias"
            $sql_registro_id_usuario_en_sinasu_guias = $conexionSINASU->query("INSERT INTO sinasu_guias (id_elemento, id_agencia, proceso, pregunta, ponderacion, criterio, evidencia_esperada, fuente_de_la_evidencia)
            SELECT id_elemento,  $id_agencia_nueva, proceso, pregunta, ponderacion, criterio, evidencia_esperada, fuente_de_la_evidencia
            FROM sinasu_guias
            LIMIT 93;");
            
            if ($registro_agencia = TRUE) { ?>  <!--si el registro es 1 o true entonces-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "La agencia <?= $agencia ?> asignada al usuario <?= $usuario ?> ha sido registrada con éxito",
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
                            text: "Error al registrar a agencia <?= $agencia ?> asignada al usuario <?= $usuario ?>",
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