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

<!-- Crear el metodo advertencia para el boton de eliminar registro -->
<!-- <script>
    function advertencia() {
        var not = confirm("¿Estas seguro de eliminar el registro?");
        return not;
    }
 </script> -->



<!-- primero se carga el topbar -->
<?php require('./../layout/topbar_sinasu.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./../layout/sidebar_sinasu.php'); ?>


<!-- inicio del contenido principal -->
<link rel="stylesheet" href="../SINASU/estilosinasu.css">
<div class="page-content">

    <h4 class="text-center text-secondery"> AGENCIA 1</h4>

    <?php
  //hacemos la conexion
  include "../../modelo/conexion-SINASU.php";
  //llamamos al controlador para eliminar registros
  include "../../controlador/controlador_vista_documentos_sinasu.php";
  // include "upload.php";
  
  // include "../../controlador/controlador_vista_agencias_id_sinasu.php";
  // include "../../controlador/controlador_eliminar_usuario_sinasu.php";
  
  //Hacemos la consulta relacionando las tablas que necesitemos
  //para dicha consulta necesitamos la tabla usuario
  // $sql = $conexionSINASU->query(" SELECT * from sinasu_guias ");
  
  // $id_agencia_filtro = $_SESSION['id_agencias_filtro'];
  
  // Realiza la consulta usando el valor
  // $sql_nombre_id_agencia = $conexionSINASU->query("SELECT *
  //     FROM sinasu_guias
  //     INNER JOIN agencias ON sinasu_guias.id_agencia = agencias.id_agencia 
  //     WHERE agencias.id_agencia = '$id_agencia_filtro';");
  
  $sql_nombre_id_agencia = $conexionSINASU->query("SELECT *
      FROM sinasu_guias
      INNER JOIN agencias ON sinasu_guias.id_agencia = agencias.id_agencia;");


  // $id_agencias_filtro = $_GET['id_agencias_filtro'];
  


  //ESTA CONSULTA SE ENCUENTRA EN EL CONTROLADOR controlador_vista_agencias_id_sinasu.php
  // $datos_id_agencia =  $sql_id_agencia ->fetch_object();
  $datos_tabla_agencia = $sql_nombre_id_agencia->fetch_object();

  ?>

    <a href="../SINASU/agencias_filtros.php?id_agencias_filtro=<?= $id_agencia_especifica ?>"
        class="btn btn-danger btn-rounded mb-3"><i class="fa-regular fa-circle-left"></i> &nbsp; ATRÁS</a>

    <!-- 
  <a href="registro_usuario.php" class="btn btn-primary btn-rounded mb-3"><i class="fa-solid fa-user-plus"></i> &nbsp;
    REGISTRAR</a> -->




    <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->
    <?php
  if ($_SESSION['rol-sinasu'] == 3) {
    ?>

    <table class="table table-bordered table-hover w-100 " id="example">
        <thead>
            <tr>
                <!-- <th scope="col">ID</th>
              <th scope="col">PROCESO</th>
              <th scope="col">ELEMENTO</th>
              <th scope="col">PREGUNTA</th>
              <th scope="col">PONDERACION</th>-->
                <th scope="col">CRITERIO</th>
                <!-- <th scope="col">ID_AGENCIA</th>  -->
                <!-- <th scope="col">ID GUIA</th>
          <th scope="col">AGENCIA</th> -->
                <th scope="col">EVIDENCIA ESPERADA</th>
                <th scope="col">FUENTE DE LA EVIDENCIA</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>



            <?php
        while ($datos = $sql_sinasu_guia->fetch_object()) { ?>

            <tr>
                <!-- <td class="id" scope="row">
              <?= $datos->id_guia ?>
            </td>
            <td>
              <?= $datos->proceso ?>
            </td>
            <td>
              <?= $datos->elemento ?>
            </td>
            <td>
              <?= $datos->pregunta ?>
            </td>
            <td>
              <?= $datos->ponderacion ?>
            </td> -->
                <td>
                    <?= $datos->criterio ?>
                </td>
                <!-- <td class="id" scope="row">
              <?= $datos->id_guia ?>
            </td>
            <td class="id" scope="row">
              <?= $datos->id_agencia ?>
            </td> -->
                <td>
                    <?= $datos->evidencia_esperada ?>
                </td>
                <td>
                    <?= $datos->fuente_de_la_evidencia ?>
                </td>

                <td>

                    <!-- AQUI SE AÑADE LA RUTA DE LA VISTA PARA SUBIR LOS DOCUMENTOS, ESPECIFICAR RUTA EN EL HREF -->

                    <a style="font-size: 25px;" class="btn btn-info"
                        href="subir_archivos.php?id_guia_subir_doc=<?= $datos->id_guia ?>"><i
                            class="fa-solid fa-file-arrow-up"></i></a>
                    <tool-tip role="tooltip"><b>Subir evidencias</b></tool-tip>
                    <!-- <a style="font-size: 25px;" class="btn btn-info" href="subir_archivos.php?id=<?= $datos->id_guia ?>"
                onclick=" advertencia(event)"><i class="fa-solid fa-file-arrow-up"></i></a>  -->
                </td>
                <td>
                    <a style="font-size: 25px;" class="btn btn-primary"
                        href="ver_archivos.php?id_guia_subir_doc=<?= $datos->id_guia ?>"><i
                            class="fa-solid fa-eye"></i></a>
                    <tool-tip role="tooltip"><b>Ver evidencias</b></tool-tip>
                </td>
            </tr>

            <?php }

        ?>
            <?php

  } else {
    ?>
            <a style="font-size: 15px;" class="btn btn-warning btn-rounded mb-3"
                href="revisar_archivos.php?id_agencia_revision_administrador=<?= $id_agencia_especifica ?>">REVISAR</a>

            <table class="table table-bordered table-hover w-100 " id="example">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <!-- <th scope="col">PROCESO</th>
              <th scope="col">ELEMENTO</th>
              <th scope="col">PREGUNTA</th>
              <th scope="col">PONDERACION</th>
              <th scope="col">CRITERIO</th> -->
                        <!-- <th scope="col">AGENCIA</th> -->
                        <th scope="col">AGENCIA</th>
                        <th scope="col">EVIDENCIA ESPERADA</th>
                        <th scope="col">FUENTE DE LA EVIDENCIA</th>
                        <!-- <th scope="col"></th> -->
                    </tr>
                </thead>

                <tbody>

                    <?php
            while ($datos = $sql_sinasu_guia->fetch_object()) { ?>

                    <!--dentro imprimiremos los valores que contienen mis tablas 
    en la base de datos-->
                    <tr>
                        <td class="id" scope="row">
                            <?= $datos->id_guia ?>
                        </td>
                        <!-- <td>
              <?= $datos->proceso ?>
            </td>
            <td>
              <?= $datos->elemento ?>
            </td>
            <td>
              <?= $datos->pregunta ?>
            </td>
            <td>
              <?= $datos->ponderacion ?>
            </td>
            <td>
              <?= $datos->criterio ?>
            </td> -->
                        <td>
                            <?= $datos->id_agencia ?>
                        </td>
                        <td>
                            <?= $datos->evidencia_esperada ?>
                        </td>
                        <td>
                            <?= $datos->fuente_de_la_evidencia ?>
                        </td>
                        <!-- <td> -->

                        <!-- AQUI SE AÑADE LA RUTA DE LA VISTA PARA REVISAR DOCUMENTACION SUBIDA POR AGENCIAS, ESPECIFICAR RUTA EN EL HREF -->

                        <!-- <a style="font-size: 15px;" class="btn btn-warning"
                    href="revisar_archivos.php?id_agencia_revision_administrador=<?= $datos->id_agencia ?>">REVISAR</a> -->
                        <!-- <a style="font-size: 25px;" class="btn btn-info" href="subir_archivos.php?id=<?= $datos->id_guia ?>"
                onclick=" advertencia(event)"><i class="fa-solid fa-file-arrow-up"></i></a>  -->
                        <!-- </td> -->

                        <!-- <?php echo $mostrarBoton ? 'otro' : ''; ?>  -->

                    </tr>



                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $datos->id_usuario ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between">
                                    <h5 class="modal-title w-100" id="exampleModalLabel">Moodificar usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!--Aqui haremos la modificacion de usuario-->
                                    <form action="" method="post">
                                        <div hidden class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="ID" class="input input__text inputmodal"
                                                name="txtid" value="<?= $datos->id_usuario ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Nombre" class="input input__text inputmodal"
                                                name="txtnombre" value="<?= $datos->nombre ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Apellido"
                                                class="input input__text inputmodal" name="txtapellido"
                                                value="<?= $datos->apellido ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Usuario"
                                                class="input input__text inputmodal" name="txtusuario"
                                                value="<?= $datos->usuario ?>">
                                        </div>

                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Rol" class="input input__text inputmodal"
                                                name="txtrol" value="<?= $datos->id_rol ?>">
                                        </div>


                                        <!-- <div class="fl-flex-label mb-4 px-2 col-12  campo">
                    <input type="password" placeholder="Contrasea" class="input input__text inputmodal" name="txtpassword" >
                  </div> -->


                                        <div class="text-right p-3">
                                            <a href="usuario-sinasu.php" class="btn btn-secondary btn-rounded">AtrÁs</a>
                                            <button type="submit" value="ok" name="btnmodificar"
                                                class="btn btn-primary btn-rounded">Modificar</button>
                                        </div>

                                    </form>


                                </div>
                                <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
              </div> -->
                            </div>
                        </div>
                    </div>
                    <?php }

            ?>



                    <?php

  }
  ?>




                </tbody>
            </table>

</div>
</div>
<!-- fin del contenido principal -->


<!-- // Dentro del script que limpia espacios en blanco al escribir -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var nombreInput = document.querySelector('[name="txtnombre"]');
    var apellidoInput = document.querySelector('[name="txtapellido"]');
    var usuarioInput = document.querySelector('[name="txtusuario"]');

    // Función para eliminar espacios en blanco
    function removeSpaces(input) {
        input.value = input.value.replace(/\s/g, ''); // Elimina espacios en blanco
    }

    // Evento input para los campos de nombre, apellido y usuario
    nombreInput.addEventListener('input', function() {
        removeSpaces(this);
    });

    apellidoInput.addEventListener('input', function() {
        removeSpaces(this);
    });

    usuarioInput.addEventListener('input', function() {
        removeSpaces(this);
    });
});
</script>


<!-- por ultimo se carga el footer -->
<?php require('./../layout/footer_sinasu.php'); ?>