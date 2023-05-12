<?php
require_once 'header.php';
require_once 'clases/Marca.php';
require_once 'clases/Categoria.php';
require_once 'clases/Producto.php';
require_once 'clases/Usuario.php';
if (!isset($_SESSION['usuario_logueado'])) {
    header('Location: ingresar.php');
    die;
}
$usuario = Usuario::getById($_SESSION['usuario_logueado']);
require_once 'funciones.php';
require 'validaciones/validar-alta-producto.php';
if(!$usuario->getDirecciones()){
    require_once 'validaciones/validar-direccion.php';
}
$categorias = Categoria::getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $errores==0) {
    $fotos_producto = $nombres_fotos ? implode(",",$nombres_fotos) : NULL;
    $marcaObjeto = new Marca(["nombre"=>ucwords($marca)]);
    $id_producto = uniqid();
    $producto = new Producto(["id"=>$id_producto,"id_vendedor"=>$usuario->id,"nombre"=>$nombre_producto,"precio"=>$precio,"id_categoria"=>$categoria,"id_marca"=>$marcaObjeto->id,"foto"=>$fotos_producto,"descripcion"=>$descripcion]);
    $producto->insert();
    if(isset($_POST['provincia'])){
        $id_direccion = uniqid();
        $objDireccion = new Direccion(["id"=>$id_direccion,"id_provincia"=>$provincia,"id_localidad"=>$localidad,"calle"=>$calle,"altura"=>$altura,"calle1"=>$calle1,"calle2"=>$calle2,"telefono"=>$telefono,"observaciones"=>$observaciones,"id_usuario"=>$usuario->id,"codigo_postal"=>$cp,"nombre"=>$nombre_direccion,"apellido"=>$apellido]);
        $objDireccion->insert();
    }
    $nombre_producto = '';
    $precio = '';
    $categoria = '';
    $marca = '';
    $descripcion = '';
    $mnsj = "Se dio de alta el producto <br> de manera exitosa.<br>
            <a href='producto.php?producto=$id_producto'>Ver producto</a>";
    modalSuccess($mnsj);   
}
$titulo = "Producto";
$valueSubmit = "Publicar";
require 'templates/form-alta-producto.php';
require 'footer.php';




