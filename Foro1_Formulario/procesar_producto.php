<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Informacion del Producto</title>
</head>
<body>
    

<?php
// procesar_producto.php

// Array de productos dummies
$productos = [
    "producto1" => ["nombre" => "Producto 1", "categoria" => "Categoría A", "cantidad" => 10, "precio" => 5.99],
    "producto2" => ["nombre" => "Producto 2", "categoria" => "Categoría B", "cantidad" => 20, "precio" => 9.99],
    "producto3" => ["nombre" => "Producto 3", "categoria" => "Categoría A", "cantidad" => 15, "precio" => 7.99],
    "producto4" => ["nombre" => "Producto 4", "categoria" => "Categoría C", "cantidad" => 5, "precio" => 12.99],
    "producto5" => ["nombre" => "Producto 5", "categoria" => "Categoría D", "cantidad" => 8, "precio" => 3.99],
    "producto6" => ["nombre" => "Producto 6", "categoria" => "Categoría B", "cantidad" => 25, "precio" => 6.99],
    "producto7" => ["nombre" => "Producto 7", "categoria" => "Categoría C", "cantidad" => 30, "precio" => 8.99],
    "producto8" => ["nombre" => "Producto 8", "categoria" => "Categoría D", "cantidad" => 12, "precio" => 4.99],
    "producto9" => ["nombre" => "Producto 9", "categoria" => "Categoría A", "cantidad" => 18, "precio" => 10.99],
    "producto10" => ["nombre" => "Producto 10", "categoria" => "Categoría B", "cantidad" => 22, "precio" => 11.99],
    // Añade más productos según sea necesario
];

echo "<div class=\"container mt-5\">";

//Comprobamos si se va a agregar un producto nuevo

if (isset($_GET['nombre']) && isset($_GET['categoria']) && isset($_GET['cantidad']) && isset($_GET['precio']) && isset($_GET['agr'])) {
    $nombre = $_GET['nombre'];
    $categoria = $_GET['categoria'];
    $cantidad = $_GET['cantidad'];
    $precio = $_GET['precio'] . ".99";
    $productos[] = ["nombre" => $nombre, "categoria" => $categoria, "cantidad" => $cantidad, "precio" => $precio];
}

//Sino se va agregar un producto nuevo comprobamos si se va a incrementar la cantidad de un producto

elseif (isset($_GET['nombre']) && isset($_GET['categoria']) && isset($_GET['cantidad']) && isset($_GET['act'])) {
    $nombre = $_GET['nombre'];
    $categoria = $_GET['categoria'];
    $cantidad = $_GET['cantidad'];
    $act = $_GET['act'];
    if ($act === 'inc') {
        foreach ($productos as $key => $producto) {
            if ($producto['nombre'] === $nombre && $producto['categoria'] === $categoria) {
                $productos[$key]['cantidad'] += $cantidad;
                break;
            }
        }
    }
}

//Sino ha ocurrido nada de lo anterior, buscamos el producto en el array y mostramos su información o un mensaje de que no esta disponible

else

{
    // Obtener los datos del formulario
    $nombre_producto = $_POST['nombre_producto'];
    $categoria_producto = $_POST['categoria_producto'];
    $cantidad_deseada = $_POST['cantidad_deseada'];

    // Buscar el producto en el array
    $producto_encontrado = null;
    foreach ($productos as $producto) {
        if ($producto['nombre'] === $nombre_producto && $producto['categoria'] === $categoria_producto) {
            $producto_encontrado = $producto;
            break;
        }
    }

    // Mostrar la información del producto o un mensaje de error

    if ($producto_encontrado) {
        echo "<h2>Información del Producto</h2>";
        echo "<p><strong>Nombre:</strong> " . $producto_encontrado['nombre'] . "</p>";
        echo "<p><strong>Categoría:</strong> " . $producto_encontrado['categoria'] . "</p>";
        echo "<p><strong>Cantidad disponible:</strong> " . $producto_encontrado['cantidad'] . "</p>";
        echo "<p><strong>Precio por unidad:</strong> " . $producto_encontrado['precio'] . "€</p>";
        //Ofrecemos la posibilidad de incrementar la cantidad del producto y pasamos por la url los datos
        echo '<a href="procesar_producto.php?act=inc&nombre='.$nombre_producto.'&categoria='.$categoria_producto.'&cantidad='.$cantidad_deseada.'" class="btn btn-primary" value="incrementar">Incrementar la cantidad</a>';    

        
    } else {
        echo '<p>El producto con Nombre:'.$nombre_producto.' y categoria:'.$categoria_producto.' no está disponible, puede agregarlo al listado o realizar una nueva busqueda</p>';
        //Ofrecemos la posibilidad de agregar el producto al listado y pasamos por la url los datos
        echo '<a href="procesar_producto.php?act=agr&nombre='.$nombre_producto.'&categoria='.$categoria_producto.'&cantidad='.$cantidad_deseada.'&precio='.rand(1, 99).'" class="btn btn-primary">Agregar al listado</a>';

    }
    echo "</div>";
    

}
// Botón para volver al formulario
echo '<div class="container mt-3">';
echo '<a href="index.html" class="btn btn-primary">Volver a la búsqueda</a>';
echo '</div>';
echo '<div class="container mt-5">';

// Mostrar todos los productos que tenemos en el array
echo "<details><summary><h2>Haz clic para ver todo el array con todos los productos</h2></summary>";
foreach ($productos as $producto) {
    echo "<p>" . $producto['nombre'] . "<br>" . $producto['categoria'] . "<br>" . $producto['cantidad'] . "<br>" . $producto['precio'] . "€</p>";

}

?>
</div>
</details>
</body>
</html>