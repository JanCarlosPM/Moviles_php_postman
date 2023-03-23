<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imagenes_db";

// Crear conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $imagen = addslashes(file_get_contents($_FILES["imagen"]["tmp_name"]));
        $nombre_imagen = $_FILES["imagen"]["name"];
        $tipo_imagen = $_FILES["imagen"]["type"];

        $query = "INSERT INTO imagenes (imagen, nombre_imagen, tipo_imagen) VALUES ('$imagen', '$nombre_imagen', '$tipo_imagen')";

        if ($conn->query($query) === TRUE) {
            echo "Imagen subida correctamente";
        } else {
            echo "Error al subir imagen: " . $conn->error;
        }
    } else {
        echo "Error al subir imagen";
    }
}

$conn->close();

?>
