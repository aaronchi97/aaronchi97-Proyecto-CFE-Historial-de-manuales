<?php

session_start(); //metodo php para guardar sesiones e inicializar sesion
//para guardar los datos del usuario al iniciar agregamos un variable $datos
//y ponemos el metodo sesion dentro de los if


if (!empty($_POST["btningresar"])) {
    
    if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {
       
        $usuario = $_POST["usuario"];
        // $password = md5($_POST["password"]); //md5 es para encriptacion de la contraseña
        $password = $_POST["password"];

      
         echo $usuario;
      //  echo $password;
        $sql = $conexionSINASU->query(" select * from usuario where usuario= '$usuario' and password= '$password' ");

       

        if ($datos = $sql->fetch_object()) {
          //si la sql tiene datos dentro entonces el usuario existe
          header("location:../SINASU/acerca-sinasu.php"); //redireccionamos a inicio 
// echo $password;
          //almacenar el nombre de usuario
          $_SESSION["nombre-sinasu"] = $datos->nombre; //el "nombre" es el campo que se llama asi en la bd
    
          //almacenar el apellido
          $_SESSION["apellido-sinasu"] = $datos->apellido;

          //almacenar el id
          $_SESSION["id-sinasu"] = $datos->id_usuario;

           //almacenar el rol
          $_SESSION["rol-sinasu"] = $datos->id_rol;



          //PARTE DEL CODIGO PARA LA TABLA AGENCIAS
        $id_usuario_sinasu_para_id_agencia = $_SESSION["id-sinasu"];

          $sql_obtener_id_agencia = $conexionSINASU->query("select * from agencias where id_usuario = '$id_usuario_sinasu_para_id_agencia'");
          $dato_obtener_id_agencia =  $sql_obtener_id_agencia ->fetch_object();


           //almacenar el id de agencia
           $_SESSION["id-agencia-sinasu"] =  $dato_obtener_id_agencia->id_agencia;


    
        } else {

            //si la bd devuelve un dato vacio entonces el usuario no existe y manda error
            echo "<div class='alert alert-danger'> Usuario inexistente </div>";
        }
        
    
    } else {
        echo "<div class='alert alert-danger'> los campos estas vacios </div>";
    }
    
}


?>