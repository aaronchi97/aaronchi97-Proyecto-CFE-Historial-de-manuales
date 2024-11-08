<!-- MODAL PARA HACER COMPARACIONES DE HISTORICOS DE NEGATIVAS, SE COMPARA CUALQUIER HISTORICO CON LA NEGATIVA ACTUAL ----------------------------------------------------------------------------------->

<div class="modal fade" id="modal_comparacion_negativas_historial<?= $datos->id_historial_negativas  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">COMPARATIVA RPU: <span style="color: orange;"> <?= $datos->rpu ?> </span>, MODIFICACIÓN: <span style="color: orange;"> <?= $datos->responsable_modificacion ?> </span> </h5>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <?php
                $sql_actual = $conexion->query("SELECT * FROM control_negativas WHERE rpu = $datos->rpu");
                $datos_actual = $sql_actual->fetch_object();

                $id_antiguo = $datos->id_historial_negativas;

                //CONSULTA PARA OBETENER TODOS LOS DATOS DEL REGISTRO HISTORICO QUE EL USUARIO SELECCIONE (ES DECIR LA INFO ANTIGUA)
                // $sql_info_antiguas =  $conexion->query("SELECT * FROM historial_negativas WHERE id_historial_negativas = $datos->id_historial_negativas ");
                // $datos_antiguos = $sql_actual->fetch_object();
                ?>

                <!-- AQUI PONDREMOS LOS INPUTS PARA COMPARAR--------------- -->

                <form action="" method="post">
                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="ID" class="input input__text inputmodal_ineditable" name="txtid" value=" <?= $datos_actual->id_control_negativas ?>" readonly>
                    </div>

                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="ID" class="input input__text inputmodal_ineditable" name="txtid_antigua" value=" <?= $datos->id_historial_negativas ?>" readonly>
                    </div>

                    <!-- -------------------------------------------- -->

                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="RPU ACTUAL" class="input input__text inputmodal" name="txtrpu" value="<?= $datos->rpu ?>" readonly>
                    </div>

                    <!-- -------------------------------------------- -->


                    <!-- ESTE INPUT ES EL MOTIVO POR EL CUAL SE ESTA EDITANDO LA NEGATIVA, EN ESTE CASO SU VALOR ID ES 8 EL CUAL
                    SIGNIFICA QUE SE ESTA REGRESANDO UNA NEGATIVA DESDE EL HISTORIAL -->
                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="MOTIVO DE EDICION DE NEGATIVA" class="input input__text inputmodal" name="txtmotivo" value="8" readonly>
                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input id="txtcuenta<?= $datos_actual->id_control_negativas ?>" type="text" placeholder="CUENTA ACTUAL" class="input input__text inputmodal_ineditable" name="txtcuenta" value="<?= $datos_actual->cuenta ?>" autocomplete="off" readonly>

                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input id="txtcuenta<?= $datos->id_control_negativas ?>" type="text" placeholder="CUENTA ANTIGUO" class="input input__text inputmodal" name="txtcuenta_antigua" value="<?= $datos->cuenta ?>" autocomplete="off" readonly>

                    </div>

                    <!-- -------------------------------------------- -->

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input id="txtciclo<?= $datos_actual->id_control_negativas ?>" type="text" placeholder="CICLO ACTUAL" class="input input__text inputmodal_ineditable" name="txtciclo" value="<?= $datos_actual->ciclo ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input id="txtciclo<?= $datos->id_control_negativas ?>" type="text" placeholder="CICLO ANTIGUO" class="input input__text inputmodal" name="txtciclo_antigua" value="<?= $datos->ciclo ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input id="txtagencia<?= $datos_actual->id_control_negativas ?>" type="text" placeholder="AGENCIA ACTUAL" class="input input__text inputmodal_ineditable" name="txtagencia" value="<?= $datos_actual->agencia ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input id="txtagencia<?= $datos->id_control_negativas ?>" type="text" placeholder="AGENCIA ANTIGUO" class="input input__text inputmodal" name="txtagencia_antigua" value="<?= $datos->agencia ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <!-- -------------------------------------------- -->



                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="TARIFA ACTUAL" class="input input__text inputmodal_ineditable" name="txttarifa" value="<?= $datos_actual->tarifa ?>" autocomplete="off" readonly>

                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="TARIFA ANTIGUO" class="input input__text inputmodal" name="txttarifa_antigua" value="<?= $datos->tarifa ?>" autocomplete="off" readonly>

                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="MEDIDOR ACTUAL" class="input input__text inputmodal_ineditable" name="txtmedidor" value="<?= $datos_actual->medidor ?>" autocomplete="off" readonly>

                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="MEDIDOR ANTIGUO" class="input input__text inputmodal" name="txtmedidor_antigua" value="<?= $datos->medidor ?>" autocomplete="off" readonly>

                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="AA_MM ACTUAL" class="input input__text inputmodal_ineditable" name="txtaa_mm" value="<?= $datos_actual->aa_mm ?>" autocomplete="off" maxlength="4" onkeypress="return validarFecha(event)" readonly>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="AA_MM ANTIGUO" class="input input__text inputmodal" name="txtaa_mm_antigua" value="<?= $datos->aa_mm ?>" autocomplete="off" maxlength="4" onkeypress="return validarFecha(event)" readonly>
                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="TIPO-MEDIDOR ACTUAL" class="input input__text inputmodal_ineditable" name="txttipo_medidor" value="<?= $datos_actual->tipo_medidor ?>" autocomplete="off" readonly>

                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="TIPO-MEDIDOR ANTIGUO" class="input input__text inputmodal" name="txttipo_medidor_antigua" value="<?= $datos->tipo_medidor ?>" autocomplete="off" readonly>

                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="CVE ACTUAL" class="input input__text inputmodal_ineditable" name="txtcve" value="<?= $datos_actual->cve ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="CVE ANTIGUO" class="input input__text inputmodal" name="txtcve_antigua" value="<?= $datos->cve ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="DICE ACTUAL" class="input input__text inputmodal_ineditable" name="txtdice" value="<?= $datos_actual->dice ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="DICE ANTIGUO" class="input input__text inputmodal" name="txtdice_antigua" value="<?= $datos->dice ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="DEBE DECIR ACTUAL" class="input input__text inputmodal_ineditable" name="txtdebe_decir" value="<?= $datos_actual->debe_decir ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="DEBE DECIR ANTIGUO" class="input input__text inputmodal" name="txtdebe_decir_antigua" value="<?= $datos->debe_decir ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="KWH A RECUPERAR ACTUAL" class="input input__text inputmodal_ineditable" name="txtkwh_recuperar" value="<?= $datos_actual->kwh_recuperar ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="KWH A RECUPERAR ANTIGUO" class="input input__text inputmodal" name="txtkwh_recuperar_antigua" value="<?= $datos->kwh_recuperar ?>" autocomplete="off" onkeypress="return validarNumeros(event)" readonly>
                    </div>

                    <!-- -------------------------------------------- -->



                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="RESPALDO ACTUAL" class="input input__text inputmodal_ineditable" name="txtid_justificacionnegativa" value="<?= $datos_actual->id_justificacionnegativas ?>" autocomplete="off" readonly>

                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="RESPALDO ANTIGUO" class="input input__text inputmodal" name="txtid_justificacionnegativa_antigua" value="<?= $datos->id_justificacionnegativas ?>" autocomplete="off" readonly>

                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="MOTIVO ACTUAL" class="input input__text inputmodal_ineditable" name="txtmotivo_correccion" value="<?= $datos_actual->motivo_correccion ?>" autocomplete="off" readonly>

                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="MOTIVO ANTIGUO" class="input input__text inputmodal" name="txtmotivo_correccion_antigua" value="<?= $datos->motivo_correccion ?>" autocomplete="off" readonly>

                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="RPE-AUXILIAR ACTUAL" class="input input__text inputmodal_ineditable" name="txtrpe_auxiliar" value="<?= $datos_actual->rpe_auxiliar ?>" autocomplete="off" readonly>

                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="RPE-AUXILIAR ANTIGUO" class="input input__text inputmodal" name="txtrpe_auxiliar_antigua" value="<?= $datos->rpe_auxiliar ?>" autocomplete="off" readonly>

                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="OBSERVACIÓN ACTUAL" class="input input__text inputmodal_ineditable" name="txtobservaciones" value="<?= $datos_actual->observaciones ?>" autocomplete="off" readonly>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="OBSERVACIÓN ANTIGUO" class="input input__text inputmodal" name="txtobservaciones_antigua" value="<?= $datos->observaciones ?>" autocomplete="off" readonly>
                    </div>

                    <!-- -------------------------------------------- -->


                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="RESPONSABLE DE CAPTURA ACTUAL" class="input input__text inputmodal_ineditable" name="txtresponsable_negativa" value="<?= $datos_actual->responsable_negativa ?>" autocomplete="off" readonly>
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="RESPONSABLE DE CAPTURA ANTIGUO" class="input input__text inputmodal" name="txtresponsable_negativa_antigua" value="<?= $datos->responsable_negativa ?>" autocomplete="off" readonly>
                    </div>

                    <!-- -------------------------------------------- -->

                    <!-- SE REGISTRA QUIEN ES EL RESPONSABLE DE REGRESAR LA NEGATIVA DEL HISTORICO-------------------- -->


                    <div hidden class="fl-flex-label mb-4 px-2 col-md-6  campo">

                        <input type="text" placeholder="RESPONSABLE DE TRAER DE VUELTA NEGATIVA" class="input input__text inputmodal_ineditable" name="txtresponsable_historial_regresar_negativa" value="<?= $_SESSION["nombre"] . " " .  $_SESSION["apellido"] ?>" autocomplete="off" readonly>
                    </div>

                    <!-- -------------------------------------------- -->














                    <div class="text-right p-3">




                        <?php
                        if ($_SESSION['rol'] == 1) { ?>

                            <div class="fl-flex-label mb-4 px-2 col-md-12    campo">
                                <input type="password" placeholder="Por favor <?= $_SESSION["nombre"] ?>, ingresa contraseña" class=" txtcontraseña input input__text " name="txtverificar_contraseña">
                            </div>

                            <p class="errorMessage" style="color: red; font-weight:600;"></p>
                            <p class="okMessage" style="color: green; font-weight:600;"></p>

                        <?php } else { ?>


                            <p>-</p>

                        <?php } ?>

                        <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                            <span style="padding: 5px;" aria-hidden="true">Cancelar <i class="fa-solid fa-xmark"></i></span>
                        </button>

                        <?php
                        if ($_SESSION['rol'] == 1) { ?>




                            <button style="margin-top: 5%;" class=" submitButton btn btn-info btn-rounded" type="submit" disabled onclick="return confirm('¿Estás seguro de que deseas modificar el registro?')">Continuar</button>




                        <?php } else { ?>


                            <p>-</p>

                        <?php } ?>

                    </div>

                </form>


            </div>
        </div>
    </div>
