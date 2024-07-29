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


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDB1ZAbXIPoh9I7pTh_AwFveGiyAUn_xEc&libraries=places"></script>

</script>

</script>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<link rel="stylesheet" href="estiloinicio.css">
<div class="page-content">

    <h4 class="text-center text-secondery"> REGISTRO DE EMPLAZAMIENTOS</h4>

    <!--llamamos al controlador para enviar los datos a la base de datos y 
  en el form tenemos que especificar el metodo POST-->
    <?php
    include "../modelo/conexion.php";
    // include "../controlador/controlador_registrar_manual.php";
    include "../controlador/control-emplazamientos/controlador_registrar_emplazamiento.php";





    $id_manual_obtenido_xemplazamiento = $_GET['id_manual_xemplazamiento'];

    $sql_emplazameinto = $conexion->query("SELECT * FROM control_manuales WHERE control_manuales.id_control_manuales = ' $id_manual_obtenido_xemplazamiento'  ");
    $datos_emplazamiento = $sql_emplazameinto->fetch_object();

    ?>






    <!-- 
//TENGO QUE OBTENER EL VALOR DEL ID DE LA MANUAL-------------------- -->




    <section class="row">
        <!--Aqui especificamos el metodo-->
        <form action="" method="post" id="miFormulario">

            <div hidden class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtid_manual" type="text" placeholder="RPU" class="input input__text inputmodal_ineditable" name="txtid_manual" autocomplete="off" readonly value="<?= trim($datos_emplazamiento->id_control_manuales) ?>">
            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtrpu" type="text" placeholder="RPU" class="input input__text inputmodal_ineditable" name="txtrpu" autocomplete="off" readonly value="<?= trim($datos_emplazamiento->rpu) ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtcuenta" type="text" placeholder="CUENTA" class="input input__text inputmodal_ineditable" name="txtcuenta" autocomplete="off" readonly value="<?= trim($datos_emplazamiento->cuenta) ?>">

            </div>



            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtagencia" type="text" placeholder="AGENCIA" class="input input__text inputmodal_ineditable" name="txtagencia" autocomplete="off" readonly value="<?= trim($datos_emplazamiento->agencia) ?>">

            </div>

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input id="txtciclo" type="text" placeholder="CICLO" class="input input__text inputmodal_ineditable" name="txtciclo" autocomplete="off" readonly value="<?= trim($datos_emplazamiento->ciclo) ?>">
            </div>




            <!-- ------------------------------------------------------ -->

            <div class="fl-flex-label mb-4 px-2 col-md-4 campo">

                <input id="txtnombre" class="input input__text inputmodal" name="txtnombre" type="text" placeholder="NOMBRE" autocomplete="off">


            </div>

            <!-- ------------------------------------------------------ -->

            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">
                <input type="text" name="txtdireccion" id="autocomplete-input" class="input input__text inputmodal" placeholder="DIRECCIÓN" autocomplete="off">
            </div>
            <!-- <script>
                ({
                    key: "AIzaSyDB1ZAbXIPoh9I7pTh_AwFveGiyAUn_xEc",
                    v: "beta"
                });
            </script> -->


            <!-- 
            <gmpx-api-loader key="AIzaSyDB1ZAbXIPoh9I7pTh_AwFveGiyAUn_xEc" solution-channel="GMP_GE_placepicker_v1">
            </gmpx-api-loader>
            <div id="place-picker-box" class="fl-flex-label mb-4 px-2 col-md-4 campo">
                <div class="input input__text inputmodal" autocomplete="off">
                    <gmpx-place-picker placeholder="DIRECCIÓN" autocomplete="off"></gmpx-place-picker>
                </div>
            </div> -->



            <!-- ------------------------------------------------------ -->
            <div class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="MEDIDOR" class="input input__text inputmodal" name="txtmedidor" list="medidorList" autocomplete="off">
                <datalist id="medidorList"></datalist>
            </div>

            <!-- ------------------------------------------------------ -->
            <!-- <div id="contenedor_georeferencia" class="fl-flex-label mb-4 px-2 col-md-4 campo">
                <input type="text" id="georeferencia" placeholder="GEOREFERENCIA" class="input input__text inputmodal" name="txtgeoreferencia" autocomplete="off">
            </div> -->
            <div id="contenedor_georeferencia" class="fl-flex-label mb-4 px-2 col-md-4 campo">
                <input type="text" id="input-latlng" class="input input__text inputmodal" name="txtgeoreferencia" placeholder="GEOREFERENCIA">
            </div>
            <!-- ------------------------------------------------------ -->
            <div id="contenedor_dias" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="DÍAS" class="input input__text inputmodal" name="txtdias" autocomplete="off" onkeypress="return validarNumeros(event)">

            </div>

            <div id="contenedor_correccion" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="CORRECCIÓN" class="input input__text inputmodal" name="txtcorreccion" autocomplete="off">
            </div>

            <div id="contenedor_fecha_emplazamiento" class="fl-flex-label mb-4 px-2 col-md-4 campo">

                <input type="date" placeholder="FECHA" class="input input__text inputmodal" name="txtfecha_emplazamiento" autocomplete="off" id="fecha_emplazamiento">
            </div>


            <div hidden id="contenedor_impresion" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="IMPRESIÓN" class="input input__text inputmodal" name="txtimpresion" autocomplete="off">

            </div>





            <!-- CONTINUACION DE REPORTES---------------------------------------------------------------- -->



            <div id="contenedor_responsable_emplazamiento" class="fl-flex-label mb-4 px-2 col-md-4  campo">

                <input type="text" placeholder="RESPONSABLE EMPLAZAMIENTO" class="input input__text inputmodal" name="txtresponsable_emplazamiento" autocomplete="off" value="<?= $_SESSION["nombre"] . " " .  $_SESSION["apellido"] ?>" readonly>

            </div>



            <!-- ESTE DIV MUESTRA LA INFORMACIÓN DE LA DIRECCION SELECCIONADA-------------------------------------------------- -->
            <!-- <div id="place-details">
                <p id="selected-place-title">Selected Place:</p>
                <p id="selected-place-name"></p>
                <p id="selected-place-address"></p>
                <p>Latitud: <span id="latitude"></span></p>
                <p>Longitud: <span id="longitude"></span></p>
            </div> -->









            <div class="text-right p-3">
                <a style="margin-top: 5%; margin-bottom: 3%;" href="manuales.php" class="btn btn-secondary btn-rounded">ATRÁS</a>
                <button style="margin-top: 5%; margin-bottom: 3%;" type="submit" value="ok" name="btnregistrar" class="btn btn-warning btn-rounded">GENERAR</button>
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


        });


    });





    //BUSQUEDA PARA INFO DE NEGATIVAS
    $(document).ready(function() {
        $.getJSON("funciones_ajax/busquedas_negativas.php", function(data) {
            var existingOptions = {};

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





<!-- SCRIPT PARA LLENAR CAMPO DE TEXTO CON LA FECHA ACTUAL DEL SISTEMA -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let today = new Date();
        let day = ("0" + today.getDate()).slice(-2);
        let month = ("0" + (today.getMonth() + 1)).slice(-2);
        let date = today.getFullYear() + "-" + month + "-" + day;
        document.getElementById('fecha_emplazamiento').value = date;
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


<script>
    // Función para inicializar Autocomplete
    function initAutocomplete() {
        // Seleccionar el campo de entrada
        const input = document.getElementById('autocomplete-input');

        // Configurar Autocomplete
        const autocomplete = new google.maps.places.Autocomplete(input);

        // Evento cuando se selecciona un lugar
        autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                console.error("El lugar seleccionado no tiene detalles de geometría");
                return;
            }

            // Mostrar detalles del lugar seleccionado
            const latLng = `${place.geometry.location.lat()}, ${place.geometry.location.lng()}`;
            document.getElementById('input-latlng').value = latLng;
        });
    }

    // Asegurarse de que la API de Google Maps se ha cargado completamente
    window.onload = function() {
        initAutocomplete();
    };
</script>





<!-- 
<script>
    let map;
    let marker;
    let infoWindow;

    async function initMap() {
        // Request needed libraries.
        //@ts-ignore
        const [{
            Map
        }, {
            AdvancedMarkerElement
        }] = await Promise.all([
            google.maps.importLibrary("maps"),
            google.maps.importLibrary("marker"),
            google.maps.importLibrary("places"),
        ]);

        // Initialize the map.
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 40.749933,
                lng: -73.98633
            },
            zoom: 13,
            mapId: "4504f8b37365c3d0",
            mapTypeControl: false,
        });

        // Create the place autocomplete input
        const placeAutocomplete = new google.maps.places.Autocomplete(
            document.getElementById('place-autocomplete-input'), {
                types: ['geocode']
            }
        );

        // Create the marker and infowindow
        marker = new google.maps.marker.AdvancedMarkerElement({
            map,
        });
        infoWindow = new google.maps.InfoWindow({});

        // Add the place_changed listener, and display the results on the map.
        placeAutocomplete.addListener('place_changed', () => {
            const place = placeAutocomplete.getPlace();

            // If the place has a geometry, then present it on a map.
            if (place.geometry && place.geometry.location) {
                map.fitBounds(place.geometry.viewport);
                map.setCenter(place.geometry.location);
                map.setZoom(17);

                let content =
                    '<div id="infowindow-content">' +
                    '<span id="place-displayname" class="title">' +
                    (place.name || '') +
                    "</span><br />" +
                    '<span id="place-address">' +
                    (place.formatted_address || '') +
                    "</span>" +
                    "</div>";

                updateInfoWindow(content, place.geometry.location);
                marker.position = place.geometry.location;
            }
        });
    }

    // Helper function to create an info window.
    function updateInfoWindow(content, center) {
        infoWindow.setContent(content);
        infoWindow.setPosition(center);
        infoWindow.open({
            map,
            anchor: marker,
            shouldFocus: false,
        });
    }

    window.initMap = initMap;
</script> -->





<!-- <script>
    // Función para inicializar Autocomplete
    function initAutocomplete() {
        // Seleccionar el campo de entrada
        const input = document.getElementById('autocomplete-input');

        // Configurar Autocomplete
        const autocomplete = new google.maps.places.Autocomplete(input);

        // Evento cuando se selecciona un lugar
        autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                console.error("El lugar seleccionado no tiene detalles de geometría");
                return;
            }

            // Mostrar detalles del lugar seleccionado
            const selectedPlaceTitle = document.getElementById('selected-place-title');
            const selectedPlaceName = document.getElementById('selected-place-name');
            const selectedPlaceAddress = document.getElementById('selected-place-address');
            const latitude = document.getElementById('latitude');
            const longitude = document.getElementById('longitude');

            selectedPlaceTitle.textContent = "Selected Place:";
            selectedPlaceName.textContent = place.name;
            selectedPlaceAddress.textContent = place.formatted_address;
            latitude.textContent = place.geometry.location.lat();
            longitude.textContent = place.geometry.location.lng();
        });
    }

    // Inicializar Autocomplete después de que la API de Google Maps se haya cargado
    google.maps.event.addDomListener(window, 'load', initAutocomplete);
</script> -->
















<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>