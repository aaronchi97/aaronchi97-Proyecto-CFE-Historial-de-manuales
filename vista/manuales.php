<?php

session_start();
//si el nombre y apellido estan vacios entonces redirigelos a la pagina de login.php
//esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
//lo compias y lo pegas desde el inicio entonces no te dejara, hasta que pongas un usuario valido
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
  header("location:login/login.php");
}

?>

<style>
  ul li:nth-child(1) .activo {
    background: #598b6b !important;
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
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<link rel="stylesheet" href="estiloinicio.css">
<div class="page-content">

  <h4 class="text-center text-secondery"> USUARIOS</h4>

  <?php
  //hacemos la conexion
  include "../modelo/conexion.php";
  //llamamos al controlador para eliminar registros
  include "../controlador/controlador_modificar_usuario.php";
  include "../controlador/controlador_eliminar_usuario.php";

  //Hacemos la consulta relacionando las tablas que necesitemos
  //para dicha consulta necesitamos la tabla usuario
  $sql = $conexion->query(" SELECT * from control_de_manuales ");



  ?>


  <?php

  if ($_SESSION['id'] == 13) {
    ?>
    <a href="registro_usuario.php" class="btn btn-primary btn-rounded mb-3" style="display: none;"><i
        class="fa-solid fa-user-plus"></i> &nbsp; REGISTRAR</a>
    <?php

    $mostrarBoton = false;

  } else {
    ?>

    <a href="registro_usuario.php" class="btn btn-primary btn-rounded mb-3 otro"><i class="fa-solid fa-user-plus "></i>
      &nbsp;
      REGISTRAR</a>
    <?php

  }
  ?>

  <!-- 
  <a href="registro_usuario.php" class="btn btn-primary btn-rounded mb-3"><i class="fa-solid fa-user-plus"></i> &nbsp;
    REGISTRAR</a> -->


  <table class="table table-bordered table-hover w-100 " id="example">
    <thead>
      <tr>
        <th scope="col">RPU</th>
        <th scope="col">CUENTA</th>
        <th scope="col">CICLO</th>
        <th scope="col">TARIFA</th>
        <th scope="col"></th>
      </tr>
    </thead>

    <tbody>

      <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->
      <?php
      if ($_SESSION['id'] == 13) {
        ?>
        <?php
        while ($datos = $sql->fetch_object()) { ?>

          <tr>
            <td class="id" scope="row">
              <?= $datos->RPU ?>
            </td>
            <td>
              <?= $datos->CUENTA ?>
            </td>
            <td>
              <?= $datos->CICLO ?>
            </td>
            <td>
              <?= $datos->TARIFA ?>
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
              <?= $datos->RPU ?>
            </td>
            <td>
              <?= $datos->CUENTA ?>
            </td>
            <td>
              <?= $datos->CICLO ?>
            </td>
            <td>
              <?= $datos->TARIFA ?>
            </td>
            <td>
              <!-- <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_usuario ?> "
                class="btn btn-warning "><i class="fa-solid fa-user-pen"></i></a>
              <a class="btn btn-danger" href="usuario.php?id=<?= $datos->id_usuario ?>" onclick=" advertencia(event)"><i
                  class="fa-solid fa-trash-can"></i></a> -->
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
                        value=" <?= $datos->id_usuario ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Nombre" class="input input__text inputmodal" name="txtnombre"
                        value=" <?= $datos->nombre ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Apellido" class="input input__text inputmodal" name="txtapellido"
                        value=" <?= $datos->apellido ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Usuario" class="input input__text inputmodal" name="txtusuario"
                        value=" <?= $datos->usuario ?>">
                    </div>
                    <!-- <div class="fl-flex-label mb-4 px-2 col-12  campo">
                    <input type="password" placeholder="Contrasea" class="input input__text inputmodal" name="txtpassword" >
                  </div> -->

                    <div class="text-right p-3">
                      <a href="usuario.php" class="btn btn-secondary btn-rounded">Atras</a>
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


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>