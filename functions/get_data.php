<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "usuario", "contraseña", "base_de_datos");

if ($conn->connect_error) {
    echo json_encode(['error' => 'Error de conexión']);
    exit;
}

// Ejemplo: obtenemos todos los datos
$result = $conn->query("SELECT id, nombre, valor FROM datos");

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>