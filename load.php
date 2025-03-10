<?php
require ("Bd_registro.php");
// Array asociativo para almacenar los datos
$data = array();
// Verificar si hay resultados
// Consulta SQL
$sql = "SELECT * FROM controlatencion";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Recorrer los resultados y guardarlos en el array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = array("error" => "No se encontraron resultados");
}
// Convertir el array a JSON
$json_data = json_encode($data);
// Devolver la respuesta JSON
header('Content-Type: application/json');
echo $json_data;
// Cerrar conexión
$conn->close();

?>