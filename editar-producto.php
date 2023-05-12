<?php
require_once 'header.php';
require_once 'clases/Marca.php';
require_once 'clases/Categoria.php';
require_once 'clases/Producto.php';
require_once 'clases/Usuario.php';
if (!isset($_SESSION['usuario_logueado'])) {
    header('Location: index.php');
    die;
}
require_once 'funciones.php';
require 'validaciones/validar-alta-producto.php';
$categorias = Categoria::getAll();
$usuario = Usuario::getById($_SESSION['usuario_logueado']);

$id = $_GET['id'] ?? null;
$producto = Producto::getById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $errores==0) {
    $marcaObjeto = new Marca(["nombre"=>ucwords(strtolower($marca))]);
    $producto->nombre = $nombre_producto;
    $producto->precio = $precio;
    $producto->id_categoria = $categoria;
    $producto->id_marca = $marcaObjeto->id;
    if($nombres_fotos){
        $producto->foto = implode(",",$nombres_fotos);
    }
    $producto->descripcion = $descripcion;
    $producto->update();
    modalSuccess("Cambios guardados correctamente");
    echo "<script>
            function redirigir() {
                window.location = 'productos-usuario.php';
            }
            setInterval(redirigir,1500);
        </script>";
}

if(in_array($id,$usuario->getIdProductos()) && !$_POST){
    $nombre_producto = $producto->nombre;
    $precio = $producto->precio;
    $categoria = $producto->id_categoria;
    $marca = $producto->marca;
    $descripcion = $producto->descripcion;
}
elseif(!in_array($id,$usuario->getIdProductos())){
    echo "
        <script>
                location.href = 'productos-usuario.php';
        </script>
        ";
    die;
}
$titulo = "Editar productos";
$valueSubmit = "Guardar cambios";
require 'templates/form-alta-producto.php';
require 'footer.php';


