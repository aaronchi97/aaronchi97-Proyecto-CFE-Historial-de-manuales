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

    //   include "../controlador/controlador_modificar_manual.php";
    // include "../controlador/controlador_eliminar_usuario.php";


    $mes_actual = date('m');



    $sql = $conexion->query(" SELECT * FROM control_manuales WHERE MONTH(fecha_captura) = $mes_actual ORDER BY fecha_captura DESC; ");






    ?>



    <form class="fechas" action="tu_controlador.php" method="post">


        <div class="fl-flex-label mb-4 px-2 col-3">
            <label for="fechaInicio">Fecha de Inicio:</label>
            <input class="input input__text" type="date" id="fechaInicio" name="fechaInicio">
        </div>


        <div class="fl-flex-label mb-4 px-2 col-3">
            <label for="fechaFin">Fecha de Fin:</label>
            <input type="date" id="fechaFin" name="fechaFin" class="input input__text">
        </div>


        <input type="submit" value="Consultar">
    </form>





    <!-- AQUI EMPIEZAN LAS CONDICIONES DE VISTA POR ROLES-------------------------------------------------------------------------- -->
    <?php
    if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
    ?>


        <table class="table table-bordered table-hover w-100 " id="example">
            <thead>
                <tr>


                    <th scope="col">RPU</th>
                    <th scope="col">ESTATUS</th>
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
                    <th scope="col">FECHA CAPTURA MANUAL</th>
                    <th scope="col">ACCION</th>
                </tr>
            </thead>

            <tbody>


                <?php
                while ($datos = $sql->fetch_object()) { ?>

                    <tr>


                        <?php
                        if ($datos->id_estatus == '1') { ?>
                            <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                <?= $datos->rpu ?>
                            </td>



                            <td style="background-color: rgba(110, 149, 52, 0.7); text-decoration: none;" class="td-celda-icono-estatus">
                                <a href="#">
                                    ATENDIDO </i>
                                </a>
                            </td>

                        <?php } else if (($datos->id_estatus == '2')) { ?>

                            <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                <?= $datos->rpu ?>
                            </td>


                            <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;" class="td-celda-icono-estatus">

                                <a href="#">
                                    PENDIENTE</a>

                            </td>


                        <?php } else { ?>


                            <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                <?= $datos->rpu ?>
                            </td>


                            <td style="background-color: rgba(255, 53, 53, 0.7);" class="td-celda-icono-estatus">

                                <a href="#">
                                    RECHAZADO </a>

                            </td>


                        <?php } ?>





                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->cuenta ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->ciclo ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->tarifa ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->id_motivomanual ?>
                        </td>
                        <!-- <td id="celdaSinUso" onclick="copiarContenido('celdaSinUso')">
                <?= $datos->sin_uso ?>
              </td> -->
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->lectura_manual ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->kwh_recuperar ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->respaldo_man ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->rpe_auxiliar ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->observaciones ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->correccion ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->agencia ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->responsable_manual ?>
                        </td>
                        <td class="celda" onclick="copiarContenido(this)">
                            <?= $datos->fecha_captura ?>
                        </td>

                        <td>
                            <a class="btn btn-danger" href="manuales.php?id_manual_eliminar=<?= $datos->id_control_manuales ?>" onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>




                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $datos->id_control_manuales  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                            <input type="text" placeholder="ID" class="input input__text inputmodal" name="txtid" value=" <?= $datos->id_control_manuales ?>" readonly>
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="RPU" class="input input__text inputmodal" name="txtrpu" value=" <?= $datos->rpu ?>" readonly>
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Cuenta" class="input input__text inputmodal" name="txtcuenta" value=" <?= $datos->cuenta ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Ciclo" class="input input__text inputmodal" name="txtciclo" value=" <?= $datos->ciclo ?>">
                                        </div>

                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Tarifa" class="input input__text inputmodal" name="txttarifa" value=" <?= $datos->tarifa ?>">
                                        </div>

                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Motivo de la manual" class="input input__text inputmodal" name="txtidmotivomanual" value=" <?= $datos->id_motivomanual ?>">
                                        </div>

                                        <!-- <div class="fl-flex-label mb-4 px-2 col-12  campo">

                      <input type="text" placeholder="sin_uso" class="input input__text inputmodal" name="txtsin_uso"
                        value=" <?= $datos->sin_uso ?>">
                    </div> -->

                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="lectura de manual" class="input input__text inputmodal" name="txtlectura_manual" value=" <?= $datos->lectura_manual ?>">
                                        </div>

                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="kwh a recuperar" class="input input__text inputmodal" name="txtkwh_recuperar" value=" <?= $datos->kwh_recuperar ?>">
                                        </div>

                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Respaldo_manual" class="input input__text inputmodal" name="txtrespaldo_manual" value=" <?= $datos->respaldo_man ?>">
                                        </div>

                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="RPE auxiliar" class="input input__text inputmodal" name="txtrpe_auxiliar" value=" <?= $datos->rpe_auxiliar ?>">
                                        </div>

                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Observaciones" class="input input__text inputmodal" name="txtobservaciones" value=" <?= $datos->observaciones ?>">
                                        </div>

                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Correccion" class="input input__text inputmodal" name="txtcorreccion" value=" <?= $datos->correccion ?>">
                                        </div>

                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Agencia" class="input input__text inputmodal" name="txtagencia" value=" <?= $datos->agencia ?>">
                                        </div>

                                        <div class="fl-flex-label mb-4 px-2 col-12  campo">

                                            <input type="text" placeholder="Responsable Manual" class="input input__text inputmodal" name="txtresponsable_manual" value=" <?= $datos->responsable_manual ?>">
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
                                            <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
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



                            <th scope="col">RPU</th>
                            <th scope="col">ESTATUS</th>
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
                            <th scope="col">FECHA CAPTURA</th>


                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        while ($datos = $sql->fetch_object()) { ?>





                            <?php
                            if ($datos->id_estatus == '1') { ?>
                                <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.6);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                    <?= $datos->rpu ?>
                                </td>



                                <td style="background-color: rgba(110, 149, 52, 0.5); text-decoration: none;" class="td-celda-icono-estatus">
                                    <a href="#">
                                        ATENDIDO </i>
                                    </a>
                                </td>

                            <?php } else if (($datos->id_estatus == '2')) { ?>

                                <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.6);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                    <?= $datos->rpu ?>
                                </td>


                                <td style="background-color:rgba(245, 174, 22, 0.5); text-decoration: none;" class="td-celda-icono-estatus">

                                    <a href="#">
                                        PENDIENTE</a>

                                </td>


                            <?php } else { ?>


                                <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.6);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                                    <?= $datos->rpu ?>
                                </td>


                                <td style="background-color: rgba(255, 53, 53, 0.5);" class="td-celda-icono-estatus">

                                    <a href="#">
                                        RECHAZADO </a>

                                </td>


                            <?php } ?>






                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->cuenta ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->ciclo ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->tarifa ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->id_motivomanual ?>
                            </td>
                            <!-- <td id="celdaSinUso" onclick="copiarContenido('celdaSinUso')">
                <?= $datos->sin_uso ?>
              </td> -->
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->lectura_manual ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->kwh_recuperar ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->respaldo_man ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->rpe_auxiliar ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->observaciones ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->correccion ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->agencia ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->responsable_manual ?>
                            </td>
                            <td>
                                <?= $datos->fecha_captura ?>
                            </td>




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