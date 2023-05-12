<?php
require_once 'clases\Categoria.php';
require_once 'clases\Marca.php';

//VALÍDO EL NOMBRE Y GUARDO LA CONSULTA EN $buscarPorNombre..
$nombre = isset($_GET['p']) ? trim($_GET['p']) : "";
$links_breadcrumb[] = null;
$text_breadcrumb[] = null;
$buscarPorNombre = null;
if($nombre){
$links_breadcrumb[] = "p=$nombre&";
$text_breadcrumb[] = $nombre;
foreach(explode(" ",$nombre) as $unNombre){
    if($unNombre){
        $buscarPorNombre.=" p.nombre LIKE '%$unNombre%' OR c.nombre LIKE '%$unNombre%' OR m.nombre LIKE '%$unNombre%' OR p.descripcion LIKE '%$unNombre%' OR";
    }
}
}
if($buscarPorNombre){
    $buscarPorNombre = "(".trim($buscarPorNombre,"OR").") AND";
}

//VALÍDO EL ID DE LA CATEGORÍA Y LO GUARDO EN $buscarPorCategoria.
$categoria_id = isset($_GET['categoria']) ? trim($_GET['categoria']) : "";
$buscarPorCategoria = null;
if(ctype_digit($categoria_id) && Categoria::getById($categoria_id)){
    $buscarPorCategoria = " p.id_categoria = $categoria_id AND";
    $categoria_relevancia = Categoria::getById($categoria_id);
    $categoria_relevancia->update();
    $links_breadcrumb[] = "categoria=$categoria_id&";
    $text_breadcrumb[] = $categoria_relevancia->nombre;;
}

//VALÍDO LOS ELEMENTOS DEL ARRAY MARCAS Y GUARDO LA CONSULTA EN $buscarPorMarca.
$marcas_id = $_GET['marcas'] ?? "";
$marca_id = "";
if($marcas_id){
    $links_breadcrumb_str = null;
    $text_breadcrumb_str = null;
    foreach($marcas_id as $marcaId){
        $marcaIdTrim = trim($marcaId);
        if(ctype_digit($marcaIdTrim) && Marca::getById($marcaIdTrim)){
            $marca_id.=" p.id_marca = $marcaIdTrim OR";
            $links_breadcrumb_str .= "marcas[]=$marcaIdTrim&";
            $text_breadcrumb_str .= Marca::getById($marcaIdTrim)->nombre.", ";
        }
    }
    $links_breadcrumb[] = $links_breadcrumb_str;
    $text_breadcrumb[] = trim($text_breadcrumb_str,", ");
}
$buscarPorMarca = $marca_id ? " (".trim($marca_id,"OR").") AND" : null;

//VALÍDO EL ID DE LA PROVINCIA Y LO GUARDO EN $buscarPorProvincia.
$provincias_array = Direccion::getProvincias();
$provincia_id = isset($_GET['provincia']) ? trim($_GET['provincia']) : "";
$buscarPorProvincia = null;
if(isset($provincias_array[$provincia_id])){
    $buscarPorProvincia = " d.id_provincia = $provincia_id AND";
    $links_breadcrumb[] = "provincia=$provincia_id&";
    $text_breadcrumb[] = $provincias_array[$provincia_id];
}

//VALÍDO LOS ELEMENTOS DEL ARRAY localidades Y GUARDO LA CONSULTA EN $buscarPorLocalidad.
$localidades_array = Direccion::getLocalidades();
$localidades_id = $_GET['localidades'] ?? "";
$localidad_id = "";
if($localidades_id){
    $links_breadcrumb_str = null;
    $text_breadcrumb_str = null;
    foreach($localidades_id as $localidadId){
        $localidadIdTrim = trim($localidadId);
        if(isset($localidades_array[$localidadIdTrim])){
            $localidad_id.=" d.id_localidad = $localidadIdTrim OR";
            $links_breadcrumb_str .= "localidades[]=$localidadIdTrim&";
            $text_breadcrumb_str .= ucwords(strtolower($localidades_array[$localidadIdTrim])).", ";
        }
    }
    $links_breadcrumb[] = $links_breadcrumb_str;
    $text_breadcrumb[] = trim($text_breadcrumb_str,", ");
}
$buscarPorLocalidad = $localidad_id ? " (".trim($localidad_id,"OR").") AND" : null;

