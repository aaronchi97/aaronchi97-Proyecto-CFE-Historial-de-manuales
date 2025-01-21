<?php
session_start(); //sesion iniciada

session_destroy(); //destruir la sesion

//redireccionar al usuario a la pagina de login
header("location:/Proyecto-CFE-reportes/vista/login/login.php");

//tenemos que ir a donde esta el a href del boton cerrar sesion para
//llamar al archivo controlador_cerrar_sesion.php que cerrara sesion que se creo aqui
//el boton esta en vista/topbar.php
