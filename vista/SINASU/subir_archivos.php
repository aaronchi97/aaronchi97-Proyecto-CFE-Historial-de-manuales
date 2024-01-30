<?php

session_start();
//si el nombre y apellido estan vacios entonces redirigelos a la pagina de login.php
//esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
//lo compias y lo pegas desde el inicio entonces no te dejara, hasta que pongas un usuario valido
if (empty($_SESSION['nombre-sinasu']) and empty($_SESSION['apellido-sinasu'])) {
  header("location:../login/login_sinasu.php");
}

?>
<style>
  ul li:nth-child(1) .activo {
    background: #9889fe !important;
  }
</style>
<!-- primero se carga el topbar -->
<?php require('./../layout/topbar_sinasu.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./../layout/sidebar_sinasu.php'); ?>


<!-- inicio del contenido principal -->


<link rel="stylesheet" href="estilosinasu.css">

<body class="cuerpo_subir">
  <div class="page-content">
    <a href="agencia1.php" class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-regular fa-circle-left"></i> &nbsp;
      ATRAS</a>
    <div class="subir">
      <div class="drop-area">
        <h2>Arrastra y suelta el documento PDF</h2>
        <span>O</i>
        </span>
        <button>Selecciona tus archivos</button>
        <input type="file" name="" id="input-file" hidden multipart>
      </div>
      <div id="preview">
      </div>
    </div>

  </div>
</body>
<script src="upload.js"></script>



<!-- <div class="page-content">
  <h1 class="titulo_subir">Subir Archivos</h1>
  <a href="agencia1.php" class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-regular fa-circle-left"></i> &nbsp;
    ATRAS</a>
  <section class="seccion_subir">
    <article>
      <div>
        <form class="form_subir" action="upload.php" method="post" enctype="multipart/form-data" id="uploadForm">
          <label for="pdfFile">Seleccionar archivo PDF:</label>
          <input type="file" name="pdfFile" id="pdfFile" accept=".pdf" onchange="previewFile()">
          <br>
          <img src="" alt="Vista previa" id="previewImg" style="display:none;">
          <br>
          <div id="drop-area" ondrop="dropHandler(event);" ondragover="dragOverHandler(event)">
            <p>O arrastra y suelta tu archivo PDF aquí</p>
            <p id="fileNameDisplay"></p>
          </div>
          <br>
          <input type="submit" value="Subir PDF">
        </form>
      </div>
    </article>
  </section>
</div>

<script>
  function dropHandler(event) {
    event.preventDefault();
    const files = event.dataTransfer.files;

    // Verifica si hay archivos
    if (files.length > 0) {
      // Muestra el nombre del archivo debajo del área de arrastre
      const fileNameDisplay = document.getElementById('fileNameDisplay');
      fileNameDisplay.innerHTML = 'Nombre del archivo: ' + files[0].name;
    }
  }

  function dragOverHandler(event) {
    event.preventDefault();
  }

  function previewFile() {
    const preview = document.getElementById('previewImg');
    const file = document.getElementById('pdfFile').files[0];
    const reader = new FileReader();

    reader.onloadend = function () {
      preview.src = reader.result;
      preview.style.display = 'block';
    }

    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.src = '';
      preview.style.display = 'none';
    }
  }

</script> -->



<!-- por ultimo se carga el footer -->
<?php require('./../layout/footer_sinasu.php'); ?>