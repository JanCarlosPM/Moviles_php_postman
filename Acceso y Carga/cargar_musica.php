<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musica_db";

// Crear conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    $query = "SELECT ruta_musica, nombre_musica, tipo_musica FROM musica WHERE id = $id";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ruta_musica = $row["ruta_musica"];
        $nombre_musica = $row["nombre_musica"];
        $tipo_musica = $row["tipo_musica"];

        header("Content-type: " . $tipo_musica);
        header("Content-Disposition: inline; filename=\"" . $nombre_musica . "\"");
        readfile($ruta_musica);
    } else {
        echo "No se encontró el archivo de música con el ID proporcionado";
    }
} else {
    echo "Por favor, proporcione un ID de música válido";
}

$conn->close();

?>
