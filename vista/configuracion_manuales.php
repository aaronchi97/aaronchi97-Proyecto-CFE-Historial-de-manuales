<?php

session_start();
//si el nombre y apellido estan vacios entonces redirigelos a la pagina de login.php
//esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
//lo compias y lo pegas desde el inicio entonces no te dejara, hasta que pongas un usuario valido
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header("location:login/login.php");
}

?>

<style>
    ul li:nth-child(1) .activo {
        background: #598b6b !important;
    }
</style>

<!-- Crear el metodo advertencia para el boton de eliminar registro -->
<!-- <script>
    function advertencia() {
        var not = confirm("¿Estas seguro de eliminar el registro?");
        return not;
    }
 </script> -->



<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>






<!-- inicio del contenido principal -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="estiloinicio.css">
<div class="page-content">

    <h4 style="margin-bottom: 5%;" class="text-center text-secondery"> CONFIGURACIÓN MANUALES</h4>

    <?php
    //hacemos la conexion
    include "../modelo/conexion.php";

    include "../controlador/control-estadisticos/controlador_buscar_fecha_manual.php";
    include "../controlador/control-configuracion/controlador_agregar_cuenta.php";
    include "../controlador/control-configuracion/controlador_agregar_motivo.php";
    include "../controlador/control-configuracion/controlador_agregar_respaldo.php";
    include "../controlador/control-configuracion/controlador_agregar_rpe.php";
    ?>


    <!-- ------------------------------------------------BOTONES PARA MODALES POR BUSQUEDAS DE FILTROS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->



    <a data-toggle="modal" data-target="#añadirMotivo" class="btn-reportes-configuracion ">AÑADIR MOTIVO<i class="fa-solid fa-file-signature"></i></a>

    <a data-toggle="modal" data-target="#añadirRespaldo" class="btn-reportes-configuracion ">AÑADIR RESPALDO <i class="fa-solid fa-shield-dog"></i></a>

    <a data-toggle="modal" data-target="#añadirCuenta" class="btn-reportes-configuracion ">AÑADIR CUENTA <i class="fa-solid fa-address-book"></i></a>

    <a data-toggle="modal" data-target="#añadirRPE" class="btn-reportes-configuracion ">AÑADIR RPE <i class="fa-solid fa-person-circle-plus"></i></a>


    <!-- //SE AGREGAN LOS INCLUD PARA OBTENER LOS MODALES DE CADA OPCION-->
    <?php
    include "modales/modal_configuracion/modal_agregar_motivo.php";
    include "modales/modal_configuracion/modal_agregar_respaldo.php";
    include "modales/modal_configuracion/modal_agregar_cuenta.php";
    include "modales/modal_configuracion/modal_agregar_rpe.php";
    ?>



    <!-- //ANALISIS DE CONTRASEÑA PARA TODOS LOS MODALES-->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const correctPassword = "<?php echo addslashes($_SESSION['contraseña']); ?>";

            // Obtener todas las referencias usando clases en lugar de IDs
            const passwordInputs = document.querySelectorAll(".txtcontraseña");
            const camposMotivoInputs = document.querySelectorAll(".campo_motivo");
            const submitButtons = document.querySelectorAll(".submitButton");
            const errorMessages = document.querySelectorAll(".errorMessage");
            const okMessages = document.querySelectorAll(".okMessage");

            // Iterar sobre cada input de contraseña para agregar listeners
            passwordInputs.forEach(function(passwordInput, index) {
                const campoMotivoInput = camposMotivoInputs[index];
                const submitButton = submitButtons[index];
                const errorMessage = errorMessages[index];
                const okMessage = okMessages[index];

                const validateInputs = function() {
                    const inputPassword = passwordInput.value;
                    const motivoCampoValue = campoMotivoInput.value;

                    if (inputPassword === correctPassword && motivoCampoValue.trim() !== "") {
                        submitButton.disabled = false;
                        errorMessage.textContent = "";
                        okMessage.textContent = `Correcto <?= $_SESSION["nombre"] ?>, puedes continuar`;
                    } else {
                        submitButton.disabled = true;
                        if (inputPassword.length > 0 && inputPassword !== correctPassword) {
                            errorMessage.textContent = "Contraseña Incorrecta";
                            okMessage.textContent = "";
                        } else if (inputPassword === correctPassword && motivoCampoValue.trim() === "") {
                            errorMessage.textContent = "Por favor <?= $_SESSION["nombre"] ?>, llena todos los campos";
                            okMessage.textContent = `Contraseña correcta`;
                        } else {
                            errorMessage.textContent = "";
                            okMessage.textContent = "";
                        }
                    }
                };

                passwordInput.addEventListener("input", validateInputs);
                campoMotivoInput.addEventListener("input", validateInputs);
            });





            // LIMPIAR CAMPOS DEL MODAL -------------------------------------------------------------
            $('[id^="añadir"]').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset(); // Resetea el formulario dentro del modal actual
                $(this).find('.submitButton').prop('disabled', true); // Deshabilita el botón de submit nuevamente dentro del modal actual
                $(this).find('.errorMessage').text(""); // Limpia el mensaje de error dentro del modal actual
                $(this).find('.okMessage').text("");
                $(this).find('.campo_motivo').text(""); // Limpia el mensaje de exito dentro del modal actual
            });
        });
    </script>




    <!-- por ultimo se carga el footer -->
    <?php require('./layout/footer.php'); ?>