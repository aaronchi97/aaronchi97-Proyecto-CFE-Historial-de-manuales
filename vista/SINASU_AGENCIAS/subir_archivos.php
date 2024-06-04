<?php
include '../../controlador/controlador_eliminar_documentos.php';


session_start();
//si el nombre y apellido estan vacios entonces redirigelos a la pagina de login.php
//esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
//lo compias y lo pegas desde el inicio entonces no te dejara, hasta que pongas un usuario valido
if (empty ($_SESSION['nombre-sinasu']) and empty ($_SESSION['apellido-sinasu'])) {
  header("location:../login/login_sinasu.php");
}

?>
<style>
ul li:nth-child(1) .activo {
    background: #9889fe !important;
}
</style>
<!-- primero se carga el topbar -->
<?php require ('./../layout/topbar_sinasu.php'); ?>
<!-- luego se carga el sidebar -->
<?php require ('./../layout/sidebar_sinasu.php'); ?>
<?php include "../../modelo/conexion-SINASU.php"; ?>

<!-- inicio del contenido principal -->


<link rel="stylesheet" href="../SINASU/estilosinasu.css">

<body class="cuerpo_subir">
    <div class="page-content">
        <?php
    $id_agencia_regresar_vista_documentos = $_SESSION["id-agencia-sinasu"];
    $mostrar_id_guia = $_GET['id_guia_subir_doc'];
    $mostrar_id_proceso = $_GET['id_proceso'];

    $sql_pregunta = $conexionSINASU->query("SELECT pregunta FROM sinasu_guias_" . $mostrar_id_proceso . " WHERE id_guia = '$mostrar_id_guia';");

    if ($sql_pregunta->num_rows > 0) {
      // Obtener el nombre del proceso del primer resultado
      $nombre_pregunta = $sql_pregunta->fetch_assoc()['pregunta'];

      // Mostrar el nombre del proceso
      echo "<h4 class='text-justify text-secondary titulo-renta2'><b>" . $mostrar_id_guia . "- " . $nombre_pregunta . "</b></h4>";
    }
    // echo "la guia es: " . $mostrar_id_guia;
    // Verificar si se ha proporcionado un id_guia_subir_doc en la URL
    $_SESSION["mostrar-id-guia"] = $mostrar_id_guia;
    $_SESSION["mostrar-id-proceso"] = $mostrar_id_proceso;
    ?>

        <input type="hidden" id="mostrar_id_agencia" value="<?php echo $id_agencia_regresar_vista_documentos; ?>">
        <a href="../SINASU/agencias_filtros.php?id_agencias_filtro=<?= $id_agencia_regresar_vista_documentos ?>&id_proceso=<?= $mostrar_id_proceso ?>&id_departamento=<?= $_GET['id_departamento'] ?>"
            class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-regular fa-circle-left"></i>
            &nbsp;
            ATRÁS</a>
        <div class="subir">
            <div class="drop-area">
                <h2>Arrastra y Suelta la Evidencia</h2>
                <span>O</i>
                </span>
                <button>Selecciona tus archivos</button>
                <input type="file" name="" id="input-file" hidden multipart>
            </div>
            <article>
                <h5 style="color:#aaa;">Nota: Puedes subir imagenes (png, jpg y jpeg), documentos de office(docx, xslx,
                    pptx) y
                    documentos pdf</h5>
            </article>
            <div id="preview">
            </div>
        </div>

    </div>
</body>
<script src="upload.js"></script>



<!-- por ultimo se carga el footer -->
<?php require ('./../layout/footer_sinasu.php'); ?>