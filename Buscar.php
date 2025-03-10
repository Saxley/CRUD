<?php
include('Bd_registro.php');

// Recoger el término de búsqueda desde la solicitud
$searchTerm = isset($_REQUEST['searchTerm']) ? $_REQUEST['searchTerm'] : '';

// Verificando si hay un término de búsqueda
if (!empty($searchTerm)) {
    // Escapar el término de búsqueda para evitar inyecciones SQL
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);

    // Crear la consulta SQL para buscar en varias columnas
    $selectQuery = "SELECT * FROM controlatencion WHERE 
                    nombre LIKE '%$searchTerm%' OR 
                    apellido LIKE '%$searchTerm%' OR
                    cedula LIKE '%$searchTerm%' OR
                    fecha LIKE '%$searchTerm%' OR
                    entidad LIKE '%$searchTerm%' OR
                    tipoatencion LIKE '%$searchTerm%' OR
                    otro LIKE '%$searchTerm%'";
    // Ejecutar la consulta
    $query = mysqli_query($conn, $selectQuery);
    $results = array();

    // Recoger los resultados
    while ($row = mysqli_fetch_assoc($query)) {
        $results[] = $row;
    }
} else {
    // Si no se proporciona término de búsqueda, no devolver datos
    $results = array();
}

// Mostrar los resultados en formato JSON
header('Content-type: application/json; charset=utf-8');
echo json_encode($results);
?>
