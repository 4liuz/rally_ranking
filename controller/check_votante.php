<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");
    session_start();

    if (!$votante = GetVotante(GetIp())) {
        $votante = json_decode(json_encode([
            "ip" => GetIp(),
            "rally" => 1,
            "votos" => 3
        ]));
        CreateVotante($votante);
    }

    echo json_encode($votante);
?>