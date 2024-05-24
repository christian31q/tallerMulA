<?php 
include "conexion.php";

// Datos del nuevo carnet
$codigo = $_POST["codigo"]; // codigo del estudiante
$foto = $_FILES["foto"]; // foto del estudiante
$nombre = $_POST["nombre"];
$sangre = $_POST["sangre"]; // tipo de sangre

// Consulta SQL de inserción
$sql = "INSERT INTO carnets (codigo, foto, nombre, sangre)
        VALUES ('$codigo', $foto, '$nombre', '$sangre')";

if(isset($_FILES["foto"])) {
    $archivoNombre = $_FILES["foto"]["name"];
    $archivoTempNombre = $_FILES["foto"]["tmp_name"];

    // Directorio de destino para guardar la foto
    $directorioDestino = "carpeta_fotos/" . $archivoNombre;

    // Mover el archivo a la carpeta de destino
    if(move_uploaded_file($archivoTempNombre, $directorioDestino)) {
        // Procesar otros datos del formulario
        $nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $sangre = $_POST["sangre"];

        // Aquí puedes realizar la inserción en la base de datos o cualquier otra acción que necesites con los datos y la ubicación del archivo

        echo "La foto se ha subido correctamente.";
    } else {
        echo "Error al subir el archivo.";
    }
} else {
    echo "No se ha seleccionado ningún archivo.";
}
?>