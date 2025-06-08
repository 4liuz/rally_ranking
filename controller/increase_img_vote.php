<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");
    session_start();

    $jsonData = json_decode(file_get_contents("php://input"));

    IncreaseVotes($jsonData->id);
?>