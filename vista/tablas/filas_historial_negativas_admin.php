<!-- FILAS PARA TABLA HISTORIAL NEGATIVAS VISTA ADMIN Y SUPERVISOR ------------------ -->



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



    <td style="background-color: rgba(110, 149, 52, 0.7); text-decoration: none;">

        ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>

    </td>

<?php } else if (($datos->id_estatus == '2')) { ?>

    <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
        <?= $datos->rpu ?>
    </td>


    <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;">


        PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i>

    </td>


<?php } else { ?>


    <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
        <?= $datos->rpu ?>
    </td>


    <td style="background-color: rgba(255, 53, 53, 0.7);">


        RECHAZADO <i class="fa-solid fa-circle-xmark" style="color: #ff2424;"></i>

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
<!-- <td class="celda" onclick="copiarContenido(this)">
    <?= $datos->responsable_negativa ?>
</td> -->

<td class="celda" onclick="copiarContenido(this)">
    <?php if ($datos->responsable_negativa == 0): ?>
        NO ACTUALIZADO
    <?php else: ?>
        <?= $datos->responsable_negativa ?>
    <?php endif; ?>
</td>

<td id="celdaFechaCaptura" onclick="copiarContenido('celdaFechaCaptura')">
    <?= $datos->fecha_captura ?>
</td>
<td id="celdaFechaCaptura" onclick="copiarContenido('celdaFechaCaptura')">
    <?= $datos->fecha_historial ?>
</td>
<!-- <td class="celda" onclick="copiarContenido(this)">
    <?= $datos->responsable_modificacion ?>
</td> -->
<td class="celda" onclick="copiarContenido(this)">
    <?php if ($datos->responsable_modificacion == 0): ?>
        NADIE HA MODIFICADO EL REGISTRO
    <?php else: ?>
        <?= $datos->responsable_modificacion ?>
    <?php endif; ?>
</td>
<td>
    <a class="btn btn-danger" href="negativas.php?id_historial_negativa_eliminar=<?= $datos->id_control_negativas ?>" onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a>

    <a href="" data-toggle="modal" data-target="#modal_comparacion_negativas_historial<?= $datos->id_historial_negativas ?> " class="btn btn-warning ">COMPARAR <i class="fa-solid fa-code-compare"></i></a>
</td>