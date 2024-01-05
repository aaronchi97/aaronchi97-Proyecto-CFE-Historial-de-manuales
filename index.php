<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/estilos/estiloind.css">
    <title>Bienvenido</title>
</head>
<body>


<section class="asistenciaregistro ancho">

    <article class="bienvenida ancho">
        <figure class="imgfondo">
            <img src="public/images/itm-merida-fondo.webp" alt="">
        </figure>

        <figure class="imglogo">
            <img src="public/images/merida.png" alt="">
        </figure>
       
        <h1>Bienvenido, registra tu asistencia</h1>

        <h2 id="fecha"></h2>
    </article>

    <section class="continer ancho">
       
        <p> Ingrese su DNI</p>
        <form action="">
            <input type="text" placeholder="DNI del maestro" name="txtdni">
        </form>

        <div class="botones">
        <a class="entrada" href="#">Entrada</a>
        <a class="salida" href="#">Salida</a>
        </div>

        <br>
        <a class="botonsistema" href="vista/login/login.php"> Ingresar al sistema</a>

    </section>

</section>




    <script>
        

        setInterval(() => {

            let fecha = new Date();
            let fechahora = fecha.toLocaleString();
            document.getElementById("fecha").textContent = fechahora;
            
        }, 1000);
    </script>
</body>
</html>
