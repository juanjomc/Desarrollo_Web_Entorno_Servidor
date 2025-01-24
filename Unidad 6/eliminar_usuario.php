<!-- filepath: eliminar_usuario.php -->
<?php
// Incluir el archivo de configuración para obtener las variables de conexión
include 'config.php';

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del usuario a eliminar
$id = $_POST['id'];

// Eliminar el usuario de la base de datos
$sql = "DELETE FROM usuarios WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "Usuario eliminado exitosamente";
} else {
    echo "Error: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>