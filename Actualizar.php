<?php
include 'Bd_registro.php'; 

// Recibir los datos del formulario
$datos = [
    'id' => $_POST['id'] ?? '',
    'nombre' => $_POST['nombre'] ?? '',
    'apellido' => $_POST['apellido'] ?? '',
    'cedula' => $_POST['cedula'] ?? '',
    'fecha' => $_POST['fecha'] ?? '',
    'telefono' => $_POST['telefono'] ?? '',
    'entidad' => $_POST['entidad'] ?? '',
    'tipoatencion' => $_POST['tipoatencion'] ?? '',
    'otro' => $_POST['otro'] ?? '', 
];


if ($datos['tipoatencion'] !== 'Otro') {
    $datos['otro'] = '-';  
}

// Actualizar los datos en la base de datos
$stmt = $conn->prepare("UPDATE controlatencion SET Nombre = ?, Cedula = ?, Fecha = ?, Telefono = ?, Entidad = ?, Tipoatencion = ?, Otro = ? WHERE id = ?");
$stmt->bind_param("sssssssi", $datos['nombre'], $datos['cedula'], $datos['fecha'], $datos['telefono'], $datos['entidad'], $datos['tipoatencion'], $datos['otro'], $datos['id']);

$response = [];
if($stmt->execute()){
    $response = ["success" => true, "message" => "Datos guardados con éxito"];
} else {
    $response = ["success" => false, "message" => "Error: " . $conn->error];
}

echo json_encode($response);
$conn->close();
?>
