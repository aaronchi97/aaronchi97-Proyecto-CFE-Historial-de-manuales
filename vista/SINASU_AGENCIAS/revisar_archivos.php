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
    background: #008f5a !important;
}
</style>




<!-- primero se carga el topbar -->
<?php require ('./../layout/topbar_sinasu.php'); ?>
<!-- luego se carga el sidebar -->
<?php require ('./../layout/sidebar_sinasu.php'); ?>


<!-- inicio del contenido principal -->
<link rel="stylesheet" href="../SINASU/estilosinasu.css">
<div class="page-content">



    <?php

  //Oculta los warnings
  error_reporting(E_ERROR | E_PARSE);

  //hacemos la conexion
  include "../../modelo/conexion-SINASU.php";

  if (isset ($_GET["id_agencia_revision_administrador"])) {
    // Incluir el controlador existente si el parámetro id_agencia_revision_administrador está presente en la URL
    include "../../controlador/controlador_vista_administrador__documentos_sinasu.php";
  } else {
    // Incluir el nuevo controlador si el parámetro id_agencia_revision_administrador no está presente en la URL
    include "../../controlador/controlador_vista_administrador__documentos_comercial.php";
  }

  include "../../controlador/controlador_eliminar_documentos.php";

  //Hacemos la consulta relacionando las tablas que necesitemos
  //para dicha consulta necesitamos la tabla usuario
  // $sql = $conexionSINASU->query("SELECT * FROM documentos");
  $id_proceso = $_GET['id_proceso'];
  $id_agencia = $_GET['id_agencia_revision_administrador'];


  if ($sql_pregunta->num_rows > 0) {
    // Obtener el nombre del proceso del primer resultado
    $nombre_pregunta = $sql_pregunta->fetch_assoc()['pregunta'];

    // Mostrar el nombre del proceso
    echo "<h4 class='text-justify text-secondary titulo-renta2'>" . $_GET['id_guia'] . "- " . $nombre_pregunta . "</h4>";
  }

  ?>

    <?php
  if ($_SESSION['rol-sinasu'] == 3) {
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

  // Verificar si el parámetro relacionado con las agencias está presente en la URL
  $agenciasPresentes = isset ($_GET['id_agencia_revision_administrador']);

  // Verificar si el parámetro relacionado con el proceso comercial está presente en la URL
  $procesoComercialPresente = isset ($_GET['id_proceso']);
  ?>



    <!-- Botón de atrás a Agencias -->
    <?php if ($agenciasPresentes): ?>
    <!-- Botón de atrás a Agencias -->
    <a href="../SINASU/agencias_filtros.php?id_agencias_filtro=<?= $_GET['id_agencia_revision_administrador'] ?>&id_proceso=<?= $_GET['id_proceso'] ?>&id_departamento=<?= $_GET['id_departamento'] ?>"
        class="btn btn-danger btn-rounded mb-3 mb-md-4 otro" style="margin: 20px 0px;">
        <i class="fa-regular fa-circle-left"></i> &nbsp; ATRÁS
    </a>
    <?php elseif ($procesoComercialPresente && ($_GET['id_proceso'] == 4 || $_GET['id_proceso'] == 5)): ?>
    <!-- Botón de atrás a Filtro Proceso Comercial -->
    <a href="../SINASU/filtro_proceso_comercial.php?id_proceso=<?= $_GET['id_proceso'] ?>&id_departamento=<?= $_GET['id_departamento'] ?>"
        class="btn btn-danger btn-rounded mb-3 otro" style="margin: 20px 0px;">
        <i class="fa-regular fa-circle-left"></i> &nbsp; ATRÁS
    </a>
    <?php endif; ?>



    <?php

  // Verificar qué controlador se está utilizando y generar la tabla correspondiente
  if (isset ($_GET["id_agencia_revision_administrador"])) {
    ?>
    <table class="table table-bordered table-hover w-100 " id="example">
        <thead>
            <tr>
                <th><input type="checkbox" id="marcarTodas"> Todo</th>
                <th scope="col">ID DOCUMENTO</th>
                <!-- <th scope="col">ID GUIA</th> -->
                <th scope="col">NOMBRE DOCUMENTO</th>
                <th scope="col">FECHA SUBIDA</th>
                <th scope="col">OBSERVACIONES</th>
                <th scope="col">ESTADO</th>
                <th scope="col">NOMBRE RESPONSABLE</th>
                <th scope="col">Responsable </th>
                <th scope="col">Estado Evidencia</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>

            <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->

            <?php
        while ($datos = $sql_id_agencia_revision_administrador->fetch_object()) { ?>

            <!--dentro imprimiremos los valores que contienen mis tablas 
    en la base de datos-->
            <tr>
                <td>
                    <label class="checkbox-seleccionar">
                        <input type="checkbox" name="documento_seleccionado[]" id="<?= $datos->id_documento ?>">
                        <span class="checkmark"></span>
                    </label>
                </td>


                <td class="so" scope="row">
                    <?= $datos->id_documento ?>
                </td>
                <!-- <td>
              <?= $datos->id_guia ?>
            </td> -->
                <td>
                    <a target="_blank" href="<?= $datos->ruta_doc ?>">
                        <?= $datos->nombre_doc ?>
                    </a>

                </td>
                <td>
                    <?= $datos->fecha_subida ?>
                </td>
                <td>
                    <?= $datos->observaciones ?>
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
                    <?= $datos->nombre_responsable ?>
                </td>
                <td>
                    <?= $datos->modificador ?>
                </td>





                <td>
                    <div class="<?php switch ($datos->nombre_estado_evidencia) {
                case 'Revisado':
                  echo 'estado-evidencia-revisado';
                  break;
                case 'No Revisado':
                  echo 'estado-evidencia-no-revisado';
                  break;
                default:
                  echo ''; //Si hay un estado no definido, no se aplica ninguna clase
              } ?>">
                        <?= $datos->nombre_estado_evidencia ?>

                    </div>
                </td>

                <td>
                    <a href="revisar_archivos.php?id=<?= $datos->id_documento ?>&id_guia=<?= $_GET['id_guia'] ?>&id_agencia_revision_administrador=<?= $_GET['id_agencia_revision_administrador'] ?>&id_proceso=<?= $_GET['id_proceso'] ?>&id_departamento=<?= $_GET['id_departamento'] ?>"
                        onclick="advertencia(event)" class="btn btn-danger" style="font-size: 15px;"><i
                            class="fa-solid fa-trash-can"></i></a>
                    <tool-tip role="tooltip"><b>Eliminar Archivo</b></tool-tip>
                </td>

                <!-- <td>
              <a href="#" id="abrirbtn" class="btn btn-warning btn-evaluar" onclick="gatito(event)"
                style="font-size: 15px;"><i class="fa-solid fa-file-circle-check"></i></a>
              <tool-tip role="tooltip"><b>Evaluar evidencia</b></tool-tip>
            </td> -->
                <td>
                    <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_documento ?> "
                        class="btn btn-warning "><i class="fa-solid fa-file-circle-check"></i></a>
                    <tool-tip role="tooltip"><b>Revisar evidencia</b></tool-tip>
                </td>
                <!-- <?php echo $mostrarBoton ? 'otro' : ''; ?>  -->

            </tr>



            <!-- Modal -->

            <div class="modal fade" id="exampleModal<?= $datos->id_documento ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-between titulo_modal">
                            <h5 class="modal-title w-80" id="exampleModalLabel">Vista previa de la evidencia: <span>
                                    <?= $datos->id_documento ?>
                                </span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="formulario_actualizar_evidencia">
                                <form action="../../controlador/controlador_actualizar_estado_documento.php"
                                    method="post">

                                    <input type="hidden" name="id_documento" value="<?= $datos->id_documento ?>">
                                    <input type="hidden" name="usuario-sinasu"
                                        value="<?= $_SESSION["usuario-sinasu"] ?>">
                                    <label>Observaciones</label>
                                    <textarea class="text-area-observaciones" name="observaciones"
                                        id="observacion_evidencia" cols="30" rows="3"
                                        placeholder="Escriba sus observaciones" style="resize: none;"></textarea>

                                    <label for="select-estado">Estado de la Evidencia</label>
                                    <select name="select-estado" id="" class="select-estado-evidencia" required>
                                        <option value="" disabled selected hidden>Selecciona Estado</option>
                                        <option value="1">Aprobado</option>
                                        <option value="2">Rechazado</option>
                                    </select>

                                    <a target="_blank" href="<?= $datos->ruta_doc ?>"
                                        onclick="actualizarEstadoEvidencia(<?= $datos->id_documento ?>)"
                                        class="btn btn-info "><i class="fa-solid fa-file-circle-check"></i> VISTA PREVIA
                                        DE LA EVIDENCIA</a>

                                    <div class="modal-footer text-right p-3">
                                        <button type="button" class="btn btn-secondary btn-rounded"
                                            data-dismiss="modal">AtrÁs</button>
                                        <button type="submit" value="ok" name="btnmodificar"
                                            class="btn btn-primary btn-rounded">Actualizar</button>
                                    </div>
                                </form>

                                <!-- <iframe src="<?= $datos->ruta_doc ?>" width="100%" height="500px" frameborder="0"
                    sandbox="allow-modals allow-orientation-lock allow-pointer-lock allow-popups allow-popups-to-escape-sandbox allow-presentation allow-top-navigation allow-top-navigation-by-user-activation">
                  </iframe> -->






                            </div>
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
    <?php } else { ?>
    <table class="table table-bordered table-hover w-100 " id="example">
        <thead>
            <tr>
                <th><input type="checkbox" id="marcarTodas"> Todo</th>
                <th scope="col">ID DOCUMENTO</th>
                <!-- <th scope="col">ID GUIA</th> -->
                <th scope="col">NOMBRE DOCUMENTO</th>
                <th scope="col">FECHA SUBIDA</th>
                <th scope="col">OBSERVACIONES</th>
                <th scope="col">ESTADO</th>
                <th scope="col">NOMBRE RESPONSABLE</th>
                <th scope="col">Responsable </th>
                <th scope="col">Estado Evidencia</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>

            <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES---------------------------------------------------------------------------->

            <?php
        while ($datos = $sql_id_guia_revision_administrador->fetch_object()) { ?>

            <!--dentro imprimiremos los valores que contienen mis tablas 
        en la base de datos-->
            <tr>
                <td>
                    <label class="checkbox-seleccionar">
                        <input type="checkbox" name="documento_seleccionado[]" id="<?= $datos->id_documento ?>">
                        <span class="checkmark"></span>
                    </label>
                </td>


                <td class="so" scope="row">
                    <?= $datos->id_documento ?>
                </td>
                <!-- <td>
              <?= $datos->id_guia ?>
            </td> -->
                <td>
                    <a target="_blank" href="<?= $datos->ruta_doc ?>">
                        <?= $datos->nombre_doc ?>
                    </a>

                </td>
                <td>
                    <?= $datos->fecha_subida ?>
                </td>
                <td>
                    <?= $datos->observaciones ?>
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
                    <?= $datos->nombre_responsable ?>
                </td>
                <td>
                    <?= $datos->modificador ?>
                </td>
                <td>
                    <div class="<?php switch ($datos->nombre_estado_evidencia) {
                case 'Revisado':
                  echo 'estado-evidencia-revisado';
                  break;
                case 'No Revisado':
                  echo 'estado-evidencia-no-revisado';
                  break;
                default:
                  echo ''; //Si hay un estado no definido, no se aplica ninguna clase
              } ?>">
                        <?= $datos->nombre_estado_evidencia ?>

                    </div>
                </td>

                <td>
                    <a href="revisar_archivos.php?id=<?= $datos->id_documento ?>&id_guia=<?= $_GET['id_guia'] ?>&id_agencia_revision_administrador=<?= $_GET['id_agencia_revision_administrador'] ?>&id_proceso=<?= $_GET['id_proceso'] ?>&id_departamento=<?= $_GET['id_departamento'] ?>"
                        onclick="advertencia(event)" class="btn btn-danger" style="font-size: 15px;"><i
                            class="fa-solid fa-trash-can"></i></a>
                    <tool-tip role="tooltip"><b>Eliminar Archivo</b></tool-tip>
                </td>

                <!-- <td>
              <a href="#" id="abrirbtn" class="btn btn-warning btn-evaluar" onclick="gatito(event)"
                style="font-size: 15px;"><i class="fa-solid fa-file-circle-check"></i></a>
              <tool-tip role="tooltip"><b>Evaluar evidencia</b></tool-tip>
            </td> -->
                <td>
                    <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_documento ?> "
                        class="btn btn-warning "><i class="fa-solid fa-file-circle-check"></i></a>
                    <tool-tip role="tooltip"><b>Revisar evidencia</b></tool-tip>
                </td>

                <!-- <?php echo $mostrarBoton ? 'otro' : ''; ?>  -->

            </tr>



            <!-- Modal -->

            <div class="modal fade" id="exampleModal<?= $datos->id_documento ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-between titulo_modal">
                            <h5 class="modal-title w-100" id="exampleModalLabel">Vista previa de la evidencia: <span>
                                    <?= $datos->id_documento ?>
                                </span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="formulario_actualizar_evidencia">
                                <form action="../../controlador/controlador_actualizar_estado_documento.php"
                                    method="post">

                                    <input type="hidden" name="id_documento" value="<?= $datos->id_documento ?>">
                                    <input type="hidden" name="usuario-sinasu"
                                        value="<?= $_SESSION["usuario-sinasu"] ?>">
                                    <label>Observaciones</label>
                                    <textarea class="text-area-observaciones" name="observaciones"
                                        id="observacion_evidencia" cols="30" rows="3"
                                        placeholder="Escriba sus observaciones" style="resize: none;"></textarea>

                                    <label for="select-estado">Estado de la Evidencia</label>
                                    <select name="select-estado" id="" class="select-estado-evidencia" required>
                                        <option value="" disabled selected hidden>Selecciona Estado</option>
                                        <option value="1">Aprobado</option>
                                        <option value="2">Rechazado</option>
                                    </select>

                                    <a target="_blank" href="<?= $datos->ruta_doc ?>"
                                        onclick="actualizarEstadoEvidencia(<?= $datos->id_documento ?>)"
                                        class="btn btn-info "><i class="fa-solid fa-file-circle-check"></i> VISTA PREVIA
                                        DE LA EVIDENCIA</a>

                                    <div class="modal-footer text-right p-3">
                                        <button type="button" class="btn btn-secondary btn-rounded"
                                            data-dismiss="modal">AtrÁs</button>
                                        <button type="submit" value="ok" name="btnmodificar"
                                            class="btn btn-primary btn-rounded">Actualizar</button>
                                    </div>
                                </form>

                                <!-- <iframe src="<?= $datos->ruta_doc ?>" width="100%" height="500px" frameborder="0"
                    sandbox="allow-modals allow-orientation-lock allow-pointer-lock allow-popups allow-popups-to-escape-sandbox allow-presentation allow-top-navigation allow-top-navigation-by-user-activation">
                  </iframe> -->






                            </div>
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

    <?php } ?>
    <!-- <div class="dropdown">
    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
      aria-expanded="false">
      Dropdown button
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <li><a class="dropdown-item" href="#">Action</a></li>
      <li><a class="dropdown-item" href="#">Another action</a></li>
      <li><a class="dropdown-item" href="#">Something else here</a></li>
    </ul>
  </div> -->
</div>

</div>

<!-- fin del contenido principal -->
<!-- script para el dropdown -->
<!-- <script>
  document.addEventListener('DOMContentLoaded', function () {
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
      return new bootstrap.Dropdown(dropdownToggleEl);
    });
  });

