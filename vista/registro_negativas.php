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

                <input type="text" placeholder="RPU" class="input input__text inputmodal_ineditable" name="txtrpu" autocomplete="on">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="CUENTA" class="input input__text inputmodal" name="txtcuenta" list="cuentaList" autocomplete="off">
                <datalist id="cuentaList"></datalist>
            </div>
            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="CICLO" class="input input__text inputmodal" name="txtciclo" autocomplete="off" onkeypress="return validarNumeros(event)">
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

                <input type="text" placeholder="AA_MM" class="input input__text inputmodal" name="txtaa_mm" list="aammList" autocomplete="off" onkeypress="return validarNumeros(event)">
                <datalist id="aammList"></datalist>
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
                <a href="negativas.php" class="btn btn-secondary btn-rounded">Atras</a>
                <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
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
            // Manejar datos de justificacion de negativa
            $.each(data.justificacion, function(key, val) {
                console.log(val);
                $('#justiList').append("<option value='" + val + "' />");
            });

            // Manejar datos de cuenta
            $.each(data.cuenta, function(key, val) {
                console.log(val);
                $('#cuentaList').append("<option value='" + val + "' />");
            });

            // Manejar datos de medidor
            $.each(data.medidor, function(key, val) {
                console.log(val);
                $('#medidorList').append("<option value='" + val + "' />");
            });

            // Manejar datos de aa_mm 
            $.each(data.aamm, function(key, val) {
                console.log(val);
                $('#aammList').append("<option value='" + val + "' />");
            });

            // Manejar datos de la tarifa
            $.each(data.tarifa, function(key, val) {
                console.log(val);
                $('#tarifaList').append("<option value='" + val + "' />");
            });

            // Manejar datos de responsable del tipo de medidor
            $.each(data.tipo_medidor, function(key, val) {
                console.log(val);
                $('#tipo_medidorList').append("<option value='" + val + "' />");
            });




            // Manejar datos de responsable de la negativa basandose de los datos del usuario
            $.each(data.responsablenegativa, function(key, val) {
                console.log(val);
                $('#responsablenegativaList').append("<option value='" + val.nombre + ' ' + val.apellido + "' />");
            });

            // Manejar datos de responsable de la negativa basandose de la tabla control_negativas
            $.each(data.responsablenegativa2, function(key, val) {
                console.log(val);
                $('#responsablenegativaList').append("<option value='" + val + "' />");
            });

            // Manejar datos de responsable de la negativa basandose de los rpe auxiliares

            $.each(data.rpeauxiliar, function(key, val) {
                console.log(val);
                $('#responsablenegativaList').append("<option value='" + val + "' />");
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









<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>