<?php
 if (!empty($_GET["id"])) {
//almacenamos el id que obtenemos del boton eliminar en la variable idkiki
//tambien tenemos que agregar el include de esta pagina en el archivo donde querermos
//llamarlo, en este caso en usuario.php

    $idkiki = $_GET["id"];
//    echo $idkiki;
// header("location: vista/registro_asistencias_vista2.php?id=" . $idkiki);
    //ahora eliminaremos el registro de la bd una vez que recibamos el id 
    //que el usuario nos mande presionando el boton de eliminar
    $sql = $conexion->query(" SELECT 

    asign.id_asignacion,
    asign.id_docente,
    asign.id_aula,
    asign.id_dia,
    asign.id_horario,
    doce.id_docente,
    doce.nombre,
    doce.apellido,
    doce.expediente,
    aula.id_aula,
    aula.nombre_aula,
    dia.id_dia,
    dia.nombre_dias,
    hora.id_horario,
    hora.hora
 
    FROM
    asignaciones asign
    INNER JOIN docentes doce ON asign.id_docente = doce.id_docente
    INNER JOIN aulas aula ON asign.id_aula = aula.id_aula
    INNER JOIN dias dia ON asign.id_dia = dia.id_dia
    INNER JOIN horario hora ON asign.id_horario = hora.id_horario
    WHERE
    asign.id_dia = $idkiki
    
     ");
     
     $sql2 = $conexion->query(" SELECT * FROM presencia" );
     
     ?>

<!-- <script>
setTimeout(() => {
    window.history.replaceState(null,null,window.location.pathname);
}, 0);
</script> -->
    
<?php }

 ?>

 