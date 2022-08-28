<?php
error_reporting(0);
header('Content-Type: application/json; charset=utf-8');
$mysql = new mysqli("192.168.162.179", "android", "android", "android");
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
        $array = array();
        $id = $registro['id_tienda'];
        $nombre = $registro['nombre'];
        $ciudad =$registro['ciudad'];
        $localizacion = $registro['localizacion'];
        $QR = $registro['QR_tienda'];
        //extraer array
        array_push($array,$nombre,$ciudad,$localizacion,$QR);
        //asociar campos al id
        //crear array de arrays
        array_push($Tarrays,$array);
        //siguiente registross
        $registro = $result -> fetch_assoc();
        //echo $array;
    }
    //formato definitivo: conjunto de tiendas
    $json = array("tiendas"=>$Tarrays);
    echo json_encode($json);
}
?>