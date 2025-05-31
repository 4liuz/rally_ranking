<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");
    session_start();

    $response = [
        "success" => true
    ];

    if ($_SESSION['rol'] == "Participante") {

        $response['rol'] = "Participante";

    } elseif($_SESSION['rol'] == "Administrador") {

        $response['rol'] = "Administrador";
    }

    echo json_encode($response);

?>