<?php
include 'Bd_registro.php'; 

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar las variables usando el operador de fusión nula
$nombre       = $_POST['nombre']       ?? '';
$apellido     = $_POST['apellido']     ?? '';
$cedula       = $_POST['cedula']       ?? '';
$telefono     = $_POST['telefono']     ?? '';
$entidad      = $_POST['entidad']      ?? '';
$tipoatencion = $_POST['tipoatencion'] ?? '';
$fecha        = $_POST['fecha']        ?? '';
$otro         = $_POST['otro']         ?? '-';

if ($tipoatencion !== 'Otro') {
    $otro = '-';
}

// Procesa tus datos y prepara la respuesta (ejemplo)
$response = [
    'success' => true,
    'message' => 'Datos procesados correctamente',
    'data'    => [
        'nombre'       => $nombre,
        'apellido'     => $apellido,
        'cedula'       => $cedula,
        'telefono'     => $telefono,
        'entidad'      => $entidad,
        'tipoatencion' => $tipoatencion,
        'fecha'        => $fecha,
        'otro'         => $otro
    ]
];

// Verifica si la cédula ya existe
$stmt = $conn->prepare("SELECT * FROM controlatencion WHERE Cedula = ?");
$stmt->bind_param("s", $cedula);
$stmt->execute();
$result = $stmt->get_result();

$coincidencia = $result->num_rows > 0; // true si la cédula ya existe, false si no

if ($coincidencia) {
    // Si la cédula ya existe, devolver respuesta con success: false
    echo json_encode(["success" => false, "message" => "La cédula ya existe en el sistema.", "coincidencia" => $coincidencia]);
} else {
    // Si no existe, registrar los datos
    $stmt = $conn->prepare("UPDATE controlatencion SET 
    Nombre=?, Apellido=?, Cedula=?, Fecha=?, Telefono=?, Entidad=?, Tipoatencion=?, detalleatencion=? WHERE id=?");
    $stmt->bind_param("sssssssss", $nombre, $apellido, $cedula, $fecha, $telefono, $entidad, $tipoatencion, $otro,$id);

    $response = $stmt->execute() ? ["success" => true, "message" => "Registro exitoso"] : ["success" => false, "message" => "Error: " . $stmt->error];

    echo json_encode(["response" => $response, "coincidencia" => $coincidencia]);
}
?>
