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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    $query = "SELECT ruta_video, nombre_video, tipo_video FROM videos WHERE id = $id";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ruta_video = $row["ruta_video"];
        $nombre_video = $row["nombre_video"];
        $tipo_video = $row["tipo_video"];

        header("Content-type: " . $tipo_video);
        header("Content-Disposition: inline; filename=\"" . $nombre_video . "\"");
        readfile($ruta_video);
    } else {
        echo "No se encontró el video con el ID proporcionado";
    }
} else {
    echo "Por favor, proporcione un ID de video válido";
}

$conn->close();

?>
