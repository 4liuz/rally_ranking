<?php
    require_once("../functions/functions.php");
    session_start();

    $user_data = new user_data($_POST);
    UpdateUser($user_data);

    if ($_SESSION['rol'] == "Participante") {
        $_SESSION['usuario'] = $user_data -> usuario;
    } elseif ($_SESSION['rol'] == "Administrador") {
        $_SESSION['changing_user'] = $user_data -> usuario;
    }

    unset($user_data);

    header("Location:../index.php?id=".GetScreenIndex("profile"));
?>