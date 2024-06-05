<?php
session_start();
//si el nombre y apellido estan vacios entonces redirigelos a la pagina de login.php
//esto hace que si quieres colocar el link que te arroja el navegador al iniciar sesion
//lo compias y lo pegas desde el inicio entonces no te dejara, hasta que pongas un usuario valido

if (empty($_SESSION['nombre-sinasu']) and empty($_SESSION['apellido-sinasu'])) {
  header("location:../login/login_sinasu.php");
}


?>

<?php require ('./../layout/topbar_sinasu.php'); ?>
<?php require ('./../layout/sidebar_sinasu.php');
include '../../controlador/controlador_pendientes_administrador.php';
include '../../modelo/conexion-SINASU.php'; ?>

<style>
ul li:nth-child(5) .activo {
    background: #008f5a !important;
}
</style>

<link rel="stylesheet" href="../estiloinicio.css">

<div class="page-content">



    <div id="carouselExampleCaptions" class="carousel slide carrusel" data-ride=" carousel">
        <!-- <h2 class="text-correct text-lg">BIENVENIDO AL SISTEMA DE GESTIÓN DE DOCUMENTOS PARA SINASU</h2> -->
        <ol class="carousel-indicators" style=" margin-bottom: 10%;">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>

        </ol>
        <div class="carousel-inner" style="aspect-ratio: 16/9;">
            <div class="carousel-item active" style="width: 100%;">
                <img src="../login/img/sinasu/slide-sinasu.jpg" style="filter: brightness(30%); object-fit:cover;"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block" style=" margin-bottom: 20%;">
                    <h5>SISTEMA DE GESTIÓN Y VERIFICACIÓN DE ARCHIVOS SINASU</h5>
                    <p>Seleccione la opción acorde a sus necesidades:</p>
                    <br>
                    <div class="botones-inicio-sinasu">
                        <a class="btn-inicio-sinasu" href="#">Subir documentación</a>

                        <a class="btn-inicio-sinasu" href="#">Ver status de documento</a>
                    </div>
                    <section class="ui-elements">
                        <article class="ui-1">
                            <h5 class="titulo-pendiente">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <b>
                                    PENDIENTES
                                </b>
                            </h5>
                            <?php
              $pendientes = new Pendientes($conexionSINASU);
              $totalPendientes = 0; // Variable para almacenar el total de pendientes
              

              for ($i = 1; $i <= 5; $i++) {
                echo "<p>";
                $tabla = "sinasu_guias_" . $i;
                $consulta = "SELECT COUNT(id_estado) FROM $tabla WHERE id_estado = ?";
                $parametros = array('3'); // suponiendo que $usuario contiene el valor que deseas buscar
                $resultado = $pendientes->getConsultasPreparadas($consulta, $parametros);

                // print_r($resultado);
                foreach ($resultado as $fila) {
                  if (isset($fila['COUNT(id_estado)'])) {
                    // Accede a la clave "id_estado"
                    // echo "Pendientes para $tabla: " . $fila['COUNT(id_estado)'] . "<br>";
                    $totalPendientes += $fila['COUNT(id_estado)']; // Suma al total de pendientes
                  } else {
                    // Si la clave no está definida, haz algo más o simplemente ignóralo
                    echo "La clave 'id_estado' no está definida en esta fila.";
                  }
                }
                echo "</p>";
              }
              echo "<div class='seccion-pendientes'>";
              echo "<p class='texto-pendiente'>";
              echo "Total de pendientes de los departamentos:";
              echo "</p>";
              echo "<a href='estadisticas_sinasu.php' class='pendientes_total'>$totalPendientes</a>";
              echo "</div>";
              ?>



                        </article>
                        <article class="ui-1">
                            <i class="fa-solid fa-chart-pie"></i>
                            <b>
                                Estadísticas
                            </b>
                        </article>
                    </section>

                </div>
            </div>
            <div class="carousel-item" style="width: 100%;">
                <img src="../login/img/sinasu/slide-sinasu2.jpg" style="filter: brightness(50%); object-fit:cover;"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block" style=" margin-bottom: 25%;">


                    <h5>SISTEMA DE GESTIÓN Y VERIFICACIÓN DE ARCHIVOS SINASU</h5>
                    <p>Seleccione la opción acorde a sus necesidades:</p>
                    <br>
                    <div class="botones-inicio-sinasu">
                        <a class="btn-inicio-sinasu" href="#">Especificaciones y formatos</a>
                    </div>

                </div>
            </div>
            <button class="carousel-control-prev"
                style="margin-bottom: 0; position: absolute; z-index: 200; top:50%; left:5%; background:transparent; color:#fff; font-size: 50px; border:none;"
                type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="">
                    <i class="fa-solid fa-arrow-left"></i>
                </span>
            </button>
            <button class="carousel-control-next"
                style="margin-bottom: 0; position:absolute; z-index:200; top:50%; left:93%; background:transparent; color:#fff; font-size: 50px; border:none;"
                type="button" data-target="#carouselExampleCaptions" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden visually-hidden-focusable">
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </button>

        </div>

    </div>

</div>

<script>
var myCarousel = document.querySelector('#carouselExampleCaptions')
var carousel = new bootstrap.Carousel(myCarousel, {
    interval: false,
    wrap: false
})
</script>





<?php require ('./../layout/footer_sinasu.php'); ?>