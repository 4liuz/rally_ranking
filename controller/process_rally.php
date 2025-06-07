<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");
    session_start();

    $rally = json_decode(json_encode($_POST));
    UpdateRally($rally);
?>