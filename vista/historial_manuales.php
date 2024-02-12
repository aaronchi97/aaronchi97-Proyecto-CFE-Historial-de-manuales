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

  <h4 style="margin-bottom: 5%;" class="text-center text-secondery">HISTORIAL DE MANUALES</h4>

  <?php
  //hacemos la conexion
  include "../modelo/conexion.php";
  //llamamos al controlador para eliminar registros
//   include "../controlador/controlador_modificar_manual.php";
  // include "../controlador/controlador_eliminar_usuario.php";




$id_manual_obtenido = $_GET['id_manual'];

$sql = $conexion->query(" SELECT * from historial_manuales where id_control_manuales = $id_manual_obtenido");

$datos = $sql->fetch_object()
  ?>



<a href="manuales.php?id_manuales_vuelta=<?= $datos->rpu ?> " class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-solid fa-caret-left"></i>
    ATRAS</a>



        <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->
        <?php
        if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ) {
          ?>

          
    <table class="table table-bordered table-hover w-100 " id="example">
      <thead>
        <tr>
          <!-- <th scope="col" >ACCION</th> -->
          <!-- <th scope="col"></th> -->
          <th scope="col">ACCION</th>
          <th scope="col">RPU</th>
          <th scope="col">CUENTA</th>
          <th scope="col">CICLO</th>
          <th scope="col">TARIFA</th>
          <th scope="col">MOTIVO MANUAL</th>
          <th scope="col">SIN USO</th>
          <th scope="col">LECTURA MANUAL</th>
          <th scope="col">KWH A RECUPERAR</th>
          <th scope="col">RESPALDO</th>
          <th scope="col">RPE_AUXILIAR</th>
          <th scope="col">OBSERVACIONES</th>
          <th scope="col">CORRECCION</th>
          <th scope="col">CUENTA2</th>
          <th scope="col">RESPONSABLE_MANUAL</th>
          <th scope="col">FECHA HISTORIAL</th>
          <th scope="col">ACCION</th>
        </tr>
      </thead>

      <tbody>


          <?php
          while ($datos = $sql->fetch_object()) { ?>

            <tr>
              
              <!-- <td>
              <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_control_manuales ?> "
                class="btn btn-success ">Generar manual <i class="fa-regular fa-file"></i></a>
              </td>
              <td>
                <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>">Historico <i class="fa-solid fa-eye"></i></a>
              </td> -->
             
              <!-- <td class="id" scope="row"> -->
              <td id="accionhistorial" onclick="copiarContenido('accionhistorial')">
                <?= $datos->accion_historial ?>
              </td>

              <td id="rpu" onclick="copiarContenido('rpu')">
                <?= $datos->rpu ?>
              </td>
              <td id="cuenta" onclick="copiarContenido('cuenta')">
                <?= $datos->cuenta ?>
              </td>
              <td id="ciclo" onclick="copiarContenido('ciclo')"> 
                <?= $datos->ciclo ?>
              </td>
              <td id="celdaTarifa" onclick="copiarContenido('celdaTarifa')">
                <?= $datos->tarifa ?>
              </td>
              <td id="celdaMotivoManual" onclick="copiarContenido('celdaMotivoManual')">
                <?= $datos->id_motivomanual ?>
              </td>
              <td id="celdaSinUso" onclick="copiarContenido('celdaSinUso')">
                <?= $datos->sin_uso ?>
              </td>
              <td id="celdaLecturaManual" onclick="copiarContenido('celdaLecturaManual')">
                <?= $datos->lectura_manual ?>
              </td>
              <td  id="celdaKwhRecuperar" onclick="copiarContenido('celdaKwhRecuperar')">
                <?= $datos->kwh_recuperar?>
              </td>
              <td id="celdaRespaldoManual" onclick="copiarContenido('celdaRespaldoManual')">
                <?= $datos->respaldo_man ?>
              </td>
              <td id="celdaRpeAuxiliar" onclick="copiarContenido('celdaRpeAuxiliar')">
                <?= $datos->rpe_auxiliar ?>
              </td>
              <td id="celdaObservaciones" onclick="copiarContenido('celdaObservaciones')">
                <?= $datos->observaciones ?>
              </td>
              <td id="celdaCorreccion" onclick="copiarContenido('celdaCorreccion')">
                <?= $datos->correccion ?>
              </td>
              <td id="celdaAgencia" onclick="copiarContenido('celdaAgencia')">
                <?= $datos->agencia ?>
              </td>
              <td id="celdaResponsableManual" onclick="copiarContenido('celdaResponsableManual')">
                <?= $datos->responsable_manual ?>
              </td>
              <!-- <td id="celdaFechaCaptura" onclick="copiarContenido('celdaFechaCaptura')">
                <?= $datos->fecha_captura ?>
              </td> -->
              <td id="celdaFechaCaptura" onclick="copiarContenido('celdaFechaCaptura')">
                <?= $datos->fecha_historial ?>
              </td>
              <td>
                <a class="btn btn-danger" href="manuales.php?id_manual_eliminar=<?= $datos->id_control_manuales ?>" onclick=" advertencia(event)"><i
                    class="fa-solid fa-trash-can"></i></a>
              </td>
            </tr>

            


          <!-- Modal -->
          <div class="modal fade" id="exampleModal<?= $datos->id_control_manuales  ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                  <h5 class="modal-title w-100" id="exampleModalLabel">GENERAR MANUAL</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!--Aqui haremos la modificacion de usuario-->
                  <form action="" method="post">
                    <div hidden class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="ID" class="input input__text inputmodal" name="txtid"
                        value=" <?= $datos->id_control_manuales ?>" readonly>
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="RPU" class="input input__text inputmodal" name="txtrpu"
                        value=" <?= $datos->rpu ?>" readonly> 
                    </div> 
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Cuenta" class="input input__text inputmodal" name="txtcuenta"
                        value=" <?= $datos->cuenta ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Ciclo" class="input input__text inputmodal" name="txtciclo"
                        value=" <?= $datos->ciclo ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Tarifa" class="input input__text inputmodal" name="txttarifa"
                        value=" <?= $datos->tarifa ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Motivo de la manual" class="input input__text inputmodal" name="txtidmotivomanual"
                        value=" <?= $datos->id_motivomanual ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="sin_uso" class="input input__text inputmodal" name="txtsin_uso"
                        value=" <?= $datos->sin_uso ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="lectura de manual" class="input input__text inputmodal" name="txtlectura_manual"
                        value=" <?= $datos->lectura_manual ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="kwh a recuperar" class="input input__text inputmodal" name="txtkwh_recuperar"
                        value=" <?= $datos->kwh_recuperar ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Respaldo_manual" class="input input__text inputmodal" name="txtrespaldo_manual"
                        value=" <?= $datos->respaldo_man ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="RPE auxiliar" class="input input__text inputmodal" name="txtrpe_auxiliar"
                        value=" <?= $datos->rpe_auxiliar ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Observaciones" class="input input__text inputmodal" name="txtobservaciones"
                        value=" <?= $datos->observaciones ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Correccion" class="input input__text inputmodal" name="txtcorreccion"
                        value=" <?= $datos->correccion ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Agencia" class="input input__text inputmodal" name="txtagencia"
                        value=" <?= $datos->agencia ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Responsable Manual" class="input input__text inputmodal" name="txtresponsable_manual"
                        value=" <?= $datos->responsable_manual ?>">
                    </div>

                    <!-- <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Fecha Captura" class="input input__text inputmodal" name="txtfecha_captura"
                        value=" <?= $datos->fecha_captura ?>">
                    </div> -->

          


                    
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



          <?php 
          
        }

          ?>
          <?php

        } else {
          ?>


            <table class="table table-bordered table-hover w-100 " id="example">
                <thead>
                    <tr>
                    <!-- <th scope="col" >ACCION</th> -->
                    <!-- <th scope="col"></th> -->
                    <th scope="col">ACCION</th>
                    <th scope="col">RPU</th>
                    <th scope="col">CUENTA</th>
                    <th scope="col">CICLO</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MOTIVO MANUAL</th>
                    <th scope="col">SIN USO</th>
                    <th scope="col">LECTURA MANUAL</th>
                    <th scope="col">KWH A RECUPERAR</th>
                    <th scope="col">RESPALDO</th>
                    <th scope="col">RPE_AUXILIAR</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">CORRECCION</th>
                    <th scope="col">CUENTA2</th>
                    <th scope="col">RESPONSABLE_MANUAL</th>
                    <th scope="col">FECHA HISTORIAL</th>
                    <!-- <th scope="col">ACCION</th> -->
                    </tr>
                </thead>

                <tbody>

          <?php
          while ($datos = $sql->fetch_object()) { ?>

            <!--dentro imprimiremos los valores que contienen mis tablas 
    en la base de datos-->
            <tr>
            <!-- <td>
                <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>"><i class="fa-solid fa-eye"></i></a>
              </td> -->
              <td id="accionhistorial" onclick="copiarContenido('accionhistorial')">
                <?= $datos->accion_historial ?>
              </td>

              <td id="rpu" onclick="copiarContenido('rpu')">
                <?= $datos->rpu ?>
              </td>
              <td id="cuenta" onclick="copiarContenido('cuenta')">
                <?= $datos->cuenta ?>
              </td>
              <td id="ciclo" onclick="copiarContenido('ciclo')"> 
                <?= $datos->ciclo ?>
              </td>
              <td id="celdaTarifa" onclick="copiarContenido('celdaTarifa')">
                <?= $datos->tarifa ?>
              </td>
              <td id="celdaMotivoManual" onclick="copiarContenido('celdaMotivoManual')">
                <?= $datos->id_motivomanual ?>
              </td>
              <td id="celdaSinUso" onclick="copiarContenido('celdaSinUso')">
                <?= $datos->sin_uso ?>
              </td>
              <td id="celdaLecturaManual" onclick="copiarContenido('celdaLecturaManual')">
                <?= $datos->lectura_manual ?>
              </td>
              <td  id="celdaKwhRecuperar" onclick="copiarContenido('celdaKwhRecuperar')">
                <?= $datos->kwh_recuperar?>
              </td>
              <td id="celdaRespaldoManual" onclick="copiarContenido('celdaRespaldoManual')">
                <?= $datos->respaldo_man ?>
              </td>
              <td id="celdaRpeAuxiliar" onclick="copiarContenido('celdaRpeAuxiliar')">
                <?= $datos->rpe_auxiliar ?>
              </td>
              <td id="celdaObservaciones" onclick="copiarContenido('celdaObservaciones')">
                <?= $datos->observaciones ?>
              </td>
              <td id="celdaCorreccion" onclick="copiarContenido('celdaCorreccion')">
                <?= $datos->correccion ?>
              </td>
              <td id="celdaAgencia" onclick="copiarContenido('celdaAgencia')">
                <?= $datos->agencia ?>
              </td>
              <td id="celdaResponsableManual" onclick="copiarContenido('celdaResponsableManual')">
                <?= $datos->responsable_manual ?>
              </td>
              <!-- <td>
                <?= $datos->fecha_captura ?>
              </td> -->
              <td id="celdaFechaCaptura" onclick="copiarContenido('celdaFechaCaptura')">
                <?= $datos->fecha_historial ?>
              </td>
             

              <!-- <?php echo $mostrarBoton ? 'otro' : ''; ?>  -->

            </tr>
          <?php } ?>

           


        <?php }

        ?>



   




    </tbody>
  </table>

