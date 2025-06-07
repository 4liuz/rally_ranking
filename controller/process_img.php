<?php
    require_once("../functions/functions.php");
    header("Content-Type: application/json");
    session_start();

    if (
    isset($_FILES['file']) &&
    $_FILES['file']['error'] === UPLOAD_ERR_OK
    ) {
        CheckUploadsDir();

        $uploadDir = __DIR__ . '/../uploads/';
        $originalName = basename($_FILES['file']['name']);
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);

        $uniqId = uniqid('img_', true) . '.' . $ext;
        $targetDir = $uploadDir . $uniqId;


        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetDir)) {

            $img_data = json_decode(json_encode($_POST));
            $img_data -> ruta = $uniqId;
            CreateImg($img_data);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'File could\'t be moved']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Not valid file.']);
    }

    
?>