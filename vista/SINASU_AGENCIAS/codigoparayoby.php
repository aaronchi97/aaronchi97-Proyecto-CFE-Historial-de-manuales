
<?php

$datos = $sql_sinasu_guia->fetch_object();



$id_agencia_para_regresar_vista = $_SESSION["id-agencia-sinasu"];

//agencia1.php?id_guia<?= $i ?>=<?= $datos_nombre_elemento->id_guia ?>&id_guia_siguiente<?= $i ?>=<?= $datos_nombre_elemento_siguiente->id_guia ?>&id_agencia_especifica=<?= $id_agencia_para_regresar_vista ?>



?>