<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");
    session_start();

    $user_data = new user_data($_POST);
    
    $response = [
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

    if (ValidateUser($user_data, $regexMap)) {

        $response["success"] = true;
        
        UpdateUser($user_data);

        if ($_SESSION['rol'] == "Participante") {
            $_SESSION['usuario'] = $user_data -> usuario;
        }
    } else {
        
        $response["success"] = false;
    }
        
    echo json_encode($response);

?>