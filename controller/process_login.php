<?php
    require_once("../functions/functions.php");
    session_start();

    $usuario = $_POST['usuario'];
    $passwd = $_POST['passwd'];
    $login_check;
    if (CheckLogin($usuario, $passwd)) {        
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = CheckOferer($usuario) != 0?'ofertante':'solicitante';
        
        $login_check = true;
    } else {
        $_SESSION['failed_login'] = 1;
        $login_check = false;
    }
    
    header("Location:../index.php?id=".($login_check?GetScreenIndex("home"):GetScreenIndex("login")));
?>