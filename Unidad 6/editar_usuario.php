<!-- filepath: editar_usuario.php -->
<?php
// Incluir el archivo de configuración para obtener las variables de conexión
include 'config.php';

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del usuario a editar
$id = $_GET['id'];

// Consultar los datos del usuario
$sql = "SELECT * FROM usuarios WHERE id = $id";
$result = $conn->query($sql);

// Verificar si el usuario existe
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Usuario no encontrado.";
    exit;
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Incluir el menú común -->
    <?php include 'menu.php'; ?>
    <div class="container">
        <h1>Editar Usuario</h1>
        <!-- Formulario para editar los datos del usuario -->
        <form action="actualizar_usuario.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required><br><br>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $row['correo']; ?>" required><br><br>
            <label for="telefono">Teléfono Móvil:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" required><br><br>
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $row['fecha_nacimiento']; ?>" required><br><br>
            <label for="pais">País:</label>
            <input type="text" id="pais" name="pais" value="<?php echo $row['pais']; ?>" required><br><br>
            <label for="estado_empleo">Estado de Empleo:</label>
            <select id="estado_empleo" name="estado_empleo" required>
                <option value="Empleado" <?php if ($row['estado_empleo'] == 'Empleado') echo 'selected'; ?>>Empleado</option>
                <option value="Desempleado" <?php if ($row['estado_empleo'] == 'Desempleado') echo 'selected'; ?>>Desempleado</option>
            </select><br><br>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>