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
    background: rgb(11, 150, 214) !important;
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

  <h4 class="text-center text-secondery"> DOCENTES </h4>

  <?php
  //hacemos la conexion
  include "../modelo/conexion.php";
  //llamamos al controlador 
  include "../controlador/controlador_asis_vistas.php";
  include "../controlador/controlador_registrar_asistencia.php";
  
  ?>

  <table class="table table-bordered table-hover col-12" id="example">
    <thead>
      <tr>
        <!-- <th scope="col">ID</th> -->
        <th scope="col">MAESTRO</th>
        <th scope="col">HORA</th>
        <th scope="col">AULA</th>
        <th scope="col"></th>
      </tr>
    </thead>

    <tbody>

      <?php
      while ($datos = $sql->fetch_object()) { ?>

        <!--dentro imprimiremos los valores que contienen mis tablas 
    en la base de datos-->
        <tr>
          <!-- <td>
            <?= $datos->id_docente ?>
          </td> -->
          <td>
            <?= $datos->nombre ?>
          </td>
          <td>
            <?= $datos->hora ?>
          </td>
          <td>
            <?= $datos->nombre_aula ?>
          </td>

          <td>
            <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_asignacion ?>"
              class="btn btn-warning ">REGISTRAR ASISTENCIA</a>
          </td>


        </tr>


        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?= $datos->id_asignacion ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header d-flex justify-content-between ">
                <h5 class="modal-title text-center text-primary" id="exampleModalLabel">Registro de asistencia</h5>
                <h5 class="modal-title text-center text-secundary font-size-10" id="exampleModalLabel">Docente:
                  <?= $datos->nombre ?>
                  <?= $datos->apellido ?>
                </h5>
                <br>
                <h5 class="text-danger font-size-10  p-2" id="fecha"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Aqui haremos el registro de asistencia-->
                 <!--LOS ESTILOS ESTAN EN estilos.css-->


                <form action="" method="post">
                  <div class="fl-flex-label mb-4 px-2 col-12  campo">

                    <input hidden type="text" placeholder="EXPEDIENTE <?= $datos->expediente ?>" class="input input__text inputmodal" name="txtid_asig"
                      value=" <?= $datos->id_asignacion ?>">
                  </div>

                  <div class="fl-flex-label mb-4 px-2 col-12  campo">

                    <select name="txtid_pres" class="input input__select inputmodal">
                      <option value=""> Asistencia</option>
                      <?php
                      $sql2 = $conexion->query(" SELECT * FROM presencia");
                      while ($datos2 = $sql2->fetch_object()) { ?>
                        <option value="<?= $datos2->id_presencia ?>"><?= $datos2->nombre_presencia ?></option>
                      <?php }
                      ?>
                    </select>
                    <!-- <input type="text" placeholder="Asistencia" class="input input__text inputmodal" name="txtid_pres" value=" <?= $datos->id_presencia ?>"> -->
                  </div>

                  <!-- <div class="fl-flex-label mb-4 px-2 col-12  campo">
                   
                    <input type="text" placeholder="Fecha" class="input input__text inputmodal" name="txtfecha" >
                  </div> -->



                  <div class="text-center p-3">
                    <a href="registro_asistencias_vista2.php?id=<?= $datos->id_dia ?>"
                      class="btn btn-secondary btn-rounded">Atras</a>

                    <button type="submit" value="ok" name="btnregistrar"
                      class="btn btn-primary btn-rounded">Registrar</button>
                  </div>
                  <!-- <div href="registro_asistencias_vista2.php?id=<?= $datos->id_dia ?>" id="seccion-destino">
                  
                    </div> -->


                </form>

                <script>


                  setInterval(() => {
                      
                    let fecha = new Date();
                    let fechahora = fecha.toLocaleString();
                    document.getElementById("fecha").textContent = fechahora;

                  }, 1000);
                </script>

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



    </tbody>
  </table>


  <a class="btn btn-danger btn-rounded  mb-1" href="registro_asistencias.php">
    ATRAS
  </a>
  

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>