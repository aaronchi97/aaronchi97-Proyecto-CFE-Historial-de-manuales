<?php


 if (!empty($_GET["id_agencia_revision_administrador"])) {
    $id_guia_revision_administrador = $_GET["id_agencia_revision_administrador"];


    
    
$sql_id_agencia_revision_administrador = $conexionSINASU->query("SELECT d.*
FROM documentos d
JOIN sinasu_guias g ON d.id_guia = g.id_guia
WHERE g.id_agencia = '$id_guia_revision_administrador';
");

}

     
 ?>

<!-- <script>
setTimeout(() => {
    window.history.replaceState(null,null,window.location.pathname);
}, 0);
</script> -->
    

 