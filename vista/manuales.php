
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="estiloinicio.css">
<!-- Select2 -->

        <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
        <!-- <link rel="stylesheet" href="select2/select2.min.css"> -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<!-- Select2 -->
        
      
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
        <!-- <script src="select2/select2.min.js"></script> -->

  








  





<div class="page-content">

  <h4 style="margin-bottom: 5%;" class="text-center text-secondery"> MANUALES</h4>

  <?php
  //hacemos la conexion
  include "../modelo/conexion.php";
  //llamamos al controlador para eliminar registros
  include "../controlador/controlador_modificar_manual.php";
  // include "../controlador/controlador_eliminar_usuario.php";

  
  $mostrarTablas = false;
  if (isset($_POST['txtbuscarrpu'])) { ?>


<!-- AQUI AGREGAMOS EL FOMR PARA BUSCAR RPU INDIVIDUAL, PERO LA PRIMERA VISTA SERA LA QUE ESTA EN EL ELSE, QUE MUESTRA 
LOS RPU QUE SE HAN REGISTRADO EN EL MES ACTUAL  -->

    <form style="margin-bottom: 4%;" action="" method="post" id="searchForm">
   
    <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
    <input type="text"  class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpu">
    </div>
    <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
  </form>


  <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>



  <?php
    $rpu_buscar = $_POST['txtbuscarrpu'];
    // $rpu_vuelta = $_GET['id_manuales_vuelta'];
    // Modificar la consulta para incluir la cláusula WHERE
    $sql = $conexion->query("SELECT * FROM control_manuales WHERE rpu = $rpu_buscar  ");

    // Activar la visualización de las tablas
    $mostrarTablas = true;
  }else{
    $mes_actual = date('m');

    // Realizar la consulta SQL
    $sql_mes = $conexion->query("SELECT * FROM control_manuales WHERE MONTH(fecha_captura) = $mes_actual"); 
  
       
        if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ) {
          ?>

<form style="margin-bottom: 4%;" action="" method="post" id="searchForm">
   
   <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
   <input type="text"  class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpu">
   </div>
   <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
 </form>


 <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>






           <table class="table table-bordered table-hover w-100 " id="example">
                <thead>
                  <tr>
                   
                    <th scope="col"></th>
                    <th scope="col">RPU</th>
                    <th scope="col">CUENTA</th>
                    <th scope="col">CICLO</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MOTIVO MANUAL</th>
                    <!-- <th scope="col">SIN USO</th> -->
                    <th scope="col">LECTURA MANUAL</th>
                    <th scope="col">KWH A RECUPERAR</th>
                    <th scope="col">RESPALDO</th>
                    <th scope="col">RPE_AUXILIAR</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">CORRECCION</th>
                    <th scope="col">CUENTA2</th>
                    <th scope="col">RESPONSABLE_MANUAL</th>
                    <th scope="col">FECHA</th>
                    <th scope="col" >ACCION</th>
                  
                  </tr>
               </thead>

                <tbody>
          <?php
          while ($datos = $sql_mes->fetch_object()) { ?>

            <tr>
              
              
              <td>
                <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>">HISTÓRICO  <i class="fa-solid fa-file-shield"></i></a>
              </td>
              
              <!-- <td class="id" scope="row"> -->
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
              <!-- <td id="celdaSinUso" onclick="copiarContenido('celdaSinUso')">
                <?= $datos->sin_uso ?>
              </td> -->
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
              <td id="celdaFechaCaptura" onclick="copiarContenido('celdaFechaCaptura')">
                <?= $datos->fecha_captura ?>
              </td>

              <td>
              <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_control_manuales ?> "
                class="btn btn-success ">CORREGIR MANUAL RPU: <?= $datos->rpu ?> <i class="fa-brands fa-stack-overflow"></i></a>

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
                  <h5 class="modal-title w-100" id="exampleModalLabel">CORREGIR MANUAL</h5>
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

                      <input type="text" placeholder="RPU" class="input input__text inputmodal_ineditable" name="txtrpu"
                        value=" <?=$datos->rpu ?>" readonly> 
                    </div> 
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="CUENTA ACTUAL: <span class='placeholder_otrocolor'> <?= trim($datos->cuenta) ?> </span> " class="input input__text inputmodal" name="txtcuenta" list="cuentaList" autocomplete="off"
                        value=" <?= trim($datos->cuenta) ?>">
                        <datalist  id="cuentaList"></datalist>
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="CICLO ACTUAL: <?= trim($datos->ciclo) ?>" class="input input__text inputmodal" name="txtciclo"
                        value=" <?= trim($datos->ciclo) ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="TARIFA ACTUAL: <?= trim($datos->tarifa) ?>" class="input input__text inputmodal" name="txttarifa"
                        value=" <?= trim($datos->tarifa) ?>">
                    </div>


                    <div  class="fl-flex-label mb-4 px-2 col-12 campo">

                   
                        <input class="input input__text inputmodal"  name="txtidmotivomanual" type="text" placeholder="MOTIVO DE MANUAL ACTUAL: <?= $datos->id_motivomanual ?>"  value=" <?= trim($datos->id_motivomanual ) ?>" list="motivosList" autocomplete="off">
                        <datalist  id="motivosList"></datalist>


                    
                        <!-- <select  name="txtidmotivomanual" class="input input__select inputmodal" >
                      
                                <option value="">  <?= $datos->id_motivomanual ?> </option>
                                <?php
                                $sql_mostrar_motivo_manuales = $conexion->query(" SELECT DISTINCT TRIM(id_motivomanual) AS id_motivomanual
                                FROM control_manuales ");
                                while ($datoss = $sql_mostrar_motivo_manuales->fetch_object()) { ?>
                                  <option value="<?= $datoss->id_motivomanual ?>"><?= $datoss->id_motivomanual ?></option>
                                <?php }
                                ?>
                        </select>-->
                    </div>

            




                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="SIN_USO: <?= trim($datos->sin_uso) ?>" class="input input__text inputmodal" name="txtsin_uso"
                        value=" <?= trim($datos->sin_uso) ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="lECTURA MANUAL ACTUAL: <?= trim($datos->lectura_manual) ?>" class="input input__text inputmodal" name="txtlectura_manual"
                        value=" <?= trim($datos->lectura_manual) ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="KWH A RECUPERAR ACTUAL: <?=trim($datos->kwh_recuperar) ?>" class="input input__text inputmodal" name="txtkwh_recuperar"
                        value=" <?=trim($datos->kwh_recuperar) ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="RESPALDO-MANUAL ACTUAL: <?=trim($datos->respaldo_man) ?>" class="input input__text inputmodal" name="txtrespaldo_manual" list="respaldomanualList" autocomplete="off"
                        value=" <?=trim($datos->respaldo_man) ?>">
                        <datalist  id="respaldomanualList"></datalist>
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="RPE-AUXILIAR ACTUAL: <?= trim($datos->rpe_auxiliar) ?>" class="input input__text inputmodal" name="txtrpe_auxiliar" list="rpeauxiliarList" autocomplete="off"
                        value=" <?= trim($datos->rpe_auxiliar) ?>">
                        <datalist  id="rpeauxiliarList"></datalist>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="OBSERVACIÓN ACTUAL: <?= trim($datos->observaciones) ?>" class="input input__text inputmodal" name="txtobservaciones"
                        value=" <?= trim($datos->observaciones) ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="CORRECCIÓN ACTUAL: <?=trim($datos->correccion)?>" class="input input__text inputmodal" name="txtcorreccion"
                      value="<?=trim($datos->correccion)?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="AGENCIA ACTUAL: <?= trim($datos->agencia) ?>" class="input input__text inputmodal" name="txtagencia"
                        value=" <?= trim($datos->agencia) ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="RESPONSABLE-MANUAL ACTUAL: <?=trim( $datos->responsable_manual) ?> " class="input input__text inputmodal" name="txtresponsable_manual" list="responsablemanualList" autocomplete="off"
                        value=" <?=trim( $datos->responsable_manual) ?>">
                        <datalist  id="responsablemanualList"></datalist>
                    </div>

                    <!-- <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Fecha Captura" class="input input__text inputmodal" name="txtfecha_captura"
                        value=" <?= $datos->fecha_captura ?>">
                    </div> -->

          


                    <div class="text-right p-3">
                      <a href="manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>
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

        }else{ ?>

          <table class="table table-bordered table-hover w-100 " id="example">
          <thead>
            <tr>
              <th scope="col" >ACCION</th>
              <th scope="col">RPU</th>
              <th scope="col">CUENTA</th>
              <th scope="col">CICLO</th>
              <th scope="col">TARIFA</th>
              <th scope="col">MOTIVO MANUAL</th>
              <!-- <th scope="col">SIN USO</th> -->
              <th scope="col">LECTURA MANUAL</th>
              <th scope="col">KWH A RECUPERAR</th>
              <th scope="col">RESPALDO</th>
              <th scope="col">RPE_AUXILIAR</th>
              <th scope="col">OBSERVACIONES</th>
              <th scope="col">CORRECCION</th>
              <th scope="col">AGENCIA</th>
              <th scope="col">RESPONSABLE_MANUAL</th>
              <th scope="col">FECHA</th>
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
        <td>
              <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>">HISTÓRICO  <i class="fa-solid fa-file-shield"></i></a>
        </td>
        <td class="id" scope="row">
          <?= $datos->rpu ?>
        </td>
        <td>
          <?= $datos->cuenta ?>
        </td>
        <td>
          <?= $datos->ciclo ?>
        </td>
        <td>
          <?= $datos->tarifa ?>
        </td>
        <td>
          <?= $datos->id_motivomanual ?>
        </td>
        <!-- <td>
          <?= $datos->sin_uso ?>
        </td> -->
        <td>
          <?= $datos->lectura_manual ?>
        </td>
        <td>
          <?= $datos->kwh_recuperar?>
        </td>
        <td>
          <?= $datos->respaldo_man ?>
        </td>
        <td>
          <?= $datos->rpe_auxiliar ?>
        </td>
        <td>
          <?= $datos->observaciones ?>
        </td>
        <td>
          <?= $datos->correccion ?>
        </td>
        <td>
          <?= $datos->agencia ?>
        </td>
        <td>
          <?= $datos->responsable_manual ?>
        </td>
        <td>
          <?= $datos->fecha_captura ?>
        </td>
       

        <!-- <?php echo $mostrarBoton ? 'otro' : ''; ?>  -->

      </tr>
    <?php } ?>

     


  <?php }

  ?>

<?php }
          ?>

   

  <!-- <form style="margin-bottom: 4%;" action="" method="post">
    <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
      <input type="text" placeholder="Inserte RPU" class="input input__text" name="txtbuscarrpu">
    </div>
    <button type="submit" class="btn btn-primary btn-rounded mb-10 otro">
      <i class="fa-solid fa-search"></i> &nbsp; BUSCAR
    </button>
  </form> -->

 

  <!-- 
  <a href="registro_usuario.php" class="btn btn-primary btn-rounded mb-3"><i class="fa-solid fa-user-plus"></i> &nbsp;
    REGISTRAR</a> -->


















    <!-- CODIGO PARA APARECER Y OCULTAR EL BOTON GENERAR MANUAL -->

  <!-- <?php
  if ($_SESSION['rol'] != 1  && $mostrarTablas == true) {
    ?>
    <a href="registro_usuario.php" class="btn btn-warning btn-rounded mb-3" style="display: none;"><i
        class="fa-solid fa-file"></i> &nbsp; Generar Manual</a>
    <?php

    $mostrarBoton = false;

  } else if ($mostrarTablas == true) {
    ?>
      <div class="contenedor-btn-manual">
        <a href="registro_usuario.php" class="btn btn-warning btn-rounded otro btn_generarmanual"><i
            class="fa-solid fa-file"></i>
          &nbsp;
          Generar Manual</a>
      </div>

    <?php

  }
  ?> -->










 



  <!-- CONDICION PARA OCULTAR O MOSTRAR LA TABLA SEGUN LOS VALORES QUE INGRESE EL USUARIO -->

  <?php if ($mostrarTablas) { ?>

    




        <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->
        <?php
        if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ) {
          ?>

           <table class="table table-bordered table-hover w-100 " id="example">
                <thead>
                  <tr>
                    
                    <th scope="col"></th>
                    <th scope="col">RPU</th>
                    <th scope="col">CUENTA</th>
                    <th scope="col">CICLO</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MOTIVO MANUAL</th>
                    <!-- <th scope="col">SIN USO</th> -->
                    <th scope="col">LECTURA MANUAL</th>
                    <th scope="col">KWH A RECUPERAR</th>
                    <th scope="col">RESPALDO</th>
                    <th scope="col">RPE_AUXILIAR</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">CORRECCION</th>
                    <th scope="col">CUENTA2</th>
                    <th scope="col">RESPONSABLE_MANUAL</th>
                    <th scope="col">FECHA</th>
                    <th scope="col" >ACCION</th>
                    <th scope="col"></th>
                  </tr>
               </thead>

                <tbody>
          <?php
          while ($datos = $sql->fetch_object()) { ?>

            <tr>
              


              <td>
                <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>">HISTÓRICO  <i class="fa-solid fa-file-shield"></i></a>
              </td>
             
              <!-- <td class="id" scope="row"> -->
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
              <!-- <td id="celdaSinUso" onclick="copiarContenido('celdaSinUso')">
                <?= $datos->sin_uso ?>
              </td> -->
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
              <td id="celdaFechaCaptura" onclick="copiarContenido('celdaFechaCaptura')">
                <?= $datos->fecha_captura ?>
              </td>

              <td>
              <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_control_manuales ?> "
                class="btn btn-success ">Generar manual <i class="fa-regular fa-file"></i></a>
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
                  <h5 class="modal-title w-100" id="exampleModalLabel">CORREGIR MANUAL</h5>
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

                      <input type="text" placeholder="RPU" class="input input__text inputmodal_ineditable" name="txtrpu"
                        value=" <?= trim($datos->rpu) ?>" readonly> 
                    </div> 
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Cuenta" class="input input__text inputmodal" name="txtcuenta"
                        value=" <?= trim($datos->cuenta) ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Ciclo" class="input input__text inputmodal" name="txtciclo"
                        value=" <?= trim($datos->ciclo) ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Tarifa" class="input input__text inputmodal" name="txttarifa"
                        value=" <?= trim($datos->tarifa) ?>">
                    </div>

                     <!-- <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Motivo de la manual" class="input input__text inputmodal" name="txtidmotivomanual"
                        value=" <?= $datos->id_motivomanual ?>">
                    </div> -->


                    <div  class="fl-flex-label mb-4 px-2 col-12 campo">

                   
                        <input class="input input__text inputmodal" type="text" id="searchMotivoManual" placeholder="Buscar motivos manuales" list="motivosList" name="txtidmotivomanual" value=" <?= $datos->id_motivomanual ?>">
                        <datalist id="motivosList"></datalist>


                    
                        <!-- <select  name="txtidmotivomanual" class="input input__select inputmodal" >
                      
                                <option value="">  <?= $datos->id_motivomanual ?> </option>
                                <?php
                                $sql_mostrar_motivo_manuales = $conexion->query(" SELECT DISTINCT TRIM(id_motivomanual) AS id_motivomanual
                                FROM control_manuales ");
                                while ($datoss = $sql_mostrar_motivo_manuales->fetch_object()) { ?>
                                  <option value="<?= $datoss->id_motivomanual ?>"><?= $datoss->id_motivomanual ?></option>
                                <?php }
                                ?>
                        </select>-->
                    </div>

          


                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="sin_uso" class="input input__text inputmodal" name="txtsin_uso"
                        value=" <?= trim($datos->sin_uso) ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="lectura de manual" class="input input__text inputmodal" name="txtlectura_manual"
                        value=" <?= trim($datos->lectura_manual) ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="kwh a recuperar" class="input input__text inputmodal" name="txtkwh_recuperar"
                        value=" <?=trim( $datos->kwh_recuperar) ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Respaldo_manual" class="input input__text inputmodal" name="txtrespaldo_manual"
                        value=" <?=trim( $datos->respaldo_man) ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="RPE auxiliar" class="input input__text inputmodal" name="txtrpe_auxiliar"
                        value=" <?= trim($datos->rpe_auxiliar) ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Observaciones" class="input input__text inputmodal" name="txtobservaciones"
                        value=" <?= trim($datos->observaciones) ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Correccion" class="input input__text inputmodal" name="txtcorreccion"
                      value="<?=trim($datos->correccion)?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Agencia" class="input input__text inputmodal" name="txtagencia"
                        value=" <?= trim($datos->agencia) ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Responsable Manual" class="input input__text inputmodal" name="txtresponsable_manual"
                        value=" <?=trim( $datos->responsable_manual) ?>">
                    </div>

          


                    <div class="text-right p-3">
                      <!-- <a href="usuario.php" class="btn btn-secondary btn-rounded">Atras</a> -->
                      <a href="manuales.php" class="btn btn-danger btn-rounded">Cancelar</a>
                      <button type="submit" value="ok" name="btnmodificar"
                        class="btn btn-primary btn-rounded">Modificar</button>
                    </div>

                  </form>


                </div>
              
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
                    <th scope="col" >ACCION</th>
                    <th scope="col">RPU</th>
                    <th scope="col">CUENTA</th>
                    <th scope="col">CICLO</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MOTIVO MANUAL</th>
                    <!-- <th scope="col">SIN USO</th> -->
                    <th scope="col">LECTURA MANUAL</th>
                    <th scope="col">KWH A RECUPERAR</th>
                    <th scope="col">RESPALDO</th>
                    <th scope="col">RPE_AUXILIAR</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">CORRECCION</th>
                    <th scope="col">AGENCIA</th>
                    <th scope="col">RESPONSABLE_MANUAL</th>
                    <th scope="col">FECHA</th>
                  </tr>
               </thead>

                <tbody>

          <?php
          while ($datos = $sql->fetch_object()) { ?>

            <!--dentro imprimiremos los valores que contienen mis tablas 
    en la base de datos-->
            <tr>
            <td>
                <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>"><i class="fa-solid fa-eye"></i></a>
              </td>
              <td class="id" scope="row">
                <?= $datos->rpu ?>
              </td>
              <td>
                <?= $datos->cuenta ?>
              </td>
              <td>
                <?= $datos->ciclo ?>
              </td>
              <td>
                <?= $datos->tarifa ?>
              </td>
              <td>
                <?= $datos->id_motivomanual ?>
              </td>
              <!-- <td>
                <?= $datos->sin_uso ?>
              </td> -->
              <td>
                <?= $datos->lectura_manual ?>
              </td>
              <td>
                <?= $datos->kwh_recuperar?>
              </td>
              <td>
                <?= $datos->respaldo_man ?>
              </td>
              <td>
                <?= $datos->rpe_auxiliar ?>
              </td>
              <td>
                <?= $datos->observaciones ?>
              </td>
              <td>
                <?= $datos->correccion ?>
              </td>
              <td>
                <?= $datos->agencia ?>
              </td>
              <td>
                <?= $datos->responsable_manual ?>
              </td>
              <td>
                <?= $datos->fecha_captura ?>
              </td>
             

              <!-- <?php echo $mostrarBoton ? 'otro' : ''; ?>  -->

            </tr>
          <?php } ?>

           


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



    <!-- FUNCION PARA HACER BUSQUEDAS A TRAVES DE SOLICITUDES AJAX EN INPUTS DATALIST, SECCION DE MODALES-->

  <script>

  $(document).ready(function () {
    $.getJSON("funciones_ajax/busquedas_manuales.php", function (data) {
        // Manejar datos de id_motivomanual
        $.each(data.motivo, function (key, val) {
            console.log(val);
            $('#motivosList').append("<option value='" + val + "' />");
        });

        // Manejar datos de cuenta
        $.each(data.cuenta, function (key, val) {
            console.log(val);
            $('#cuentaList').append("<option value='" + val + "' />");
        });

         // Manejar datos de cuenta
         $.each(data.respaldo, function (key, val) {
            console.log(val);
            $('#respaldomanualList').append("<option value='" + val + "' />");
        });

        // Manejar datos de rpe auxiliar
        $.each(data.rpeauxiliar, function (key, val) {
            console.log(val);
            $('#rpeauxiliarList').append("<option value='" + val + "' />");
        });

        // Manejar datos de responsable de la manual
        $.each(data.responsablemanual, function (key, val) {
            console.log(val);
            $('#responsablemanualList').append("<option value='" + val + "' />");
        });


    });
});




  </script>




<!-- <script>
  document.addEventListener("DOMContentLoaded", function () {
    var searchInput = document.getElementById('searchMotivoManual');
    var selectMotivoManual = document.getElementById('selectMotivoManual');

    searchInput.addEventListener('input', function () {
      var searchTerm = searchInput.value.toLowerCase();

      // Realizar una solicitud AJAX para obtener los resultados de búsqueda
      // Reemplaza la URL con la ruta correcta a tu archivo de búsqueda
      // Puedes usar jQuery o la API Fetch para hacer la solicitud AJAX
      // Ejemplo con Fetch:
      fetch('funciones_ajax/busqueda_motivo_manual.php?searchTerm=' + searchTerm)
        .then(response => response.json())
        .then(data => {
          // Limpiar las opciones actuales del select
          selectMotivoManual.innerHTML = '<option value="">Seleccione un motivo manual</option>';

          // Agregar las nuevas opciones al select
          data.forEach(function (item) {
            var option = document.createElement('option');
            option.value = item.id_motivomanual;
            option.text = item.id_motivomanual;
            selectMotivoManual.add(option);
          });
        })
        .catch(error => console.error('Error en la solicitud AJAX:', error));
    });
  });
</script> -->

<!-- document.addEventListener("DOMContentLoaded", function () {
    var searchInput = document.getElementById('searchMotivoManual');
    var selectMotivoManual = document.getElementById('selectMotivoManual');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();

        fetch('funciones_ajax/busqueda_motivo_manual.php?searchTerm=' + searchTerm)
            .then(response => response.json())
            .then(data => {
                selectMotivoManual.innerHTML = '<option value="">Seleccione un motivo manual</option>';

                data.forEach(item => {
                    selectMotivoManual.options.add(new Option(item.id_motivomanual, item.id_motivomanual));
                });
            })
            .catch(error => console.error('Error en la solicitud AJAX:', error));
    });
});
 -->










<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>