</div>

<!-- //ANALISIS DE CONTRASEÑA PARA TODOS LOS MODALES-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const correctPassword = "<?php echo addslashes($_SESSION['contraseña']); ?>";

        // Obtener todas las referencias usando clases en lugar de IDs
        const passwordInputs = document.querySelectorAll(".txtcontraseña");
        // const camposMotivoInputs = document.querySelectorAll(".campo_motivo");
        const submitButtons = document.querySelectorAll(".submitButton");
        const errorMessages = document.querySelectorAll(".errorMessage");
        const okMessages = document.querySelectorAll(".okMessage");

        // Iterar sobre cada input de contraseña para agregar listeners
        passwordInputs.forEach(function(passwordInput, index) {
            // const campoMotivoInput = camposMotivoInputs[index];
            const submitButton = submitButtons[index];
            const errorMessage = errorMessages[index];
            const okMessage = okMessages[index];

            const validateInputs = function() {
                const inputPassword = passwordInput.value;


                if (inputPassword === correctPassword) {
                    submitButton.disabled = false;
                    errorMessage.textContent = "";
                    okMessage.textContent = `Correcto <?= $_SESSION["nombre"] ?>, puedes continuar`;
                } else {
                    submitButton.disabled = true;
                    if (inputPassword.length > 0 && inputPassword !== correctPassword) {
                        errorMessage.textContent = "Contraseña Incorrecta";
                        okMessage.textContent = "";

                    } else {
                        errorMessage.textContent = "";
                        okMessage.textContent = "";
                    }
                }
            };

            passwordInput.addEventListener("input", validateInputs);
            // campoMotivoInput.addEventListener("input", validateInputs);
        });





        // LIMPIAR CAMPOS DEL MODAL -------------------------------------------------------------
        $('[id^="añadir"]').on('hidden.bs.modal', function() {

            $(this).find('.submitButton').prop('disabled', true); // Deshabilita el botón de submit nuevamente dentro del modal actual
            $(this).find('.errorMessage').text(""); // Limpia el mensaje de error dentro del modal actual
            $(this).find('.okMessage').text("");

        });
    });
</script>