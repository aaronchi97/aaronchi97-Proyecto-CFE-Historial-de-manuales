<?php

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


<!-- inicio del contenido principal -->
<link rel="stylesheet" href="estilosinasu.css">
<div class="page-content">




  <?php
  //hacemos la conexion
  include "../../modelo/conexion-SINASU.php";

  //Hacemos la consulta relacionando las tablas que necesitemos
  //para dicha consulta necesitamos la tabla usuario
  // $sql = $conexionSINASU->query(" SELECT * FROM sinasu_guias JOIN filtro_documentos ON sinasu_guias.id_elemento = filtro_documentos.id_elemento;");
  $id_proceso = $_GET['id_proceso'];
  $id_departamento = $_GET['id_departamento'];

  // Query para obtener el nombre del proceso
  $sql_nombre_proceso = $conexionSINASU->query("SELECT nombre_proceso FROM procesos WHERE id_proceso = $id_proceso");

  // Verificar si se obtuvieron resultados
  if ($sql_nombre_proceso->num_rows > 0) {
    // Obtener el nombre del proceso del primer resultado
    $nombre_proceso = $sql_nombre_proceso->fetch_assoc()['nombre_proceso'];

    // Mostrar el nombre del proceso
    echo "<h4 class='text-center text-secondary titulo-renta'><b>$nombre_proceso</b></h4>";
  }

  $sql_sinasu_guia = $conexionSINASU->query("SELECT s.*, p.*, e.*
  FROM sinasu_guias_" . $id_proceso . " AS s
  INNER JOIN procesos AS p ON s.id_proceso = p.id_proceso
  INNER JOIN estado AS e ON s.id_estado = e.id_estado
  ");

  ?>

  <section class="seccion-btns">
    <a href="../SINASU/procesos_comercial.php?id_departamento=<?= $id_departamento ?>"
      class="btn btn-danger btn-rounded mb-3"><i class="fa-regular fa-circle-left"></i>
      &nbsp; ATRAS</a>
    <div id="seccionActualizar" style="display: none;">
      <button id="btnActualizar" onclick="advertencia2(event)" class="btn btn-primary btn-rounded">Actualizar</button>
    </div>
  </section>


  <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->

  <?php
  if ($_SESSION['rol-sinasu'] == 3) {
    ?>

    <table class="table table-bordered table-hover w-100 " id="example">
      <thead>
        <tr>
          <th scope="col">ID GUIA</th>
          <th class="PREGUNTA" scope="col">Pregunta</th>

          <th scope="col">Criterio</th>

          <th scope="col">Evidencia Esperada</th>
          <th scope="col">Fuente de la Evidencia</th>
          <th scope="col">Estado</th>
          <th scope="col">Observaciones</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>

      <tbody>

        <?php
        while ($datos = $sql_sinasu_guia->fetch_object()) { ?>

          <tr>
            <td class="id" scope="row">
              <?= $datos->id_guia ?>
            </td>
            <!-- <td>
              <?= $datos->nombre_proceso ?>
            </td> -->
            <!-- <td>
              <?= $datos->elemento ?>
            </td> -->
            <td class="PREGUNTA">
              <?= $datos->pregunta ?>
            </td>
            <!-- <td>
              <?= $datos->ponderacion ?>
            </td> -->
            <td>
              <?= $datos->criterio ?>
            </td>
            <!-- <td class="id" scope="row">
              <?= $datos->id_guia ?>
            </td> -->
            <!-- <td class="id" scope="row">
              <?= $datos->id_agencia ?>
            </td> -->
            <td>
              <?= $datos->evidencia_esperada ?>
            </td>
            <td>
              <?= $datos->fuente_de_la_evidencia ?>
            </td>
            <td>
              <div class="<?php
              switch ($datos->nombre_estado) {
                case 'Aprobado':
                  echo 'estado-aceptado';
                  break;
                case 'Rechazado':
                case 'Sin evidencias':
                  echo 'estado-rechazado';
                  break;
                case 'En revisión':
                  echo 'estado-revision';
                  break;
                default:
                  echo ''; // Si hay un estado no definido, no se aplica ninguna clase
              }
              ?>">
                <?= $datos->nombre_estado ?>
              </div>
            </td>
            <td>
              <?= $datos->observaciones ?>
            </td>
            <td>
              <!-- AQUI SE AÑADE LA RUTA DE LA VISTA PARA SUBIR LOS DOCUMENTOS, ESPECIFICAR RUTA EN EL HREF -->
              <a style="font-size: 25px;" class="btn btn-info"
                href="../SINASU_AGENCIAS/subir_archivos.php?id_guia_subir_doc=<?= $datos->id_guia ?>&id_proceso=<?= $id_proceso ?>&id_departamento=<?= $_GET['id_departamento'] ?>"><i
                  class="fa-solid fa-file-arrow-up"></i>
              </a>
              <tool-tip role="tooltip"><b>Subir evidencias</b></tool-tip>

              <!-- <a style="font-size: 25px;" class="btn btn-info" href="subir_archivos.php?id=<?= $datos->id_guia ?>"
                onclick=" advertencia(event)"><i class="fa-solid fa-file-arrow-up"></i></a>  -->
            </td>
            <td>
              <a style="font-size: 25px;" class="btn btn-primary"
                href="../SINASU_AGENCIAS/ver_archivos.php?id_guia_subir_doc=<?= $datos->id_guia ?>&id_agencias_filtro=<?= $id_agencias_filtro ?>&id_proceso=<?= $id_proceso ?>&id_departamento=<?= $id_departamento ?>"><i
                  class="fa-solid fa-eye"></i></a>
              <tool-tip role="tooltip"><b>Ver evidencias</b></tool-tip>
            </td>
          </tr>


        <?php }

        ?>
        <?php

  } else {
    ?>
      </tbody>
    </table>

    <table class="table table-bordered table-hover w-100 " id="example">
      <thead>
        <tr>
          <th><input type="checkbox" id="marcarTodas"> All</th>
          <th scope="col">Id Guia</th>
          <th class="PREGUNTA" scope="col">Pregunta</th>
          <th scope="col">Criterio</th>
          <th scope="col">Evidencia Esperada</th>
          <th scope="col">Fuente de la Evidencia</th>
          <th scope="col">Estado</th>
          <th scope="col">Observaciones</th>
          <th scope="col">Cambiar estado</th>
          <th scope="col">Agregar Observaciones</th>
          <th scope="col"></th>
        </tr>
      </thead>

      <tbody>

        <?php
        while ($datos = $sql_sinasu_guia->fetch_object()) { ?>

          <!--dentro imprimiremos los valores que contienen mis tablas 
    en la base de datos-->
          <tr>
            <td><input type="checkbox" name="documento_seleccionado[]" class="id checkbox-seleccionar"
                id="<?= $datos->id_guia ?>"></td>

            <td>
              <?= $datos->id_guia ?>
            </td>
            <td class="PREGUNTA">
              <?= $datos->pregunta ?>
            </td>
            <td>
              <?= $datos->criterio ?>
            </td>
            <td>
              <?= $datos->evidencia_esperada ?>
            </td>
            <td>
              <?= $datos->fuente_de_la_evidencia ?>
            </td>
            <td>
              <div class="<?php
              switch ($datos->nombre_estado) {
                case 'Aprobado':
                  echo 'estado-aceptado';
                  break;
                case 'Rechazado':
                case 'Sin evidencias':
                  echo 'estado-rechazado';
                  break;
                case 'En revisión':
                  echo 'estado-revision';
                  break;
                default:
                  echo ''; // Si hay un estado no definido, no se aplica ninguna clase
              }
              ?>">
                <?= $datos->nombre_estado ?>
              </div>
            </td>
            <td>
              <?= $datos->observaciones ?>
            </td>
            <td>
              <select name="estado" class="select-estado" disabled>
                <option value="" disabled selected hidden>Escoge tu opción</option>
                <option class="so" value="1" <?php if ($datos->id_estado == 1)
                  echo "selected"; ?>>Aprobado</option>
                <option class="so" value="2" <?php if ($datos->id_estado == 2)
                  echo "selected"; ?>>Rechazado</option>
                <option class="so" value="3" <?php if ($datos->id_estado == 3)
                  echo "selected"; ?>>En revisión</option>
                <option class="so" value="4" <?php if ($datos->id_estado == 4)
                  echo "selected"; ?>>Sin evidencias</option>
              </select>

            </td>
            <td>
              <input class="form-control text-observacionnes" type="text" placeholder="Observaciones"
                aria-label="default input example">
            </td>
            <td>

              <!-- AQUI SE AÑADE LA RUTA DE LA VISTA PARA REVISAR DOCUMENTACION SUBIDA POR AGENCIAS, ESPECIFICAR RUTA EN EL HREF -->
              <div class="grupobtns">
                <a style="font-size: 15px;" class="btn btn-warning"
                  href="../SINASU_AGENCIAS/revisar_archivos.php?id_guia=<?= $datos->id_guia ?>&id_proceso=<?= $datos->id_proceso ?>&id_departamento=<?= $_GET['id_departamento'] ?>"><img
                    class="doc_review_logo" src="img-sinasu/review-file.svg" alt=""><tool-tip
                    role="tooltip"><b>EVIDENCIAS</b></tool-tip> </a>


                <a style="font-size: 15px;" class="btn "
                  href="../SINASU_AGENCIAS/subir_archivos_admin.php?id_guia=<?= $datos->id_guia ?>&id_proceso=<?= $datos->id_proceso ?>&id_departamento=<?= $_GET['id_departamento'] ?>"><img
                    class="doc_subir_logo" src="img-sinasu/agregar_evidencia.svg" alt=""> <tool-tip role="tooltip"><b>Subir
                      evidencias</b></tool-tip></a>


                <!-- BTN CON TOOLTIP -->
                <!-- <button class="Btns">

                  <div class="sign"><svg viewBox="0 0 512 512">
                      <path
                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                      </path>
                    </svg></div>

                  <div class="text">Logout</div>
                </button> -->

                <!-- FIN -->
              </div>

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
    <!-- <tfoot>
      <td>Solo</td>
      <td>Solo</td>
      <td>Solo</td>
      <td>Solo</td>
      <td>Solo</td>
    </tfoot> -->
  </table>
</div>

<!-- De los contenedores -->
<!-- <section class="continer-agencias-filtros"> -->

<!-- <form action="">
           <input type="text" placeholder="DNI del maestro" name="txtdni">
       </form> -->






<!-- 
       <a class="boton-sinasu-agencias-filtros"  href="../SINASU_AGENCIAS/agencia1.php?id_guia=<?= $datos->id_elemento + 1 ?>">

    

          
           <div  class="parte-sinasu-agencias-filtros">

               <figure>
                   <img src="img-sinasu/Yucatan.webp" alt="">
                </figure>

               <div class="fondo-agencias-filtros-2"></div>
         
               <i class="fa-regular fa-folder-open"></i>
     
               <h1> Control del Proceso</h1>

          </div>

       </a> -->





<!-- </section> -->
<!-- SCRIPT PARA LA FUNCION DE LOS checkbox -->
<!-- Javascript para el cambio de estados del checkbox -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Obtener referencias a elementos DOM
    var btnActualizar = document.getElementById('btnActualizar');
    var checkboxesFilas = document.querySelectorAll('.checkbox-seleccionar');
    var checkboxEncabezado = document.getElementById('marcarTodas');
    var seccionActualizar = document.getElementById('seccionActualizar');

    // Obtener el valor de id_proceso
    var idProceso = <?php echo json_encode($id_proceso); ?>;
    // console.log(idProceso);

    // Función para controlar la visibilidad del botón de actualizar
    function controlarVisibilidadBoton() {
      var hayFilasSeleccionadas = Array.from(checkboxesFilas).some(function (checkbox) {
        return checkbox.checked;
      });
      seccionActualizar.style.display = hayFilasSeleccionadas ? 'block' : 'none';
    }

    // Función para habilitar/deshabilitar los selects según el estado de los checkboxes
    function actualizarSelects() {
      checkboxesFilas.forEach(function (checkbox) {
        var fila = checkbox.closest('tr');
        var select = fila.querySelector('.select-estado');
        select.disabled = !checkbox.checked;
        if (!checkbox.checked) {
          select.value = ''; // Esto depende de cómo quieras manejar el estado vacío
        }
      });
    }

    // Función para obtener los datos actualizados
    function obtenerDatosActualizados() {
      var datosActualizados = [];
      checkboxesFilas.forEach(function (checkbox) {
        if (checkbox.checked) {
          var idGuia = checkbox.id;
          var nuevoEstado = checkbox.closest('tr').querySelector('.select-estado').value;
          datosActualizados.push({
            idGuia: idGuia,
            nuevoEstado: nuevoEstado
          });
        }
      });
      return datosActualizados;
    }

    // Agregar un evento de escucha al checkbox del encabezado
    checkboxEncabezado.addEventListener('change', function () {
      checkboxesFilas.forEach(function (checkbox) {
        checkbox.checked = checkboxEncabezado.checked;
      });
      controlarVisibilidadBoton();
      actualizarSelects();
    });

    // Agregar un evento de escucha a los checkboxes de las filas
    checkboxesFilas.forEach(function (checkbox) {
      checkbox.addEventListener('change', function () {
        controlarVisibilidadBoton();
        actualizarSelects();
      });
    });

    // Agregar un evento de escucha al botón de actualizar
    btnActualizar.addEventListener('click', function () {
      advertencia2(event);
    });

    function advertencia2(event) {
      event.preventDefault();
      var checkboxesFilas = document.querySelectorAll('.checkbox-seleccionar:checked');
      var datosActualizados = [];

      checkboxesFilas.forEach(function (checkbox) {
        var idGuia = checkbox.id;
        var nuevoEstado = checkbox.closest('tr').querySelector('.select-estado').value;
        var observaciones = checkbox.closest('tr').querySelector('.text-observacionnes').value; // Obtener las observaciones
        datosActualizados.push({
          idGuia: idGuia,
          nuevoEstado: nuevoEstado,
          observaciones: observaciones
        });
      });

      Swal.fire({
        title: "¿Estás seguro de que deseas actualizar los datos?",
        text: "El estado será actualizado",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#2CB073",
        cancelButtonColor: "#d33",
        confirmButtonText: "MODIFICAR",
        cancelButtonText: "CANCELAR",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          var data = {
            id_proceso: idProceso,
            datos_actualizados: datosActualizados
          };
          var jsonData = JSON.stringify(data);

          var xhr = new XMLHttpRequest();
          xhr.open('POST', '../SINASU_AGENCIAS/actualizar_datos.php');
          xhr.setRequestHeader('Content-Type', 'application/json');
          xhr.send(jsonData);

          xhr.onload = function () {
            if (xhr.status === 200) {
              Swal.fire({
                title: "CORRECTO",
                text: "La información se ha actualizado correctamente",
                icon: "success",
                confirmButtonColor: "#2CB073"
              }).then((result) => {
                location.reload();
              });
            } else {
              Swal.fire({
                title: "ERROR",
                text: "Ha ocurrido un error al actualizar la información",
                icon: "error",
                confirmButtonColor: "#d33"
              });
            }
          };
        }
      });
    }

  });



</script>


<!-- por ultimo se carga el footer -->
<?php require ('./../layout/footer_sinasu.php'); ?>