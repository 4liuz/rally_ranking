<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");

    $jsonData = json_decode(file_get_contents("php://input"));

    $usuario = GetUser( $jsonData->usuario);

    echo json_encode($usuario);
?>