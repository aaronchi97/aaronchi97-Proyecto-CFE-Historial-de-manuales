<!-- FILAS DE TABLA EMPLAZAMIENTOS PARA VISTA ADMIN Y SUPERVISOR --------------- -->


<td></td>
<td hidden class="celda" onclick="copiarContenido(this)">
    <?= $datos->id_emplazamiento ?>
</td>
<td hidden class="celda" onclick="copiarContenido(this)">
    <?= $datos->id_control_manuales ?>
</td>


<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->rpu_emplazamiento ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->cuenta_emplazamiento ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->agencia_emplazamiento ?>
</td>

<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->nombre ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->direccion ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->medidor_emplazamiento ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->georeferencia ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->dias ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->correccion_emplazamiento ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->fecha_emplazamiento ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->ciclo_emplazamiento ?>
</td>
<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->impresion ?>
</td>

<td class="celda" onclick="copiarContenido(this)">
    <?= $datos->responsable_emplazamiento ?>
</td>

<!-- <td class="celda" onclick="copiarContenido(this)">
    <?= $datos->responsable_modificar_emplazamiento ?>
</td> -->

<td>
    <a href="" data-toggle="modal_modificacion_emplazamiento" data-target="#exampleModal<?= $datos->id_emplazamiento ?> " class="btn btn-success ">CORREGIR EMPLAZAMIENTO <i class="fa-brands fa-stack-overflow"></i></a>
    <a class="btn btn-warning" href="historial_emplazamientos.php?id_emplazamiento=<?= $datos->id_emplazamiento ?>">HISTÓRICO <i class="fa-solid fa-file-shield"></i></a>
    <a class="btn btn-danger" href="emplazamientos.php?id_emplazamiento_eliminar=<?= $datos->id_emplazamiento ?>" onclick=" advertencia(event)"><i class="fa-solid fa-trash-can"></i></a>
</td>