</script> -->
<!-- fin del script -->
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
<script>
var fondo = document.getElementById("modal");
$("#abrirbtn").click(function() {
    fondo.style.display = "flex";
});

$("#cerrarbtn").click(function() {
    fondo.style.display = "none";
});

window.onclick = function(event) {
    if (event.target == fondo) {
        fondo.style.display = "none";
    }
};
</script>

<!-- Javascript para el cambio de estados del checkbox -->
<!-- Agregar este script al final del documento HTML -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Obtener referencia al checkbox "marcarTodas"
    var marcarTodasCheckbox = document.getElementById('marcarTodas');
    // Obtener referencia a todos los checkboxes de las filas
    var checkboxesFilas = document.querySelectorAll('.checkbox-seleccionar input[type="checkbox"]');

    // Agregar un evento de escucha al checkbox "marcarTodas"
    marcarTodasCheckbox.addEventListener('change', function() {
        // Iterar sobre todos los checkboxes de las filas
        checkboxesFilas.forEach(function(checkbox) {
            // Marcar o desmarcar el checkbox de la fila según el estado de "marcarTodas"
            checkbox.checked = marcarTodasCheckbox.checked;
        });
    });
});
</script>





<!-- por ultimo se carga el footer -->
<?php require ('./../layout/footer_sinasu.php'); ?>