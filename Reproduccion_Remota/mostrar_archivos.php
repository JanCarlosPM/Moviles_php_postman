<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "multimedia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$query = "SELECT * FROM multimedia";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre del archivo</th><th>Tipo</th><th>Acciones</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $nombre_archivo = $row["nombre_multimedia"];
        $tipo_archivo = $row["tipo_multimedia"];

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$nombre_archivo</td>";
        echo "<td>$tipo_archivo</td>";
        echo "<td><a href='download_file.php?id=$id'>Descargar</a></td>"; // Aquí puedes agregar más acciones como reproducir, eliminar, etc.
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron archivos";
}

$conn->close();

?>
