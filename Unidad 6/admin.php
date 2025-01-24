<!-- filepath: admin.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Incluir el menú común -->
    <?php include 'menu.php'; ?>
    <div class="container">
        <h1>Listado de Usuarios</h1>
        <div id="user-list"></div>
    </div>

    <script>
        // Función para cargar los usuarios
        function loadUsers() {
            $.ajax({
                url: 'listar_usuarios.php',
                method: 'GET',
                success: function(data) {
                    $('#user-list').html(data);
                }
            });
        }

        // Función para eliminar un usuario
        function deleteUser(id) {
            $.ajax({
                url: 'eliminar_usuario.php',
                method: 'POST',
                data: { id: id },
                success: function(data) {
                    alert(data);
                    loadUsers();
                }
            });
        }

        // Cargar los usuarios cuando el documento esté listo
        $(document).ready(function() {
            loadUsers();
        });
    </script>
</body>
</html>