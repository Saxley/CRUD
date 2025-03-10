<?php
require("Bd_registro.php"); // Asegúrate de que el archivo de conexión existe

// Obtener los parámetros de la página actual y registros por página
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$registrosPorPagina = 10; // Puedes cambiar este número

// Calcular el OFFSET, es decir, a partir de qué registro empezar
$offset = ($paginaActual - 1) * $registrosPorPagina;

// Consulta SQL para obtener los registros con LIMIT y OFFSET
$sql = "SELECT * FROM controlatencion LIMIT $registrosPorPagina OFFSET $offset";
$result = $conn->query($sql);

// Array para almacenar los registros
$data = array();

// Si hay registros, se agregan al array
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = array("error" => "No se encontraron resultados");
}

// Convertir los datos a JSON
echo json_encode($data);

// Cerrar la conexión
$conn->close();
