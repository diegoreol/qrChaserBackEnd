<?php
error_reporting(0);
header('Content-Type: application/json; charset=utf-8');
$username = $_GET['username'];
$password = $_GET['password'];
$mode = "user";
if(isset($username) && isset($password)){
    $mysql = new mysqli("192.168.85.179","android", "android", "android");
    if($mysql->connect_errno){
        $json = array("respuesta" => "error");
        echo json_encode($json);
        exit();
    }
    else{
        try{
            //sintaxis sql
            $sql = "INSERT INTO usuarios(username,password,mode) values ('".$username."','".$password."', '".$mode."');";
            //ejecutar comando sql
            $result = $mysql->query($sql);
            //si ha funcionado
            $json = array("respuesta" => "true");
            echo json_encode($json);
            //cerrar enlace
            mysqli_close($mysql);
        }catch(mysqli_sql_exception $excep){
            if($excep->getCode()==1062){
                //si error de insercion
                $json = array("respuesta" => "false");
                echo json_encode($json);
                //cerrar enlace
                mysqli_close($mysql);
            }else{
                //si error desconocido
                $json = array("respuesta" => "error");
                echo json_encode($json);
                //cerrar enlace
                mysqli_close($mysql);
            }
        }
    }
}else{
    $json = array("respuesta" => "error");
    echo json_encode($json);
}