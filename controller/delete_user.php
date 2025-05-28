<?php
    require_once("../functions/functions.php");
    session_start();

    $user = GetUser($_SESSION['usuario']);
    DeleteUser($user->id_usuario);
    
    session_unset();

    header("Location:../index.php?id=".GetScreenIndex("home"));
    ?>