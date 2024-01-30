<!-- <?php


 if (!empty($_GET['id_agencias_filtro'])) {
    $id_agencias_filtro = $_GET['id_agencias_filtro'];


    $sql_id_agencia = $conexionSINASU->query("SELECT *
         FROM sinasu_guias
         INNER JOIN agencias ON sinasu_guias.id_agencia = agencias.id_agencia 
         WHERE agencias.id_agencia = '$id_agencias_filtro';");

} else {?>
               
    <script>
        $(function notificacion() {
            new PNotify({
                title: "ERROR",
                type: "error",
                text: "Agencia inexistente",
                styling: "bootstrap3"
            })
        })
    </script>

<?php
}
     
 ?> -->

<!-- <script>
setTimeout(() => {
    window.history.replaceState(null,null,window.location.pathname);
}, 0);
</script> -->