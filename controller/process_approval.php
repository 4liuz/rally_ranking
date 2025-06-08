<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");

    $jsonData = json_decode(file_get_contents("php://input"));

    UpdateApproval($jsonData->id, $jsonData->estado, $jsonData->admin);
?>