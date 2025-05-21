<?php
    require_once("../functions/functions.php");
    session_start();
    $_SESSION['usuario'] = $_POST['usuario'];
    $user_data = new user_data($_POST);
    UpdateUser($user_data);

    if ($user_data->ofertante == 1) {
        if(!CheckOferer($user_data->usuario)){
            CreateOferer($_POST['id_usuario'], $_POST['usuario']);
        }
    } else {
        DeleteOferer($user_data->id_usuario);
    }

    header("Location:../index.php?id=".GetScreenIndex("profile"));
?>