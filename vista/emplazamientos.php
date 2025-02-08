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

    <h4 style="margin-bottom: 5%;" class="text-center text-secondery"> EMPLAZAMIENTOS</h4>

    <?php
    //hacemos la conexion
    include "../modelo/conexion.php";
    //llamamos al controlador para eliminar registros
    //   include "../controlador/controlador_modificar_manual.php";
    //   include "../controlador/controlador_asignar_estatus.php";
    //   include "../controlador/controlador_eliminar_manual.php";
    include "../controlador/control-estadisticos/controlador_buscar_fecha_manual.php";
    ?>


    <section class="botones-manual">

        <!-- <?php

                if ($_SESSION["rol"] == '1' || $_SESSION["rol"] == '2') { ?>

      <a href="registro_manuales.php" class="btn-generar-manual"> <i class="fa-solid fa-plus"></i> GENERAR NUEVA MANUAL</a>

    <?php } else { ?>

      <a hidden href="registro_manuales.php" class="btn-generar-manual"><i class="fa-solid fa-plus"></i> GENERAR NUEVA MANUAL</a>

    <?php }  ?> -->






        <!-- ------------------------------------------------BOTONES PARA MODALES POR BUSQUEDAS DE FILTROS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->



        <a data-toggle="modal" data-target="#atendidasModal" class="btn-manual-validas">PRIMER REPORTE <i class="fa-solid fa-hand-fist"></i></a>

        <a data-toggle="modal" data-target="#desatendidasModal" class="btn-manual-pendiente">SEGUNDO REPORTE <i class="fa-solid fa-flag"></i></a>

        <a data-toggle="modal" data-target="#fechaModal" class="btn-manual-pendiente">POR CANCELAR <i class="fa-solid fa-skull-crossbones"></i></a>

        <a data-toggle="modal" data-target="#emplazamientosValidadosModal" class="btn-manual-pendiente">VALIDADAS <i class="fa-solid fa-check"></i></a>


    </section>


    <!-- ------------------------------------------------AREA DE MODALES POR BUSQUEDAS DE FILTROS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


    <?php
    include "modales/modal_filtros_busqueda_manuales.php";
    ?>




    <!-- ------------------------------------------------AREA DE VISTAS POR TABLAS Y MES ACTUAL---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


    <?php

    $mostrarTablas = false;
    if (isset($_POST['txtbuscarrpu'])) { ?>


        <!-- AQUI AGREGAMOS EL FOMR PARA BUSCAR RPU INDIVIDUAL, PERO LA PRIMERA VISTA SERA LA QUE ESTA EN EL ELSE, QUE MUESTRA 
LOS RPU QUE SE HAN REGISTRADO EN EL MES ACTUAL  -->

        <form style="margin-bottom: 4%;" action="" method="post" id="searchForm">

            <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
                <input type="text" class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpu">
            </div>
            <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
        </form>


        <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>



        <?php
        $rpu_buscar = $_POST['txtbuscarrpu'];
        // $rpu_vuelta = $_GET['id_manuales_vuelta'];
        // Modificar la consulta para incluir la cláusula WHERE
        $sql = $conexion->query("SELECT * FROM emplazamientos WHERE emplazamientos.rpu_emplazamiento = '$rpu_buscar'  ");

        // Activar la visualización de las tablas
        $mostrarTablas = true;
    } else {
        date_default_timezone_set('America/Mexico_City');
        $mes_actual = date('m');

        // // Realizar la consulta SQL
        // $sql_mes = $conexion->query("SELECT * FROM emplazamientos WHERE MONTH(fecha_emplazamiento) = $mes_actual ORDER BY fecha_emplazamiento DESC");

        // CONEXION SIN RANGO DE MES
        $sql_mes = $conexion->query("SELECT * FROM emplazamientos ORDER BY fecha_emplazamiento DESC");








        //INCLUDE PARA AGREGAR LA VISTA DE TABLAS POR CONSULTA DE MES ACTUAL DEL SISTEMA 




        if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
        ?>

            <form style="margin-bottom: 5%;" action="" method="post" id="searchForm">

                <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
                    <input type="text" class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpu">
                </div>
                <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
            </form>


            <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>






            <table class="table table-bordered table-hover w-100 " id="example">
                <thead>
                    <tr>


                        <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->

                        <?php
                        include "tablas/emplazamientos_admin/tabla_cabecera_emplazamientos_admin.php";

                        ?>


                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($datos = $sql_mes->fetch_object()) { ?>

                        <tr>

                            <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->
                            <?php
                            include "tablas/emplazamientos_admin/tabla_filas_emplazamientos_admin.php";

                            ?>


                        </tr>








                    <?php

                        //-- MODAL PARA CORRECCION Y CAMBIO DE ESTATUS-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->




                        // include "modales/modal_modificacion_manuales.php";





                        //-- Modal-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                    }

                    ?>
                <?php

            } else { ?>


                    <form style="margin-bottom: 5%;" action="" method="post" id="searchForm">

                        <div style="margin-bottom: 3%;" class="fl-flex-label mb-4 px-2 col-12 col-md-10 campo">
                            <input type="text" class="input input__text" placeholder="Inserte RPU" id="searchInput" name="txtbuscarrpu">
                        </div>
                        <button type="submit" class="btn btn-primary btn-rounded mb-10 otro" type="button" onclick="buscar()"><i class="fa-solid fa-search"></i> &nbsp;Buscar</button>
                    </form>


                    <div id="errorMessage" class="error-message" style="display:none;">Campo vacío, por favor ingrese RPU.</div>

                    <table class="table table-bordered table-hover w-100 " id="example">
                        <thead>
                            <tr>


                                <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA PROFESIONISTAS Y CONSULTAS-->

                                <?php
                                include "tablas/emplazamientos_consultor/tabla_cabecera_emplazamientos_consultor.php";
                                ?>

                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            while ($datos = $sql_mes->fetch_object()) { ?>



                                <tr>

                                    <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA PROFESIONISTAS Y CONSULTAS-->
                                    <?php
                                    include "tablas/emplazamientos_consultor/tabla_filas_emplazamientos_consultor.php";
                                    ?>


                                </tr>
                            <?php } ?>




                    <?php }
            }
                    ?>


























                    <!-- CONDICION PARA OCULTAR O MOSTRAR LA TABLA SEGUN LOS VALORES QUE INGRESE EL USUARIO -->

                    <?php if ($mostrarTablas) { ?>






                        <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->



                        <?php



                        if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                        ?>


                            <table class="table table-bordered table-hover w-100 " id="example">
                                <thead>
                                    <tr>


                                        <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->

                                        <?php
                                        include "tablas/emplazamientos_admin/tabla_cabecera_emplazamientos_admin.php";
                                        ?>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    while ($datos = $sql->fetch_object()) { ?>

                                        <tr>



                                            <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->
                                            <?php
                                            include "tablas/emplazamientos_admin/tabla_filas_emplazamientos_admin.php";
                                            ?>



                                        </tr>







                                    <?php





                                        //-- MODAL PARA CORRECCION Y CAMBIO DE ESTATUS-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->




                                        // include "modales/modal_modificacion_manuales.php";





                                        //-- Modal-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->



                                    }

                                    ?>
                                <?php

                            } else {
                                ?>

                                    <table class="table table-bordered table-hover w-100 " id="example">
                                        <thead>
                                            <tr>

                                                <!-- //SE AGREGA CODIGO DE LAS CABECERAS DE LA TABLA VISTA PARA PROFESIONISTAS Y CONSULTAS-->

                                                <?php
                                                include "tablas/emplazamientos_consultor/tabla_cabecera_emplazamientos_consultor.php";
                                                ?>


                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php
                                            while ($datos = $sql->fetch_object()) { ?>


                                                <tr>


                                                    <!-- //SE AGREGA CODIGO DE LAS FILAS DE LA TABLA VISTA PARA ADMINISTRADOR Y SUPERVISOR-->
                                                    <?php
                                                    include "tablas/emplazamientos_consultor/tabla_filas_emplazamientos_consultor.php";
                                                    ?>

                                                </tr>
                                            <?php } ?>




                                    <?php }
                            }
                                    ?>




                                        </tbody>
                                    </table>



                                    <!-- //BOTON PARA QUITAR O OTORGAR EL ESTADO RESPONSIVE DE LA TABLA -->

                                    <button class="btn" id="toggleResponsive"><i class="fa-solid fa-up-right-and-down-left-from-center"></i></button>

