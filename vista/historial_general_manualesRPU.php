<?php
ob_start();
session_start();



if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header("location:login/login.php");
}

?>

<style>
    ul li:nth-child(1) .activo {
        background: #598b6b !important;
    }
</style>



<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<link rel="stylesheet" href="estiloinicio.css">
<div class="page-content">

    <h4 style="margin-bottom: 5%;" class="text-center text-secondery"><span style="color: orange; text-transform: uppercase;">HISTORIAL
        </span> MANUALES</h4>

    <?php
    //hacemos la conexion
    include "../modelo/conexion.php";




    ?>










    <form style="margin-bottom: 4%;" action="" method="post">

        <div class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
            <input type="number" class="input input__text" placeholder="<?= $_SESSION["nombre"] ?>, Ingresa el RPU" id="searchInputRPUhistorial" name="txthistorial_rpu" require>
        </div>

        <!-- Botón "Continuar" para enviar el formulario -->
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>



    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['txthistorial_rpu'])) {
        $rpu_historial_manual = $_POST['txthistorial_rpu'];

        // Consultar si el RPU existe en la base de datos
        $sql_contador_historial_rpu = $conexion->query("SELECT count(*) AS 'Total' FROM historial_manuales WHERE rpu='$rpu_historial_manual '");

        if ($sql_contador_historial_rpu->fetch_object()->Total > 0) {
            // Redirigir al archivo con el RPU como parámetro si existe
            header("Location: historial_general_manuales.php?id_rpu_historial=$rpu_historial_manual ");
            exit;
        } else {
            // Mostrar mensaje de error si el RPU no existe
            echo "<div style='font-size: 14px; padding-top: 4%;' class='error-message'>RPU: <span style='color: red; font-weight: bold;'>$rpu_historial_manual </span> INEXISTENTE.</div>";
        }
    }
    ?>









</div>
<!-- fin del contenido principal -->
<script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
</script>


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php');

ob_end_flush(); ?>