</div>
</div>
<!-- fin del contenido principal -->



 <!-- SCRIPT PARA COPIAR CELADAS DE LA TABLA -->
 <script>
    function copiarContenido(idCelda) {
      // Obtener el contenido de la celda
      const contenido = document.getElementById(idCelda).innerText;

      // Crear un elemento de texto temporal
      const elementoTemporal = document.createElement('textarea');
      elementoTemporal.value = contenido;

      // Añadir el elemento al DOM
      document.body.appendChild(elementoTemporal);

      // Seleccionar el contenido del elemento temporal
      elementoTemporal.select();

      // Copiar al portapapeles
      document.execCommand('copy');

      // Eliminar el elemento temporal después de 1 segundo
      setTimeout(() => {
        document.body.removeChild(elementoTemporal);
      }, 1000);

      // Mostrar un mensaje temporal en la posición del puntero
      const mensajeCopiado = document.createElement('div');
      mensajeCopiado.innerHTML = 'Copiado';
      mensajeCopiado.style.position = 'fixed';
      mensajeCopiado.style.top = `${event.clientY}px`;
      mensajeCopiado.style.left = `${event.clientX}px`;
      mensajeCopiado.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
      mensajeCopiado.style.color = '#fff';
      mensajeCopiado.style.padding = '5px';
      mensajeCopiado.style.borderRadius = '5px';

      document.body.appendChild(mensajeCopiado);

      // Eliminar el mensaje después de 1 segundo
      setTimeout(() => {
        document.body.removeChild(mensajeCopiado);
      }, 1000);
    }
</script>

<script>
    function buscar() {
      var input = document.getElementById("searchInput").value;

      if (input.trim() === "") {
        // Mostrar mensaje de error si el campo está vacío
        document.getElementById("errorMessage").style.display = "block";
      } else {
        // Ocultar el mensaje de error si el campo no está vacío
        document.getElementById("errorMessage").style.display = "none";
        
        // Realizar la búsqueda o la acción que desees aquí
        // Puedes agregar tu lógica de búsqueda o redireccionar a otra página.
        // Ejemplo: document.getElementById("searchForm").submit();
      }
    }
  </script>




<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>