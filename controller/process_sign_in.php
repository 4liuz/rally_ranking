<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");
    session_start();

    $_POST['id_participante'] = null;
    $_POST['baja'] = 0;
    $user_data = new user_data($_POST);
    CreateUser($user_data);

    $response = [
        "success" => true,
        "data" => [
            "id_participante" => $user_data->id_participante,
            "usuario" => $user_data->usuario,
            "nombre" => $user_data->nombre,
            "apellidos" => $user_data->apellidos,
            "email" => $user_data->email,
            "password" => $user_data->password,
        ]
    ];

    echo json_encode($response);
?>