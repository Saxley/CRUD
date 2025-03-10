<?php
include 'Bd_registro.php';
header('Content-Type: application/json'); 

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Conexión fallida: " . $conn->connect_error]);
    exit;
}


$nombre = $_POST['nombre'] ?? $_POST['addNombre'] ?? '';
$apellido = $_POST['apellido'] ?? $_POST['addApellido'] ?? '';
$cedula = $_POST['cedula'] ?? $_POST['addCedula'] ?? '';
$fecha = $_POST['fecha'] ?? $_POST['addFecha'] ?? '';
$telefono = $_POST['telefono'] ?? $_POST['addTelefono'] ?? '';
$entidad = $_POST['entidad'] ?? $_POST['addEntidad'] ?? '';
$tipoatencion = $_POST['tipoatencion'] ?? $_POST['addTipoatencion'] ?? '';
$otro = $_POST['otro'] ?? $_POST['addOtro'] ?? '';

if ($tipoatencion !== 'Otro') $otro = '-';

// Verifica si la cédula ya existe
$stmt = $conn->prepare("SELECT * FROM controlatencion WHERE Cedula = ?");
$stmt->bind_param("s", $cedula);
$stmt->execute();
$result = $stmt->get_result();

$coincidencia = $result->num_rows > 0; // true si la cédula ya existe, false si no

    // Si no existe, registrar los datos
    $stmt = $conn->prepare("INSERT INTO controlatencion (Nombre, Apellido, Cedula, Fecha, Telefono, Entidad, Tipoatencion, Otro) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $nombre, $apellido, $cedula, $fecha, $telefono, $entidad, $tipoatencion, $otro);
    
    $response = $stmt->execute() ? ["success" => true, "message" => "Registro exitoso"] : ["success" => false, "message" => "Error: " . $stmt->error];

    echo json_encode(["response" => $response]);

$stmt->close();
$conn->close();
?>
