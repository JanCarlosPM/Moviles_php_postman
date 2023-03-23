<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videos_db";

// Crear conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$upload_dir = "videos/"; // Directorio de almacenamiento de videos en el servidor

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["video"]) && $_FILES["video"]["error"] == 0) {
        $nombre_video = $_FILES["video"]["name"];
        $tipo_video = $_FILES["video"]["type"];
        $ruta_video = $upload_dir . basename($nombre_video);

        if (move_uploaded_file($_FILES["video"]["tmp_name"], $ruta_video)) {
            $query = "INSERT INTO videos (ruta_video, nombre_video, tipo_video) VALUES ('$ruta_video', '$nombre_video', '$tipo_video')";

            if ($conn->query($query) === TRUE) {
                echo "Video subido correctamente";
            } else {
                echo "Error al guardar la ruta del video en la base de datos: " . $conn->error;
            }
        } else {
            echo "Error al subir el video al servidor";
        }
    } else {
        echo "Error al subir el video";
    }
}

$conn->close();

?>
