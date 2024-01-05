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

  <h4 class="text-center text-secondery"> REGISTRO ASIGNACIONES DE HORARIO A DOCENTES</h4>

  <!--llamamos al controlador para enviar los datos a la base de datos y 
  en el form tenemos que especificar el metodo POST-->
  <?php
  include "../modelo/conexion.php";
  include "../controlador/controlador_registrar_asignacion_docente.php";
  ?>

  <section class="row">
    <!--Aqui especificamos el metodo-->
    <form action="" method="post">
    <div hidden class="fl-flex-label mb-4 px-2 col-12  campo">
          
          <input type="text" placeholder="Asignacion" class="input input__text inputmodal" name="txtid_asign">
        </div>
        
      <div class="fl-flex-label mb-4 px-2 col-12  campo">

        <select name="txtnombre" class="input input__select inputmodal">
          <option value=""> Seleccione docente </option>
          <?php
          $sql = $conexion->query(" SELECT * FROM docentes");
          while ($datos = $sql->fetch_object()) { ?>
            <option value="<?= $datos->id_docente ?>"><?= $datos->nombre ?></option>
          <?php }
          ?>
        </select>
          </div>
        <div class="fl-flex-label mb-4 px-2 col-12 campo">
          
        <select name="txtaula" class="input input__select inputmodal">
          <option value=""> Seleccione salon </option>
          <?php
          $sql = $conexion->query(" SELECT * FROM aulas");
          while ($datos = $sql->fetch_object()) { ?>
            <option value="<?= $datos->id_aula ?>"><?= $datos->nombre_aula ?></option>
          <?php }
          ?>
        </select>
        </div>

        <div class="fl-flex-label mb-4 px-2 col-12 campo">
          
        <select name="txtdia" class="input input__select inputmodal">
          <option value=""> Seleccione dia </option>
          <?php
          $sql = $conexion->query(" SELECT * FROM dias");
          while ($datos = $sql->fetch_object()) { ?>
            <option value="<?= $datos->id_dia ?>"><?= $datos->nombre_dias ?></option>
          <?php }
          ?>
        </select>
        </div>

        <div class="fl-flex-label mb-4 px-2 col-12 campo">
        
        <select name="txthora" class="input input__select inputmodal">
          <option value=""> Seleccione horario </option>
          <?php
          $sql = $conexion->query(" SELECT * FROM horario");
          while ($datos = $sql->fetch_object()) { ?>
            <option value="<?= $datos->id_horario ?>"><?= $datos->hora ?></option>
          <?php }
          ?>
        </select>
        </div>




        <div class="text-right p-3">
          <a href="asignacion_docentes.php" class="btn btn-secondary btn-rounded">Atras</a>
          <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
        </div>

    </form>
  </section>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>