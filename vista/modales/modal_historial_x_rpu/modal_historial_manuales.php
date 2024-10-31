<div class="modal fade" id="modal_historial_negativas_x_rpu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">HISTÓRICO <span style="color: orange;"> RPU </span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-4 px-2 col-6 campo">
                    <input type="number" id="rpuInput" placeholder="ID" class="input input__text inputmodal input_modificado" name="txtbusqueda_historial_manual" required>
                    <div id="error-message" class="text-danger" style="display: none;"></div>
                </div>
                <button id="continuarButton" class="btn-generar-manual"><i class="fa-solid fa-plus"></i> CONTINUAR</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('continuarButton').addEventListener('click', function() {
        const rpu = document.getElementById('rpuInput').value;
        const errorMessage = document.getElementById('error-message');

        // Validar que se haya ingresado un RPU
        if (!rpu) {
            errorMessage.textContent = 'Por favor, ingrese un RPU.';
            errorMessage.style.display = 'block';
            return;
        }

        // Realizar una llamada AJAX para verificar si el RPU existe
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'modal_historial_manuales.php', true); // Cambia 'tu_archivo_actual.php' al nombre de tu archivo
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                if (data.exists) {
                    // Redirigir a la nueva página con el RPU
                    window.location.href = 'historico_general_manuales.php?id_manual_eliminar=' + rpu;
                } else {
                    errorMessage.textContent = 'El RPU ingresado no existe. Intente de nuevo.';
                    errorMessage.style.display = 'block';
                }
            } else {
                console.error('Error en la solicitud AJAX:', xhr.statusText);
            }
        };

        xhr.send('rpu=' + encodeURIComponent(rpu));
    });
</script>

<?php
// Conectar a la base de datos
//hacemos la conexion
include "../../../modelo/conexion.php";

// Verificar si se recibió una solicitud AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rpu'])) {
    $rpu = $_POST['rpu'];
    $response = ['exists' => false];

    if ($rpu) {
        $query = $pdo->prepare("SELECT COUNT(*) FROM historial_manuales WHERE rpu = :rpu");
        $query->execute([':rpu' => $rpu]);
        $count = $query->fetchColumn();

        if ($count > 0) {
            $response['exists'] = true;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Asegúrate de salir después de procesar la solicitud AJAX
}
?>