</div>
</div>
<!-- fin del contenido principal -->













<!-- SCRIPT PARA COPIAR CONTENIDO DEL SPAN DENTRO DEL LI -->
<script>
    function copiarContenidoSpan(spanElement) {
        // Obtener el contenido del span
        const contenido = spanElement.innerText;

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







<!-- FUNCIONES PARA LOS MODALES DE FILTROS DE BUSQUEDA----------------------------------------------- -->




<!-- CALCULAR FECHA CADA 6 MESES-------------------------------- -->

<script>
    function calcularMeses() {
        var inputFecha = document.getElementById('fecha_semestral');
        var fechaSeleccionada = new Date(inputFecha.value);

        // Obtener el mes y año seleccionado por el usuario
        var mesSeleccionado = fechaSeleccionada.getMonth();
        var annoSeleccionado = fechaSeleccionada.getFullYear();

        // Calcular el mes después de 6 meses
        var nuevoMes = (mesSeleccionado + 6) % 12; // Utiliza el operador de módulo para manejar el cambio de año
        var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 6) / 12);

        // Formatear el resultado
        var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

        // Asignar el valor al input oculto
        document.getElementById('sextomes').value = resultado;

        // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
        console.log("Fecha después de 6 meses: " + resultado);
    }
</script>


<!-- CALCULAR FECHA POR AÑO--------------------------------  -->

