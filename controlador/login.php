<?php

session_start(); //metodo php para guardar sesiones e inicializar sesion
//para guardar los datos del usuario al iniciar agregamos un variable $datos
//y ponemos el metodo sesion dentro de los if


if (!empty($_POST["btningresar"])) {

  if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {

    $usuario = $_POST["usuario"];
    // $password = md5($_POST["password"]); //md5 es para encriptacion de la contraseña
    $password = $_POST["password"];


    //  echo $usuario;
    //  echo $password;
    $sql = $conexion->query(" select * from usuario where usuario= '$usuario' and password= '$password' ");

    if ($datos = $sql->fetch_object()) {
      //si la sql tiene datos dentro entonces el usuario existe
      header("location:../acerca.php"); //redireccionamos a inicio 

      //almacenar el nombre de usuario
      $_SESSION["nombre"] = $datos->nombre; //el "nombre" es el campo que se llama asi en la bd

      //almacenar el apellido
      $_SESSION["apellido"] = $datos->apellido;

      //almacenar el id
      $_SESSION["id"] = $datos->id_usuario;

      //almacenar el rol
      $_SESSION["rol"] = $datos->id_rol;

      //almacenar el contraseña
      $_SESSION["contraseña"] = $datos->password;
    } else {

      //si la bd devuelve un dato vacio entonces el usuario no existe y manda error
      echo "<div class='alert alert-danger'> Usuario inexistente </div>";
    }
  } else {
    echo "<div class='alert alert-danger'> los campos estas vacios </div>";
  }
}
