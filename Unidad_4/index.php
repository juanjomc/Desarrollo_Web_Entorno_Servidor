<?php
session_start();

// Inicializar el carrito en la sesión si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Comprobar si se agregó un producto al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnAgregar'])) {
    $producto = $_POST['btnAgregar'];
    $_SESSION['carrito'][] = $producto;  // Agregar el nombre del producto al carrito
}

// Verificar si el usuario está logueado
$loggedIn = isset($_SESSION['username']);
$username = $loggedIn ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Tienda</title>
    <link rel="stylesheet" href="css/light.css" id="theme-style">
    <script src="js/scrip.js" defer></script>
</head>
<body>
    <header>
        <h1>Bienvenido,
            <?php if ($loggedIn): ?>
                <a href="carrito.php" id="user-link"><?= htmlspecialchars($username) ?></a>
            <?php else: ?>
                <a href="login.php" id="user-link">Iniciar sesión</a>
            <?php endif; ?>    
        </h1> 
    
        <div class="controls">
            <?php if ($loggedIn): ?>
               <a href="logout.php" id="user-link">Finalizar sesión</a>
            <?php endif; ?>
            
            <select id="theme-selector">
                <option value="light">Modo Claro</option>
                <option value="dark">Modo Oscuro</option>
            </select>

            <select id="language-selector">
                <option value="es" data-icon="🇪🇸">🇪🇸 Español</option>
                <option value="en" data-icon="🇺🇸">🇺🇸 English</option>
                <option value="fr" data-icon="🇫🇷">🇫🇷 Français</option>
                <option value="de" data-icon="🇩🇪">🇩🇪 Deutsch</option>
                <option value="it" data-icon="🇮🇹">🇮🇹 Italiano</option>
            </select>

            <!-- Contador que se ira actualizando conforme vaya introduciendo elementos en el carrito -->
            <span class="cart-icon"><?= count($_SESSION['carrito']); ?>🛒</span>
        </div>
    </header>

    <main>
    <form action="index.php" method="POST">
        <section class="product-grid">
        
            <?php
/* Con este bucle creamos una grilla con 6 productos, donde cada elemento esta representado por un id 
 y ese id lo usamos para cargar la imagen y desarrollar su descripcion */

            for($i=1;$i<7;$i++){
                echo "<div class=\"product\">";
                echo "<a href=\"detalle.php?producto=".$i."\"><img src=\"img/".$i.".webp\" alt=\"Producto 1\"></a>";
                echo "<p>Descripción breve del producto ".$i."</p>";
                if ($loggedIn):
                    echo "<button type=\"submit\" value=\"Producto ".$i."\" name=\"btnAgregar\">Agregar</button>";
                endif;
                echo "</div>";
            }
            ?>

        </section>
    </form>
    </main>
</body>
</html>
