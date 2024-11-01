<link rel="stylesheet" href="../estiloinicio.css">
<!-- ------------------------------------------MODAL PARA AGREGAR MOTIVOS MANUALES  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->




<div class="modal fade" id="añadirMotivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">AÑADIR MOTIVO MANUAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--Aqui haremos la modificacion de usuario-->
                <form action="" method="post">

                    <p>Administrador: </p>
                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="" class="input input__text inputmodal_ineditable input_modificado" onkeypress="return validarNumeros(event)" name="txtnombre_config" value="<?= $_SESSION["nombre"] . " " . $_SESSION["apellido"] ?>" readonly>
                    </div>

                    <div hidden class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input type="text" placeholder="ID" class="input input__text inputmodal input_modificado" name="txtid" value="<?= $_SESSION["id"]  ?>" readonly>
                    </div>


                    <div class="fl-flex-label mb-4 px-2 col-12  campo">

                        <input id="txtmotivo<?= $_SESSION["id"] ?>" type="text" placeholder="INGRESA NUEVO MOTIVO" autocomplete="off" class="mayuscula campo_motivo input input__text inputmodal input_modificado" name="txtagregar_motivo">
                    </div>

                    <br><br>
                    <p> Por favor ingresa tu contraseña para continuar: </p>

                    <div class="fl-flex-label mb-4 px-2 col-mb-6  campo">

                        <input type="password" placeholder="CONTRASEÑA ADMINISTRADOR " class="txtcontraseña input__text inputmodal input_modificado" autocomplete="new-password" name="txtcontraseña_config">
                    </div>



                    <br>
                    <p class="errorMessage" style="color: red; font-weight:600;"></p>
                    <p class="okMessage" style="color: green; font-weight:600;"></p>

                    <div class="text-right p-3">
                        <button style="margin-top: 5%;" type="submit" value="ok" name="btnregistrar_motivo_manual" class=" submitButton btn btn-primary btn-rounded" disabled onclick="return confirm('¿Estás seguro de que deseas registrar esto?')">
                            Añadir <i class="fa-regular fa-face-flushed"></i>
                        </button>
                        <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                            <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                        </button>
                    </div>





                </form>


            </div>
        </div>
    </div>
</div>








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


<script>
    function mostrarConfirmacion() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Estás seguro de que deseas modificar el registro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2CB073',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Aquí puedes agregar la lógica para modificar el registro
                // Por ejemplo, puedes enviar un formulario o realizar una llamada AJAX
                console.log('Registro modificado');
            }
        });
    }
</script>






<!-- //ANALISIS DE CONTRASEÑA PARA TODOS LOS MODALES -->
<!-- <script>
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
                        errorMessage.textContent = "";
                        okMessage.textContent = `Contraseña correcta <?= $_SESSION["nombre"] ?>, por favor llena todos los campos`;
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
</script> -->