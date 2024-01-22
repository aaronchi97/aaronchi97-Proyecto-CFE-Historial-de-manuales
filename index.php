<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/estilos/estiloind.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Bienvenido</title>
</head>

<body>


    <article class="bienvenida">
        <!-- <figure class="imgfondo">
            <img src="vista/login/img/Sucursal-CFE.jpeg" alt="">
        </figure> -->

        <div class="wave" style="height: 150px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none"
                style="height: 100%; width: 100%;">
                <path d="M-6.96,102.05 C139.20,201.61 271.29,-50.10 502.63,140.89 L500.00,0.00 L-0.00,0.00 Z"
                    style="stroke: none; fill:#3F7C85;"></path>
            </svg></div>

        <div class="bienvenida-titulos">

            <h1>Bienvenido</h1>



            <figure class="imglogo">
                <img src="vista/login/img/cfe_logo.png" alt="">
            </figure>

            <h2 id="fecha"></h2>

        </div>

    </article>

    <section class="continer">


        <!-- <form action="">
            <input type="text" placeholder="DNI del maestro" name="txtdni">
        </form> -->

        <a class="boton-sinasu-manuales" href="vista/login/login_sinasu.php">


            <div class="parte-sinasu-manuales">

                <figure>
                    <img src="vista/login/img/imagen-1.jpg" alt="">
                </figure>

                <div class="fondo-2"></div>

                <i class="fa-regular fa-folder-open"></i>

                <h1>Evidencias SINASU Zona Mérida </h1>

            </div>

        </a>




        <a class="boton-sinasu-manuales" href="vista/login/login.php">


            <div class="parte-sinasu-manuales">

                <figure>
                    <img src="vista/login/img/imagen-3.jpg" alt="">
                </figure>

                <div class="fondo"></div>

                <i class="fa-solid fa-list-check"></i>

                <h1>REPORTE DE MANUALES</h1>

            </div>
        </a>


    </section>


    <!-- <div class="botones">
        <a class="entrada" href="#">Entrada</a>
        <a class="salida" href="#">Salida</a>
        </div> -->






    <script>


        setInterval(() => {

            let fecha = new Date();
            let fechahora = fecha.toLocaleString();
            document.getElementById("fecha").textContent = fechahora;

        }, 1000);
    </script>
</body>

</html>