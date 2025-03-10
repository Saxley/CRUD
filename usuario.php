<?php
include 'Bd_registro.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $user = $_POST['user'];

    if (empty($password)) {
        echo "Debe ingresar la contraseña.";
        exit; 
    }

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM logear WHERE user = '$user' and clave = '$password'";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error en la consulta: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        echo 'success';
    } else {
        echo "Contraseña incorrecta";
    }
}

$conn->close();
?>