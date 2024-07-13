<!-- MODAL PARA HACER COMPARACIONES DE HISTORICOS DE MANUALES, SE COMPARA CUALQUIER HISTORICO CON LA MANUAL ACTUAL ----------------------------------------------------------------------------------->


<div class="modal fade" id="modal_comparacion_manuales_historial<?= $datos->id_historial_manuales ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">COMPARATIVA RPU: <span style="color: orange;"> <?= $datos->rpu ?> </span>, MODIFICACIÓN: <span style="color: orange;"> <?= $datos->responsable_modificacion ?> </span> </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
                $sql_actual = $conexion->query("SELECT * FROM control_manuales WHERE rpu = $datos->rpu");
                $datos_actual = $sql_actual->fetch_object()
                ?>

                <!-- AQUI PONDREMOS LOS INPUTS PARA COMPARAR--------------- -->

                <form action="" method="post">

                    <div hidden class="fl-flex-label mb-4 px-2 col-6  campo">

                        <input type="text" placeholder="ID" class="input input__text inputmodal input_modificado" name="txtid" value="<?= $datos_actual->id_control_manuales ?>" readonly>
                    </div>

                    <div hidden class="fl-flex-label mb-4 px-2 col-6  campo">

                        <input type="text" placeholder="ID" class="input input__text inputmodal input_modificado" name="txtid_historial" value="<?= $datos->id_historial_manuales ?>" readonly>
                    </div>

                    <!-- -------------------------------------------- -->



                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="RPU" class="input input__text inputmodal_ineditable input_modificado" name="txtrpu" value="<?= $datos_actual->rpu ?>" readonly>
                    </div>



                    <!-- -------------------------------------------- -->




                    <!-- ESTE INPUT ES EL MOTIVO POR EL CUAL SE ESTA EDITANDO LA NEGATIVA, EN ESTE CASO SU VALOR ID ES 8 EL CUAL
                    SIGNIFICA QUE SE ESTA REGRESANDO UNA NEGATIVA DESDE EL HISTORIAL -->
                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="MOTIVO DE EDICION DE MANUAL" class="input input__text inputmodal" name="txtmotivo" value="8" readonly>
                    </div>




                    <!-- -------------------------------------------- -->

                    <div class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input id="txtcuenta<?= $datos_actual->id_control_manuales ?>" type="text" placeholder="CUENTA ACTUAL" class="input input__text inputmodal_ineditable input_modificado" name="txtcuenta" list="cuentaList" autocomplete="off" value="<?= trim($datos_actual->cuenta) ?>" oninput="autocompletarCampos()" readonly>

                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input id="txtcuenta<?= $datos->id_control_manuales ?>" type="text" placeholder="CUENTA ANTIGUA" class="input input__text inputmodal input_modificado" name="txtcuenta_antigua" list="cuentaList" autocomplete="off" value="<?= trim($datos->cuenta) ?>" oninput="autocompletarCampos()" readonly>

                    </div>


                    <!-- -------------------------------------------- -->

                    <div class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input id="txtciclo<?= $datos_actual->id_control_manuales ?>" type="text" placeholder="CICLO ACTUAL" class="input input__text inputmodal_ineditable input_modificado" name="txtciclo" value="<?= trim($datos_actual->ciclo) ?>" readonly>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input id="txtciclo<?= $datos->id_control_manuales ?>" type="text" placeholder="CICLO ANTIGUA" class="input input__text inputmodal input_modificado" name="txtciclo_antigua" value="<?= trim($datos->ciclo) ?>" readonly>
                    </div>

                    <!-- -------------------------------------------- -->

                    <div class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input id="txtagencia<?= $datos_actual->id_control_manuales ?>" type="text" placeholder="AGENCIA ACTUAL" class="input input__text inputmodal_ineditable input_modificado" name="txtagencia" autocomplete="off" value="<?= trim($datos_actual->agencia) ?>" readonly>

                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input id="txtagencia<?= $datos->id_control_manuales ?>" type="text" placeholder="AGENCIA ANTIGUA" class="input input__text inputmodal input_modificado" name="txtagencia_antigua" autocomplete="off" value="<?= trim($datos->agencia) ?>" readonly>

                    </div>

                    <!-- -------------------------------------------- -->

                    <div class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="TARIFA ACTUAL" class="input input__text inputmodal_ineditable input_modificado" name="txttarifa" value="<?= trim($datos_actual->tarifa) ?>" readonly>

                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="TARIFA ANTIGUA" class="input input__text inputmodal input_modificado" name="txttarifa_antigua" value="<?= trim($datos->tarifa) ?>" readonly>

                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input id="txtidmotivomanual_<?= $datos_actual->id_control_manuales ?>" class="input input__text inputmodal_ineditable input_modificado" name="txtidmotivomanual" type="text" placeholder="MOTIVO DE MANUAL ACTUAL" value="<?= trim($datos_actual->id_motivomanual) ?>" autocomplete="off" readonly>

                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input id="txtidmotivomanual_<?= $datos->id_control_manuales ?>" class="input input__text inputmodal input_modificado" name="txtidmotivomanual_antigua" type="text" placeholder="MOTIVO DE MANUAL ANTIGUA" value="<?= trim($datos->id_motivomanual) ?>" autocomplete="off" readonly>

                    </div>


                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="SIN_USO" class="input input__text inputmodal_ineditable input_modificado" name="txtsin_uso" value="<?= trim($datos_actual->sin_uso) ?>" readonly>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="SIN_USO ANTIGUA" class="input input__text inputmodal input_modificado" name="txtsin_uso_antigua" value="<?= trim($datos->sin_uso) ?>" readonly>
                    </div>

                    <!-- -------------------------------------------- -->

                    <div id="contenedor_lectura_manual_<?= $datos_actual->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="LECTURA MANUAL ACTUAL" class="input input__text inputmodal_ineditable input_modificado" name="txtlectura_manual" onkeypress="return validarNumeros(event)" value="<?= trim($datos_actual->lectura_manual) ?>" readonly>
                    </div>

                    <div id="contenedor_lectura_manual_<?= $datos->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="LECTURA MANUAL ANTIGUA" class="input input__text inputmodal input_modificado" name="txtlectura_manual_antigua" onkeypress="return validarNumeros(event)" value="<?= trim($datos->lectura_manual) ?>" readonly>
                    </div>


                    <!-- -------------------------------------------- -->


                    <div id="contenedor_kwh_recuperar_<?= $datos_actual->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="KWH A RECUPERAR ACTUAL" class="input input__text inputmodal_ineditable input_modificado" name="txtkwh_recuperar" onkeypress="return validarNumeros(event)" value="<?= trim($datos_actual->kwh_recuperar) ?>" readonly>
                    </div>

                    <div id="contenedor_kwh_recuperar_<?= $datos->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="KWH A RECUPERAR ANTIGUA" class="input input__text inputmodal input_modificado" name="txtkwh_recuperar_antigua" onkeypress="return validarNumeros(event)" value="<?= trim($datos->kwh_recuperar) ?>" readonly>
                    </div>


                    <!-- -------------------------------------------- -->


                    <div id="contenedor_respaldo_manual_<?= $datos_actual->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="RESPALDO-MANUAL ACTUAL" class="input input__text inputmodal_ineditable input_modificado" name="txtrespaldo_manual" list="respaldomanualList" autocomplete="off" value="<?= trim($datos_actual->respaldo_man) ?>" readonly>

                    </div>

                    <div id="contenedor_respaldo_manual_<?= $datos->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="RESPALDO-MANUAL ANTIGUA" class="input input__text inputmodal input_modificado" name="txtrespaldo_manual_antigua" list="respaldomanualList" autocomplete="off" value="<?= trim($datos->respaldo_man) ?>" readonly>

                    </div>


                    <!-- -------------------------------------------- -->

                    <div id="contenedor_no_ordenservicio" class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="ORDEN DE SERVICIO ACTUAL" class="input input__text inputmodal_ineditable" name="txtno_ordenservicio" autocomplete="off" value="<?= trim($datos_actual->no_ordenservicio) ?>" readonly>

                    </div>

                    <div id="contenedor_no_ordenservicio" class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="ORDEN DE SERVICIO ANTIGUA" class="input input__text inputmodal" name="txtno_ordenservicio_antigua" autocomplete="off" value="<?= trim($datos->no_ordenservicio) ?>" readonly>

                    </div>


                    <!-- -------------------------------------------- -->


                    <div id="contenedor_txtrpe_auxiliar_<?= $datos_actual->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="RPE-AUXILIAR ACTUAL" class="input input__text inputmodal_ineditable input_modificado" name="txtrpe_auxiliar" autocomplete="off" value="<?= trim($datos_actual->rpe_auxiliar) ?>" readonly>

                    </div>

                    <div id="contenedor_txtrpe_auxiliar_<?= $datos->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="RPE-AUXILIAR ANTIGUA" class="input input__text inputmodal input_modificado" name="txtrpe_auxiliar_antigua" autocomplete="off" value="<?= trim($datos->rpe_auxiliar) ?>" readonly>

                    </div>


                    <!-- -------------------------------------------- -->


                    <div id="contenedor_observaciones_<?= $datos_actual->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="OBSERVACIÓN ACTUAL" class="input input__text inputmodal_ineditable input_modificado" name="txtobservaciones" value="<?= trim($datos_actual->observaciones) ?>" readonly>
                    </div>

                    <div id="contenedor_observaciones_<?= $datos->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="OBSERVACIÓN ANTIGUA" class="input input__text inputmodal input_modificado" name="txtobservaciones_antigua" value="<?= trim($datos->observaciones) ?>" readonly>
                    </div>



                    <!-- -------------------------------------------- -->

                    <div id="contenedor_responsable_manual_<?= $datos_actual->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="RESPONSABLE DE CAPTURA" class="input input__text inputmodal_ineditable input_modificado" name="txtresponsable_manual" autocomplete="off" value="<?= trim($datos_actual->responsable_manual) ?>" readonly>

                    </div>

                    <div id="contenedor_responsable_manual_<?= $datos->id_control_manuales ?>" class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="RESPONSABLE DE CAPTURA" class="input input__text inputmodal input_modificado" name="txtresponsable_manual_antigua" autocomplete="off" value="<?= trim($datos->responsable_manual) ?>" readonly>

                    </div>

                    <!-- -------------------------------------------- -->

                    <div class="fl-flex-label mb-4 px-2 col-md-6 campo">

                        <input type="text" placeholder="RESPONSABLE DE MODIFICACION" class="input input__text inputmodal_ineditable" name="txtresponsable_modificacion_actual" autocomplete="off" value="<?= trim($datos_actual->responsable_modificacion) ?>" readonly>

                    </div>


                    <div class="fl-flex-label mb-4 px-2 col-md-6 campo">

                        <input type="text" placeholder="RESPONSABLE DE MODIFICACION" class="input input__text inputmodal_ineditable" name="txtresponsable_modificacion_antigua" autocomplete="off" value="<?= trim($datos->responsable_modificacion) ?>" readonly>

                    </div>




                    <!-- -------------------------------------------- -->

                    <!-- SE REGISTRA QUIEN ES EL RESPONSABLE DE REGRESAR LA MANUAL DEL HISTORICO-------------------- -->

                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6    campo">

                        <input type="text" placeholder="RESPONSABLE DE TRAER DE VUELTA MANUAL" class="input input__text inputmodal_ineditable" name="txtresponsable_historial_regresar_manual" autocomplete="off" value="<?= $_SESSION["nombre"] . " " .  $_SESSION["apellido"] ?>" readonly>

                    </div>




                    <!-- -------------------------------------------- -->


                    <div class="text-right p-3">
                        <!-- <button style="margin-top: 5%;" type="button" class="close " data-dismiss="modal" aria-label="Close">
                            <span style="padding: 5px;" aria-hidden="true"> <i class="fa-solid fa-left-long"></i></span>
                        </button> -->
                        <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                            <span style="padding: 5px;" aria-hidden="true">Cancelar <i class="fa-solid fa-xmark"></i></span>
                        </button>


                        <?php
                        if ($_SESSION['rol'] == 1) { ?>

                            <a data-toggle="modal" data-target="#modal_confirmar_contraseña_manual<?= $datos->id_historial_manuales ?>" style="margin-top: 5%;" class="btn btn-info btn-rounded" data-dismiss="modal" aria-label="Close">Traer de vuelta</a>

                            <!-- <button style="margin-top: 5%;" type="submit" value="ok" name="btnregresar_historico_manual" class="btn btn-info btn-rounded" onclick="return confirm('¿Estás seguro de que deseas modificar el registro?')">Traer de vuelta <i class="fa-solid fa-arrows-rotate"></i></button> -->

                        <?php } else { ?>


                            <p>-</p>

                        <?php } ?>

                    </div>

                    <!-- -------------------------------------------- -->




                    <!-- <div class="fl-flex-label mb-4 px-2 col-12  campo">
                    <input type="password" placeholder="Contrasea" class="input input__text inputmodal" name="txtpassword" >
                  </div> -->


                </form>


            </div>
        </div>
    </div>
