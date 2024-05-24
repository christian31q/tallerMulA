<?php

include "conexion.php";

// Consulta SQL para seleccionar datos de la tabla de imágenes
$sql = "SELECT codigo, foto, nombre, sangre FROM carnets";
$result = $conn->query($sql);

// Array para almacenar los datos de las imágenes
$carnets  = array();

// Verificar si hay resultados y agregarlos al array de productos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $carnet = array(
            "codigo" => $row["codigo"],
            "foto" => $row["foto"],
            "nombre" => $row["nombre"],
            "sangre" => $row["sangre"]
        );
        array_push($carnets, $carnet);
    }
}

// Imprimir el array en formato JSON
echo json_encode($carnets);
?>