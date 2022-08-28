<?php
    $valor1 = "valor1";
    $valor2 = "valor2";
    $arrayP = array();
    $array1 = array();
    array_push($array1,$valor1);
    array_push($array1,$valor2);
    array_push($arrayP,$array1);
    $valor3 = "valor3";
    $valor4 = "valor4";
    $array2 = array();
    array_push($array2,$valor3);
    array_push($array2,$valor4);
    array_push($arrayP,$array2);
    $json = array("tiendas"=>$arrayP);
    echo json_encode($json);
?>