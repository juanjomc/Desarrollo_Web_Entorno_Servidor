<!-- filepath: insertar_usuario.php -->
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
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$pais = $_POST['pais'];
$estado_empleo = $_POST['estado_empleo'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, correo, telefono, fecha_nacimiento, pais, estado_empleo) VALUES ('$nombre', '$correo', '$telefono', '$fecha_nacimiento', '$pais', '$estado_empleo')";
if ($conn->query($sql) === TRUE) {
    $mensaje = "Usuario registrado exitosamente";
} else {
    $mensaje = "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado del Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h1>Resultado del Registro</h1>
        <p><?php echo $mensaje; ?></p>
        <a href="registro.php" class="button">Volver al Registro</a>
    </div>
</body>
</html>