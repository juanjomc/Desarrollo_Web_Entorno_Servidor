<!-- filepath: registro.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Incluir el menú común -->
    <?php include 'menu.php'; ?>
    <div class="container">
        <h1>Registro de Usuario</h1>
        <!-- Formulario para registrar un nuevo usuario -->
        <form action="insertar_usuario.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required><br><br>
            <label for="telefono">Teléfono Móvil:</label>
            <input type="text" id="telefono" name="telefono" required><br><br>
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>
            <label for="pais">País:</label>
            <input type="text" id="pais" name="pais" required><br><br>
            <label for="estado_empleo">Estado de Empleo:</label>
            <select id="estado_empleo" name="estado_empleo" required>
                <option value="Empleado">Empleado</option>
                <option value="Desempleado">Desempleado</option>
            </select><br><br>
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>