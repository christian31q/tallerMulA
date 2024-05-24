<?php
include "conexion.php";

// Consulta SQL
$sql = "SELECT codigo, foto, nombre, sangre FROM carnets";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Inicializar un array para almacenar los resultados
    $data = array();

    // Iterar sobre los resultados y agregarlos al array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Convertir el array a formato JSON
    $json_data = json_encode($data);

    // Establecer el encabezado de respuesta como JSON
    header('Content-Type: application/json');

    // Imprimir el JSON
    echo $json_data;
} else {
    // Si no hay resultados, imprimir un mensaje
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conn->close();
?>