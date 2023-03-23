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

$upload_dir = "musica/"; // Directorio de almacenamiento de música en el servidor

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["musica"]) && $_FILES["musica"]["error"] == 0) {
        $nombre_musica = $_FILES["musica"]["name"];
        $tipo_musica = $_FILES["musica"]["type"];
        $ruta_musica = $upload_dir . basename($nombre_musica);

        if (move_uploaded_file($_FILES["musica"]["tmp_name"], $ruta_musica)) {
            $query = "INSERT INTO musica (ruta_musica, nombre_musica, tipo_musica) VALUES ('$ruta_musica', '$nombre_musica', '$tipo_musica')";

            if ($conn->query($query) === TRUE) {
                echo "Archivo de música subido correctamente";
            } else {
                echo "Error al guardar la ruta del archivo de música en la base de datos: " . $conn->error;
            }
        } else {
            echo "Error al subir el archivo de música al servidor";
        }
    } else {
        echo "Error al subir el archivo de música";
    }
}

$conn->close();

?>
