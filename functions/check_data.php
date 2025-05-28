<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conn = new mysqli("localhost", "usuario", "contraseña", "base_de_datos");

// Verifica errores
if ($conn->connect_error) {
    echo json_encode(['error' => 'Error de conexión']);
    exit;
}

// Consulta la última fecha de actualización
$result = $conn->query("SELECT MAX(actualizado_en) AS ultima_actualizacion FROM datos");

$row = $result->fetch_assoc();
echo json_encode(['ultima_actualizacion' => $row['ultima_actualizacion']]);

$conn->close();
?>