<?php
session_start();

$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light'; // 'light' por defecto si no existe la cookie

// Sino estamos logueados nos redirige a la pagina de login

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
$carrito = $_SESSION['carrito'] ?? [];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="css/<?= $theme === 'dark' ? 'dark.css' : 'light.css' ?>" id="theme-style">
</head>
<body>
    <header>
        <h1>Carrito del usuario <?= htmlspecialchars($_SESSION['username']) ?></h1> <a href="index.php"> Regresar al inicio</a>
    </header>
    <!-- Contenido del carrito -->

    <h1><?= count($carrito);?> elementos</h1>

    <?php if (empty($carrito)): ?>
        <p>Tu carrito está vacío.</p>
    <?php else: ?>
        <ul>
            <?php 
            //Bucle foreach creado para listar los elementos que tenemos en el carrito mediante la variable de sesion carrito.
            foreach ($carrito as $producto): 
            
            ?>
                <li><?php echo "<img src=\"img/".substr($producto, -1).".webp\" style=\"width: 50px; height: auto;\">".htmlspecialchars($producto); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <a href="index.php">Volver a la tienda</a>
</body>
</html>
