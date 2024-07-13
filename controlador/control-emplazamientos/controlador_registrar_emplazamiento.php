<?php
if (!empty($_POST["btnregistrar"])) {
    if (
        !empty($_POST["txtrpu"]) and !empty($_POST["txtcuenta"])

        and !empty($_POST["txtciclo"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtdireccion"])
        and !empty($_POST["txtmedidor"]) and !empty($_POST["txtgeoreferencia"]) and !empty($_POST["txtdias"])
        and !empty($_POST["txtcorreccion"]) and !empty($_POST["txtfecha_emplazamiento"]) // and !empty($_POST["txtimpresion"])
        and !empty($_POST["txtresponsable_emplazamiento"]) and !empty($_POST["txtagencia"])

    ) {

        $id_manual = $_POST["txtid_manual"];
        $rpu = $_POST["txtrpu"];
        $cuenta = $_POST["txtcuenta"];
        $ciclo = $_POST["txtciclo"];
        $medidor = $_POST["txtmedidor"];

        $nombre = $_POST["txtnombre"];

        $direccion = $_POST["txtdireccion"];
        // $direccion = json_decode($_POST['txtdireccion'], true);
        // Ahora puedes acceder a la información de la dirección:
        // $nombre = $direccion['name'];
        // $latitud = $direccion['geometry']['location']['lat'];
        // $longitud = $direccion['geometry']['location']['lng'];


        $georeferencia = $_POST["txtgeoreferencia"];
        $agencia = $_POST["txtagencia"];
        $dias = $_POST["txtdias"];
        $correccion = $_POST["txtcorreccion"];
        $impresion = $_POST["txtimpresion"];

        $responsable_emplazamiento = $_POST["txtresponsable_emplazamiento"];
        date_default_timezone_set('America/Mexico_City');
        $fecha_impresion = date("Y-m-d H:i:s");
        $fecha = $_POST["txtfecha_emplazamiento"];




        $sql_registro_emplazamientos = $conexion->query(" select count(*) as 'Total' from emplazamientos where rpu_emplazamiento=$rpu ");

        if ($sql_registro_emplazamientos->fetch_object()->Total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El emplazamiento con RPU <?= $rpu ?> ya ha sido registrado ",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <!--si el RPU no existe entonces se procede a modificarlo en el else-->
            <?php } else {
            // echo "El usuario no existe";


            $agregar = $conexion->query(" insert into emplazamientos(id_control_manuales, rpu_emplazamiento, cuenta_emplazamiento,
            ciclo_emplazamiento,
            nombre,
            medidor_emplazamiento,
            direccion,
            georeferencia,
            dias,
            correccion_emplazamiento,
            fecha_emplazamiento,
           agencia_emplazamiento,
            impresion,
            responsable_emplazamiento)values($id_manual,$rpu, '$cuenta',
            $ciclo,
            '$nombre',
            '$medidor',
     
            '$direccion',
             '$georeferencia',
             $dias,
             '$correccion',
             '$fecha',
            '$agencia',
            '$fecha_impresion',
            '$responsable_emplazamiento'
             )  ");





            if ($agregar = TRUE) { ?> <!--si el registro es 1 o true entonces, es decir, es exitoso en la bd-->

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Se ha genarado emplazamiento con RPU <?= $rpu ?> correctamente",
                            styling: "bootstrap3"
                        })
                    })
                </script>

                <a href="emplazamientos.php">ver</a>

            <?php } else { ?>

                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Error al generar emplazamiento con RPU <?= $rpu ?>",
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