<?php
error_reporting(0);
header('Content-Type: application/json; charset=utf-8');
$mysql = new mysqli("192.168.85.179", "android", "android", "android");
if ($mysql->connect_errno) {
    printf("Conexión fallida: %s\n", $mysql->connect_error);
    exit();
} else {
    $sql = "SELECT * from tienda;";
    //ejecutar comando sql
    $result = $mysql->query($sql);
    //obtener registro de la consulta
    $registro = $result ->fetch_assoc();
    $Tarrays = array();
    while ($registro) {
        //renovar el siguiente array(registro)
        $array = array();
        //formatear el contenido del registro
        $formato = array("id"=>$registro['id_tienda'],
            "ciudad"=>$registro['ciudad'],
            "localizacion"=>$registro['localizacion'],
            "QR"=>$registro['QR_tienda']);
        //juntar en un solo array para luego pasarselo al json
        array_push($Tarrays,$formato);
        //siguiente registross
        $registro = $result -> fetch_assoc();
        //echo $array;
    }
    //formato definitivo: conjunto de tiendas llamado tiendas
    $json = array("tiendas"=>$Tarrays);
    echo json_encode($json);
}
?>