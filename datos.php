<?php
include "conexion.php";

// Consulta SQL
$sql = "SELECT codigo, foto, nombre, sangre FROM carnets";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Inicializar un objeto para almacenar los resultados
    $data = new stdClass();

    // Iterar sobre los resultados y agregarlos al objeto
    while($row = $result->fetch_assoc()) {
        $data->{$row["codigo"]} = $row;
    }

    // Convertir el objeto a formato JSON
    $json_data = json_encode($data, JSON_FORCE_OBJECT);

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
