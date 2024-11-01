<?php

session_start();


if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header("location:login/login.php");
}

?>

<style>
    ul li:nth-child(2) .activo {
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

    <h4 class="text-center text-secondery"> REGISTRO DE NEGATIVA</h4>

    <!--llamamos al controlador para enviar los datos a la base de datos y 
  en el form tenemos que especificar el metodo POST-->
    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_negativa.php";
    ?>

    <section class="row">
        <!--Aqui especificamos el metodo-->
        <form action="" method="post">

            <!-- INPUTS PARA REGSTRAR NEGATIVAS NUEVAS ---------------------- -->



            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="RPU" class="input input__text inputmodal_ineditable" name="txtrpu" autocomplete="on" onkeypress="return validarNumeros(event)">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtcuenta" type="text" placeholder="CUENTA" class="input input__text inputmodal" name="txtcuenta" list="cuentaList" autocomplete="off" oninput="autocompletarCampos()">
                <datalist id="cuentaList"></datalist>
            </div>
            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtciclo" type="text" placeholder="CICLO" class="input input__text inputmodal" name="txtciclo" autocomplete="off" readonly>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtagencia" type="text" placeholder="AGENCIA" class="input input__text inputmodal" name="txtagencia" autocomplete="off" readonly>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="TARIFA" class="input input__text inputmodal" name="txttarifa" list="tarifaList" autocomplete="off">
                <datalist id="tarifaList"></datalist>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="MEDIDOR" class="input input__text inputmodal" name="txtmedidor" list="medidorList" autocomplete="off">
                <datalist id="medidorList"></datalist>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="AA_MM (año-mes)" class="input input__text inputmodal" name="txtaa_mm" list="aammList" autocomplete="off" maxlength="4" onkeypress="return validarFecha(event)">
                <!-- <datalist id="aammList"></datalist> -->
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="TIPO-MEDIDOR" class="input input__text inputmodal" name="txttipo_medidor" list="tipo_medidorList" autocomplete="off">
                <datalist id="tipo_medidorList"></datalist>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="CVE" class="input input__text inputmodal" name="txtcve" onkeypress="return validarNumeros(event)">
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="DICE" class="input input__text inputmodal" name="txtdice" onkeypress="return validarNumeros(event)">
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="DEBE DECIR" class="input input__text inputmodal" name="txtdebe_decir" autocomplete="off" onkeypress="return validarNumeros(event)">
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="KWH A RECUPERAR" class="input input__text inputmodal" name="txtkwh_recuperar" autocomplete="off" onkeypress="return validarNumeros(event)">
            </div>




            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="OBSERVACIÓN" class="input input__text inputmodal" name="txtobservaciones" autocomplete="on">
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="JUSTIFICACION" class="input input__text inputmodal" name="txtid_justificacionnegativa" list="justiList" autocomplete="off">
                <datalist id="justiList"></datalist>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" list="MotivoCorreccionList" placeholder="MOTIVO DE CORRECCION" class="input input__text inputmodal" name="txtmotivo_correccion" autocomplete="off">
                <datalist id="MotivoCorreccionList"></datalist>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="RPE-AUXILIAR" class="input input__text inputmodal" name="txtrpe_auxiliar" list="rpeauxiliarList" autocomplete="off">
                <datalist id="rpeauxiliarList"></datalist>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="RESPONSABLE DE CAPTURA" class="input input__text inputmodal" name="txtresponsable_negativa" value="<?= $_SESSION["nombre"] . " " .  $_SESSION["apellido"] ?>" autocomplete="off" list="responsablemanualList" readonly>
                <datalist id="responsablemanualList"></datalist>
            </div>


            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <select name="txtestatus" class="input input__select inputmodal">

                    <option value=""> SELECCIONA EL MOTIVO </option>
                    <?php
                    $sql_mostrar_motivo_status = $conexion->query(" SELECT * FROM estatus ");
                    while ($datosestatus = $sql_mostrar_motivo_status->fetch_object()) { ?>
                        <option value="<?= $datosestatus->id_estatus ?>"><?= $datosestatus->nombre_estatus ?></option>
                    <?php }
                    ?>

                </select>

            </div>




            <div class="text-right p-3">
                <a style="margin-top: 5%;" href="negativas.php" class="btn btn-secondary btn-rounded">Atras</a>
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
        $.getJSON("funciones_ajax/busquedas_negativas.php", function(data) {
            var existingOptions = {};

            // Manejar datos de justificacion de negativa
            $('#justiList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.respaldo_negativas, function(key, val) {
                if (!existingOptions[val]) {
                    $('#justiList').append("<option value='" + val + "' />");
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

            // Manejar datos de medidor
            $('#medidorList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.medidor, function(key, val) {
                if (!existingOptions[val]) {
                    $('#medidorList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });

            // Manejar datos de aa_mm
            $('#aammList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.aamm, function(key, val) {
                if (!existingOptions[val]) {
                    $('#aammList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });

            // // Manejar datos de tarifa
            // $('#tarifaList').find('option').each(function() {
            //     existingOptions[$(this).val()] = true;
            // });
            // $.each(data.tarifa, function(key, val) {
            //     if (!existingOptions[val]) {
            //         $('#tarifaList').append("<option value='" + val + "' />");
            //         existingOptions[val] = true;
            //     }
            // });




            // // Manejar datos de tipo de medidor
            // $('#tipo_medidorList').find('option').each(function() {
            //     existingOptions[$(this).val()] = true;
            // });
            // $.each(data.tipo_medidor, function(key, val) {
            //     if (!existingOptions[val]) {
            //         $('#tipo_medidorList').append("<option value='" + val + "' />");
            //         existingOptions[val] = true;
            //     }
            // });

            // Manejar datos de motivo de correccion
            $('#MotivoCorreccionList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.motivoCorreccion, function(key, val) {
                if (!existingOptions[val]) {
                    $('#MotivoCorreccionList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });





            // // Manejar datos de responsable de la negativa basandose de los datos del usuario
            // $.each(data.responsablenegativa, function(key, val) {
            //     console.log(val);
            //     $('#responsablenegativaList').append("<option value='" + val.nombre + ' ' + val.apellido + "' />");
            // });

            // // Manejar datos de responsable de la negativa basandose de la tabla control_negativas
            // $.each(data.responsablenegativa2, function(key, val) {
            //     console.log(val);
            //     $('#responsablenegativaList').append("<option value='" + val + "' />");
            // });

            // // Manejar datos de responsable de la negativa basandose de los rpe auxiliares

            // $.each(data.rpeauxiliar, function(key, val) {
            //     console.log(val);
            //     $('#responsablenegativaList').append("<option value='" + val + "' />");
            // });






            //NUEVOS AUTOCOMPLETADOS CON TABLAS SIN DEPENDENCIA --------------------------------------------------------------------------------------------------------------


            // Manejar datos de medidor
            $('#medidorList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.medidor_tabla, function(key, val) {
                if (!existingOptions[val]) {
                    $('#medidorList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });


            // Manejar datos de tipo de medidor
            $('#tipo_medidorList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.tipo_medidor_tabla, function(key, val) {
                if (!existingOptions[val]) {
                    $('#tipo_medidorList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });



            // Manejar datos de tarifa
            $('#tarifaList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.tarifa_tabla, function(key, val) {
                if (!existingOptions[val]) {
                    $('#tarifaList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });



        });
    });




    // MANDAR DATOS DATALIST A TRAVES DE UN AJAX A MIS INPUTS EN EL ARCHIVO DE BUSQUEDA MANUALES

    $(document).ready(function() {
        $.getJSON("funciones_ajax/busquedas_manuales.php", function(data) {
            var existingOptions = {};


            // Manejar datos de RPE auxiliar de la tabla control_negativas
            $('#rpeauxiliarList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.rpeauxiliar, function(key, val) {
                if (!existingOptions[val]) {
                    $('#rpeauxiliarList').append("<option value='" + val + "' />");
                    existingOptions[val] = true;
                }
            });

            // Manejar datos de RPE auxiliar directo de la tabla rpe_auxiliar
            $('#rpeauxiliarList').find('option').each(function() {
                existingOptions[$(this).val()] = true;
            });
            $.each(data.rpeauxiliar_tabla, function(key, val) {
                if (!existingOptions[val]) {
                    $('#rpeauxiliarList').append("<option value='" + val + "' />");
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





        });



    });
</script>

<!-- MANDAR DATOS DATALIST A TRAVES DE UN AJAX A MIS INPUTS EN EL ARCHIVO DE BUSQUEDA MANUALES***------------------ -->
<!-- <script>
    $(document).ready(function() {
        $.getJSON("funciones_ajax/busquedas_manuales.php", function(data) {


            // Manejar datos de rpe auxiliar
            $.each(data.rpeauxiliar, function(key, val) {
                console.log(val);
                $('#rpeauxiliarList').append("<option value='" + val + "' />");
            });



        });



    });
</script> -->



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
<script>
    function validarNumeros(e) {
        // Obtener el código de la tecla presionada
        let codigoTecla = e.which ? e.which : e.keyCode;

        // Permitir teclas de control como Enter, Backspace y Delete
        if (codigoTecla == 13 || codigoTecla == 8 || codigoTecla == 46) {
            return true;
        }

        // Verificar si la tecla presionada es un número
        if (codigoTecla < 48 || codigoTecla > 57) {
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






<script>
    function validarFecha(event) {
        // Obtener el código ASCII del caracter ingresado
        var charCode = (event.which) ? event.which : event.keyCode;
        var inputValue = event.target.value;

        // Verificar que solo se ingresen dígitos
        if (charCode < 48 || charCode > 57) {
            return false;
        }

        // Concatenar el nuevo dígito para formar el valor completo del input
        var newValue = inputValue + String.fromCharCode(charCode);

        // Verificar que el valor completo tenga la longitud adecuada
        if (newValue.length > 4) {
            return false;
        }

        // Verificar que los primeros dos dígitos correspondan a un año válido y los últimos dos a un mes válido
        if (newValue.length === 4) {
            var year = parseInt(newValue.slice(0, 2));
            var month = parseInt(newValue.slice(2));

            // Validar que el año esté dentro del rango 00-99 y el mes dentro del rango 01-12
            if ((year < 0 || year > 99) || (month < 1 || month > 12)) {
                return false;
            }
        }

        // Verificar que el tercer dígito sea 0 o 1
        if (newValue.length === 3) {
            var thirdDigit = parseInt(newValue.charAt(2));
            if (thirdDigit !== 0 && thirdDigit !== 1) {
                return false;
            }
        }

        return true;
    }
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