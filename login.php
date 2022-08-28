<?php
error_reporting(0);
header('Content-Type: application/json; charset=utf-8');
$username = $_GET['username'];
$password = $_GET['password'];
if(isset($username) && isset($password)){
    $mysql = new mysqli("192.168.85.179","android", "android", "android");
    if($mysql->connect_errno){
        printf("Conexión fallida: %s\n", $mysql->connect_error);
        exit();
    }
    else{
        //sintaxis sql
        $sql = "SELECT count(*) as registro FROM usuarios where username='".$username."' AND password='".$password."';";
        //ejecutar comando sql
        $result = $mysql->query($sql);
        //como el resultado ha de devolver 1 fila:
        $resultado = $result->fetch_assoc();
        if($resultado["registro"]==0){
            $json = array("respuesta" => "false");
            echo json_encode($json);
            mysqli_close($mysql);
        }else{
            $json = array("respuesta" => "true");
            echo json_encode($json);
            mysqli_close($mysql);
        }
    }
    //cerrar enlace
    mysqli_close($mysql);
}else{
    $json = array("respuesta" => "error");
    echo json_encode($json);
}