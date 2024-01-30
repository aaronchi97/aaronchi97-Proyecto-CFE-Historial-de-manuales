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
<link rel="stylesheet" href="estilosinasu.css">
<div class="page-content">

  <h4 class="text-center text-secondery"> AGENCIA 1</h4>

  <?php
  //hacemos la conexion
  include "../../modelo/conexion-SINASU.php";
  //llamamos al controlador para eliminar registros
  include "../../controlador/controlador_modificar_usuario_sinasu.php";
  include "../../controlador/controlador_eliminar_usuario_sinasu.php";

  //Hacemos la consulta relacionando las tablas que necesitemos
  //para dicha consulta necesitamos la tabla usuario
  $sql = $conexionSINASU->query("SELECT * FROM documentos");



  ?>


  <?php

  if ($_SESSION['rol-sinasu'] == 2 || $_SESSION['rol-sinasu'] == 3) {
    ?>
    <a href="registro_usuario_sinasu.php" class="btn btn-primary btn-rounded mb-3" style="display: none;"><i
        class="fa-solid fa-user-plus"></i> &nbsp; REGISTRAR</a>
    <?php

    $mostrarBoton = false;

  } else {
    ?>

    <!-- <a href="registro_usuario_sinasu.php" class="btn btn-primary btn-rounded mb-3 otro"><i
        class="fa-solid fa-user-plus "></i> &nbsp;
      REGISTRAR</a> -->
    <?php

  }
  ?>


  <a href="agencia1.php" class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-regular fa-circle-left"></i> &nbsp;
    ATRAS</a>


  <table class="table table-bordered table-hover w-100 " id="example">
    <thead>
      <tr>
        <th scope="col">ID DOCUMENTO</th>
        <th scope="col">ID GUIA</th>
        <th scope="col">RUTA DOCUMENTO</th>
        <th scope="col">NOMBRE DOCUMENTO</th>
        <th scope="col">FECHA SUBIDA</th>
        <th scope="col">OBSERVACIONES</th>
        <th scope="col">ESTADO</th>
        <th scope="col">NOMBRE RESPONSABLE</th>
        <th scope="col"></th>
      </tr>
    </thead>

    <tbody>

      <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->
      <?php
      if ($_SESSION['rol-sinasu'] == 2 || $_SESSION['rol-sinasu'] == 3) {
        ?>
        <?php
        while ($datos = $sql->fetch_object()) { ?>

          <tr>
            <td class="id" scope="row">
              <?= $datos->id_documento ?>
            </td>
            <td>
              <?= $datos->id_guia ?>
            </td>
            <td>
              <a href="<?= $datos->ruta_doc ?>">
                <?= $datos->ruta_doc ?>
              </a>

            </td>
            <td>
              <?= $datos->nombre_doc ?>
            </td>
            <td>
              <?= $datos->fecha_subida ?>
            </td>
            <td>
              <?= $datos->observaciones ?>
            </td>
            <td>
              <?= $datos->estado ?>
            </td>
            <td>
              <?= $datos->nombre_responsable ?>
            </td>
            <td>
              <a href="controlador_eliminar_archivos.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </td>
          </tr>

        <?php }

        ?>
        <?php

      } else {
        ?>

        <?php
        while ($datos = $sql->fetch_object()) { ?>

          <!--dentro imprimiremos los valores que contienen mis tablas 
    en la base de datos-->
          <tr>
            <td class="id" scope="row">
              <?= $datos->id_documento ?>
            </td>
            <td>
              <?= $datos->id_guia ?>
            </td>
            <td>
              <a href="<?= $datos->ruta_doc ?>">
                <?= $datos->ruta_doc ?>
              </a>
            </td>
            <td>
              <?= $datos->nombre_doc ?>
            </td>
            <td>
              <?= $datos->fecha_subida ?>
            </td>
            <td>
              <?= $datos->observaciones ?>
            </td>
            <td>
              <?= $datos->estado ?>
            </td>
            <td>
              <?= $datos->nombre_responsable ?>
            </td>
            <td>
              <a href="controlador_eliminar_archivos.php"><i class="fa-solid fa-circle-xmark"></i></a>
              <!-- <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_usuario ?> "
                class="btn btn-warning "><i class="fa-solid fa-user-pen"></i></a>
              <a class="btn btn-danger" href="usuario-sinasu.php?id=<?= $datos->id_usuario ?>"
                onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a> -->
            </td>

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

                      <input type="text" placeholder="ID" class="input input__text inputmodal" name="txtid"
                        value="<?= $datos->id_usuario ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Nombre" class="input input__text inputmodal" name="txtnombre"
                        value="<?= $datos->nombre ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Apellido" class="input input__text inputmodal" name="txtapellido"
                        value="<?= $datos->apellido ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Usuario" class="input input__text inputmodal" name="txtusuario"
                        value="<?= $datos->usuario ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Rol" class="input input__text inputmodal" name="txtrol"
                        value="<?= $datos->id_rol ?>">
                    </div>


                    <!-- <div class="fl-flex-label mb-4 px-2 col-12  campo">
                    <input type="password" placeholder="Contrasea" class="input input__text inputmodal" name="txtpassword" >
                  </div> -->


                    <div class="text-right p-3">
                      <a href="usuario-sinasu.php" class="btn btn-secondary btn-rounded">Atras</a>
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
  document.addEventListener('DOMContentLoaded', function () {
    var nombreInput = document.querySelector('[name="txtnombre"]');
    var apellidoInput = document.querySelector('[name="txtapellido"]');
    var usuarioInput = document.querySelector('[name="txtusuario"]');

    // Función para eliminar espacios en blanco
    function removeSpaces(input) {
      input.value = input.value.replace(/\s/g, ''); // Elimina espacios en blanco
    }

    // Evento input para los campos de nombre, apellido y usuario
    nombreInput.addEventListener('input', function () {
      removeSpaces(this);
    });

    apellidoInput.addEventListener('input', function () {
      removeSpaces(this);
    });

    usuarioInput.addEventListener('input', function () {
      removeSpaces(this);
    });
  });
</script>


<!-- por ultimo se carga el footer -->
<?php require('./../layout/footer_sinasu.php'); ?>