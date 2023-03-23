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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    $query = "SELECT imagen, tipo_imagen FROM imagenes WHERE id = $id";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header("Content-type: " . $row["tipo_imagen"]);
        echo $row["imagen"];
    } else {
        echo "No se encontró la imagen con el ID proporcionado";
    }
} else {
    echo "Por favor, proporcione un ID de imagen válido";
}

$conn->close();

?>
