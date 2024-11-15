<?php

/*Formulario de logeo donde compruebo si ha rellenado el formulario,
carga el formulari y si lo ha rellenado y los datos son correctos
redirige al usuario a la pagina principal. */
session_start();

$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light'; // 'light' por defecto si no existe la cookie


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Aquí agregarías la validación del usuario. Ejemplo básico:
    if ($username === 'prueba' && $password === '123') {
        $_SESSION['username'] = $username;
        header('Location: index.php'); // Redirige a la página principal
        exit();
    } else {
        $error = "Credenciales incorrectas. Inténtelo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/<?= $theme === 'dark' ? 'dark.css' : 'light.css' ?>" id="theme-style">
    <script src="js/scrip.js" defer></script>
</head>
<body>
    <main class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="login.php" method="post">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Entrar</button>
            <?php if (isset($error)): ?>
                <p style="color:red"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </form>
    </main>
</body>
</html>
