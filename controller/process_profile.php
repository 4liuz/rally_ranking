<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");
    session_start();

    $user_data = new user_data($_POST);
    UpdateUser($user_data);
    
    $response = [
        "success" => true,
        "data" => [
            "id" => $user_data->id,
            "usuario" => $user_data->usuario,
            "nombre" => $user_data->nombre,
            "apellidos" => $user_data->apellidos,
            "email" => $user_data->email,
            "password" => $user_data->password,
            "baja" => $user_data->baja,
            "ultimo_usuario" => $_SESSION['usuario']
        ]
    ];
        
    echo json_encode($response);

    if ($_SESSION['rol'] == "Participante") {
        $_SESSION['usuario'] = $user_data -> usuario;
    }
?>