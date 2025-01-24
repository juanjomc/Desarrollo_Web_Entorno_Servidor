<!-- filepath: actualizar_usuario.php -->
<?php
// Incluir el archivo de configuración para obtener las variables de conexión
include 'config.php';

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$pais = $_POST['pais'];
$estado_empleo = $_POST['estado_empleo'];

// Actualizar los datos del usuario en la base de datos
$sql = "UPDATE usuarios SET nombre='$nombre', correo='$correo', telefono='$telefono', fecha_nacimiento='$fecha_nacimiento', pais='$pais', estado_empleo='$estado_empleo' WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    // Redirigir a la página de administración después de actualizar
    header("Location: listar_usuarios.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>