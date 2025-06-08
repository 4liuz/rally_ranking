<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");
    session_start();

    $ranking = GetRanking();

    echo json_encode($ranking);
?>