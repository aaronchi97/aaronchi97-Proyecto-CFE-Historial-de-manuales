<!-- BTONES A USAR PARA ACTIVAR EL MODAL SE PUEDEN QUITAR LOS SPAN QUE SOLO DAN FORMATO AL BOTON


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
    </section> -->







<!-- SECCION DE MODALES POR FILTRO, POR FECHA, ATENDIDAS, DESATENDIDAS Y ESTADISTICOS GENERALES PARA NEGATIVAS -->

<?php
include "../controlador/control-estadisticos/controlador_buscar_fecha_manual.php";
?>




<!-- .......................................................... AREA DE MODALES -------------------------------------------------------------------------------------------------------------------------------------------- -->


<!-- MODAL BUSQUEDA POR FECHA  -->
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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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
                        <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                            <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                        </button>
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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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
                        <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                            <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                        </button>
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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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
                        <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                            <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                        </button>
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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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
                        <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                            <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                        </button>
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
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

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








<!-- MODAL PARA BOTON SOLICITUDES DOBLES AL MISMO SERVICIO ----------------------------------------------------------------------------------------------------------------------------------------------->
<div class="modal fade" style="width: 90%;" id="doblesolicitudModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label><input type="checkbox" name="opciones" value="fecha_personalizada_dobless"> Buscar por fecha personalizada</label>
                        <label><input type="checkbox" name="opciones" value="ver_mes_dobless"> Ver por mes</label>
                        <label><input type="checkbox" name="opciones" value="ver_semestre_dobless"> Ver por semestre</label>
                        <label><input type="checkbox" name="opciones" value="ver_anio_dobless"> Ver por año</label>
                        <label><input type="checkbox" name="opciones" value="ver_todas_dobless"> Ver todas</label>
                    </div>


                    <!-- Bloques de código -->
                    <div class="opciones-container fecha_personalizada_dobless" style="display: none;">

                        <div class="fl-flex-label mb-4 px-2 col-md-6">
                            <label for="fechaInicio">Fecha de Inicio:</label>
                            <input class="input input__text" type="date" id="fechaInicio" name="fechaInicio">
                        </div>


                        <div class="fl-flex-label mb-4 px-2 col-md-6">
                            <label for="fechaFin">Fecha de Fin:</label>
                            <input type="date" id="fechaFin" name="fechaFin" class="input input__text">
                        </div>

                        <div class="text-center p-3">
                            <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdobless" class="btn btn-primary btn-rounded">Asignar</button>
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

                        </div>


                    </div>

                    <div class="opciones-container ver_mes_dobless" style="display: none;">
                        <!-- Código para Ver por mes -->
                        <div class="fl-flex-label mb-4 px-2 col-10">
                            <label>Selecciona mes y año: </label>
                            <input class="input input__text" type="month" name="fecha_1mes">
                        </div>
                        <div class="text-center p-3">
                            <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdobless" class="btn btn-primary btn-rounded">Asignar</button>
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

                        </div>
                    </div>


                    <div class="opciones-container ver_semestre_dobless" style="display: none;">
                        <!-- Código para Ver por semestre -->
                        <div class="fl-flex-label mb-4 px-2 col-12">
                            <label>Selecciona mes y año inicial: </label>
                            <input class="input input__text" type="month" id="fecha_semestral_dobless" name="fecha_6meses">
                            <input hidden type="month" id="sextomes_dobless" name="sextomes">
                        </div>
                        <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdobless" class="btn btn-primary btn-rounded" onclick="calcularMesesdobless()">Asignar</button>
                        <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                            <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                        </button>
                    </div>



                    <div class="opciones-container ver_anio_dobless" style="display: none;">
                        <!-- Código para Ver por año -->
                        <div class="fl-flex-label mb-4 px-2 col-12">
                            <label>Selecciona mes y año inicial: </label>
                            <input class="input input__text" type="month" id="fecha_anual_dobless" name="fecha_anio">
                            <input hidden type="month" id="mesdoce_dobless" name="mes_doce">
                        </div>


                        <div class="text-center p-3">
                            <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdobless" class="btn btn-primary btn-rounded" onclick="calcularAniodobless()">Asignar</button>
                            <button style="margin-top: 5%;" type="button" class="btn btn-danger btn-rounded" data-dismiss="modal" aria-label="Close">
                                <span style="padding: 5px;" aria-hidden="true">Cancelar </span>
                            </button>

                        </div>
                    </div>

                    <div class="opciones-container ver_todas_dobless" style="display: none;">

                        <button style="margin-top: 5%;" type="submit" value="ok" name="btn_verxdobless" class="btn btn-primary btn-rounded">Continuar</button>

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
            window.location.href = "busqueda_manuales_fecha.php";
        }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->

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
            window.location.href = "manuales_atendidas.php";
        }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->




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
            window.location.href = "manuales_atendidas.php";
        }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->


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
            window.location.href = "manuales_desatendidas.php";
        }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->

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
            window.location.href = "manuales_desatendidas.php";
        }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->


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
            window.location.href = "resumen_general_manuales.php";
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
            window.location.href = "resumen_general_manuales.php";
        }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->


<?php } else if (!empty($_POST["btn_verxdobless"])    &&      ((!empty($_POST["fechaInicio"]) && !empty($_POST["fechaFin"])) || (!empty($_POST["fecha_anio"])
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
            window.location.href = "solicitud_mismo_servicio_manuales.php";
        }, 2000); // Retraso de 1000 milisegundos (1 segundo)
    </script>

    <!-- header("location:../../vista/busqueda_manuales_fecha.php"); -->

<?php } else if (!empty($_POST["btn_verxdobless"])) { ?>


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
            window.location.href = "solicitud_mismo_servicio_manuales.php";
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






<!-- CALCULAR FECHA CADA 6 MESES-  ATENDIDAS-------------------------------------------------------------------------------------------------------------------------------------- -->

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


<!-- CALCULAR FECHA CADA 6 MESES DESATENDIDAS---------------------------------------------------------------------------------------------------------------------------------------------- -->

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




<!-- CALCULAR FECHA CADA 6 MESES RESUMEN GENERAL------------------------------------------------------------------------------------------------------------------------------------------------- -->

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


<!-- CALCULAR FECHA CADA 6 MESES- AÑO DOBLES SOLICITUDES ---------------------------------------------------------------------------------------------------------------------------------------------------------  -->

<script>
    function calcularMesesdobless() {
        var inputFecha = document.getElementById('fecha_semestral_dobless');
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
        document.getElementById('sextomes_dobless').value = resultado;

        // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
        console.log("Fecha después de 6 meses: " + resultado);
    }
</script>


<!-- CALCULAR FECHA POR AÑO DOBLES SOLICITUDES ---------------------------------------------------------------------------------------------------------------------------------------------------------  -->

<script>
    function calcularAniodobless() {
        var inputFecha = document.getElementById('fecha_anual_dobless');
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
        document.getElementById('mesdoce_dobless').value = resultado;

        // Puedes hacer algo con el resultado, como enviarlo a tu servidor o mostrarlo en la consola
        console.log("Fecha después de 12 meses: " + resultado);
    }
</script>



<!-- SCRIPTS PARA LOS CHECKBOX SOLICITUDES-------------------------------------------------------- -->

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