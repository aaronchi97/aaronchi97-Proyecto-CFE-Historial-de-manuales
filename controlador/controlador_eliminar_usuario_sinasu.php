<?php
 if (!empty($_GET["id"])) {
//almacenamos el id que obtenemos del boton eliminar en la variable idkiki
//tambien tenemos que agregar el include de esta pagina en el archivo donde querermos
//llamarlo, en este caso en usuario-sinasu.php
    $idkiki = $_GET["id"];
//    echo $idkiki;

    //ahora eliminaremos el registro de la bd una vez que recibamos el id 
    //que el usuario nos mande presionando el boton de eliminar
    $sql = $conexionSINASU->query(" delete from usuario where id_usuario=$idkiki ");

    //ahora hacemos la validacion 
    if ($sql=true) { ?>
        <script>
            $(function notificacion(){
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "Usuario eliminado correctamente",
                    styling: "bootstrap3"
                })
            })
        </script>
        
   <?php } else {?>
        
        <script>
            $(function notificacion(){
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "Error al eliminar al usuario",
                    styling: "bootstrap3"
                })
            })
        </script>

   <?php } ?>

   <!--ahora eliminaremos el id que aparece en la barra del navegador
    esto hace que la ruta se actualice y regrese a su config original-->
   <script>
    setTimeout(() => {
        window.history.replaceState(null,null,window.location.pathname);
    }, 0);
   </script>
   
    
<?php }