<?php
$servername = "127.0.0.1";
$username = "root";
$clave = "hola";
$dbname = "bd_crua";

$conn = mysqli_connect($servername, $username, $clave, $dbname); 
if (!$conn) {
  echo json_encode(['status' => 'error', 'message' => 'Error en la conexión a la base de datos']);
  exit;
}
?>