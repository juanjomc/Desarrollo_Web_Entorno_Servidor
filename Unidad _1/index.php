<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Validado</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<?php
   
   if (isset($_POST['registrar']) && ($_SERVER["REQUEST_METHOD"] == "POST")) {
       
       $servername = "localhost";
       $username = "root";  
       $password = "12345";  
       $dbname = "unidad1";
   
       // Creamos la conexión
       $conn = new mysqli($servername, $username, $password, $dbname);
   
       // Comprobamos la conexión
       if ($conn->connect_error) {
           die("Conexión fallida: " . $conn->connect_error);
       }   

       // Recogemos y sanitizamos los datos del formulario
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $fecha_nacimiento = $conn->real_escape_string($_POST['fecha-nacimiento']);
    $password_plain = $_POST['password'];

    // Consulta SQL para insertar los datos
    $sql = "INSERT INTO registro (nombre, apellido, correo, fechanacimiento, pass)
            VALUES ('$nombre', '$apellido', '$correo', '$fecha_nacimiento', '$password_plain')";

    if ($conn->query($sql) === TRUE) {
        echo "Formulario enviado correctamente.";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerramos la conexión
    $conn->close();
    
    
    }

   else {
   
?>
    <div class="container">
        <form id="registration-form" action="index.php" method="POST" class="form">
            <h2>Registro</h2>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="fecha-nacimiento">Fecha de Nacimiento</label>
                <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirmar Contraseña</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <button type="submit" name="registrar" class="submit-btn">Registrar</button>
        </form>
    </div>

    <script src="js/script.js"></script>

    <?php
   }
    ?>
</body>
</html>
