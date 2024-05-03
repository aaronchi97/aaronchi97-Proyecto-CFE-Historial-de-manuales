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

    <h4 style="margin-bottom: 5%;" class="text-center text-secondery">HISTORIAL DE NEGATIVAS</h4>

    <?php
    //hacemos la conexion
    include "../modelo/conexion.php";
    //llamamos al controlador para eliminar registros
    //   include "../controlador/controlador_modificar_manual.php";
    // include "../controlador/controlador_eliminar_usuario.php";




    $id_negativa_obtenido = $_GET['id_negativas'];

    // $sql = $conexion->query(" SELECT * from historial_manuales where id_control_manuales = $id_manual_obtenido order by fecha_historial desc;");


    $sql = $conexion->query(" SELECT historial_negativas.*, motivo_historial.*, estatus.*
FROM historial_negativas
JOIN motivo_historial ON historial_negativas.id_motivohistorial = motivo_historial.id_motivohistorial
JOIN estatus ON historial_negativas.id_estatus = estatus.id_estatus
WHERE historial_negativas.id_control_negativas = $id_negativa_obtenido
ORDER BY historial_negativas.fecha_historial DESC;");






    ?>



    <a href="negativas.php" class="btn btn-danger btn-rounded mb-3 otro"><i class="fa-solid fa-caret-left"></i>
        ATRAS</a>



    <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->
    <?php
    if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
    ?>


        <table class="table table-bordered table-hover w-100 " id="example">
            <thead>
                <tr>

                    <th scope="col">ACCION</th>
                    <th scope="col">MOTIVO</th>
                    <th scope="col">RPU</th>
                    <th scope="col">ESTATUS</th>
                    <th scope="col">CUENTA</th>
                    <th scope="col">CICLO</th>
                    <th scope="col">AGENCIA</th>
                    <th scope="col">TARIFA</th>
                    <th scope="col">MEDIDOR</th>
                    <!-- <th scope="col">SIN USO</th> -->
                    <th scope="col">AA_MM</th>
                    <th scope="col">TIPO MEDIDOR</th>
                    <th scope="col">CVE</th>
                    <th scope="col">DICE</th>
                    <th scope="col">DEBE DECIR</th>
                    <th scope="col">KWH_A_RECUPERAR</th>
                    <th scope="col">RESPALDO_NEGATIVA</th>
                    <th scope="col">MOTIVO_CORRECCION</th>
                    <th scope="col">RPE AUXILIAR</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col">RESPONSABLE</th>
                    <th scope="col">FECHA CAPTURA NEGATIVA</th>
                    <th scope="col">FECHA HISTORIAL</th>
                    <th scope="col">ACCION</th>
                </tr>
            </thead>

            <tbody>


                <?php
                while ($datos = $sql->fetch_object()) { ?>

                    <tr>




                        <td style="color: #AAEA6D;" id="accionhistorial" class="celda" onclick="copiarContenido(this)">
                            <?= $datos->accion_historial ?>
                        </td>

                        <td style="color: #AAEA6D;" class="celda" onclick="copiarContenido(this)">
                            <?= $datos->nombre_motivo ?>
                        </td>


                        <?php
                        if ($datos->id_estatus == '1') { ?>
                            <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                <?= $datos->rpu ?>
                            </td>



                            <td style="background-color: rgba(110, 149, 52, 0.7); text-decoration: none;" class="td-celda-icono-estatus">
                                <a href="#">
                                    ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                                </a>
                            </td>

                        <?php } else if (($datos->id_estatus == '2')) { ?>

                            <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                <?= $datos->rpu ?>
                            </td>


                            <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;" class="td-celda-icono-estatus">

                                <a href="#">
                                    PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                            </td>


                        <?php } else { ?>


                            <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                <?= $datos->rpu ?>
                            </td>


                            <td style="background-color: rgba(255, 53, 53, 0.7);" class="td-celda-icono-estatus">

                                <a href="#">
                                    RECHAZADO <i class="fa-solid fa-circle-xmark" style="color: #ff2424;"></i> </a>

                            </td>


                        <?php } ?>


                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->cuenta ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->ciclo ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->agencia ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->tarifa ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->medidor ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->aa_mm ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->tipo_medidor ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->cve ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->dice ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->debe_decir ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->kwh_recuperar ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->id_justificacionnegativas ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->motivo_correccion ?>
                        </td>

                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->rpe_auxiliar ?>
                        </td>


                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->observaciones ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->responsable_negativa ?>
                        </td>

                        <td id="celdaFechaCaptura" onclick="copiarContenido('celdaFechaCaptura')">
                            <?= $datos->fecha_captura ?>
                        </td>
                        <td id="celdaFechaCaptura" onclick="copiarContenido('celdaFechaCaptura')">
                            <?= $datos->fecha_historial ?>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="negativas.php?id_negativa_eliminar=<?= $datos->id_control_negativas ?>" onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>





                <?php

                }

                ?>
            <?php

        } else {
            ?>


                <table class="table table-bordered table-hover w-100 " id="example">
                    <thead>
                        <tr>

                            <th scope="col">ACCION</th>
                            <th scope="col">MOTIVO</th>
                            <th scope="col">RPU</th>
                            <th scope="col">ESTATUS</th>
                            <th scope="col">CUENTA</th>
                            <th scope="col">CICLO</th>
                            <th scope="col">AGENCIA</th>
                            <th scope="col">TARIFA</th>
                            <th scope="col">MEDIDOR</th>
                            <!-- <th scope="col">SIN USO</th> -->
                            <th scope="col">AA_MM</th>
                            <th scope="col">TIPO MEDIDOR</th>
                            <th scope="col">CVE</th>
                            <th scope="col">DICE</th>
                            <th scope="col">DEBE DECIR</th>
                            <th scope="col">KWH_A_RECUPERAR</th>
                            <th scope="col">RESPALDO_NEGATIVA</th>
                            <th scope="col">MOTIVO_CORRECCION</th>
                            <th scope="col">RPE AUXILIAR</th>
                            <th scope="col">OBSERVACIONES</th>
                            <th scope="col">RESPONSABLE</th>
                            <th scope="col">FECHA CAPTURA NEGATIVA</th>
                            <th scope="col">FECHA HISTORIAL</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        while ($datos = $sql->fetch_object()) { ?>




                            <td style="color: #AAEA6D;" id="accionhistorial" onclick="copiarContenido('accionhistorial')">
                                <?= $datos->accion_historial ?>
                            </td>

                            <td style="color: #AAEA6D;" id="motivo" onclick="copiarContenido('motivo')">
                                <?= $datos->nombre_motivo ?>
                            </td>


                            <?php
                            if ($datos->id_estatus == '1') { ?>
                                <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                    <?= $datos->rpu ?>
                                </td>



                                <td style="background-color: rgba(110, 149, 52, 0.7); text-decoration: none;" class="td-celda-icono-estatus">
                                    <a href="#">
                                        ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                                    </a>
                                </td>

                            <?php } else if (($datos->id_estatus == '2')) { ?>

                                <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                    <?= $datos->rpu ?>
                                </td>


                                <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;" class="td-celda-icono-estatus">

                                    <a href="#">
                                        PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                                </td>


                            <?php } else { ?>


                                <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                    <?= $datos->rpu ?>
                                </td>


                                <td style="background-color: rgba(255, 53, 53, 0.7);" class="td-celda-icono-estatus">

                                    <a href="#">
                                        RECHAZADO <i class="fa-solid fa-circle-xmark" style="color: #ff2424;"></i> </a>

                                </td>


                            <?php } ?>


                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->cuenta ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->ciclo ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->agencia ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->tarifa ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->medidor ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->aa_mm ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->tipo_medidor ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->cve ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->dice ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->debe_decir ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->kwh_recuperar ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->id_justificacionnegativas ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->motivo_correccion ?>
                            </td>

                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->rpe_auxiliar ?>
                            </td>

                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->observaciones ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->responsable_negativa ?>
                            </td>

                            <td id="celdaFechaCaptura" onclick="copiarContenido('celdaFechaCaptura')">
                                <?= $datos->fecha_captura ?>
                            </td>
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