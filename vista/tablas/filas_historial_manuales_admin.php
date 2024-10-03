<!-- FILAS DE TABLA HISTORIAL MANUALES PARA VISTA ADMIN Y SUPERVISOR --------------- -->



<td style="color: #AAEA6D;" class="celda" onclick="copiarContenido(this)">
    <?= $datos->accion_historial ?>
</td>




<!-- style="color: #F07267;" style="color: #F09789; -->
<td style="color: #F09779;" class="celda" onclick="copiarContenido(this)">
    <?= $datos->nombre_motivo ?>
</td>


<!-- <td>
    <a href="" data-toggle="modal" data-target="#modal_comparacion_manuales_historial<?= $datos->id_control_manuales ?> " class="btn btn-warning ">COMPARAR </a>

</td> -->

<?php
if ($datos->id_estatus == '1') { ?>
    <td style="color:whitesmoke; font-weight: bold; background-color: rgba(110, 149, 52, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
        <?= $datos->rpu ?>
    </td>



    <td style="background-color: rgba(110, 149, 52, 0.7); text-decoration: none;">

        ATENDIDO

    </td>

<?php } else if (($datos->id_estatus == '2')) { ?>

    <td style="color:whitesmoke; font-weight: bold; background-color: rgba(245, 174, 22, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
        <?= $datos->rpu ?>
    </td>


    <td style="background-color:rgba(245, 174, 22, 0.7); text-decoration: none;">


        PENDIENTE

    </td>


<?php } else { ?>


    <td style="color:whitesmoke; font-weight: bold; background-color:rgba(255, 53, 53, 0.8);" class="td-celda-rpu celda" onclick="copiarContenido(this)">
        <?= $datos->rpu ?>
    </td>


    <td style="background-color: rgba(255, 53, 53, 0.7);">


        RECHAZADO

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
<td class="celda" onclick="copiarContenido(this)">
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

    <a class="btn btn-danger" href="historial_manuales.php?id_manual_eliminar=<?= $datos->id_control_manuales ?>" onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a>

    <a href="" data-toggle="modal" data-target="#modal_comparacion_manuales_historial<?= $datos->id_historial_manuales ?> " class="btn btn-warning ">COMPARAR <i class="fa-solid fa-code-compare"></i></a>
</td>









<!-- ATENDIDO <i class="fa-solid fa-circle-check" style="color: #42ca07;">
  PENDIENTE <i class="fa-solid fa-clock" style="color: #f4a701;"></i>
  RECHAZADO <i class="fa-solid fa-circle-xmark" style="color: #ff2424;"></i>  -->