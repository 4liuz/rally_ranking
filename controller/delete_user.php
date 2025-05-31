<?php
    require_once("../functions/functions.php");
    session_start();

    $user = GetUser($_SESSION['usuario']);
    DeleteUser($user->id);
    
    session_unset();

    header("Location:../index.php?id=".GetScreenIndex("home"));
    ?>