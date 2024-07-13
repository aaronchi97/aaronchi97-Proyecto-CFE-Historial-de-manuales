<?php
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
?>


    <table class="table table-bordered table-hover w-100 " id="example">
        <thead>
            <tr>

                <th scope="col"></th>
                <th scope="col">RPU</th>
                <th scope="col"><i class="fa-solid fa-list-check"></i></th>
                <th scope="col">CUENTA</th>
                <th scope="col">CICLO</th>
                <th scope="col">TARIFA</th>
                <th scope="col">MOTIVO MANUAL</th>
                <!-- <th scope="col">SIN USO</th> -->
                <th scope="col">LECTURA MANUAL</th>
                <th scope="col">KWH A RECUPERAR</th>
                <th scope="col">RESPALDO</th>
                <th scope="col">ORDEN SERVICIO</th>
                <th scope="col">RPE_AUXILIAR</th>
                <th scope="col">OBSERVACIONES</th>
                <th scope="col">CORRECCION</th>
                <th scope="col">AGENCIA</th>
                <th scope="col">RESPONSABLE_MANUAL</th>
                <th scope="col">FECHA</th>
                <th scope="col">ACCION</th>
            </tr>
        </thead>

        <tbody>
            <?php
            while ($datos = $sql->fetch_object()) { ?>

                <tr>



                    <td></td>
                    <?php
                    if ($datos->id_estatus == '1') { ?>
                        <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                            <?= $datos->rpu ?>
                        </td>



                        <td style="background-color: rgba(110, 149, 52, 0.7); text-decoration: none;" class="td-celda-icono-estatus">
                            <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_manuales ?> ">
                                ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
                            </a>
                        </td>

                    <?php } else if (($datos->id_estatus == '2')) { ?>

                        <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                            <?= $datos->rpu ?>
                        </td>


                        <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;" class="td-celda-icono-estatus">

                            <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_manuales ?> ">
                                PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

                        </td>


                    <?php } else { ?>


                        <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
                            <?= $datos->rpu ?>
                        </td>


                        <td style="background-color: rgba(255, 53, 53, 0.7);" class="td-celda-icono-estatus">

                            <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_manuales ?> ">
                                RECHAZADO <i class="fa-solid fa-circle-xmark" style="color: #ff2424;"></i> </a>

                        </td>


                    <?php } ?>



                    <!-- <td class="id" scope="row"> -->

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
                        <?= $datos->no_ordenservicio ?>
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
                        <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_control_manuales ?> " class="btn btn-success ">CORREGIR MANUAL <i class="fa-brands fa-stack-overflow"></i></a>
                        <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>">HISTÓRICO <i class="fa-solid fa-file-shield"></i></a>
                        <a class="btn btn-danger" href="manuales.php?id_manual_eliminar=<?= $datos->id_control_manuales ?>" onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a>
                    </td>






                </tr>







            <?php





                //-- MODAL PARA CORRECCION Y CAMBIO DE ESTATUS-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->




                include "modales/modal_modificacion_manuales.php";





                //-- Modal-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->



            }

            ?>
        <?php

    } else {
        ?>

            <table class="table table-bordered table-hover w-100 " id="example">
                <thead>
                    <tr>

                        <th scope="col">RPU</th>
                        <th scope="col"><i class="fa-solid fa-list-check"></i></th>
                        <th scope="col">CUENTA</th>
                        <th scope="col">CICLO</th>
                        <th scope="col">TARIFA</th>
                        <th scope="col">MOTIVO MANUAL</th>
                        <!-- <th scope="col">SIN USO</th> -->
                        <th scope="col">LECTURA MANUAL</th>
                        <th scope="col">KWH A RECUPERAR</th>
                        <th scope="col">RESPALDO</th>
                        <th scope="col">ORDEN SERVICIO</th>
                        <th scope="col">RPE_AUXILIAR</th>
                        <th scope="col">OBSERVACIONES</th>
                        <th scope="col">CORRECCION</th>
                        <th scope="col">AGENCIA</th>
                        <th scope="col">RESPONSABLE_MANUAL</th>
                        <th scope="col">FECHA</th>
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
                                <?= $datos->tarifa ?>
                            </td>
                            <td class="celda" onclick="copiarContenido(this)">
                                <?= $datos->id_motivomanual ?>
                            </td>
                            <!-- <td>
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
                                <?= $datos->no_ordenservicio ?>
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
                                <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>"><i class="fa-solid fa-eye"></i></a>
                            </td>

                        </tr>
                    <?php } ?>




                <?php }

                ?>