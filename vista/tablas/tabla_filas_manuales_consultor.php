<?php
if ($datos->id_estatus == '1') { ?>
    <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
        <?= $datos->rpu ?>
    </td>



    <td style=" text-decoration: none;" class="td-celda-icono-estatus">
        <a href="#">
            ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
        </a>
    </td>

<?php } else if (($datos->id_estatus == '2')) { ?>

    <td style="color:whitesmoke; font-weight: bold; background-color: rgba(255, 141, 20, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
        <?= $datos->rpu ?>
    </td>


    <td style="text-decoration: none;" class="td-celda-icono-estatus">

        <a href="#">
            PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

    </td>


<?php } else { ?>


    <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
        <?= $datos->rpu ?>
    </td>


    <td class="td-celda-icono-estatus">

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
<!-- <td class="celda" onclick="copiarContenido(this)">
    <?= $datos->correccion ?>
</td> -->
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->agencia ?>
</td>
<!-- <td class="celda" onclick="copiarContenido(this)">
    <?= $datos->responsable_manual ?>
</td> -->

<td class="celda" onclick="copiarContenido(this)">
    <?php if ($datos->responsable_manual == 0): ?>
        NO ACTUALIZADO
    <?php else: ?>
        <?= $datos->responsable_manual ?>
    <?php endif; ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->fecha_captura ?>
</td>

<!-- <td class="celda" onclick="copiarContenido(this)">
    <?= $datos->responsable_modificacion ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->id_motivohistorial ?>
</td> -->

<td class="celda" onclick="copiarContenido(this)">
    <?php if ($datos->responsable_modificacion == 0): ?>
        NADIE HA MODIFICADO EL REGISTRO
    <?php else: ?>
        <?= $datos->responsable_modificacion ?>
    <?php endif; ?>
</td>


<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->nombre_motivo ?>
</td>


<td class="celda" onclick="copiarContenido(this)">
    <a class="btn btn-warning" href="historial_manuales.php?id_manual=<?= $datos->id_control_manuales ?>">HISTÓRICO <i class="fa-solid fa-file-shield"></i></a>
</td>