//VALÍDO EL PRECIO MÍNIMO Y GUARDO LA CONSULTA EN $buscarPorPrecioMin.
$minimo = isset($_GET['min']) ? trim($_GET['min']) : "";
$buscarPorPrecioMin = null;
if(is_numeric($minimo) && $minimo > 0){
    $buscarPorPrecioMin = " precio >= $minimo AND";
}

//VALÍDO EL PRECIO MÁXIMO Y GUARDO LA CONSULTA EN $buscarPorPrecioMax.
$maximo = isset($_GET['max']) ? trim($_GET['max']) : "";
$buscarPorPrecioMax = null;
if(is_numeric($maximo)){
    $buscarPorPrecioMax = " precio <= $maximo AND";
    if($maximo < $minimo){
        $buscarPorPrecioMin = " precio <= $minimo AND";
        $buscarPorPrecioMax = " precio >= $maximo AND";
    }
}

//GUARDO LA BÚSQUEDA COMPLETA.
$busquedaCompleta = $buscarPorNombre . $buscarPorCategoria . $buscarPorPrecioMin . $buscarPorPrecioMax . $buscarPorMarca . $buscarPorProvincia . $buscarPorLocalidad;
$where = null;
//SI LA BÚSQUEDA COMPLETA TIENE CONTENIDO GUARDO LA CONSULTA EN $where PARA ENVIARLA POR PARÁMETRO AL MÉTODO getAll() DE LA CLASE Productos.
if($busquedaCompleta){
    $where = " AND ".trim($busquedaCompleta,"AND");
}

//LO MISMO PARA LOS MÉTODOS QUE RETORNAN LAS CATEGORÍAS Y MARCAS.
$busquedaCompletaParaCategorias = $buscarPorNombre . $buscarPorPrecioMin . $buscarPorPrecioMax . $buscarPorMarca . $buscarPorLocalidad . $buscarPorProvincia;
$whereParaCategorias = null;
if($busquedaCompletaParaCategorias){
    $whereParaCategorias = " AND ".trim($busquedaCompletaParaCategorias,"AND");
}

$busquedaCompletaParaMarcas = $buscarPorNombre . $buscarPorCategoria . $buscarPorPrecioMin . $buscarPorPrecioMax . $buscarPorProvincia . $buscarPorLocalidad;
$whereParaMarcas = null;
if($busquedaCompletaParaMarcas){
    $whereParaMarcas = " AND ".trim($busquedaCompletaParaMarcas,"AND");
}

$busquedaCompletaParaProvincias = $buscarPorNombre . $buscarPorCategoria . $buscarPorMarca . $buscarPorPrecioMin . $buscarPorPrecioMax . $buscarPorLocalidad;
$whereParaProvincias = null;
if($busquedaCompletaParaProvincias){
    $whereParaProvincias = " AND ".trim($busquedaCompletaParaProvincias,"AND");
}

$busquedaCompletaParaLocalidades = $buscarPorNombre . $buscarPorCategoria . $buscarPorMarca . $buscarPorPrecioMin . $buscarPorPrecioMax . $buscarPorProvincia;
$whereParaLocalidades = null;
if($busquedaCompletaParaLocalidades){
    $whereParaLocalidades = " AND ".trim($busquedaCompletaParaLocalidades,"AND");
}

//FUNCION PARA CHECKEAR LOS CHECKBOX AL ACTUALIZAR LA PÁGINA.
function checkedMarca($id){
    global $marcas_id;
    if($marcas_id){
        foreach($marcas_id as $marca){
            if($marca == $id){
                echo "checked";
            } 
        }
    }
}

function checkedLocalidad($id){
    global $localidades_id;
    if($localidades_id){
        foreach($localidades_id as $localidad){
            if($localidad == $id){
                echo "checked";
            } 
        }
    }
}


