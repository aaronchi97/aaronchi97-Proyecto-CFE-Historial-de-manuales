<!-- FILAS PARA TABLAS DE NEGATIVAS VISTA CONSULTOR Y PROFESIONISTA ----------------------------------------------
(HACER AQUI CUALQUIER MODIFICACION O CORRECCION DE LA CABECERA) -->


<td></td>

<?php
if ($datos->id_estatus == '1') { ?>
    <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
        <?= $datos->rpu ?>
    </td>



    <td style=" text-decoration: none;" class="td-celda-icono-estatus">
        <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
            ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;"></i>
        </a>
    </td>

<?php } else if (($datos->id_estatus == '2')) { ?>

    <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
        <?= $datos->rpu ?>
    </td>


    <td style=" text-decoration: none;" class="td-celda-icono-estatus">

        <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
            PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i> </a>

    </td>


<?php } else { ?>


    <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
        <?= $datos->rpu ?>
    </td>


    <td class="td-celda-icono-estatus">

        <a href="#" data-toggle="modal" data-target="#exampleModal_estatus<?= $datos->id_control_negativas ?> ">
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
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->fecha_captura ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->responsable_modificacion ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->id_motivohistorial ?>
</td>
<td>


    <a class="btn btn-warning" href="historial_negativas.php?id_negativas=<?= $datos->id_control_negativas ?>">HISTÓRICO <i class="fa-solid fa-eye"></i></a>


</td>