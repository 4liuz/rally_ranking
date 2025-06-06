<?php
    require_once("../functions/functions.php");
    session_start();

    $user = GetUser($_SESSION['usuario']);
    session_unset();

    DeleteUser($user->id);

    header("Location:../index.php?id=".GetScreenIndex("home"));
    ?>