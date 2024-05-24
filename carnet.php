<?php 
include "conexion.php";

// Datos del nuevo carnet
$codigo = $_POST["codigo"]; // codigo del estudiante
$foto = $_FILES["foto"]; // foto del estudiante
$nombre = $_POST["nombre"];
$sangre = $_POST["sangre"]; // tipo de sangre


if(isset($_FILES["foto"])) {
    if ($_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        $archivoNombreOriginal = $_FILES["foto"]["name"];
        $archivoTempNombre = $_FILES["foto"]["tmp_name"];
        // Obtener la extensión del archivo original
        $extension = pathinfo($archivoNombreOriginal, PATHINFO_EXTENSION);

        $codigo = $_POST["codigo"]; // Obtener el código del estudiante

        // Directorio de destino y nuevo nombre de archivo
        $directorioDestino = "carpeta_fotos/";
        $nuevoNombreArchivo = $codigo; // Concatenar el código con el nombre original

        // Ruta completa del archivo de destino
        $directorioDestinoCompleto = $directorioDestino . $nuevoNombreArchivo . "." . $extension;

        // Consulta SQL de inserción
        $sql = "INSERT INTO carnets (codigo, foto, nombre, sangre)
                VALUES ('$codigo','$directorioDestinoCompleto','$nombre', '$sangre')";
        // Mover el archivo a la carpeta de destino con el nuevo nombre
        if(move_uploaded_file($archivoTempNombre, $directorioDestinoCompleto)) {


            if ($conn->query($sql) === TRUE) {
                echo "Registro insertado correctamente.<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Error al subir el archivo: " . $_FILES["foto"]["error"];
    }
} else {
    echo "No se ha seleccionado ningún archivo.";
}
// Cerrar la conexión a la base de datos
$conn->close();
?>