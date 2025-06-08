<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");
    session_start();

    Vote(GetIp(), 1);
?>