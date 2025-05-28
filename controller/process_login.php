<?php
    require_once("../functions/functions.php");
    session_start();

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $login_check;
    print_r($_POST);
    
    if (CheckUserLogin($usuario, $password)) {        
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = 'Participante';
        $login_check = true;
        echo "Paricipante";
        
    } elseif(CheckAdminLogin($usuario, $password)) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = 'Administrador';
        $login_check = true;
        echo "Administrador";
        
    } else {
        $_SESSION['failed_login'] = 1;
        $login_check = false;
        echo "Error";
        
    }

    
    
    header("Location:../index.php?id=".($login_check?GetScreenIndex("home"):GetScreenIndex("login")));
?>