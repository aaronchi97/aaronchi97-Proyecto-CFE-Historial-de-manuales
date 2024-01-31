<?php


//AQUI SE HARA FILTRO DE BUSQUEDA SEGUN EL NOMBRE DEL ELEMENTO QUE SE SELECCIONE EN EL DOCUMENTO agencia1.php
//SE CAPTURA EL ID_ELEMENTO Y EL ID_ELEMENTO DEL ULTIMO CAMPO DONDE LLEGA EL ID, ACTUALEMNTE SOLO HAY DEL 1 AL 4
//Y SE HACE UNOS IF ANIDADOS PARA SABER CUAL CONSULTA MANDAR AL ARCHIVO agencia1.php DEPENDIENDO DE QUE ELEMENTO 
//PRESIONA EL USUARIO


 if (!empty($_GET["id_guia1"])) {
    $id_guia1 = $_GET["id_guia1"];
    $id_guia_siguiente1 = $_GET["id_guia_siguiente1"];
    $id_agencia_especifica = $_GET['id_agencia_especifica'];

    
    // Imprime las variables para verificar sus valores
    // echo "id_guia1: $id_guia1, id_guia2: $id_guia_siguiente1";

   // Realiza la consulta para obtener la información de sinasu_guias
$sql_sinasu_guia = $conexionSINASU->query("SELECT * FROM sinasu_guias WHERE id_guia BETWEEN $id_guia1 AND ($id_guia_siguiente1 - 1) AND id_agencia = $id_agencia_especifica ");

} else if(!empty($_GET["id_guia2"])) {
    $id_guia2 = $_GET["id_guia2"];
    $id_guia_siguiente2 = $_GET["id_guia_siguiente2"];
    $id_agencia_especifica = $_GET['id_agencia_especifica'];

    // Imprime las variables para verificar sus valores
    // echo "id_guia2: $id_guia2, id_guia_sigueinte2: $id_guia_siguiente2";

   // Realiza la consulta para obtener la información de sinasu_guias
$sql_sinasu_guia = $conexionSINASU->query("SELECT * FROM sinasu_guias WHERE id_guia BETWEEN $id_guia2 AND ($id_guia_siguiente2 - 1) AND id_agencia = $id_agencia_especifica ");

}else if(!empty($_GET["id_guia3"])) {
    $id_guia3 = $_GET["id_guia3"];
    $id_guia_siguiente3 = $_GET["id_guia_siguiente3"];
    $id_agencia_especifica = $_GET['id_agencia_especifica'];

    // Imprime las variables para verificar sus valores
    // echo "id_guia3: $id_guia3, id_guia_sigueinte3: $id_guia_siguiente3";

   // Realiza la consulta para obtener la información de sinasu_guias
$sql_sinasu_guia = $conexionSINASU->query("SELECT * FROM sinasu_guias WHERE id_guia BETWEEN $id_guia3 AND ($id_guia_siguiente3 - 1) AND id_agencia = $id_agencia_especifica ");

}else if(!empty($_GET["id_guia4"])) {
    $id_guia4 = $_GET["id_guia4"];
    $id_agencia_especifica = $_GET['id_agencia_especifica'];
    // $id_guia_siguiente4 = $_GET["id_guia_siguiente4"];

    // Imprime las variables para verificar sus valores
    // echo "id_guia4: $id_guia4";

   // Realiza la consulta para obtener la información de sinasu_guias
$sql_sinasu_guia = $conexionSINASU->query("SELECT 
sg.*,
ultimo.id_guia AS ultimo_valor
FROM 
sinasu_guias sg
LEFT JOIN (
SELECT 
    id_elemento,
    MAX(id_guia) AS id_ultimo_guia
FROM 
    sinasu_guias
GROUP BY 
    id_elemento
) ultimos ON sg.id_elemento = ultimos.id_elemento
LEFT JOIN sinasu_guias ultimo ON ultimos.id_ultimo_guia = ultimo.id_guia
WHERE
sg.id_elemento = ultimos.id_elemento
AND sg.id_guia >= $id_guia4;


");

}

     
 ?>

<!-- <script>
setTimeout(() => {
    window.history.replaceState(null,null,window.location.pathname);
}, 0);
</script> -->
    

 