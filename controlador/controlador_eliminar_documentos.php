<?php
// require '../modelo/conexion-SINASU.php';
if (isset($_GET["id"])) {
  //almacenamos el id que obtenemos del boton eliminar en la variable idkiki
  //tambien tenemos que agregar el include de esta pagina en el archivo donde querermos
  //llamarlo, en este caso en usuario-sinasu.php
  $id_documento = $_GET["id"];
  // echo $id_documento;

  //ahora eliminaremos el registro de la bd una vez que recibamos el id 
  //que el usuario nos mande presionando el boton de eliminar
  $sql = $conexionSINASU->query("DELETE FROM documentos WHERE id_documento='$id_documento'");

  //ahora hacemos la validacion 
  if ($sql === true) { ?>
    <script>
      $(function notificacion() {
        new PNotify({
          title: "CORRECTO",
          type: "success",
          text: "Documento eliminado correctamente",
          styling: "bootstrap3"
        });
        // Recargar la página después de 2 segundos
        setTimeout(function () {
          location.reload();
        }, 500);
      });
    </script>

  <?php } else { ?>

    <script>
      $(function notificacion() {
        new PNotify({
          title: "INCORRECTO",
          type: "error",
          text: "Error al eliminar el documento",
          styling: "bootstrap3"
        });
      });
    </script>

  <?php } ?>

  <!--ahora eliminaremos solo el id del documento de la barra del navegador-->
  <script>
    var urlParams = new URLSearchParams(window.location.search);
    urlParams.delete('id');
    var newUrl = window.location.pathname + '?' + urlParams.toString();
    window.history.replaceState(null, null, newUrl);
  </script>


<?php } else {
  // Si no se proporciona un ID válido en la URL, mostrar un mensaje de error
  // echo "No se proporcionó un ID válido en la URL";

}
?>