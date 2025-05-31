<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");

    $jsonData = json_decode(file_get_contents("php://input"));

    $lastUser = GetLastUser( $jsonData->id);

    echo json_encode($lastUser);
?>