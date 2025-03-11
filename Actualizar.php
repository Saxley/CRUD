<?php
include 'Bd_registro.php'; 

// Crea el array asociativo
$datos = [
    'id' => $_POST['id'] ?? '',
    'nombre' => $_POST['nombre'] ?? '',
    'apellido' => $_POST['apellido'] ?? '',
    'cedula' => $_POST['cedula'] ?? '',
    'telefono' => $_POST['telefono'] ?? '',
    'entidad' => $_POST['entidad'] ?? '',
    'tipoatencion' => $_POST['tipoatencion'] ?? '',
    'fecha' => $_POST['fecha'] ?? '',
    'otro' => $_POST['otro'] ?? '-',
];

    // Actualizar datos
    $stmt = $conn->prepare("UPDATE controlatencion SET Nombre = ?, Cedula = ?, Fecha = ?, Telefono = ?, Entidad = ?, Tipoatencion = ?, Otro = ? WHERE id = ?");
$stmt->bind_param("sssssssi", $datos['nombre'], $datos['cedula'], $datos['fecha'], $datos['telefono'], $datos['entidad'], $datos['tipoatencion'], $datos['otro'], $datos['id']);

    
    if($stmt->execute()){
      $response = ["success" => true, "message" => "Datos guardados con éxito"];
    } else {
        $response = ["success" => false, "message" => "Error: " . $conn->error];
    }
    echo json_encode($response);
    $conn->close();
?>