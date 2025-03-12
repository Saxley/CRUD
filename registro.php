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
$stmt = $conn->prepare("SELECT Cedula FROM controlatencion WHERE Cedula = ?");
$stmt->bind_param("s", $cedula);
$stmt->execute();
$result = $stmt->get_result();

$sql = "INSERT INTO controlatencion (id, Nombre, Apellido, Cedula, Fecha, Telefono, Entidad, Tipoatencion, Otro)
            VALUES (null, '$nombre', '$apellido', '$cedula', '$fecha', '$telefono', '$entidad', '$tipoatencion', '$otro')";

$response = [];
if ($conn->query($sql) === TRUE) {
    $response = ["success" => true, "message" => "Datos guardados con éxito"];
} else {
    $response = ["success" => false, "message" => "Error: " . $conn->error];  // En caso de error
}

echo json_encode($response);  

$conn->close();
?>
