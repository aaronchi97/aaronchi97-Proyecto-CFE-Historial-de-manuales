<?php
if (!empty($_POST["btnregistrar"])) {
  //controlar que los datos no esten ni viajes vacios
  // if (!empty($_POST["txtnombreproceso"]) and !empty($_POST["txtid_usuario"]) and !empty($_POST["txtresponsable"]) and !empty($_POST["txtdescripcion"]) and !empty($_POST["txtzona"])) {
  if (!empty($_POST["txtnombreproceso"]) and !empty($_POST["txtid_usuario"]) and !empty($_POST["txtdescripcion"]) and !empty($_POST["txtzona"])) {
    //si los campos de registro estan llenos entonces:
    //creamos las variables que alamcenaran los valores:txtrol
    $proceso = $_POST["txtnombreproceso"];
    // $usuario = $_POST["txtid_usuario"];
    // $responsable = $_POST["txtresponsable"];
    // $descripcion = $_POST["txtdescripcion"];
    // $zona = $_POST["txtzona"];
    // $password = md5($_POST["txtpassword"]);
    // $password = $_POST["txtpassword"];

    //evitemos que los atributos o nombres de mis tablas se dupliquen
    //para eso hacemos una conslta y le pedimos que me diga cuantos usuarios hay 
    //con el mismo nombre:
    // $sql_registro_procesos = $conexionSINASU->query(" select count(*) as 'Total' from agencias where nombre_proceso='$proceso' OR (id_usuario = '$usuario' AND nombre_proceso ='$proceso')  ");
    $sql_registro_procesos = $conexionSINASU->query("SELECT COUNT(*) AS 'Total' FROM procesos WHERE nombre_proceso = '$proceso' OR (id_usuario = '$usuario' AND nombre_proceso = '$proceso')");


    if ($sql_registro_procesos->fetch_object()->Total > 0) { ?>
      <script>
        $(function notificacion() {
          new PNotify({
            title: "ERROR",
            type: "error",
            text: "El proceso: <?= $proceso ?> ya ha sido registrado",
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
      $registro_proceso = $conexionSINASU->query(" insert into procesos(id_proceso, nombre_proceso)values('$usuario', '$proceso') ");

      // Obtener el último ID insertado
      $id_agencia_nueva = $conexionSINASU->insert_id;

      //la siguiente consulta es para agregar la documentacion de la nueva proceso, al final hay un
      //limit 93, que significa que quiero que se dupliquen las primeras 93 fila de mi tabla "sinasu_guias"
      $sql_registro_id_usuario_en_sinasu_guias = $conexionSINASU->query("INSERT INTO sinasu_guias (id_elemento, id_agencia, proceso, pregunta, ponderacion, criterio, evidencia_esperada, fuente_de_la_evidencia)
            SELECT id_elemento,  $id_agencia_nueva, proceso, pregunta, ponderacion, criterio, evidencia_esperada, fuente_de_la_evidencia
            FROM sinasu_guias
            LIMIT 93;");

      if ($registro_proceso = TRUE) { ?> <!--si el registro es 1 o true entonces-->

        <script>
          $(function notificacion() {
            new PNotify({
              title: "CORRECTO",
              type: "success",
              text: "La proceso <?= $proceso ?> asignada al usuario <?= $usuario ?> ha sido registrada con éxito",
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
              text: "Error al registrar a proceso <?= $proceso ?> asignada al usuario <?= $usuario ?>",
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