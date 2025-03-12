<?php
$servername = "localhost";
$username = "root";
$clave = "";
$dbname = "db_crua";

$conn = mysqli_connect($servername, $username, $clave, $dbname); 
if (!$conn) {
  echo json_encode(['status' => 'error', 'message' => 'Error en la conexión a la base de datos']);
  exit;
}
?>