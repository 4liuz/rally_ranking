<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");

    $jsonData = json_decode(file_get_contents("php://input"));

    echo json_encode($jsonData);

    $img = GetImg($jsonData->id);

    $dir = __DIR__ . '/../uploads/';
    $route = $dir . basename($img->ruta);
    
    if (file_exists($route)) {
        unlink($route);
    }

    DeleteImg($jsonData->id);
?>