<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");
    session_start();

    $_POST['id'] = null;
    $_POST['baja'] = 0;
    $user_data = new user_data($_POST);
    CreateUser($user_data);

    $response = [
        "success" => true,
        "data" => [
            "id" => $user_data->id,
            "usuario" => $user_data->usuario,
            "nombre" => $user_data->nombre,
            "apellidos" => $user_data->apellidos,
            "email" => $user_data->email,
            "password" => $user_data->password,
            "ultimo_usuario" => $user_data->ultimo_usuario
        ]
    ];

    echo json_encode($response);
?>