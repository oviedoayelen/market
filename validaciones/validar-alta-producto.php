<?php
$errores=0;
//Validar nombre_producto.
$nombre_producto = (isset($_POST['nombre_producto']) ? trim($_POST['nombre_producto']) : "");
$nombre_productoValido = $nombre_producto;
if($nombre_productoValido==""){
    $nombre_productoValido="<p>El nombre no puede estar vacío.</p>";
    $errores++;
}
elseif(strlen($nombre_productoValido) > 30){
    $nombre_productoValido="<p>El nombre debe contener 30 caracteres como máximo.</p>";
    $errores++;
}
   
//Validar precio.
$precio = (isset($_POST['precio']) ? trim($_POST['precio']) : "");
$precioValido = $precio;
if($precioValido==""){
    $precioValido="<p>El precio no puede estar vacío.</p>";
    $errores++;
}
elseif(!is_numeric($precioValido)){
    $precioValido="<p>El precio debe contener un valor numérico.</p>";
    $errores++;
}
elseif($precioValido < 0){
    $precioValido="<p>El precio debe contener un valor positivo.</p>";
    $errores++;
}

//Validar categoria.
$categoria = $_POST['categoria'] ?? "";
$categoriaValida = $categoria;
if($categoriaValida=="" || !Categoria::getById($categoria)){
    $categoriaValida="<p>Seleccione una categoría válida.</p>";
    $errores++;
}

//Validar marca.
$marca = (isset($_POST['marca']) ? trim($_POST['marca']) : "");
$marcaValida = $marca;
if($marcaValida==""){
    $marcaValida="<p>Ingrése una marca.</p>";
    $errores++;
}

//Validar descripcion.
$descripcion = (isset($_POST['descripcion']) ? trim($_POST['descripcion']) : "");
$descripcionValida = $descripcion;
if(strlen($descripcionValida) > 500){
    $descripcionValida="<p>La descripción debe contener 500 caracteres como máximo.</p>";
    $errores++;
}

//Validar foto
$fotos = "";
$fotosValidas = $fotos;
$nombres_fotos = null;
if(isset($_FILES['fotos'])){
    $fotos_nombres = $_FILES['fotos']['tmp_name'];
    $fotos_errores = $_FILES['fotos']['error'];
    for($i=0; $i<count($fotos_nombres); $i++){
        if($fotos_errores[$i] == UPLOAD_ERR_OK && getimagesize($fotos_nombres[$i])){
            if($errores==0){
                $nombre_foto = sha1_file($fotos_nombres[$i]);
                $nombres_fotos[] = $nombre_foto;
                move_uploaded_file($fotos_nombres[$i],"img-productos/".$nombre_foto);
            }
            else{
                $fotosValidas="<p>Subí de nuevo las imagenes.</p>";
                break;
            }
        }
        elseif($fotos_errores[$i] == UPLOAD_ERR_OK && !getimagesize($fotos_nombres[$i])){
            $fotosValidas="<p>Uno de los archivos que intentas subir no es una imagen.</p>";
            $errores++;
            break;
        }
        elseif($fotos_errores[$i] !== UPLOAD_ERR_OK && $fotos_errores[$i] !== UPLOAD_ERR_NO_FILE){
            $fotosValidas = "<p>No se pudieron subir las imagenes, intentalo de nuevo.</p>";
            $errores++;
            break;
        }
    }
}
