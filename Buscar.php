<?php
include 'conexion.php'; 

if (isset($_GET['buscar'])) {
    $criterio = "%" . $_GET['buscar'] . "%";

    $sql = "SELECT * FROM tu_tabla WHERE 
            Nombre LIKE ? OR 
            Apellido LIKE ? OR 
            Cedula LIKE ? OR 
            Telefono LIKE ? OR 
            Entidad LIKE ? OR 
            Tipoatencion LIKE ? OR 
            Detalleatencion LIKE ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $criterio, $criterio, $criterio, $criterio, $criterio, $criterio, $criterio);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $datos = $resultado->fetch_all(MYSQLI_ASSOC);
    echo json_encode($datos);
}
?>