<script>
    function calcularAnio() {
        var inputFecha = document.getElementById('fecha_anual');
        var fechaSeleccionada = new Date(inputFecha.value);

        // Obtener el mes y año seleccionado por el usuario
        var mesSeleccionado = fechaSeleccionada.getMonth();
        var annoSeleccionado = fechaSeleccionada.getFullYear();

        // Calcular el mes después de 6 meses
        var nuevoMes = (mesSeleccionado + 13) % 12; // Utiliza el operador de módulo para manejar el cambio de año
        var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 13) / 12);

        // Formatear el resultado
        var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

        // Asignar el valor al input oculto
        document.getElementById('mesdoce').value = resultado;

        // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
        console.log("Fecha después de 12 meses: " + resultado);
    }
</script>






<!-- CALCULAR FECHA CADA 6 MESES-------------------------------- -->

<script>
    function calcularMesesAtendidas() {
        var inputFecha = document.getElementById('fecha_semestral_atendidas');
        var fechaSeleccionada = new Date(inputFecha.value);

        // Obtener el mes y año seleccionado por el usuario
        var mesSeleccionado = fechaSeleccionada.getMonth();
        var annoSeleccionado = fechaSeleccionada.getFullYear();

        // Calcular el mes después de 6 meses
        var nuevoMes = (mesSeleccionado + 6) % 12; // Utiliza el operador de módulo para manejar el cambio de año
        var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 6) / 12);

        // Formatear el resultado
        var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

        // Asignar el valor al input oculto
        document.getElementById('sextomes_atendidas').value = resultado;

        // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
        console.log("Fecha después de 6 meses: " + resultado);
    }
</script>


<!-- CALCULAR FECHA POR AÑO--------------------------------  -->

<script>
    function calcularAnioAtendidas() {
        var inputFecha = document.getElementById('fecha_anual_atendidas');
        var fechaSeleccionada = new Date(inputFecha.value);

        // Obtener el mes y año seleccionado por el usuario
        var mesSeleccionado = fechaSeleccionada.getMonth();
        var annoSeleccionado = fechaSeleccionada.getFullYear();

        // Calcular el mes después de 6 meses
        var nuevoMes = (mesSeleccionado + 13) % 12; // Utiliza el operador de módulo para manejar el cambio de año
        var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 13) / 12);

        // Formatear el resultado
        var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

        // Asignar el valor al input oculto
        document.getElementById('mesdoce_atendidas').value = resultado;

        // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
        console.log("Fecha después de 12 meses: " + resultado);
    }
</script>


<!-- CALCULAR FECHA CADA 6 MESES-------------------------------- -->

<script>
    function calcularMesesDesatendidas() {
        var inputFecha = document.getElementById('fecha_semestral_desatendidas');
        var fechaSeleccionada = new Date(inputFecha.value);

        // Obtener el mes y año seleccionado por el usuario
        var mesSeleccionado = fechaSeleccionada.getMonth();
        var annoSeleccionado = fechaSeleccionada.getFullYear();

        // Calcular el mes después de 6 meses
        var nuevoMes = (mesSeleccionado + 6) % 12; // Utiliza el operador de módulo para manejar el cambio de año
        var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 6) / 12);

        // Formatear el resultado
        var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

        // Asignar el valor al input oculto
        document.getElementById('sextomes_desatendidas').value = resultado;

        // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
        console.log("Fecha después de 6 meses: " + resultado);
    }
</script>


<!-- CALCULAR FECHA POR AÑO--------------------------------  -->

<script>
    function calcularAnioDesatendidas() {
        var inputFecha = document.getElementById('fecha_anual_desatendidas');
        var fechaSeleccionada = new Date(inputFecha.value);

        // Obtener el mes y año seleccionado por el usuario
        var mesSeleccionado = fechaSeleccionada.getMonth();
        var annoSeleccionado = fechaSeleccionada.getFullYear();

        // Calcular el mes después de 6 meses
        var nuevoMes = (mesSeleccionado + 13) % 12; // Utiliza el operador de módulo para manejar el cambio de año
        var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 13) / 12);

        // Formatear el resultado
        var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

        // Asignar el valor al input oculto
        document.getElementById('mesdoce_desatendidas').value = resultado;

        // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
        console.log("Fecha después de 12 meses: " + resultado);
    }
</script>



<!-- SCRIPTS PARA LOS CHECKBOX-------------------------------------------------------- -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener todos los checkboxes
        var checkboxes = document.querySelectorAll('input[name="opciones"]');

        // Agregar un evento de cambio a cada checkbox
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Ocultar todos los bloques de código y limpiar el contenido
                document.querySelectorAll('.opciones-container').forEach(function(container) {
                    container.style.display = 'none';
                    container.querySelectorAll('input').forEach(function(input) {
                        input.value = ''; // Limpiar el contenido de los inputs
                    });
                });

                // Mostrar el bloque de código correspondiente al checkbox seleccionado
                var option = this.value;
                var containerToShow = document.querySelector('.' + option);

                // Mostrar el bloque de código solo si el checkbox está seleccionado
                if (this.checked && containerToShow) {
                    containerToShow.style.display = 'block';
                }
            });
        });
    });
</script>











<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>