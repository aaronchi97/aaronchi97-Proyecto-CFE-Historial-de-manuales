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

    <h4 class="text-center text-secondery"> REGISTRO MANUAL</h4>

    <!--llamamos al controlador para enviar los datos a la base de datos y 
  en el form tenemos que especificar el metodo POST-->
    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_manual.php";
    ?>

    <section class="row">
        <!--Aqui especificamos el metodo-->
        <form id="formulario_manuales" action="" method="post">

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtrpu" type="text" placeholder="RPU" class="input input__text inputmodal_ineditable" name="txtrpu" autocomplete="off" onkeypress="return validarNumeros(event)">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtcuenta" type="text" placeholder="CUENTA" class="input input__text inputmodal" name="txtcuenta" list="cuentaList" autocomplete="off" oninput="autocompletarCampos()">
                <datalist id="cuentaList"></datalist>
            </div>
            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtciclo" type="text" placeholder="CICLO" class="input input__text inputmodal" name="txtciclo" autocomplete="off" readonly>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtagencia" type="text" placeholder="AGENCIA" class="input input__text inputmodal" name="txtagencia" list="agenciaList" autocomplete="off" readonly>
                <datalist id="agenciaList"></datalist>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="TARIFA" class="input input__text inputmodal" name="txttarifa" list="tarifaList" autocomplete="off">
                <datalist id="tarifaList"></datalist>
            </div>


            <div class="fl-flex-label mb-4 px-2 col-md-4 campo">

                <input id="txtidmotivomanual" class="input input__text inputmodal" name="txtidmotivomanual" type="text" placeholder="MOTIVO DE MANUAL" list="motivosList" autocomplete="off">
                <datalist id="motivosList"></datalist>

            </div>


            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="SIN_USO" class="input input__text inputmodal" name="txtsin_uso" autocomplete="off">
            </div>

            <div id="contenedor_lectura_manual" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="LECTURA MANUAL" class="input input__text inputmodal" name="txtlectura_manual" autocomplete="off" onkeypress="return validarNumeros(event)">

            </div>

            <div id="contenedor_kwh_recuperar" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="KWH A RECUPERAR" class="input input__text inputmodal" name="txtkwh_recuperar" autocomplete="off" onkeypress="return validarNumeros(event)">

            </div>



            <div id="contenedor_txtrpe_auxiliar" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="RPE-AUXILIAR" class="input input__text inputmodal" name="txtrpe_auxiliar" list="rpeauxiliarList" autocomplete="off">
                <datalist id="rpeauxiliarList"></datalist>
            </div>

            <div id="contenedor_observaciones" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="OBSERVACIÓN" class="input input__text inputmodal" name="txtobservaciones" autocomplete="off">
            </div>

            <div id="contenedor_correccion" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="CORRECCIÓN" class="input input__text inputmodal" name="txtcorreccion" autocomplete="off">
            </div>


            <!-- AREA DE EVIDENCIAS------------------------------------------------------------- -->
            <div id="contenedor_respaldo_manual" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="EVIDENCIA RESPALDO-MANUAL" class="input input__text inputmodal" name="txtrespaldo_manual" list="respaldomanualList" autocomplete="off">
                <datalist id="respaldomanualList"></datalist>
            </div>

            <div id="contenedor_no_ordenservicio" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="No. ORDEN DE SERVICIO" class="input input__text inputmodal" name="txtno_ordenservicio" autocomplete="off">

            </div>




            <!-- <div id="contenedor_no_orden" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="EVIDENCIA" class="input input__text inputmodal" name="txtno_orden" autocomplete="off">
            </div> -->



            <!-- CONTINUACION DE REPORTES---------------------------------------------------------------- -->



            <div id="contenedor_responsable_manual" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="RESPONSABLE-MANUAL" class="input input__text inputmodal" name="txtresponsable_manual" list="responsablemanualList" autocomplete="off" value="<?= $_SESSION["nombre"] . " " .  $_SESSION["apellido"] ?>" readonly>
                <datalist id="responsablemanualList"></datalist>
            </div>

            <div id="contenedor_txtestatus" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <select name="txtestatus" class="input input__select inputmodal">

                    <option value=""> SELECCIONA EL MOTIVO </option>
                    <?php
                    $sql_mostrar_motivo_status = $conexion->query(" SELECT *
                                FROM estatus ");
                    while ($datosestatus = $sql_mostrar_motivo_status->fetch_object()) { ?>
                        <option value="<?= $datosestatus->id_estatus ?>"><?= $datosestatus->nombre_estatus ?></option>
                    <?php }
                    ?>

                </select>

            </div>




            <div class="text-right p-3">
                <a style="margin-top: 5%;" href="manuales.php" class="btn btn-secondary btn-rounded">Atras</a>
                <button style="margin-top: 5%;" type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
            </div>

        </form>
    </section>

</div>
</div>
<!-- fin del contenido principal -->




<!-- MANDAR DATOS DATALIST A TRAVES DE UN AJAX A MIS INPUTS------------------ -->
<script>
    $(document).ready(function() {
        $.getJSON("funciones_ajax/busquedas_manuales.php", function(data) {
            var existingOptions = {};

            // Manejar datos de id_motivomanual
            $('#motivosList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.motivo, function(key, val) {
                if (!existingOptions[val]) {
                    $('#motivosList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });

            // Manejar datos de cuenta
            $('#cuentaList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.cuenta, function(key, val) {
                if (!existingOptions[val]) {
                    $('#cuentaList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });

            // Manejar datos de respaldo
            $('#respaldomanualList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.respaldo, function(key, val) {
                if (!existingOptions[val]) {
                    $('#respaldomanualList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });

            // Manejar datos de RPE auxiliar
            $('#rpeauxiliarList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.rpeauxiliar, function(key, val) {
                if (!existingOptions[val]) {
                    $('#rpeauxiliarList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });




            // // Manejar datos de responsable de la manual
            // $.each(data.responsablemanual, function(key, val) {
            //     console.log(val);
            //     $('#responsablemanualList').append("<option value='" + val.nombre + ' ' + val.apellido + "' />");
            // });


            // $.each(data.responsablemanual2, function(key, val) {
            //     console.log(val);
            //     $('#responsablemanualList').append("<option value='" + val + "' />");
            // });

            // $.each(data.rpeauxiliar, function(key, val) {
            //     console.log(val);
            //     $('#responsablemanualList').append("<option value='" + val + "' />");
            // });





            // Manejar datos de responsable de la agencia
            $('#agenciaList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.agencia, function(key, val) {
                if (!existingOptions[val]) {
                    $('#agenciaList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });



            // Manejar datos de responsable de la tarifa
            $('#tarifaList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.tarifa, function(key, val) {
                if (!existingOptions[val]) {
                    $('#tarifaList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });





            //NUEVOS MOTIVOS ESPECIFICOS POR TABLAS ESPECIFICAS---------------------------------------------------------------------------------------------------



            // Manejar datos de id_motivomanual
            $('#motivosList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.motivo_tabla, function(key, val) {
                if (!existingOptions[val]) {
                    $('#motivosList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });


            // Manejar datos de cuenta
            $('#cuentaList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.cuenta_tabla, function(key, val) {
                if (!existingOptions[val]) {
                    $('#cuentaList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });


            // Manejar datos de respaldo
            $('#respaldomanualList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.respaldo_tabla, function(key, val) {
                if (!existingOptions[val]) {
                    $('#respaldomanualList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });

            // Manejar datos de RPE auxiliar
            $('#rpeauxiliarList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.rpeauxiliar_tabla, function(key, val) {
                if (!existingOptions[val]) {
                    $('#rpeauxiliarList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });










        });



    });
</script>


<!-- //EVITAR ESPACIOS ANTES DE ESCRIBIR TEXTO EN LOS INPUTS -->

<script>
    function evitarEspacios(event) {
        // Obtener el valor actual del input
        var valorInput = event.target.value;

        // Verificar si la tecla presionada es un espacio y no hay texto en el input
        if (event.key === ' ' && valorInput.trim() === '') {
            // Evitar la acción por defecto (en este caso, la inserción del espacio)
            event.preventDefault();
        }
    }

    // Obtener todos los elementos con la clase 'miInput' y asignar el evento a cada uno
    var inputs = document.querySelectorAll('.input');
    inputs.forEach(function(input) {
        input.addEventListener('keydown', evitarEspacios);
    });
</script>



<!-- FUNCION PARA SOLO PERMITIR NUMEROS EN MIS INPUTS EN ESPECIFICO -->
<!-- Función para validar la entrada y permitir solo números -->
<script>
    function validarNumeros(e) {
        // Obtener el código de la tecla presionada
        let codigoTecla = e.which ? e.which : e.keyCode;

        // Permitir teclas de control como Enter, Backspace y Delete
        if (codigoTecla == 13 || codigoTecla == 8 || codigoTecla == 46) {
            return true;
        }

        // Verificar si la tecla presionada es un número o el símbolo diagonal "/"
        if ((codigoTecla < 48 || codigoTecla > 57) && codigoTecla != 47) {
            e.preventDefault();
        }
    }
</script>



<!-- //SCRIPT PARA AUTOLLENAR INPUTS CON LA INFORMACION DE LA CUENTA -->

<script>
    function autocompletarCampos() {
        var cuentaValue = document.getElementById('txtcuenta').value.trim();

        // Obtener los primeros dígitos numéricos
        var digitosNumericos = cuentaValue.match(/^\d+/);
        var cicloValue = digitosNumericos ? digitosNumericos[0] : '';
        console.log('Ciclo Value:', cicloValue);

        // Establecer el valor en txtciclo
        var txtciclo = document.getElementById('txtciclo');
        if (txtciclo) {
            txtciclo.value = cicloValue || '';
        }

        // Obtener la última letra antes de los últimos dígitos numéricos
        var ultimaLetra = cuentaValue.match(/[a-zA-Z](?=\d+$)/);
        var agenciaValue = ultimaLetra ? ultimaLetra[0] : '';
        console.log('Agencia Value:', agenciaValue);

        // Establecer el valor en txtagencia
        var txtagencia = document.getElementById('txtagencia');
        if (txtagencia) {
            txtagencia.value = agenciaValue || '';
        }
    }
</script>

<!-- 
SCRIPT PARA ACTIVAR INPUTS SEGUN SEA EL CASO POR MOTIVO DE MANUALES.--------------------------------------------- -->


<script>
    $(document).ready(function() {
        // Función para ocultar todos los contenedores bajo 'LECTURA MANUAL'
        function ocultarContenedoresLecturaManual() {
            $('#contenedor_kwh_recuperar, #contenedor_respaldo_manual, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus, #contenedor_txtrpe_auxiliar, #contenedor_correccion, #contenedor_lectura_manual').hide();
        }

        // Función para mostrar los contenedores según el motivo seleccionado
        function mostrarContenedoresSegunMotivo(motivo) {
            ocultarContenedoresLecturaManual(); // Ocultar todos los contenedores primero



            // Limpia los campos al cambiar el motivo para que no haya mezclas entre datos añadidos por el motivo
            limpiarCampos();

            // Mostrar contenedores según el motivo seleccionado
            switch (motivo) {
                case 'ERROR EN TOMA DE LECTURA':
                    $('#contenedor_lectura_manual, #contenedor_txtrpe_auxiliar, #contenedor_respaldo_manual, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus, #contenedor_respaldo_manual').show();
                    break;
                case 'LECTURA DE RETIRO':
                    $('#contenedor_lectura_manual, #contenedor_kwh_recuperar, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus').show();
                    break;
                    // Agrega más 
                case 'ESTIMACION EN CERO CON ANOMALIA':
                    $('#contenedor_lectura_manual, #contenedor_kwh_recuperar, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus, #contenedor_respaldo_manual').show();
                    break;
                case 'MEDIDOR SIN RETROALIMENTAR':
                    $('#contenedor_lectura_manual, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus').show();
                    break;

                    //de aqui abajo todos tienen la misma funcion
                case 'MEDIDOR DESPROGRAMADO':
                    $('#contenedor_lectura_manual, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus, #contenedor_respaldo_manual').show();
                    break;
                case 'ANOMALIA SIN ATENCION':
                    $('#contenedor_lectura_manual, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus, #contenedor_respaldo_manual').show();
                    break;
                case 'MEDIDOR QUITAPON':
                    $('#contenedor_lectura_manual, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus, #contenedor_respaldo_manual').show();
                    break;
                case 'LECTURA ACUMULADA':
                    $('#contenedor_lectura_manual, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus, #contenedor_respaldo_manual').show();
                    break;
                case 'ERROR LOTE 23NU':
                    $('#contenedor_lectura_manual, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus, #contenedor_respaldo_manual').show();
                    break;
                case 'MEDIDOR INTERIOR':
                    $('#contenedor_lectura_manual, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus, #contenedor_respaldo_manual').show();
                    break;
                case 'ERROR LECTURA TELEMEDIDA':
                    $('#contenedor_lectura_manual, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus, #contenedor_respaldo_manual').show();
                    break;
                case 'CORRECCION DEMANDA Y/O FP':
                    $('#contenedor_lectura_manual, #contenedor_observaciones, #contenedor_responsable_manual, #contenedor_txtestatus, #contenedor_respaldo_manual').show();
                    break;

            }
        }


        // Función para limpiar los campos
        function limpiarCampos() {
            // Agrega aquí las líneas para limpiar los campos específicos que deseas
            $('input[name="txtno_ordenservicio"]').val(null);
            $('input[name="txtrespaldo_manual"]').val(null);
            $('input[name="txtkwh_recuperar"]').val(null);
            $('input[name="txtlectura_manual"]').val(null);
            $('input[name="txtrpe_auxiliar"]').val(null);


        }


        // Función para verificar campos vacíos
        function verificarCamposVacios(inputs) {
            var camposVacios = [];

            // Verificar cada input
            inputs.forEach(function(inputSelector) {
                var input = $(inputSelector);
                if (input.val().trim() === '') {
                    camposVacios.push(input.attr('name'));
                }
            });

            // Mostrar advertencia si hay campos vacíos
            if (camposVacios.length > 0) {
                alert('Advertencia: Los siguientes campos están vacíos: ' + camposVacios.join(', '));
            }
        }





        // Asigna un evento al input 'txtidmotivomanual'
        $('#txtidmotivomanual').on('input', function() {
            var motivoSeleccionado = $(this).val();
            mostrarContenedoresSegunMotivo(motivoSeleccionado);
        });



        // Ocultar contenedores al cargar la página
        ocultarContenedoresLecturaManual();
    });
</script>

<!-- 
SCRIPT PARA ACTIVAR INPUTS SEGUN SEA EL CASO POR MOTIVO DE MANUALES.--------------------------------------------- -->


<script>
    $(document).ready(function() {
        // Función para ocultar todos los contenedores bajo 'LECTURA MANUAL'
        function ocultarContenedoresEvidenciaManual() {
            $('#contenedor_no_ordenservicio').hide();
        }

        // Función para mostrar los contenedores según el motivo seleccionado
        function mostrarContenedoresSegunEvidencia(motivo_evidencia) {
            ocultarContenedoresEvidenciaManual(); // Ocultar todos los contenedores primero




            // Mostrar contenedores según el motivo seleccionado
            switch (motivo_evidencia) {
                case 'ORDEN DE SERVICIO':
                    $('#contenedor_no_ordenservicio').show();
                    break;
            }
        }




        // Asigna un evento al input 'txtrespaldo_manual'
        $('input[name="txtrespaldo_manual"]').on('input', function() {
            var motivoSeleccionado_evidencia = $(this).val();
            mostrarContenedoresSegunEvidencia(motivoSeleccionado_evidencia);
        });

        // Ocultar contenedores al cargar la página
        ocultarContenedoresEvidenciaManual();
    });
</script>



<!-- CONVERTIR EN MAYUSCULAS TODOS LOS INPUTS EN DONDE PUEDA ESCRIBIR -->

<script>
    // Función para convertir el texto a mayúsculas
    function convertirAMayusculas(event) {
        var input = event.target;
        input.value = input.value.toUpperCase();
    }

    // Obtener todos los elementos con la clase 'input' y asignar el evento a cada uno
    var inputs = document.querySelectorAll('.input');
    inputs.forEach(function(input) {
        input.addEventListener('input', convertirAMayusculas);
    });
</script>








<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>