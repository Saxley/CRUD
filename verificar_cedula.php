<?php
include('Bd_registro.php'); // Asegúrate de que aquí se establece correctamente la conexión en $conn

$cedula = $_REQUEST['cedula'] ?? '';

// Verificando si existe la cédula en la base de datos
$jsonData = array();

$selectQuery = "SELECT cedula FROM controlatencion WHERE cedula = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("s", $cedula);
$stmt->execute();
$result = $stmt->get_result();
$totalCliente = $result->num_rows;

if ($totalCliente > 0) {
    $jsonData['success'] = 1;
    $jsonData['message'] = '⚠️ Esta cédula ya está registrada, pero puedes continuar.';
} else {
    $jsonData['success'] = 0;
    $jsonData['message'] = ''; // No mostramos mensaje si no existe
}

// Mostrando la respuesta en formato JSON
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsonData);
?>


