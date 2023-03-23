<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "multimedia";

$conn = new mysqli($servername, $username, $password, $dbname);
function obtenerMultimediaPorId($id) {
    global $conn;

    $query = "SELECT * FROM multimedia WHERE id = $id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $multimedia = obtenerMultimediaPorId($id);

    if ($multimedia) {
        $ruta_multimedia = $multimedia["ruta_multimedia"];
        $nombre_multimedia = $multimedia["nombre_multimedia"];
        $tipo_multimedia = $multimedia["tipo_multimedia"];

        header("Content-Type: " . $tipo_multimedia);
        header("Content-Disposition: attachment; filename=\"" . $nombre_multimedia . "\"");
        readfile($ruta_multimedia);
    } else {
        echo "No se encontró el archivo multimedia con el ID proporcionado";
    }
} else {
    echo "Por favor, proporcione un ID de multimedia válido";
}

?>
