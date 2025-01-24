<!-- filepath: listar_usuarios.php -->
<?php
// Incluir el archivo de configuración para obtener las variables de conexión
include 'config.php';

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los criterios de búsqueda
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$pais = isset($_GET['pais']) ? $_GET['pais'] : '';
$estado_empleo = isset($_GET['estado_empleo']) ? $_GET['estado_empleo'] : '';

// Consultar los usuarios con los criterios de búsqueda
$sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$nombre%'";

if ($pais != '') {
    $sql .= " AND pais = '$pais'";
}

if ($estado_empleo != '') {
    $sql .= " AND estado_empleo = '$estado_empleo'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Función para eliminar un usuario
        function deleteUser(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                $.ajax({
                    url: 'eliminar_usuario.php',
                    method: 'POST',
                    data: { id: id },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    }
                });
            }
        }
    </script>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h1>Listado de Usuarios</h1>
        <!-- Formulario de búsqueda -->
        <form method="GET" action="listar_usuarios.php">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br><br>
            <label for="pais">País:</label>
            <select id="pais" name="pais">
                <option value="">Todos</option>
                <option value="España" <?php if ($pais == 'España') echo 'selected'; ?>>España</option>
                <option value="México" <?php if ($pais == 'México') echo 'selected'; ?>>México</option>
                <option value="Argentina" <?php if ($pais == 'Argentina') echo 'selected'; ?>>Argentina</option>
                <!-- Añade más opciones de países según sea necesario -->
            </select><br><br>
            <label for="estado_empleo">Estado de Empleo:</label>
            <select id="estado_empleo" name="estado_empleo">
                <option value="">Todos</option>
                <option value="Empleado" <?php if ($estado_empleo == 'Empleado') echo 'selected'; ?>>Empleado</option>
                <option value="Desempleado" <?php if ($estado_empleo == 'Desempleado') echo 'selected'; ?>>Desempleado</option>
            </select><br><br>
            <button type="submit">Buscar</button>
        </form>
        <br>
        <!-- Tabla de usuarios -->
        <?php
        if ($result->num_rows > 0) {
            echo "<table border='1'><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Fecha de Nacimiento</th><th>País</th><th>Estado de Empleo</th><th>Acciones</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['correo']}</td>
                        <td>{$row['telefono']}</td>
                        <td>{$row['fecha_nacimiento']}</td>
                        <td>{$row['pais']}</td>
                        <td>{$row['estado_empleo']}</td>
                        <td>
                            <div class='button-group'>
                                <button onclick='deleteUser({$row['id']})'>Eliminar</button>
                                <a href='editar_usuario.php?id={$row['id']}'><button>Actualizar</button></a>
                            </div>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No hay usuarios.";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </div>
</body>
</html>