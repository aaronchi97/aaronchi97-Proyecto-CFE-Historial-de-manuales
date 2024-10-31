<?php

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

    <h4 style="margin-bottom: 5%;" class="text-center text-secondery">HISTORIAL DE MANUALES</h4>

    <?php
    //hacemos la conexion
    include "../modelo/conexion.php";
    //llamamos al controlador para eliminar registros
    //   include "../controlador/controlador_modificar_manual.php";
    // include "../controlador/controlador_eliminar_usuario.php";



    $rpu_historial_manual_buscar = $_GET['id_rpu_historial'];


    $sql = $conexion->query(" SELECT historial_manuales.*, motivo_historial.*, estatus.*
    FROM historial_manuales
    JOIN motivo_historial ON historial_manuales.id_motivohistorial = motivo_historial.id_motivohistorial
    JOIN estatus ON historial_manuales.id_estatus = estatus.id_estatus

    WHERE historial_manuales.rpu = $rpu_historial_manual_buscar

    ORDER BY historial_manuales.fecha_historial DESC;");






    ?>



    <a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-solid fa-caret-left"></i>
        ATRAS</a>



    <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->
    <?php
    if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
    ?>


        <table data-url="consulta_datos.php" data-tipo="manuales" class="table table-bordered table-hover w-100 " id="example">
            <thead>
                <tr>

                    <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->

                    <?php
                    include "tablas/cabecera_historial_manuales_admin.php";
                    ?>

                </tr>
            </thead>

            <tbody>


                <?php
                while ($datos = $sql->fetch_object()) { ?>

                    <tr>


                        <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->
                        <?php
                        include "tablas/filas_historial_manuales_admin.php";
                        ?>
                    </tr>



                <?php

                    // <!-- MODAL PARA HACER COMPARACIONES DE HISTORICOS DE MANUALES, SE COMPARA CUALQUIER HISTORICO CON LA MANUAL ACTUAL ---->

                    include "modales/modal_comparacion_historicos_manuales.php";
                }

                ?>
            <?php

        } else {
            ?>


                <table data-url="consulta_datos.php" data-tipo="manuales" class="table table-bordered table-hover w-100 " id="example">
                    <thead>
                        <tr>


                            <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA PROFESIONISTAS Y CONSULTAS-->

                            <?php
                            include "tablas/cabecera_historial_manuales_consultor.php";
                            ?>

                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        while ($datos = $sql->fetch_object()) { ?>


                            <tr>

                                <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->
                                <?php
                                include "tablas/filas_historial_manuales_consultor.php";
                                ?>

                            </tr>
                        <?php
                            // <!-- MODAL PARA HACER COMPARACIONES DE HISTORICOS DE MANUALES, SE COMPARA CUALQUIER HISTORICO CON LA MANUAL ACTUAL ---->

                            include "modales/modal_comparacion_historicos_manuales.php";
                        } ?>




                    <?php }

                    ?>








                    </tbody>
                </table>


                <!-- //BOTON PARA QUITAR O OTORGAR EL ESTADO RESPONSIVE DE LA TABLA -->

                <button class="btn" id="toggleResponsive"><i class="fa-solid fa-up-right-and-down-left-from-center"></i></button>

</div>
</div>
<!-- fin del contenido principal -->



<!-- SCRIPT PARA COPIAR CELADAS DE LA TABLA -->
<script>
    function copiarContenido(elemento) {
        // Obtener el contenido de la celda
        const contenido = elemento.innerText;

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