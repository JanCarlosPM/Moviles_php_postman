<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "multimedia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$upload_dir = "uploads/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $nombre_archivo = $_FILES["file"]["name"];
        $tipo_archivo = $_FILES["file"]["type"];
        $ruta_archivo = $upload_dir . basename($nombre_archivo);

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $ruta_archivo)) {
            $query = "INSERT INTO multimedia (ruta_multimedia, nombre_multimedia, tipo_multimedia) VALUES ('$ruta_archivo', '$nombre_archivo', '$tipo_archivo')";

            if ($conn->query($query) === TRUE) {
                echo "Archivo subido correctamente";
            } else {
                echo "Error al guardar la ruta del archivo en la base de datos: " . $conn->error;
            }
        } else {
            echo "Error al subir el archivo al servidor";
        }
    } else {
        echo "Error al subir el archivo";
    }
}

$conn->close();

?>
