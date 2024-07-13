<!-- slect2 -->
<!-- <link rel="stylesheet" href="../select2/css/select2.css">
<script src="../select2/js/select2.js"></script> -->



<script src="../public/bootstrap5/js/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
</script>


<script src="../public/app/publico/js/lib/jquery/jquery.min.js">
</script>
<script src="../public/app/publico/js/lib/tether/tether.min.js">
</script>
<script src="../public/app/publico/js/lib/bootstrap/bootstrap.min.js">
</script>
<script src="../public/app/publico/js/plugins.js">
</script>

<!-- datatables -->
<script src="../public/app/publico/js/lib/datatables-net/datatables.min.js"></script>


<!-- Google maps -->
<script type="module" src="https://unpkg.com/@googlemaps/extended-component-library@0.6"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDB1ZAbXIPoh9I7pTh_AwFveGiyAUn_xEc&libraries=places"></script>
<script type="module" src="./index.js"></script>





<!-- sweet alert -->
<script src="../public/sweet/js/sweetalert2.js"></script>
<script src="../public/sweet/js/sweet.js"></script>


<!-- <script>
    $(function() {
        $('#example').DataTable({
            select: {
                //style: 'multi'
            },
            responsive: true,
            pageLength: 15,
            // responsive: false,
            "ordering": false, // Desactiva el ordenamiento predeterminado 
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Lo siento <?= $_SESSION["nombre"] ?> <?= $_SESSION["apellido"] ?>, no hay datos disponibles",
                "sInfo": "Registros del _START_ al _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Registros del 0 al 0 de 0 registros",
                "sInfoFiltered": "-",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
            }
        });
    });
</script>
 -->

<script>
    let table;
    let responsiveEnabled = true; // Estado inicial de la opción responsive

    $(document).ready(function() {
        // Inicializar la tabla con el estado inicial de responsive
        table = $('#example').DataTable({
            responsive: responsiveEnabled,
            pageLength: 15,
            ordering: false, // Desactiva el ordenamiento predeterminado 
            language: {
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ registros",
                sZeroRecords: "No se encontraron resultados",
                sEmptyTable: "Lo siento <?= $_SESSION["nombre"] ?> <?= $_SESSION["apellido"] ?>, no hay datos disponibles",
                sInfo: "Registros del _START_ al _END_ de _TOTAL_ registros",
                sInfoEmpty: "Registros del 0 al 0 de 0 registros",
                sInfoFiltered: "-",
                sInfoPostFix: "",
                sSearch: "Buscar:",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: "Cargando...",
                oPaginate: {
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: "Siguiente",
                    sPrevious: "Anterior"
                },
                oAria: {
                    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                    sSortDescending: ": Activar para ordenar la columna de manera descendente"
                },
                buttons: {
                    copy: "Copiar",
                    colvis: "Visibilidad"
                }
            }
        });

        // Manejar el clic en el botón para alternar el estado de responsive
        $('#toggleResponsive').on('click', function() {
            responsiveEnabled = !responsiveEnabled;
            table.destroy(); // Destruir la tabla actual
            table = $('#example').DataTable({
                responsive: responsiveEnabled ? true : null, // Alternar el estado de responsive
                pageLength: 15,
                ordering: false, // Desactiva el ordenamiento predeterminado 
                language: {
                    sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Lo siento <?= $_SESSION["nombre"] ?> <?= $_SESSION["apellido"] ?>, no hay datos disponibles",
                    sInfo: "Registros del _START_ al _END_ de _TOTAL_ registros",
                    sInfoEmpty: "Registros del 0 al 0 de 0 registros",
                    sInfoFiltered: "-",
                    sInfoPostFix: "",
                    sSearch: "Buscar:",
                    sUrl: "",
                    sInfoThousands: ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior"
                    },
                    oAria: {
                        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending: ": Activar para ordenar la columna de manera descendente"
                    },
                    buttons: {
                        copy: "Copiar",
                        colvis: "Visibilidad"
                    }
                }
            });
        });
    });
</script>



<script type="text/javascript" src="../public/app/publico/js/lib/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript" src="../public/app/publico/js/lib/lobipanel/lobipanel.min.js"></script>
<script type="text/javascript" src="../public/app/publico/js/lib/match-height/jquery.matchHeight.min.js">
</script>
<script type="text/javascript" src="../public/loader/loader.js"></script>

<script>
    $(document).ready(function() {

        $('.panel').lobiPanel({
            sortable: true
        });
        $('.panel').on('dragged.lobiPanel', function(ev, lobiPanel) {
            $('.dahsboard-column').matchHeight();
        });

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn('string', 'Day');
            dataTable.addColumn('number', 'Values');
            // A column for custom tooltip content
            dataTable.addColumn({
                type: 'string',
                role: 'tooltip',
                'p': {
                    'html': true
                }
            });
            dataTable.addRows([
                ['MON', 130, ' '],
                ['TUE', 130, '130'],
                ['WED', 180, '180'],
                ['THU', 175, '175'],
                ['FRI', 200, '200'],
                ['SAT', 170, '170'],
                ['SUN', 250, '250'],
                ['MON', 220, '220'],
                ['TUE', 220, ' ']
            ]);

            var options = {
                height: 314,
                legend: 'none',
                areaOpacity: 0.18,
                axisTitlesPosition: 'out',
                hAxis: {
                    title: '',
                    textStyle: {
                        color: '#fff',
                        fontName: 'Proxima Nova',
                        fontSize: 11,
                        bold: true,
                        italic: false
                    },
                    textPosition: 'out'
                },
                vAxis: {
                    minValue: 0,
                    textPosition: 'out',
                    textStyle: {
                        color: '#fff',
                        fontName: 'Proxima Nova',
                        fontSize: 11,
                        bold: true,
                        italic: false
                    },
                    baselineColor: '#16b4fc',
                    ticks: [0, 25, 50, 75, 100, 125, 150, 175, 200, 225, 250, 275, 300, 325, 350],
                    gridlines: {
                        color: '#1ba0fc',
                        count: 15
                    }
                },
                lineWidth: 2,
                colors: ['#fff'],
                curveType: 'function',
                pointSize: 5,
                pointShapeType: 'circle',
                pointFillColor: '#f00',
                backgroundColor: {
                    fill: '#008ffb',
                    strokeWidth: 0,
                },
                chartArea: {
                    left: 0,
                    top: 0,
                    width: '100%',
                    height: '100%'
                },
                fontSize: 11,
                fontName: 'Proxima Nova',
                tooltip: {
                    trigger: 'selection',
                    isHtml: true
                }
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(dataTable, options);
        }
        $(window).resize(function() {
            drawChart();
            setTimeout(function() {}, 1000);
        });
    });
</script>
<script src="../public/app/publico/js/app.js">
</script>

<script src="../public/app/publico/js/lib/jquery-flex-label/jquery.flex.label.js"></script>

<script type="application/javascript">
    (function($) {
        $(document).ready(function() {
            $('.fl-flex-label').flexLabel();
        });
    })(jQuery);
</script>

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.select-motivo').select2();
    });
</script>








</body>

</html>