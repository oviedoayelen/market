<?php
require 'header.php';
require_once 'clases/Producto.php';
require_once 'clases/Usuario.php';
require_once 'clases/Direccion.php';
require_once 'funciones.php';

$producto = null;
$id = $_GET['producto'] ?? null;
if($id && Producto::getById("$id")){
    $producto = Producto::getById($id);
}
$cantidadProducto = isset($_SESSION['carrito'][$producto->id]) ? $_SESSION['carrito'][$producto->id] : 1;
if($producto){
    $vendedor = Usuario::getById($producto->id_vendedor);
    $direccion_vendedor = $vendedor->getDirecciones()[0];
    require_once 'templates/producto-vista.php';
}
else{
?>
<div class="container-fluid mx-auto p-5" style="max-width:900px">
    <p class="py-2 p-5 text-center w-100 bg-white">
        <i style="font-size:20px" class="fas fa-search"></i>
        <br>
        Producto no disponible... <br>
        <a href="productos-articulos.php">Puedes ver todos los productos y explorar por categoría</a>
    </p>
</div>
<?php
}

require 'footer.php';
Usuario::loguearParaFavoritos();
?>
<script src="js/productos_articulos.js"></script>

