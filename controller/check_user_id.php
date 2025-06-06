<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");

    $jsonData = json_decode(file_get_contents("php://input"));

    $id = GetUser( $jsonData->usuario) -> id;

    echo json_encode($id);
?>