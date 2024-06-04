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

<!-- Crear el metodo advertencia para el boton de eliminar registro -->
<!-- <script>
    function advertencia() {
        var not = confirm("¿Estas seguro de eliminar el registro?");
        return not;
    }
 </script> -->



<!-- primero se carga el topbar -->
<?php require ('./../layout/topbar_sinasu.php'); ?>
<!-- luego se carga el sidebar -->
<?php require ('./../layout/sidebar_sinasu.php'); ?>


<!-- inicio del contenido principal -->
<link rel="stylesheet" href="../SINASU/estilosinasu.css">
<div class="page-content">

    <!-- <h4 class="text-center text-secondery"> Evidencias guia</h4> -->

    <?php
  //hacemos la conexion
  include "../../modelo/conexion-SINASU.php";
  //llamamos al controlador para eliminar registros
  // include "../../controlador/controlador_modificar_usuario_sinasu.php";
  include "../../controlador/controlador_eliminar_documentos.php";


  //Hacemos la consulta relacionando las tablas que necesitemos
  //para dicha consulta necesitamos la tabla usuario
  $id_guia = $_GET["id_guia_subir_doc"];
  $id_proceso = $_GET['id_proceso'];
  $id_agencia_regresar_vista_documentos = $_SESSION["id-agencia-sinasu"];

  $sql = $conexionSINASU->query("SELECT *, d.observaciones
  FROM documentos AS d
  INNER JOIN sinasu_guias_" . $id_proceso . " AS g ON d.id_guia = g.id_guia
  INNER JOIN estado AS e ON d.id_estado = e.id_estado
  INNER JOIN procesos p ON p.id_proceso = d.id_proceso
  WHERE d.id_guia = '$id_guia' AND g.id_agencia = '$id_agencia_regresar_vista_documentos' AND d.id_proceso = '$id_proceso';");

  $sql_pregunta = $conexionSINASU->query("SELECT pregunta FROM sinasu_guias_" . $id_proceso . " WHERE id_guia = '$id_guia';");

  if ($sql_pregunta->num_rows > 0) {
    // Obtener el nombre del proceso del primer resultado
    $nombre_pregunta = $sql_pregunta->fetch_assoc()['pregunta'];

    // Mostrar el nombre del proceso
    echo "<h4 class='text-justify text-secondary titulo-renta2'><b>" . $id_guia . "- " . $nombre_pregunta . "</b></h4>";
  }

  ?>




    <a href="../SINASU/agencias_filtros.php?id_agencias_filtro=<?= $id_agencia_regresar_vista_documentos ?>&id_proceso=<?= $_GET['id_proceso'] ?>&id_departamento=<?= $_GET['id_departamento'] ?>"
        class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-regular fa-circle-left"></i> &nbsp;
        ATRÁS</a>

    <!-- <a href="subir_archivos.php?id_guia_subir_doc=<?= $id_guia ?>" class="btn btn-primary btn-rounded mb-3 otro"><i
      class="fa-solid fa-file-arrow-up"></i>
    &nbsp;
    SUBIR ARCHIVOS</a> -->


    <table class="table table-bordered table-hover w-100 " id="example">
        <thead>
            <tr>
                <th scope="col">ID DOCUMENTO</th>
                <th scope="col">NOMBRE DOCUMENTO</th>
                <th scope="col">FECHA SUBIDA</th>
                <th scope="col">COMENTARIOS</th>
                <th scope="col">ESTADO</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>

            <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->
            <?php
      if ($_SESSION['rol-sinasu'] == 3) {
        ?>
            <?php
        while ($datos = $sql->fetch_object()) { ?>

            <tr>
                <td class="id" scope="row">
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
                <!-- <td>
              <?= $datos->nombre_responsable ?>
            </td> -->
                <td>
                    <!-- <a class="btn btn-danger" href="ver_archivos.php?id=<?= $datos->id_documento ?>"
                onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a> -->
                    <a class="btn btn-danger"
                        href="ver_archivos.php?id_guia_subir_doc=<?= $id_guia ?>&id=<?= $datos->id_documento ?>&id_agencias_filtro=<?= $_GET['id_agencias_filtro'] ?>&id_proceso=<?= $_GET['id_proceso'] ?>&id_departamento=<?= $_GET['id_departamento'] ?>"
                        onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a>
                    <tool-tip role="tooltip"><b>Eliminar Archivo</b></tool-tip>
                </td>
                <td>
                    <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_documento ?> "
                        class="btn btn-warning "><i class="fa-solid fa-comment"></i></a>
                    <tool-tip role="tooltip"><b>Comentar evidencia</b></tool-tip>
                </td>

            </tr>

            <!-- ver_archivos.php?id_guia_subir_doc=<?= $datos->id_guia ?> -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?= $datos->id_documento ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-between">
                            <h5 class="modal-title w-100" id="exampleModalLabel">Vista previa de la evidencia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="formulario_actualizar_evidencia">
                                <form action="../../controlador/controlador_actualizar_observaciones_documento.php"
                                    method="post">

                                    <input type="hidden" name="id_documento" value="<?= $datos->id_documento ?>">
                                    <label>Observaciones</label>
                                    <textarea class="text-area-observaciones" name="observaciones"
                                        id="observacion_evidencia" cols="30" rows="3"
                                        placeholder="Escriba sus observaciones" style="resize: none;"></textarea>


                                    <a target="_blank" href="<?= $datos->ruta_doc ?>"
                                        onclick="actualizarEstadoEvidencia(<?= $datos->id_documento ?>)"
                                        class="btn btn-info "><i class="fa-solid fa-file-circle-check"></i> VISTA PREVIA
                                        DE LA EVIDENCIA</a>

                                    <div class="modal-footer text-right p-3">
                                        <button type="button" class="btn btn-secondary btn-rounded"
                                            data-dismiss="modal">Atrás</button>
                                        <button type="submit" value="ok" name="btnmodificar"
                                            class="btn btn-primary btn-rounded">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        <?= $datos->nombre_doc ?>
                    </a>

                </td>
                <td>
                    <?= $datos->fecha_subida ?>
                </td>
                <!-- <td>
              <?= $datos->observaciones ?>
            </td> -->
                <td>
                    <?= $datos->estado ?>
                </td>
                <td>
                    <?= $datos->nombre_responsable ?>
                </td>
                <td>
                    <a href="controlador_eliminar_archivos.php" class="btn btn-danger" style="font-size: 15px;"><i
                            class="fa-solid fa-trash-can"></i></a>
                    <tool-tip role="tooltip"><b>Eliminar Archivo</b></tool-tip>


                    <!-- <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_usuario ?> "
                class="btn btn-warning "><i class="fa-solid fa-user-pen"></i></a> -->
                    <!-- <a class="btn btn-danger" href="usuario-sinasu.php?id=<?= $datos->id_usuario ?>"
                onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a> -->
                </td>

                <!-- <?php echo $mostrarBoton ? 'otro' : ''; ?>  -->

            </tr>



            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?= $datos->id_documento ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-between">
                            <h5 class="modal-title w-100" id="exampleModalLabel">Vista previa de la evidencia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="formulario_actualizar_evidencia">
                                <form action="../../controlador/controlador_actualizar_estado_documento.php"
                                    method="post">

                                    <input type="hidden" name="id_documento" value="<?= $datos->id_documento ?>">
                                    <label>Observaciones</label>
                                    <textarea class="text-area-observaciones" name="observaciones"
                                        id="observacion_evidencia" cols="30" rows="3"
                                        placeholder="Escriba sus observaciones" style="resize: none;"></textarea>

                                    <label for="select-estado">Estado de la Evidencia</label>
                                    <select name="select-estado" id="">
                                        <option value="">Selecciona Estado</option>
                                        <option value="1">Aprobado</option>
                                        <option value="2">Rechazado</option>
                                    </select>
                                    <a target="_blank" href="<?= $datos->ruta_doc ?>"
                                        onclick="actualizarEstadoEvidencia(<?= $datos->id_documento ?>)"
                                        class="btn btn-info "><i class="fa-solid fa-file-circle-check"></i> VISTA PREVIA
                                        DE LA EVIDENCIA</a>

                                    <div class="modal-footer text-right p-3">
                                        <button type="button" class="btn btn-secondary btn-rounded"
                                            data-dismiss="modal">Atrás</button>
                                        <button type="submit" value="ok" name="btnmodificar"
                                            class="btn btn-primary btn-rounded">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
<?php require ('./../layout/footer_sinasu.php'); ?>