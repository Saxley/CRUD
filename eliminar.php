<?php
include('Bd_registro.php');

header('Content-Type: application/json'); // Asegurar que la respuesta sea JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0; 

    if ($id > 0) {
        if (!$conn) { // Verificar la conexión
            echo json_encode(['status' => 'error', 'message' => 'Error de conexión a la base de datos']);
            exit();
        }

        // Usar consultas preparadas para evitar SQL Injection
        $stmt = $conn->prepare("DELETE FROM controlatencion WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Registro eliminado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar: ' . $stmt->error]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID inválido']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
