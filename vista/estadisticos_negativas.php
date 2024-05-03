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

    <h4 style="margin-bottom: 5%;" class="text-center text-secondery">ESTADÍSTICOS NEGATIVAS</h4>

    <?php
    //hacemos la conexion
    include "../modelo/conexion.php";
    include "../controlador/control-estadisticos/controlador_buscar_fecha_manual.php";
    //   include "../controlador/controlador_modificar_manual.php";
    // include "../controlador/controlador_eliminar_usuario.php";




    ?>

    <label style="margin-bottom: 2%;" for="">Hola <span class="nombres-usuarios-negativas"><?= $_SESSION["nombre"] ?></span>, por favor selecciona acorde a tus necesidades:</label>



    <section class="portfolio-experiment">
        <a data-toggle="modal" data-target="#fechaModal">
            <span class="text">POR FECHA
                <i class="fa-solid fa-calendar-days" style="color: #14b1ff"></i></span>
            <span class="line -right"></span>
            <span class="line -top"></span>
            <span class="line -left"></span>
            <span class="line -bottom"></span>
        </a>


        <a data-toggle="modal" data-target="#atendidasModal">
            <span class="text">ATENDIDAS
                <i class="fa-solid fa-calendar-days" style="color: #a2ee72"></i></span>
            <span class="line -right"></span>
            <span class="line -top"></span>
            <span class="line -left"></span>
            <span class="line -bottom"></span>
        </a>

        <a data-toggle="modal" data-target="#desatendidasModal">
            <span class="text">PENDIENTES
                <i class="fa-solid fa-calendar-days" style="color: #ff6213"></i></span>
            <span class="line -right"></span>
            <span class="line -top"></span>
            <span class="line -left"></span>
            <span class="line -bottom"></span>
        </a>

        <a data-toggle="modal" data-target="#resumenGeneralModal">
            <span class="text">RESUMEN GENERAL
                <i class="fa-solid fa-calendar-days" style="color: #fbff14"></i></span>
            <span class="line -right"></span>
            <span class="line -top"></span>
            <span class="line -left"></span>
            <span class="line -bottom"></span>
        </a>
    </section>








    <!-- AREA DE MODALES -------------------------------------------------------------------------------------------------------------------------------------------- -->

    <div class="modal fade" style="width: 90%;" id="fechaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 140%;">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title w-100" id="exampleModalLabel"><img src="data:image/png;base64,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">
                        SELECCIONA UNA FECHA </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--SELECCION POR FECHAS-->


                    <form class="fechas" method="post">

                        <div>
                            <label><input type="checkbox" name="opciones" value="fecha_personalizada"> Buscar por fecha personalizada</label>
                            <label><input type="checkbox" name="opciones" value="ver_mes"> Ver por mes</label>
                            <label><input type="checkbox" name="opciones" value="ver_semestre"> Ver por semestre</label>
                            <label><input type="checkbox" name="opciones" value="ver_anio"> Ver por año</label>
                        </div>


                        <!-- Bloques de código -->
                        <div class="opciones-container fecha_personalizada" style="display: none;">

                            <div class="fl-flex-label mb-4 px-2 col-md-6">
                                <label for="fechaInicio">Fecha de Inicio:</label>
                                <input class="input input__text" type="date" id="fechaInicio" name="fechaInicio">
                            </div>


                            <div class="fl-flex-label mb-4 px-2 col-md-6">
                                <label for="fechaFin">Fecha de Fin:</label>
                                <input type="date" id="fechaFin" name="fechaFin" class="input input__text">
                            </div>

                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxfecha" class="btn btn-primary btn-rounded">Asignar</button>
                                <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>
                        </div>

                        <div class="opciones-container ver_mes" style="display: none;">
                            <!-- Código para Ver por mes -->
                            <div class="fl-flex-label mb-4 px-2 col-10">
                                <label>Selecciona mes y año: </label>
                                <input class="input input__text" type="month" name="fecha_1mes">
                            </div>
                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxfecha" class="btn btn-primary btn-rounded">Asignar</button>
                                <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>
                        </div>

                        <div class="opciones-container ver_semestre" style="display: none;">
                            <!-- Código para Ver por semestre -->
                            <div class="fl-flex-label mb-4 px-2 col-12">
                                <label>Selecciona mes y año inicial: </label>
                                <input class="input input__text" type="month" id="fecha_semestral" name="fecha_6meses">
                                <input hidden type="month" id="sextomes" name="sextomes">
                            </div>
                            <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxfecha" class="btn btn-primary btn-rounded" onclick="calcularMeses()">Asignar</button>
                            <a style="margin-top: 5%;" href="estadisticos_nagativas.php" class="btn btn-danger btn-rounded">Cancelar</a>
                        </div>

                        <div class="opciones-container ver_anio" style="display: none;">
                            <!-- Código para Ver por año -->
                            <div class="fl-flex-label mb-4 px-2 col-12">
                                <label>Selecciona mes y año inicial: </label>
                                <input class="input input__text" type="month" id="fecha_anual" name="fecha_anio">
                                <input hidden type="month" id="mesdoce" name="mes_doce">
                            </div>


                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxfecha" class="btn btn-primary btn-rounded" onclick="calcularAnio()">Asignar</button>
                                <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>
                        </div>



                    </form>



                </div>
            </div>
        </div>
    </div>




    <!-- MODAL PARA BOTON ATENDIDAS ----------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade" style="width: 90%;" id="atendidasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 140%;">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title w-100" id="exampleModalLabel"><img src="data:image/png;base64,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">
                        SELECCIONA UNA FECHA </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--SELECCION POR FECHAS-->


                    <form class="fechas" method="post">

                        <div>
                            <label><input type="checkbox" name="opciones" value="fecha_personalizada_atendidas"> Buscar por fecha personalizada</label>
                            <label><input type="checkbox" name="opciones" value="ver_mes_atendidas"> Ver por mes</label>
                            <label><input type="checkbox" name="opciones" value="ver_semestre_atendidas"> Ver por semestre</label>
                            <label><input type="checkbox" name="opciones" value="ver_anio_atendidas"> Ver por año</label>
                            <label><input type="checkbox" name="opciones" value="ver_todas_atendidas"> Ver todas</label>
                        </div>


                        <!-- Bloques de código -->
                        <div class="opciones-container fecha_personalizada_atendidas" style="display: none;">

                            <div class="fl-flex-label mb-4 px-2 col-md-6">
                                <label for="fechaInicio">Fecha de Inicio:</label>
                                <input class="input input__text" type="date" id="fechaInicio" name="fechaInicio">
                            </div>


                            <div class="fl-flex-label mb-4 px-2 col-md-6">
                                <label for="fechaFin">Fecha de Fin:</label>
                                <input type="date" id="fechaFin" name="fechaFin" class="input input__text">
                            </div>

                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxatendidas" class="btn btn-primary btn-rounded">Asignar</button>
                                <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>


                        </div>

                        <div class="opciones-container ver_mes_atendidas" style="display: none;">
                            <!-- Código para Ver por mes -->
                            <div class="fl-flex-label mb-4 px-2 col-10">
                                <label>Selecciona mes y año: </label>
                                <input class="input input__text" type="month" name="fecha_1mes">
                            </div>
                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxatendidas" class="btn btn-primary btn-rounded">Asignar</button>
                                <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>
                        </div>


                        <div class="opciones-container ver_semestre_atendidas" style="display: none;">
                            <!-- Código para Ver por semestre -->
                            <div class="fl-flex-label mb-4 px-2 col-12">
                                <label>Selecciona mes y año inicial: </label>
                                <input class="input input__text" type="month" id="fecha_semestral_atendidas" name="fecha_6meses">
                                <input hidden type="month" id="sextomes_atendidas" name="sextomes">
                            </div>
                            <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxatendidas" class="btn btn-primary btn-rounded" onclick="calcularMesesAtendidas()">Asignar</button>
                            <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>
                        </div>



                        <div class="opciones-container ver_anio_atendidas" style="display: none;">
                            <!-- Código para Ver por año -->
                            <div class="fl-flex-label mb-4 px-2 col-12">
                                <label>Selecciona mes y año inicial: </label>
                                <input class="input input__text" type="month" id="fecha_anual_atendidas" name="fecha_anio">
                                <input hidden type="month" id="mesdoce_atendidas" name="mes_doce">
                            </div>


                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" style="margin-top: 5%;" type="submit" value="ok" name="btn_verxatendidas" class="btn btn-primary btn-rounded" onclick="calcularAnioAtendidas()">Asignar</button>
                                <a style="margin-top: 5%;" style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>
                        </div>

                        <div class="opciones-container ver_todas_atendidas" style="display: none;">

                            <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxatendidas" class="btn btn-primary btn-rounded">Continuar</button>

                        </div>



                    </form>



                </div>
            </div>
        </div>
    </div>





    <!-- MODAL PARA BOTON NOOO ATENDIDAS ----------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade" style="width: 90%;" id="desatendidasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 140%;">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title w-100" id="exampleModalLabel"><img src="data:image/png;base64,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">
                        SELECCIONA UNA FECHA </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--SELECCION POR FECHAS-->


                    <form class="fechas" method="post">

                        <div>
                            <label><input type="checkbox" name="opciones" value="fecha_personalizada_desatendidas"> Buscar por fecha personalizada</label>
                            <label><input type="checkbox" name="opciones" value="ver_mes_desatendidas"> Ver por mes</label>
                            <label><input type="checkbox" name="opciones" value="ver_semestre_desatendidas"> Ver por semestre</label>
                            <label><input type="checkbox" name="opciones" value="ver_anio_desatendidas"> Ver por año</label>
                            <label><input type="checkbox" name="opciones" value="ver_todas_desatendidas"> Ver todas</label>
                        </div>


                        <!-- Bloques de código -->
                        <div class="opciones-container fecha_personalizada_desatendidas" style="display: none;">

                            <div class="fl-flex-label mb-4 px-2 col-md-6">
                                <label for="fechaInicio">Fecha de Inicio:</label>
                                <input class="input input__text" type="date" id="fechaInicio" name="fechaInicio">
                            </div>


                            <div class="fl-flex-label mb-4 px-2 col-md-6">
                                <label for="fechaFin">Fecha de Fin:</label>
                                <input type="date" id="fechaFin" name="fechaFin" class="input input__text">
                            </div>

                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdesatendidas" class="btn btn-primary btn-rounded">Asignar</button>
                                <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>


                        </div>

                        <div class="opciones-container ver_mes_desatendidas" style="display: none;">
                            <!-- Código para Ver por mes -->
                            <div class="fl-flex-label mb-4 px-2 col-10">
                                <label>Selecciona mes y año: </label>
                                <input class="input input__text" type="month" name="fecha_1mes">
                            </div>
                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdesatendidas" class="btn btn-primary btn-rounded">Asignar</button>
                                <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>
                        </div>


                        <div class="opciones-container ver_semestre_desatendidas" style="display: none;">
                            <!-- Código para Ver por semestre -->
                            <div class="fl-flex-label mb-4 px-2 col-12">
                                <label>Selecciona mes y año inicial: </label>
                                <input class="input input__text" type="month" id="fecha_semestral_desatendidas" name="fecha_6meses">
                                <input hidden type="month" id="sextomes_desatendidas" name="sextomes">
                            </div>
                            <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdesatendidas" class="btn btn-primary btn-rounded" onclick="calcularMesesDesatendidas()">Asignar</button>
                            <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>
                        </div>



                        <div class="opciones-container ver_anio_desatendidas" style="display: none;">
                            <!-- Código para Ver por año -->
                            <div class="fl-flex-label mb-4 px-2 col-12">
                                <label>Selecciona mes y año inicial: </label>
                                <input class="input input__text" type="month" id="fecha_anual_desatendidas" name="fecha_anio">
                                <input hidden type="month" id="mesdoce_desatendidas" name="mes_doce">
                            </div>


                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdesatendidas" class="btn btn-primary btn-rounded" onclick="calcularAnioDesatendidas()">Asignar</button>
                                <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>
                        </div>

                        <div class="opciones-container ver_todas_desatendidas" style="display: none;">

                            <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdesatendidas" class="btn btn-primary btn-rounded">Continuar</button>

                        </div>



                    </form>



                </div>
            </div>
        </div>
    </div>




    <!-- MODAL PARA RESUMEN GENERAL ----------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade" style="width: 90%;" id="resumenGeneralModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 140%;">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title w-100" id="exampleModalLabel"><img src="data:image/png;base64,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">
                        SELECCIONA UNA FECHA </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--SELECCION POR FECHAS-->


                    <form class="fechas" method="post">

                        <div>
                            <label><input type="checkbox" name="opciones" value="fecha_personalizada_resumen"> Buscar por fecha personalizada</label>
                            <label><input type="checkbox" name="opciones" value="ver_mes_resumen"> Ver por mes</label>
                            <label><input type="checkbox" name="opciones" value="ver_semestre_resumen"> Ver por semestre</label>
                            <label><input type="checkbox" name="opciones" value="ver_anio_resumen"> Ver por año</label>
                            <label><input type="checkbox" name="opciones" value="ver_todas_resumen"> Ver todas</label>
                        </div>


                        <!-- Bloques de código -->
                        <div class="opciones-container fecha_personalizada_resumen" style="display: none;">

                            <div class="fl-flex-label mb-4 px-2 col-md-6">
                                <label for="fechaInicio">Fecha de Inicio:</label>
                                <input class="input input__text" type="date" id="fechaInicio" name="fechaInicio">
                            </div>


                            <div class="fl-flex-label mb-4 px-2 col-md-6">
                                <label for="fechaFin">Fecha de Fin:</label>
                                <input type="date" id="fechaFin" name="fechaFin" class="input input__text">
                            </div>

                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxresumen" class="btn btn-primary btn-rounded">Asignar</button>
                                <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>


                        </div>

                        <div class="opciones-container ver_mes_resumen" style="display: none;">
                            <!-- Código para Ver por mes -->
                            <div class="fl-flex-label mb-4 px-2 col-10">
                                <label>Selecciona mes y año: </label>
                                <input class="input input__text" type="month" name="fecha_1mes">
                            </div>
                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxresumen" class="btn btn-primary btn-rounded">Asignar</button>
                                <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>
                        </div>


                        <div class="opciones-container ver_semestre_resumen" style="display: none;">
                            <!-- Código para Ver por semestre -->
                            <div class="fl-flex-label mb-4 px-2 col-12">
                                <label>Selecciona mes y año inicial: </label>
                                <input class="input input__text" type="month" id="fecha_semestral_resumen" name="fecha_6meses">
                                <input hidden type="month" id="sextomes_resumen" name="sextomes">
                            </div>
                            <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxresumen" class="btn btn-primary btn-rounded" onclick="calcularMesesResumen()">Asignar</button>
                            <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>
                        </div>



                        <div class="opciones-container ver_anio_resumen" style="display: none;">
                            <!-- Código para Ver por año -->
                            <div class="fl-flex-label mb-4 px-2 col-12">
                                <label>Selecciona mes y año inicial: </label>
                                <input class="input input__text" type="month" id="fecha_anual_resumen" name="fecha_anio">
                                <input hidden type="month" id="mesdoce_resumen" name="mes_doce">
                            </div>


                            <div class="text-center p-3">
                                <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxresumen" class="btn btn-primary btn-rounded" onclick="calcularAnioResumen()">Asignar</button>
                                <a style="margin-top: 5%;" href="estadisticos_negativas.php" class="btn btn-danger btn-rounded">Cancelar</a>

                            </div>
                        </div>

                        <div class="opciones-container ver_todas_resumen" style="display: none;">

                            <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxresumen" class="btn btn-primary btn-rounded">Continuar</button>

                        </div>



                    </form>



                </div>
            </div>
        </div>
    </div>















    <!-- 
    CODIGO PARA BOTON ---POR FECHAS--- REDIRIGIR A LA PAGINA CORRESPONDIENTE SEGUN LA ELECCION DE CHECKON E INPUT------------------------ -->


    <?php
    if (!empty($_POST["btn_verxfecha"])    &&      ((!empty($_POST["fechaInicio"]) && !empty($_POST["fechaFin"])) || (!empty($_POST["fecha_anio"]) && !empty($_POST["mes_doce"]))
        || (!empty($_POST["fecha_6meses"]) && !empty($_POST["sextomes"])) || (!empty($_POST["fecha_1mes"])))) { ?>

        <div style="margin-top: 3%;">
            <!-- <i class="fa-regular fa-circle-check"></i> -->
            <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

                    <rect y="0" width="13" height="50" fill="#1fa2ff">
                        <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
                        <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
                        <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
                    </rect>

                </svg> </h1>


        </div>

        <script>
            setTimeout(function() {
                window.location.href = "busqueda_negativas_fecha.php";
            }, 2000); // Retraso de 1000 milisegundos (1 segundo)
        </script>

        <!-- header("location:../../vista/busqueda_negativas_fecha.php"); -->

    <?php } else if (!empty($_POST["btn_verxatendidas"])    &&      ((!empty($_POST["fechaInicio"]) && !empty($_POST["fechaFin"])) || (!empty($_POST["fecha_anio"])
        && !empty($_POST["mes_doce"])) || (!empty($_POST["fecha_6meses"]) && !empty($_POST["sextomes"])) || (!empty($_POST["fecha_1mes"])))) {

    ?>

        <div style="margin-top: 3%;">
            <!-- <i class="fa-regular fa-circle-check"></i> -->
            <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

                    <rect y="0" width="13" height="50" fill="#1fa2ff">
                        <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
                        <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
                        <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
                    </rect>

                </svg> </h1>


        </div>

        <script>
            setTimeout(function() {
                window.location.href = "negativas_atendidas.php";
            }, 2000); // Retraso de 1000 milisegundos (1 segundo)
        </script>

        <!-- header("location:../../vista/busqueda_negativas_fecha.php"); -->




    <?php } else if (!empty($_POST["btn_verxatendidas"])) { ?>

        <div style="margin-top: 3%;">
            <!-- <i class="fa-regular fa-circle-check"></i> -->
            <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

                    <rect y="0" width="13" height="50" fill="#1fa2ff">
                        <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
                        <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
                        <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
                    </rect>

                </svg> </h1>


        </div>

        <script>
            setTimeout(function() {
                window.location.href = "negativas_atendidas.php";
            }, 2000); // Retraso de 1000 milisegundos (1 segundo)
        </script>

        <!-- header("location:../../vista/busqueda_negativas_fecha.php"); -->


    <?php } else if (!empty($_POST["btn_verxdesatendidas"])    &&      ((!empty($_POST["fechaInicio"]) && !empty($_POST["fechaFin"])) || (!empty($_POST["fecha_anio"])
        && !empty($_POST["mes_doce"])) || (!empty($_POST["fecha_6meses"]) && !empty($_POST["sextomes"])) || (!empty($_POST["fecha_1mes"])))) { ?>

        <div style="margin-top: 3%;">
            <!-- <i class="fa-regular fa-circle-check"></i> -->
            <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

                    <rect y="0" width="13" height="50" fill="#1fa2ff">
                        <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
                        <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
                        <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
                    </rect>

                </svg> </h1>


        </div>

        <script>
            setTimeout(function() {
                window.location.href = "negativas_desatendidas.php";
            }, 2000); // Retraso de 1000 milisegundos (1 segundo)
        </script>

        <!-- header("location:../../vista/busqueda_negativas_fecha.php"); -->

    <?php } else if (!empty($_POST["btn_verxdesatendidas"])) { ?>

        <div style="margin-top: 3%;">
            <!-- <i class="fa-regular fa-circle-check"></i> -->
            <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

                    <rect y="0" width="13" height="50" fill="#1fa2ff">
                        <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
                        <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
                        <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
                    </rect>

                </svg> </h1>


        </div>

        <script>
            setTimeout(function() {
                window.location.href = "negativas_desatendidas.php";
            }, 2000); // Retraso de 1000 milisegundos (1 segundo)
        </script>

        <!-- header("location:../../vista/busqueda_negativas_fecha.php"); -->


    <?php } else if (!empty($_POST["btn_verxresumen"])    &&      ((!empty($_POST["fechaInicio"]) && !empty($_POST["fechaFin"])) || (!empty($_POST["fecha_anio"])
        && !empty($_POST["mes_doce"])) || (!empty($_POST["fecha_6meses"]) && !empty($_POST["sextomes"])) || (!empty($_POST["fecha_1mes"])))) { ?>

        <div style="margin-top: 3%;">
            <!-- <i class="fa-regular fa-circle-check"></i> -->
            <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

                    <rect y="0" width="13" height="50" fill="#1fa2ff">
                        <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
                        <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
                        <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
                    </rect>

                </svg> </h1>


        </div>

        <script>
            setTimeout(function() {
                window.location.href = "resumen_general_negativas.php";
            }, 2000); // Retraso de 1000 milisegundos (1 segundo)
        </script>

        <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->

    <?php } else if (!empty($_POST["btn_verxresumen"])) { ?>

        <div style="margin-top: 3%;">
            <!-- <i class="fa-regular fa-circle-check"></i> -->
            <h1> Listo, espera... <svg width="51px" height="50px" viewBox="0 0 51 50">

                    <rect y="0" width="13" height="50" fill="#1fa2ff">
                        <animate attributeName="height" values="50;10;50" begin="0s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="19" y="0" width="13" height="50" fill="#12d8fa">
                        <animate attributeName="height" values="50;10;50" begin="0.2s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.2s" dur="1s" repeatCount="indefinite" />
                    </rect>

                    <rect x="38" y="0" width="13" height="50" fill="#06ffcb">
                        <animate attributeName="height" values="50;10;50" begin="0.4s" dur="1s" repeatCount="indefinite" />
                        <animate attributeName="y" values="0;20;0" begin="0.4s" dur="1s" repeatCount="indefinite" />
                    </rect>

                </svg> </h1>


        </div>

        <script>
            setTimeout(function() {
                window.location.href = "resumen_general_negativas.php";
            }, 2000); // Retraso de 1000 milisegundos (1 segundo)
        </script>

        <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->


    <?php }
    ?>













    <!-- CALCULAR FECHA CADA 6 MESES-------------------------------- -->

    <script>
        function calcularMeses() {
            var inputFecha = document.getElementById('fecha_semestral');
            var fechaSeleccionada = new Date(inputFecha.value);

            // Obtener el mes y año seleccionado por el usuario
            var mesSeleccionado = fechaSeleccionada.getMonth();
            var annoSeleccionado = fechaSeleccionada.getFullYear();

            // Calcular el mes después de 6 meses
            var nuevoMes = (mesSeleccionado + 6) % 12; // Utiliza el operador de módulo para manejar el cambio de año
            var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 6) / 12);

            // Formatear el resultado
            var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

            // Asignar el valor al input oculto
            document.getElementById('sextomes').value = resultado;

            // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
            console.log("Fecha después de 6 meses: " + resultado);
        }
    </script>


    <!-- CALCULAR FECHA POR AÑO --------------------------------  -->

    <script>
        function calcularAnio() {
            var inputFecha = document.getElementById('fecha_anual');
            var fechaSeleccionada = new Date(inputFecha.value);

            // Obtener el mes y año seleccionado por el usuario
            var mesSeleccionado = fechaSeleccionada.getMonth();
            var annoSeleccionado = fechaSeleccionada.getFullYear();

            // Calcular el mes después de 6 meses
            var nuevoMes = (mesSeleccionado + 13) % 12; // Utiliza el operador de módulo para manejar el cambio de año
            var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 13) / 12);

            // Formatear el resultado
            var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

            // Asignar el valor al input oculto
            document.getElementById('mesdoce').value = resultado;

            // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
            console.log("Fecha después de 12 meses: " + resultado);
        }
    </script>






    <!-- CALCULAR FECHA CADA 6 MESES-  ATENDIDAS------------------------------- -->

    <script>
        function calcularMesesAtendidas() {
            var inputFecha = document.getElementById('fecha_semestral_atendidas');
            var fechaSeleccionada = new Date(inputFecha.value);

            // Obtener el mes y año seleccionado por el usuario
            var mesSeleccionado = fechaSeleccionada.getMonth();
            var annoSeleccionado = fechaSeleccionada.getFullYear();

            // Calcular el mes después de 6 meses
            var nuevoMes = (mesSeleccionado + 6) % 12; // Utiliza el operador de módulo para manejar el cambio de año
            var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 6) / 12);

            // Formatear el resultado
            var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

            // Asignar el valor al input oculto
            document.getElementById('sextomes_atendidas').value = resultado;

            // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
            console.log("Fecha después de 6 meses: " + resultado);
        }
    </script>


    <!-- CALCULAR FECHA POR AÑO ATENDIDAS --------------------------------  -->

    <script>
        function calcularAnioAtendidas() {
            var inputFecha = document.getElementById('fecha_anual_atendidas');
            var fechaSeleccionada = new Date(inputFecha.value);

            // Obtener el mes y año seleccionado por el usuario
            var mesSeleccionado = fechaSeleccionada.getMonth();
            var annoSeleccionado = fechaSeleccionada.getFullYear();

            // Calcular el mes después de 6 meses
            var nuevoMes = (mesSeleccionado + 13) % 12; // Utiliza el operador de módulo para manejar el cambio de año
            var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 13) / 12);

            // Formatear el resultado
            var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

            // Asignar el valor al input oculto
            document.getElementById('mesdoce_atendidas').value = resultado;

            // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
            console.log("Fecha después de 12 meses: " + resultado);
        }
    </script>


    <!-- CALCULAR FECHA CADA 6 MESES DESATENDIDAS-------------------------------- -->

    <script>
        function calcularMesesDesatendidas() {
            var inputFecha = document.getElementById('fecha_semestral_desatendidas');
            var fechaSeleccionada = new Date(inputFecha.value);

            // Obtener el mes y año seleccionado por el usuario
            var mesSeleccionado = fechaSeleccionada.getMonth();
            var annoSeleccionado = fechaSeleccionada.getFullYear();

            // Calcular el mes después de 6 meses
            var nuevoMes = (mesSeleccionado + 6) % 12; // Utiliza el operador de módulo para manejar el cambio de año
            var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 6) / 12);

            // Formatear el resultado
            var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

            // Asignar el valor al input oculto
            document.getElementById('sextomes_desatendidas').value = resultado;

            // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
            console.log("Fecha después de 6 meses: " + resultado);
        }
    </script>


    <!-- CALCULAR FECHA POR AÑO  DESATENDIDAS--------------------------------  -->

    <script>
        function calcularAnioDesatendidas() {
            var inputFecha = document.getElementById('fecha_anual_desatendidas');
            var fechaSeleccionada = new Date(inputFecha.value);

            // Obtener el mes y año seleccionado por el usuario
            var mesSeleccionado = fechaSeleccionada.getMonth();
            var annoSeleccionado = fechaSeleccionada.getFullYear();

            // Calcular el mes después de 6 meses
            var nuevoMes = (mesSeleccionado + 13) % 12; // Utiliza el operador de módulo para manejar el cambio de año
            var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 13) / 12);

            // Formatear el resultado
            var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

            // Asignar el valor al input oculto
            document.getElementById('mesdoce_desatendidas').value = resultado;

            // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
            console.log("Fecha después de 12 meses: " + resultado);
        }
    </script>




    <!-- CALCULAR FECHA CADA 6 MESES RESUMEN GENERAL-------------------------------- -->

    <script>
        function calcularMesesResumen() {
            var inputFecha = document.getElementById('fecha_semestral_resumen');
            var fechaSeleccionada = new Date(inputFecha.value);

            // Obtener el mes y año seleccionado por el usuario
            var mesSeleccionado = fechaSeleccionada.getMonth();
            var annoSeleccionado = fechaSeleccionada.getFullYear();

            // Calcular el mes después de 6 meses
            var nuevoMes = (mesSeleccionado + 6) % 12; // Utiliza el operador de módulo para manejar el cambio de año
            var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 6) / 12);

            // Formatear el resultado
            var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

            // Asignar el valor al input oculto
            document.getElementById('sextomes_resumen').value = resultado;

            // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
            console.log("Fecha después de 6 meses: " + resultado);
        }
    </script>


    <!-- CALCULAR FECHA POR AÑO--------------------------------  -->

    <script>
        function calcularAnioResumen() {
            var inputFecha = document.getElementById('fecha_anual_resumen');
            var fechaSeleccionada = new Date(inputFecha.value);

            // Obtener el mes y año seleccionado por el usuario
            var mesSeleccionado = fechaSeleccionada.getMonth();
            var annoSeleccionado = fechaSeleccionada.getFullYear();

            // Calcular el mes después de 6 meses
            var nuevoMes = (mesSeleccionado + 13) % 12; // Utiliza el operador de módulo para manejar el cambio de año
            var nuevoAnno = annoSeleccionado + Math.floor((mesSeleccionado + 13) / 12);

            // Formatear el resultado
            var resultado = nuevoAnno + '-' + ('0' + (nuevoMes + 1)).slice(-2); // Sumar 1 al mes (ya que los meses en JavaScript van de 0 a 11)

            // Asignar el valor al input oculto
            document.getElementById('mesdoce_resumen').value = resultado;

            // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
            console.log("Fecha después de 12 meses: " + resultado);
        }
    </script>



    <!-- SCRIPTS PARA LOS CHECKBOX-------------------------------------------------------- -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener todos los checkboxes
            var checkboxes = document.querySelectorAll('input[name="opciones"]');

            // Agregar un evento de cambio a cada checkbox
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    // Ocultar todos los bloques de código y limpiar el contenido
                    document.querySelectorAll('.opciones-container').forEach(function(container) {
                        container.style.display = 'none';
                        container.querySelectorAll('input').forEach(function(input) {
                            input.value = ''; // Limpiar el contenido de los inputs
                        });
                    });

                    // Mostrar el bloque de código correspondiente al checkbox seleccionado
                    var option = this.value;
                    var containerToShow = document.querySelector('.' + option);

                    // Mostrar el bloque de código solo si el checkbox está seleccionado
                    if (this.checked && containerToShow) {
                        containerToShow.style.display = 'block';
                    }
                });
            });
        });
    </script>




    <svg width="100%" id="svg" viewBox="0 -100 1440 390" xmlns="http://www.w3.org/2000/svg" display="block" class="transition duration-300 ease-in-out delay-150">
        <style>
            .path-0 {
                animation: pathAnim-0 4s;
                animation-timing-function: linear;
                animation-iteration-count: infinite;
            }

            @keyframes pathAnim-0 {
                0% {
                    d: path("M 0,400 L 0,100 C 43.52100240556186,83.51267546062545 87.04200481112372,67.0253509212509 130,67 C 172.95799518887628,66.9746490787491 215.3529831610669,83.41127177562187 267,98 C 318.6470168389331,112.58872822437813 379.54606254460873,125.32956197626163 428,113 C 476.45393745539127,100.67043802373837 512.4627666604985,63.27048031933171 553,65 C 593.5372333395015,66.72951968066829 638.6028708133972,107.5885167464115 694,122 C 749.3971291866028,136.4114832535885 815.1257500859127,124.37545269502232 864,126 C 912.8742499140873,127.62454730497768 944.8941288429512,142.90967247349917 988,139 C 1031.1058711570488,135.09032752650083 1085.2977345422823,111.98585741098098 1133,99 C 1180.7022654577177,86.01414258901902 1221.9149329879192,83.14689788257685 1272,85 C 1322.0850670120808,86.85310211742315 1381.0425335060404,93.42655105871157 1440,100 L 1440,400 L 0,400 Z");
                }

                25% {
                    d: path("M 0,400 L 0,100 C 45.07178355230114,92.03379682254355 90.14356710460228,84.0675936450871 137,78 C 183.85643289539772,71.9324063549129 232.4975151338919,67.76342224219516 287,82 C 341.5024848661081,96.23657775780484 401.8663723598298,128.8787173861323 450,134 C 498.1336276401702,139.1212826138677 534.0369954267888,116.72170821327555 571,103 C 607.9630045732112,89.27829178672445 645.9856459330143,84.23444976076554 701,87 C 756.0143540669857,89.76555023923446 828.0204208411536,100.34049274366228 884,111 C 939.9795791588464,121.65950725633772 979.9326707023713,132.40357926458535 1014,120 C 1048.0673292976287,107.59642073541464 1076.2488963493618,72.04519019799625 1126,62 C 1175.7511036506382,51.95480980200376 1247.0717439001824,67.41565994342965 1303,78 C 1358.9282560998176,88.58434005657035 1399.4641280499088,94.29217002828517 1440,100 L 1440,400 L 0,400 Z");
                }

                50% {
                    d: path("M 0,400 L 0,100 C 58.13760606941764,106.5481508895292 116.27521213883529,113.0963017790584 164,110 C 211.7247878611647,106.9036982209416 249.0367575140765,94.16294377329562 288,105 C 326.9632424859235,115.83705622670438 367.5777578048588,150.2519231277591 410,149 C 452.4222421951412,147.7480768722409 496.6522112664886,110.82936371566788 550,87 C 603.3477887335114,63.170636284332126 665.8133971291867,52.430622009569376 716,64 C 766.1866028708133,75.56937799043062 804.094200216765,109.44814824605461 848,105 C 891.905799783235,100.55185175394539 941.8098020037537,57.776785006212165 992,61 C 1042.1901979962463,64.22321499378783 1092.6665917682203,113.44471172909672 1144,125 C 1195.3334082317797,136.55528827090328 1247.5238309233657,110.44436807740094 1297,100 C 1346.4761690766343,89.55563192259906 1393.2380845383173,94.77781596129952 1440,100 L 1440,400 L 0,400 Z");
                }

                75% {
                    d: path("M 0,400 L 0,100 C 50.863398450923896,110.41725924555236 101.72679690184779,120.83451849110472 143,104 C 184.2732030981522,87.16548150889528 215.95621084353274,43.079185281133526 265,50 C 314.04378915646726,56.920814718866474 380.4483597240212,114.84874038436121 441,119 C 501.5516402759788,123.15125961563879 556.2503502603823,73.52585318142167 597,62 C 637.7496497396177,50.47414681857834 664.5502392344497,77.04784688995215 707,82 C 749.4497607655503,86.95215311004785 807.5486928018188,70.28275925876973 860,73 C 912.4513071981812,75.71724074123027 959.2549895582756,97.82111607496896 1007,109 C 1054.7450104417244,120.17888392503104 1103.4313489650797,120.43277644135452 1151,111 C 1198.5686510349203,101.56722355864548 1245.019614581406,82.44777815961301 1293,79 C 1340.980385418594,75.55222184038699 1390.490192709297,87.7761109201935 1440,100 L 1440,400 L 0,400 Z");
                }

                100% {
                    d: path("M 0,400 L 0,100 C 43.52100240556186,83.51267546062545 87.04200481112372,67.0253509212509 130,67 C 172.95799518887628,66.9746490787491 215.3529831610669,83.41127177562187 267,98 C 318.6470168389331,112.58872822437813 379.54606254460873,125.32956197626163 428,113 C 476.45393745539127,100.67043802373837 512.4627666604985,63.27048031933171 553,65 C 593.5372333395015,66.72951968066829 638.6028708133972,107.5885167464115 694,122 C 749.3971291866028,136.4114832535885 815.1257500859127,124.37545269502232 864,126 C 912.8742499140873,127.62454730497768 944.8941288429512,142.90967247349917 988,139 C 1031.1058711570488,135.09032752650083 1085.2977345422823,111.98585741098098 1133,99 C 1180.7022654577177,86.01414258901902 1221.9149329879192,83.14689788257685 1272,85 C 1322.0850670120808,86.85310211742315 1381.0425335060404,93.42655105871157 1440,100 L 1440,400 L 0,400 Z");
                }
            }
        </style>
        <defs>
            <linearGradient id="gradient" x1="50%" y1="0%" x2="50%" y2="60%">
                <stop offset="5%" stop-color="#ff8213"></stop>
                <stop offset="95%" stop-color="#f1f1f1"></stop>
            </linearGradient>
        </defs>
        <path d="M 0,400 L 0,100 C 43.52100240556186,83.51267546062545 87.04200481112372,67.0253509212509 130,67 C 172.95799518887628,66.9746490787491 215.3529831610669,83.41127177562187 267,98 C 318.6470168389331,112.58872822437813 379.54606254460873,125.32956197626163 428,113 C 476.45393745539127,100.67043802373837 512.4627666604985,63.27048031933171 553,65 C 593.5372333395015,66.72951968066829 638.6028708133972,107.5885167464115 694,122 C 749.3971291866028,136.4114832535885 815.1257500859127,124.37545269502232 864,126 C 912.8742499140873,127.62454730497768 944.8941288429512,142.90967247349917 988,139 C 1031.1058711570488,135.09032752650083 1085.2977345422823,111.98585741098098 1133,99 C 1180.7022654577177,86.01414258901902 1221.9149329879192,83.14689788257685 1272,85 C 1322.0850670120808,86.85310211742315 1381.0425335060404,93.42655105871157 1440,100 L 1440,400 L 0,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" display="block" fill-opacity="0.53" class="transition-all duration-300 ease-in-out delay-150 path-0"></path>
        <style>
            .path-1 {
                animation: pathAnim-1 4s;
                animation-timing-function: linear;
                animation-iteration-count: infinite;
            }

            @keyframes pathAnim-1 {
                0% {
                    d: path("M 0,400 L 0,233 C 48.63172433847048,251.4171138544503 97.26344867694095,269.8342277089006 140,283 C 182.73655132305905,296.1657722910994 219.5779296307066,304.08020301884795 263,282 C 306.4220703692934,259.91979698115205 356.4248328002327,207.84496021570752 411,196 C 465.5751671997673,184.15503978429248 524.7227391683629,212.53995611832192 578,241 C 631.2772608316371,269.4600438816781 678.6842105263158,297.9952153110048 730,280 C 781.3157894736842,262.0047846889952 836.5404187263739,197.47918263765894 887,194 C 937.4595812736261,190.52081736234106 983.1541145681883,248.0880541383595 1029,272 C 1074.8458854318117,295.9119458616405 1120.8431230008725,286.1686008089032 1167,270 C 1213.1568769991275,253.8313991910968 1259.4733934283222,231.23754262602768 1305,224 C 1350.5266065716778,216.76245737397232 1395.263303285839,224.88122868698616 1440,233 L 1440,400 L 0,400 Z");
                }

                25% {
                    d: path("M 0,400 L 0,233 C 42.48744349573079,222.7212588225964 84.97488699146157,212.44251764519282 135,221 C 185.02511300853843,229.55748235480718 242.5878955298844,256.9511882418251 299,257 C 355.4121044701156,257.0488117581749 410.6735308890005,229.75272938750692 455,236 C 499.3264691109995,242.24727061249308 532.7179809141135,282.03789420814724 575,271 C 617.2820190858865,259.96210579185276 668.4545454545455,198.09569377990428 712,198 C 755.5454545454545,197.90430622009572 791.4638372677047,259.5793306722356 847,280 C 902.5361627322953,300.4206693277644 977.6901054746356,279.58698353115335 1026,260 C 1074.3098945253644,240.41301646884665 1095.7757408337518,222.072735203151 1136,231 C 1176.2242591662482,239.927264796849 1235.2069311903565,276.1220756562426 1289,281 C 1342.7930688096435,285.8779243437574 1391.3965344048218,259.4389621718787 1440,233 L 1440,400 L 0,400 Z");
                }

                50% {
                    d: path("M 0,400 L 0,233 C 51.43954373628698,226.2373179306881 102.87908747257396,219.47463586137619 155,230 C 207.12091252742604,240.52536413862381 259.9231938459912,268.3387744851833 304,258 C 348.0768061540088,247.6612255148167 383.42813714346136,199.17026619789053 432,195 C 480.57186285653864,190.82973380210947 542.3642575801634,230.9801607232546 588,236 C 633.6357424198366,241.0198392767454 663.1148325358851,210.90909090909093 702,199 C 740.8851674641149,187.09090909090907 789.1764122762959,193.3834756403817 837,212 C 884.8235877237041,230.6165243596183 932.1795183589311,261.55700652938225 981,270 C 1029.820481641069,278.44299347061775 1080.10551428798,264.3884982420894 1137,259 C 1193.89448571202,253.61150175791062 1257.3984244891487,256.88900050226016 1309,254 C 1360.6015755108513,251.1109994977398 1400.3007877554255,242.05549974886992 1440,233 L 1440,400 L 0,400 Z");
                }

                75% {
                    d: path("M 0,400 L 0,233 C 51.59803325491028,207.29294985328715 103.19606650982055,181.5858997065743 144,191 C 184.80393349017945,200.4141002934257 214.81376721562816,244.94935102698992 261,263 C 307.18623278437184,281.0506489730101 369.5488646276666,272.61669618546614 424,267 C 478.4511353723334,261.38330381453386 524.9907742737054,258.58386423114547 573,262 C 621.0092257262946,265.41613576885453 670.4880382775119,275.04784688995215 723,271 C 775.5119617224881,266.95215311004785 831.0570726162467,249.22474820904594 883,237 C 934.9429273837533,224.77525179095406 983.2836712575008,218.05316027386397 1022,221 C 1060.7163287424992,223.94683972613603 1089.8082423537498,236.56261069549817 1140,231 C 1190.1917576462502,225.43738930450183 1261.4833593275,201.69639694414337 1315,199 C 1368.5166406725,196.30360305585663 1404.25832033625,214.6518015279283 1440,233 L 1440,400 L 0,400 Z");
                }

                100% {
                    d: path("M 0,400 L 0,233 C 48.63172433847048,251.4171138544503 97.26344867694095,269.8342277089006 140,283 C 182.73655132305905,296.1657722910994 219.5779296307066,304.08020301884795 263,282 C 306.4220703692934,259.91979698115205 356.4248328002327,207.84496021570752 411,196 C 465.5751671997673,184.15503978429248 524.7227391683629,212.53995611832192 578,241 C 631.2772608316371,269.4600438816781 678.6842105263158,297.9952153110048 730,280 C 781.3157894736842,262.0047846889952 836.5404187263739,197.47918263765894 887,194 C 937.4595812736261,190.52081736234106 983.1541145681883,248.0880541383595 1029,272 C 1074.8458854318117,295.9119458616405 1120.8431230008725,286.1686008089032 1167,270 C 1213.1568769991275,253.8313991910968 1259.4733934283222,231.23754262602768 1305,224 C 1350.5266065716778,216.76245737397232 1395.263303285839,224.88122868698616 1440,233 L 1440,400 L 0,400 Z");
                }
            }
        </style>
        <defs>
            <linearGradient id="gradient" x1="50%" y1="0%" x2="50%" y2="100%">
                <stop offset="5%" stop-color="#b0ea00"></stop>
                <stop offset="95%" stop-color="#f1f1f1"></stop>
            </linearGradient>
        </defs>
        <path d="M 0,400 L 0,233 C 48.63172433847048,251.4171138544503 97.26344867694095,269.8342277089006 140,283 C 182.73655132305905,296.1657722910994 219.5779296307066,304.08020301884795 263,282 C 306.4220703692934,259.91979698115205 356.4248328002327,207.84496021570752 411,196 C 465.5751671997673,184.15503978429248 524.7227391683629,212.53995611832192 578,241 C 631.2772608316371,269.4600438816781 678.6842105263158,297.9952153110048 730,280 C 781.3157894736842,262.0047846889952 836.5404187263739,197.47918263765894 887,194 C 937.4595812736261,190.52081736234106 983.1541145681883,248.0880541383595 1029,272 C 1074.8458854318117,295.9119458616405 1120.8431230008725,286.1686008089032 1167,270 C 1213.1568769991275,253.8313991910968 1259.4733934283222,231.23754262602768 1305,224 C 1350.5266065716778,216.76245737397232 1395.263303285839,224.88122868698616 1440,233 L 1440,400 L 0,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" display="block" fill-opacity="1" class="transition-all duration-300 ease-in-out delay-150 path-1"></path>
    </svg>

    <!-- por ultimo se carga el footer -->
    <?php require('./layout/footer.php'); ?>