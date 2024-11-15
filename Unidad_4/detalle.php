<?php
session_start();

$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light'; // 'light' por defecto si no existe la cookie


// Recoger la variable 'producto' del método GET
$producto = isset($_GET['producto']) ? $_GET['producto'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto <?= $producto; ?></title>
    <link rel="stylesheet" href="css/<?= $theme === 'dark' ? 'dark.css' : 'light.css' ?>" id="theme-style">
    

</head>
<body>
    <header>
        <h1>Detalle del Producto <?= $producto; ?></h1>
        <a href="index.php"> Regresar al inicio</a>
    </header>

    <main>
        <?php 
        //Comprobamos que le ha pasado un producto y que ese producto existe, como solo tenemos 6 comprobamos que este en ese rango.
        if ($producto && $producto>0 && $producto<7): 
        
        ?>
            <div class="product-detail">
                <!-- Contenedor para centrar la imagen -->
                <div class="product-image" style="text-align: center;">
                    <img src="img/<?= htmlspecialchars($producto); ?>.webp" alt="Producto <?= htmlspecialchars($producto); ?>" style="max-width: 100%; height: auto;">
                </div>
                <div class="product-info" style="text-align: center;">
                    <p><strong>Descripción:</strong> Esto es una breve descripcion sobre el producto <?= htmlspecialchars($producto); ?></p>
                    <p><strong>Precio:</strong> <?= htmlspecialchars($producto)*100.5; ?>€</p>
                </div>
            </div>
        <?php else: ?>
            <p>Producto no encontrado.</p>
        <?php endif; ?>
    </main>
</body>
</html>
