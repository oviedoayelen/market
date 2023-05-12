<?php
require_once 'session_start.php';
require_once 'clases/Producto.php';
require_once 'clases/Usuario.php';
require_once 'funciones.php';
require_once 'clases/Direccion.php';
require_once 'validaciones/validar-filtros.php';
$productos = Producto::getAll($where);
$categorias = Producto::getCategorias($whereParaCategorias);
$marcas = Producto::getMarcas($whereParaMarcas);
$provincias = Producto::getProvincias($whereParaProvincias);
$localidades = Producto::getLocalidades($whereParaLocalidades);
$tituloBusqueda = count($text_breadcrumb)>1 ? implode(" ",$text_breadcrumb) : "Todos los productos";
$total_productos = $productos ? count($productos) : null;

if($productos){
    $form_filtros_mobile = true;
}
require_once 'header.php';

$usuario = Usuario::getById($_SESSION['usuario_logueado'] ?? "");
if($productos){
    $pages = null;
    $page = 0;
    $cantidad_productos_x_pagina = 20;
    $limit = "";
    $pages = ceil(count($productos) / $cantidad_productos_x_pagina);
    $last_page = $pages;
    $page = 0;
    if(isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] >=0 && $_GET['page'] <= $pages){
        $page = $_GET['page']-1;
    }
    $desde = $page * $cantidad_productos_x_pagina;
    $cantidad = $cantidad_productos_x_pagina;
    $limit = "LIMIT $desde , $cantidad";
    parse_str($_SERVER['QUERY_STRING'],$query_array);
    unset($query_array['page']);
    $query_string = http_build_query($query_array);
    $productos = Producto::getAll("$where $limit");
    require "templates/articulos-vista.php";
}else{ ?>
<div class="container-fluid mx-auto p-5" style="max-width:900px">
    <p class="py-2 p-5 text-center w-100 bg-white">
        <i style="font-size:20px" class="fas fa-search"></i>
        <br>
        No hay productos que coincidan con tu búsqueda... <br>
        <a href="productos-articulos.php">Puedes ver todos los productos y explorar por categoría</a>
    </p>
</div>
<?php
}
include 'footer.php';
Usuario::loguearParaFavoritos();