</div>


















<!-- MODAL PARA ESCRIBIR CONTRASEÑA ----------------------------------------------------------------------------------->

<div class="modal fade" id="modal_confirmar_contraseña_manual<?= $datos->id_historial_manuales ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">POR FAVOR ESCRIBE TU CONTRASEÑA </h5>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">



                <?php
                $sql_actual = $conexion->query("SELECT * FROM control_manuales WHERE rpu = $datos->rpu");
                $datos_actual = $sql_actual->fetch_object()
                ?>


                <form action="" method="post">


                    <!-- //SE AGREGAN LOS VALORES DE LOS INPUTS QUE TIENEN LA INFORMACION QUE SE MODIFICARA PERO EN HIDDEN PARA QUE NO VUELVAN A APARECER VISUALMENTE -->



                    <div hidden class="fl-flex-label mb-4 px-2 col-6  campo">

                        <input type="text" placeholder="ID" class="input input__text inputmodal input_modificado" name="txtid" value="<?= $datos_actual->id_control_manuales ?>" readonly>
                    </div>

                    <div hidden class="fl-flex-label mb-4 px-2 col-6  campo">

                        <input type="text" placeholder="ID" class="input input__text inputmodal input_modificado" name="txtid_historial" value="<?= $datos->id_historial_manuales ?>" readonly>
                    </div>

                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="RPU" class="input input__text inputmodal_ineditable input_modificado" name="txtrpu" value="<?= $datos->rpu ?>" readonly>
                    </div>



                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input id="txtcuenta<?= $datos->id_control_manuales ?>" type="text" placeholder="CUENTA ANTIGUA" class="input input__text inputmodal input_modificado" name="txtcuenta_antigua" list="cuentaList" autocomplete="off" value="<?= trim($datos->cuenta) ?>" oninput="autocompletarCampos()" readonly>

                    </div>


                    <!-- -------------------------------------------- -->

                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input id="txtciclo<?= $datos->id_control_manuales ?>" type="text" placeholder="CICLO ANTIGUA" class="input input__text inputmodal input_modificado" name="txtciclo_antigua" value="<?= trim($datos->ciclo) ?>" readonly>
                    </div>

                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input id="txtagencia<?= $datos->id_control_manuales ?>" type="text" placeholder="AGENCIA ANTIGUA" class="input input__text inputmodal input_modificado" name="txtagencia_antigua" autocomplete="off" value="<?= trim($datos->agencia) ?>" readonly>

                    </div>

                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="TARIFA ANTIGUA" class="input input__text inputmodal input_modificado" name="txttarifa_antigua" value="<?= trim($datos->tarifa) ?>" readonly>

                    </div>

                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input id="txtidmotivomanual_<?= $datos->id_control_manuales ?>" class="input input__text inputmodal input_modificado" name="txtidmotivomanual_antigua" type="text" placeholder="MOTIVO DE MANUAL ANTIGUA" value="<?= trim($datos->id_motivomanual) ?>" autocomplete="off" readonly>

                    </div>


                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="SIN_USO ANTIGUA" class="input input__text inputmodal input_modificado" name="txtsin_uso_antigua" value="<?= trim($datos->sin_uso) ?>" readonly>
                    </div>

                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="LECTURA MANUAL ANTIGUA" class="input input__text inputmodal input_modificado" name="txtlectura_manual_antigua" onkeypress="return validarNumeros(event)" value="<?= trim($datos->lectura_manual) ?>" readonly>
                    </div>


                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="KWH A RECUPERAR ANTIGUA" class="input input__text inputmodal input_modificado" name="txtkwh_recuperar_antigua" onkeypress="return validarNumeros(event)" value="<?= trim($datos->kwh_recuperar) ?>" readonly>
                    </div>


                    <!-- -------------------------------------------- -->



                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="RESPALDO-MANUAL ANTIGUA" class="input input__text inputmodal input_modificado" name="txtrespaldo_manual_antigua" list="respaldomanualList" autocomplete="off" value="<?= trim($datos->respaldo_man) ?>" readonly>

                    </div>


                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="ORDEN DE SERVICIO ANTIGUA" class="input input__text inputmodal" name="txtno_ordenservicio_antigua" autocomplete="off" value="<?= trim($datos->no_ordenservicio) ?>" readonly>

                    </div>


                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="RPE-AUXILIAR ANTIGUA" class="input input__text inputmodal input_modificado" name="txtrpe_auxiliar_antigua" autocomplete="off" value="<?= trim($datos->rpe_auxiliar) ?>" readonly>

                    </div>


                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="OBSERVACIÓN ANTIGUA" class="input input__text inputmodal input_modificado" name="txtobservaciones_antigua" value="<?= trim($datos->observaciones) ?>" readonly>
                    </div>



                    <!-- -------------------------------------------- -->

                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6   campo">

                        <input type="text" placeholder="RESPONSABLE DE CAPTURA" class="input input__text inputmodal input_modificado" name="txtresponsable_manual_antigua" autocomplete="off" value="<?= trim($datos->responsable_manual) ?>" readonly>

                    </div>

                    <!-- -------------------------------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6 campo">

                        <input type="text" placeholder="RESPONSABLE DE MODIFICACION" class="input input__text inputmodal_ineditable" name="txtresponsable_modificacion_antigua" autocomplete="off" value="<?= trim($datos->responsable_modificacion) ?>" readonly>

                    </div>



                    <!-- -------------------------------------------- -->

                    <!-- SE REGISTRA QUIEN ES EL RESPONSABLE DE REGRESAR LA MANUAL DEL HISTORICO-------------------- -->

                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6    campo">

                        <input type="text" placeholder="RESPONSABLE DE TRAER DE VUELTA MANUAL" class="input input__text inputmodal_ineditable" name="txtresponsable_historial_regresar_manual" autocomplete="off" value="<?= $_SESSION["nombre"] . " " .  $_SESSION["apellido"] ?>" readonly>

                    </div>



                    <!-- -------------------------------------------- -->




                    <!-- ESTE INPUT ES EL MOTIVO POR EL CUAL SE ESTA EDITANDO LA NEGATIVA, EN ESTE CASO SU VALOR ID ES 8 EL CUAL
                    SIGNIFICA QUE SE ESTA REGRESANDO UNA NEGATIVA DESDE EL HISTORIAL -->
                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="MOTIVO DE EDICION DE MANUAL" class="input input__text inputmodal" name="txtmotivo" value="8" readonly>
                    </div>



                    <!-- AHORA SE AGREGA EL INPUT PARA CAMBIAR LA CONTRASEÑA----------- -->
                    <div class="fl-flex-label mb-4 px-2 col-md-12  campo">
                        <input type="password" name="txtverificar_contraseña" placeholder="Por favor <?= $_SESSION["nombre"] ?>, escribe tu contraseña" class="input input__text inputmodal_ineditable" autocomplete="off">

                    </div>

                    <button style="margin-top: 5%;" class="btn btn-info btn-rounded" type="submit" onclick="return confirm('¿Estás seguro de que deseas traer la manual, ubicada en el historial, de regreso?')">Continuar</button>

                    <!-- <a style="margin-top: 5%;" class="btn btn-info btn-rounded" href="historial_negativas.php?id_historial_negativa_regresar=<?= $datos->id_historial_manuales ?>&id_negativas=<?= $datos->id_control_manuales ?>" onclick="return confirm('¿Estás seguro de que deseas modificar el registro?')">Continuar <i class="fa-solid fa-arrows-rotate"></i></a> -->

                </form>


            </div>
        </div>
    </div>
</div>