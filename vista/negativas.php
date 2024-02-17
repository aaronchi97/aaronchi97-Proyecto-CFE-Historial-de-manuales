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
  ul li:nth-child(2) .activo {
    background: #195a78 !important;
  }
</style>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<link rel="stylesheet" href="estiloinicio.css">
<div class="page-content">

  <h4 style="margin-bottom: 5%;" class="text-center text-secondery"> NEGATIVAS</h4>

  <?php
  //hacemos la conexion
  include "../modelo/conexion.php";


  
  $mostrarTablas = false;
  if (isset($_POST['txtbuscarrpuN'])) { ?>


<!-- AQUI AGREGAMOS EL FOMR PARA BUSCAR RPU INDIVIDUAL, PERO LA PRIMERA VISTA SERA LA QUE ESTA EN EL ELSE, QUE MUESTRA 
LOS RPU QUE SE HAN REGISTRADO EN EL MES ACTUAL  -->

    <form style="margin-bottom: 4%;" action="" method="post" id="searchForm">
   
    <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
    <input type="text"  class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpuN">
    </div>
    <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
    </form>


  <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>




  <?php
    $rpu_buscar = $_POST['txtbuscarrpuN'];
    // $rpu_vuelta = $_GET['id_manuales_vuelta'];
    // Modificar la consulta para incluir la cláusula WHERE


    // $sql = $conexion->query("SELECT * FROM control_negativas WHERE rpu = $rpu_buscar  ");
    $sql = $conexion->query("SELECT control_negativas.*, justificacion_negativas.justificacion_neg
    FROM control_negativas
    LEFT JOIN justificacion_negativas ON control_negativas.id_justificacionnegativas = justificacion_negativas.id_justificacionnegativas
    WHERE control_negativas.rpu = '$rpu_buscar'
     ");

    // Activar la visualización de las tablas
    $mostrarTablas = true;
  }else{
    $mes_actual_negativa = date('m');

    // Realizar la consulta SQL
    // $sql_mes = $conexion->query("SELECT * FROM control_negativas WHERE MONTH(fecha_captura) = $mes_actual"); 
   $sql_mes_negativa = $conexion->query("SELECT control_negativas.*, justificacion_negativas.justificacion_neg
    FROM control_negativas
    LEFT JOIN justificacion_negativas ON control_negativas.id_justificacionnegativas = justificacion_negativas.id_justificacionnegativas
    WHERE MONTH(control_negativas.fecha_captura) = $mes_actual_negativa
    ");  


    
  
       
        if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ) {
          ?>

<form style="margin-bottom: 4%;" action="" method="post" id="searchForm">
   
   <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
   <input type="text"  class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpuN">
   </div>
   <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
 </form>


 <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>


 
           <table class="table table-bordered table-hover w-100 " id="example">
                <thead>
                  <tr>

                    <th scope="col" >ACCION</th>
                    <th scope="col"></th>
                    <th scope="col">RPU</th>
                    <th scope="col">CUENTA</th>
                    <th scope="col">CICLO</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MEDIDOR</th>
                    <!-- <th scope="col">SIN USO</th> -->
                    <th scope="col">AA_MM</th>
                    <th scope="col">TIPO MEDIDOR</th>
                    <th scope="col">CVE</th>
                    <th scope="col">DICE</th>
                    <th scope="col">DEBE DECIR</th>
                    <th scope="col">KWH_A_RECUPERAR</th>
                    <th scope="col">JUSTIFICACION_NEGATIVA</th>
                    <th scope="col">SIN_NOMBRE</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">RESPONSABLE</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">ELIMINAR</th>

                  </tr>
               </thead>

                <tbody>
          <?php
          while ($datos = $sql_mes_negativa->fetch_object()) { ?>

            <tr>
              
              <td>
                  <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_control_negativas ?> "
                  class="btn btn-success ">Generar negativa <i class="fa-regular fa-file"></i></a>
              </td>
              <td>
                <a class="btn btn-warning" href="historial_negativas.php?id_negativas=<?= $datos->id_control_negativas ?>">Historico <i class="fa-solid fa-eye"></i></a>
              </td>
              <td id="rpuN" onclick="copiarContenido('rpuN')">
                <?= $datos->rpu ?>
              </td>
              <td id="cuentaN" onclick="copiarContenido('cuentaN')">
                <?= $datos->cuenta ?>
              </td>
              <td id="cicloN" onclick="copiarContenido('cicloN')"> 
                <?= $datos->ciclo ?>
              </td>
              <td id="celdaTarifaN" onclick="copiarContenido('celdaTarifaN')">
                <?= $datos->tarifa ?>
              </td>
              <td id="celdaMedidorN" onclick="copiarContenido('celdaMedidorN')">
                <?= $datos->medidor ?>
              </td>
              <td id="celdaAAMMN" onclick="copiarContenido('celdaAAMMN')">
                <?= $datos->aa_mm ?>
              </td>
              <td  id="celdaTipomedidorN" onclick="copiarContenido('celdaTipomedidorN')">
                <?= $datos->tipo_medidor?>
              </td>
              <td id="celdaCVEN" onclick="copiarContenido('celdaCVEN')">
                <?= $datos->cve?>
              </td>
              <td id="celdaDiceN" onclick="copiarContenido('celdaDiceN')">
                <?= $datos->dice?>
              </td>
              <td id="celdaDebe_decirN" onclick="copiarContenido('celdaDebe_decirN')">
                <?= $datos->debe_decir ?>
              </td>
              <td id="celdaKWHRecuperarN" onclick="copiarContenido('celdaKWHRecuperar')">
                <?= $datos->kwh_recuperar ?>
              </td>
              <td id="celdaJustificacionNegN" onclick="copiarContenido('celdaJustificacionNegN')">
                <?= $datos->justificacion_neg ?>
              </td>
              <td id="celdaSinNombreN" onclick="copiarContenido('celdaSinNombreN')">
                <?= $datos->sin_nombre ?>
              </td>
              <td id="celdaObservacionesN" onclick="copiarContenido('celdaobservacionesN')">
                <?= $datos->observaciones ?>
              </td>
              <td id="celdaResponsableN" onclick="copiarContenido('celdaResponsableN')">
                <?= $datos->responsable_negativa ?>
              </td>
              <td id="celdaFechaCaputuraN" onclick="copiarContenido('celdaFechaCaputuraN')">
                <?= $datos->fecha_captura ?>
              </td>
              <td>
                <a class="btn btn-danger" href="negativas.php?id_negativa_eliminar=<?= $datos->id_control_negativas ?>" onclick=" advertencia(event)"><i
                    class="fa-solid fa-trash-can"></i></a>
              </td>

            </tr>

            


          <!-- Modal -->
          <div class="modal fade" id="exampleModal<?= $datos->id_control_negativas  ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                  <h5 class="modal-title w-100" id="exampleModalLabel">GENERAR NEGATIVA</h5>
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

                      <input type="text" placeholder="Medidor" class="input input__text inputmodal" name="txtmedidor"
                        value=" <?= $datos->medidor ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="aa_mm" class="input input__text inputmodal" name="txtaa_mm"
                        value=" <?= $datos->aa_mm ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Tipo medidor" class="input input__text inputmodal" name="txttipo_medidor"
                        value=" <?= $datos->tipo_medidor ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="CVE" class="input input__text inputmodal" name="txtcve"
                        value=" <?= $datos->cve?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Dice" class="input input__text inputmodal" name="txtdice"
                        value=" <?= $datos->dice ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Debe decir" class="input input__text inputmodal" name="txtdebe_decir"
                        value=" <?= $datos->debe_decir ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="KWH a recuperar" class="input input__text inputmodal" name="txtkwh_recuperar"
                        value=" <?= $datos->kwh_recuperar ?>">
                    </div>




                    <!-- <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Justifiacion de negativa" class="input input__text inputmodal" name="txtid_justificacionnegativa"
                        value=" <?= $datos->id_justificacionnegativas ?>">
                    </div> -->

                     <div class="fl-flex-label mb-4 px-2 col-12 col-md-6  campo">

                        <select name="txtid_justificacionnegativa" class="input input__select inputmodal">
                          <option value=""><?= $datos->justificacion_neg ?></option>
                          <?php
                            $sql_mostrar_justificacion = $conexion->query(" SELECT * FROM justificacion_negativas");
                            while ($datos4 = $sql_mostrar_rol->fetch_object()) { ?>
                            <option value="<?= $datos4->id_justificacionnegativas ?>"><?= $datos4->justificacion_neg ?></option>
                          <?php }
                            ?>
                        </select>
      
                      </div>




                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Sin nombre" class="input input__text inputmodal" name="txtsin_nombre"
                        value=" <?= $datos->sin_nombre ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Observaciones" class="input input__text inputmodal" name="txtobservaciones"
                        value=" <?= $datos->observaciones ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Responsable de negativa" class="input input__text inputmodal" name="txtresponsable_negativa"
                        value=" <?= $datos->responsable_negativa ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Fecha de captura" class="input input__text inputmodal" name="txtfecha_captura"
                        value=" <?= $datos->fecha_captura ?>">
                    </div>

                   



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

        }else{ ?>

          <table class="table table-bordered table-hover w-100 " id="example">
          <thead>
            <tr>
                   
                    <th scope="col"></th>
                    <th scope="col">RPU</th>
                    <th scope="col">CUENTA</th>
                    <th scope="col">CICLO</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MEDIDOR</th>
                    <!-- <th scope="col">SIN USO</th> -->
                    <th scope="col">AA_MM</th>
                    <th scope="col">TIPO MEDIDOR</th>
                    <th scope="col">CVE</th>
                    <th scope="col">DICE</th>
                    <th scope="col">DEBE DECIR</th>
                    <th scope="col">KWH_A_RECUPERAR</th>
                    <th scope="col">JUSTIFICACION_NEGATIVA</th>
                    <th scope="col">SIN_NOMBRE</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">RESPONSABLE</th>
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
                <a class="btn btn-warning" href="historial_negativas.php?id_negativa=<?= $datos->id_control_negativas ?>">Historico <i class="fa-solid fa-eye"></i></a>
              </td>
              
              <!-- <td class="id" scope="row"> -->
              <td id="rpuN" onclick="copiarContenido('rpuN')">
                <?= $datos->rpu ?>
              </td>
              <td id="cuentaN" onclick="copiarContenido('cuentaN')">
                <?= $datos->cuenta ?>
              </td>
              <td id="cicloN" onclick="copiarContenido('cicloN')"> 
                <?= $datos->ciclo ?>
              </td>
              <td id="celdaTarifaN" onclick="copiarContenido('celdaTarifaN')">
                <?= $datos->tarifa ?>
              </td>
              <td id="celdaMedidorN" onclick="copiarContenido('celdaMedidorN')">
                <?= $datos->medidor ?>
              </td>
    
              <td id="celdaAAMMN" onclick="copiarContenido('celdaAAMMN')">
                <?= $datos->aa_mm ?>
              </td>
              <td  id="celdaTipomedidorN" onclick="copiarContenido('celdaTipomedidorN')">
                <?= $datos->tipo_medidor?>
              </td>
              <td id="celdaCVEN" onclick="copiarContenido('celdaCVEN')">
                <?= $datos->cve?>
              </td>
              <td id="celdaDiceN" onclick="copiarContenido('celdaDiceN')">
                <?= $datos->dice?>
              </td>
              <td id="celdaDebe_decirN" onclick="copiarContenido('celdaDebe_decirN')">
                <?= $datos->debe_decir ?>
              </td>
              <td id="celdaKWHRecuperarN" onclick="copiarContenido('celdaKWHRecuperarN')">
                <?= $datos->kwh_recuperar ?>
              </td>
              <td id="celdaJustificacionNegN" onclick="copiarContenido('celdaJustificacionNegN')">
                <?= $datos->justificacion_neg ?>
              </td>
              <td id="celdaSinNombreN" onclick="copiarContenido('celdaSinNombreN')">
                <?= $datos->sin_nombre ?>
              </td>
              <td id="celdaObservacionesN" onclick="copiarContenido('celdaobservacionesN')">
                <?= $datos->observaciones ?>
              </td>
              <td id="celdaResponsableN" onclick="copiarContenido('celdaResponsableN')">
                <?= $datos->responsable_negativa ?>
              </td>
              <td id="celdaFechaCaputuraN" onclick="copiarContenido('celdaFechaCaputuraN')">
                <?= $datos->fecha_captura ?>
              </td>
          

        <!-- <?php echo $mostrarBoton ? 'otro' : ''; ?>  -->

      </tr>
    <?php } ?>

     


  <?php }

  ?>

<?php }
          ?>











 



  <!-- CONDICION PARA OCULTAR O MOSTRAR LA TABLA SEGUN LOS VALORES QUE INGRESE EL USUARIO -->

  <?php if ($mostrarTablas) { ?>

    




        <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->
        <?php
        if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ) {
          ?>

           <table class="table table-bordered table-hover w-100 " id="example">
                <thead>
                  <tr>
                  <th scope="col" >ACCION</th>
                    <th scope="col"></th>
                    <th scope="col">RPU</th>
                    <th scope="col">CUENTA</th>
                    <th scope="col">CICLO</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MEDIDOR</th>
                    <!-- <th scope="col">SIN USO</th> -->
                    <th scope="col">AA_MM</th>
                    <th scope="col">TIPO MEDIDOR</th>
                    <th scope="col">CVE</th>
                    <th scope="col">DICE</th>
                    <th scope="col">DEBE DECIR</th>
                    <th scope="col">KWH_A_RECUPERAR</th>
                    <th scope="col">JUSTIFICACION_NEGATIVA</th>
                    <th scope="col">SIN_NOMBRE</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">RESPONSABLE</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">ELIMINAR</th>
                  </tr>
               </thead>

                <tbody>
          <?php
          while ($datos = $sql->fetch_object()) { ?>

            <tr>
              
            <td>
              <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_control_negativas ?> "
                class="btn btn-success ">Generar negativa <i class="fa-regular fa-file"></i></a>
              </td>
              <td>
                <a class="btn btn-warning" href="historial_negativas.php?id_negativas=<?= $datos->id_control_negativas ?>">Historico <i class="fa-solid fa-eye"></i></a>
              </td>
              
              <!-- <td class="id" scope="row"> -->
              <td id="rpuN" onclick="copiarContenido('rpuN')">
                <?= $datos->rpu ?>
              </td>
              <td id="cuentaN" onclick="copiarContenido('cuentaN')">
                <?= $datos->cuenta ?>
              </td>
              <td id="cicloN" onclick="copiarContenido('cicloN')"> 
                <?= $datos->ciclo ?>
              </td>
              <td id="celdaTarifaN" onclick="copiarContenido('celdaTarifaN')">
                <?= $datos->tarifa ?>
              </td>
              <td id="celdaMedidorN" onclick="copiarContenido('celdaMedidorN')">
                <?= $datos->medidor ?>
              </td>
              <!-- <td id="celdaSinUso" onclick="copiarContenido('celdaSinUso')">
                <?= $datos->aa_mm ?>
              </td> -->
              <td id="celdaAAMMN" onclick="copiarContenido('celdaAAMMN')">
                <?= $datos->aa_mm ?>
              </td>
              <td  id="celdaTipomedidorN" onclick="copiarContenido('celdaTipomedidorN')">
                <?= $datos->tipo_medidor?>
              </td>
              <td id="celdaCVEN" onclick="copiarContenido('celdaCVEN')">
                <?= $datos->cve?>
              </td>
              <td id="celdaDiceN" onclick="copiarContenido('celdaDiceN')">
                <?= $datos->dice?>
              </td>
              <td id="celdaDebe_decirN" onclick="copiarContenido('celdaDebe_decirN')">
                <?= $datos->debe_decir ?>
              </td>
              <td id="celdaKWHRecuperarN" onclick="copiarContenido('celdaKWHRecuperarN')">
                <?= $datos->kwh_recuperar ?>
              </td>
              <td id="celdaJustificacionNegN" onclick="copiarContenido('celdaJustificacionNegN')">
                <?= $datos->justificacion_neg ?>
              </td>
              <td id="celdaSinNombreN" onclick="copiarContenido('celdaSinNombreN')">
                <?= $datos->sin_nombre ?>
              </td>
              <td id="celdaObservacionesN" onclick="copiarContenido('celdaobservacionesN')">
                <?= $datos->observaciones ?>
              </td>
              <td id="celdaObservacionesN" onclick="copiarContenido('celdaobservacionesN')">
                <?= $datos->responsable_negativa ?>
              </td>
              <td id="celdaFechaCaputuraN" onclick="copiarContenido('celdaFechaCaputuraN')">
                <?= $datos->fecha_captura ?>
              </td>
              <td>
                <a class="btn btn-danger" href="negativas.php?id_negativa_eliminar=<?= $datos->id_control_negativas ?>" onclick=" advertencia(event)"><i
                    class="fa-solid fa-trash-can"></i></a>
              </td>
            </tr>

            


          <!-- Modal -->
          <div class="modal fade" id="exampleModal<?= $datos->id_control_negativas  ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                  <h5 class="modal-title w-100" id="exampleModalLabel">GENERAR NEGATIVA</h5>
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

                      <input type="text" placeholder="Medidor" class="input input__text inputmodal" name="txtmedidor"
                        value=" <?= $datos->medidor ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="aa_mm" class="input input__text inputmodal" name="txtaa_mm"
                        value=" <?= $datos->aa_mm ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Tipo medidor" class="input input__text inputmodal" name="txttipo_medidor"
                        value=" <?= $datos->tipo_medidor ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="CVE" class="input input__text inputmodal" name="txtcve"
                        value=" <?= $datos->cve?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Dice" class="input input__text inputmodal" name="txtdice"
                        value=" <?= $datos->dice ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Debe decir" class="input input__text inputmodal" name="txtdebe_decir"
                        value=" <?= $datos->debe_decir ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="KWH a recuperar" class="input input__text inputmodal" name="txtkwh_recuperar"
                        value=" <?= $datos->kwh_recuperar ?>">
                    </div>


                    <!-- <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Justifiacion de negativa" class="input input__text inputmodal" name="txtid_justificacionnegativa"
                        value=" <?= $datos->id_justificacionnegativas ?>">
                    </div> -->

                     <div class="fl-flex-label mb-4 px-2 col-12 col-md-6  campo">

                        <select name="txtid_justificacionnegativa" class="input input__select inputmodal">
                          <option value=""><?= $datos->justificacion_neg ?></option>
                          <?php
                            $sql_mostrar_justificacion = $conexion->query(" SELECT * FROM justificacion_negativas");
                            while ($datos4 = $sql_mostrar_rol->fetch_object()) { ?>
                            <option value="<?= $datos4->id_justificacionnegativas ?>"><?= $datos4->justificacion_neg ?></option>
                          <?php }
                            ?>
                        </select>
      
                      </div>




                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Sin nombre" class="input input__text inputmodal" name="txtsin_nombre"
                        value=" <?= $datos->sin_nombre ?>">
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Observaciones" class="input input__text inputmodal" name="txtobservaciones"
                        value=" <?= $datos->observaciones ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Responsable de negativa" class="input input__text inputmodal" name="txtresponsable_negativa"
                        value=" <?= $datos->responsable_negativa ?>">
                    </div>

                     <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="Fecha de captura" class="input input__text inputmodal" name="txtfecha_captura"
                        value=" <?= $datos->fecha_captura ?>">
                    </div>

                   



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
                  <th scope="col"></th>
                    <th scope="col">RPU</th>
                    <th scope="col">CUENTA</th>
                    <th scope="col">CICLO</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MEDIDOR</th>
                    <!-- <th scope="col">SIN USO</th> -->
                    <th scope="col">AA_MM</th>
                    <th scope="col">TIPO MEDIDOR</th>
                    <th scope="col">CVE</th>
                    <th scope="col">DICE</th>
                    <th scope="col">DEBE DECIR</th>
                    <th scope="col">KWH_A_RECUPERAR</th>
                    <th scope="col">JUSTIFICACION_NEGATIVA</th>
                    <th scope="col">SIN_NOMBRE</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">RESPONSABLE</th>
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
                <a class="btn btn-warning" href="historial_negativas.php?id_negativa=<?= $datos->id_control_negativas ?>">Historico <i class="fa-solid fa-eye"></i></a>
              </td>
   
              <td id="rpuN" onclick="copiarContenido('rpuN')">
                <?= $datos->rpu ?>
              </td>
              <td id="cuentaN" onclick="copiarContenido('cuentaN')">
                <?= $datos->cuenta ?>
              </td>
              <td id="cicloN" onclick="copiarContenido('cicloN')"> 
                <?= $datos->ciclo ?>
              </td>
              <td id="celdaTarifaN" onclick="copiarContenido('celdaTarifaN')">
                <?= $datos->tarifa ?>
              </td>
              <td id="celdaMedidorN" onclick="copiarContenido('celdaMedidorN')">
                <?= $datos->medidor ?>
              </td>
    
              <td id="celdaAAMMN" onclick="copiarContenido('celdaAAMMN')">
                <?= $datos->aa_mm ?>
              </td>
              <td  id="celdaTipomedidorN" onclick="copiarContenido('celdaTipomedidorN')">
                <?= $datos->tipo_medidor?>
              </td>
              <td id="celdaCVEN" onclick="copiarContenido('celdaCVEN')">
                <?= $datos->cve?>
              </td>
              <td id="celdaDiceN" onclick="copiarContenido('celdaDiceN')">
                <?= $datos->dice?>
              </td>
              <td id="celdaDebe_decirN" onclick="copiarContenido('celdaDebe_decirN')">
                <?= $datos->debe_decir ?>
              </td>
              <td id="celdaKWHRecuperarN" onclick="copiarContenido('celdaKWHRecuperarN')">
                <?= $datos->kwh_recuperar ?>
              </td>
              <td id="celdaJustificacionNegN" onclick="copiarContenido('celdaJustificacionNegN')">
                <?= $datos->justificacion_neg ?>
              </td>
              <td id="celdaSinNombreN" onclick="copiarContenido('celdaSinNombreN')">
                <?= $datos->sin_nombre ?>
              </td>
              <td id="celdaObservacionesN" onclick="copiarContenido('celdaobservacionesN')">
                <?= $datos->observaciones ?>
              </td>
              <td id="celdaResponsableN" onclick="copiarContenido('celdaResponsableN')">
                <?= $datos->responsable_negativa ?>
              </td>
              <td id="celdaFechaCaputuraN" onclick="copiarContenido('celdaFechaCaputuraN')">
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




<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>