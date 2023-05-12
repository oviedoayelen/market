<?php
require_once 'clases/Usuario.php';
require_once 'clases/Producto.php';
session_start();
//CARGAR EL CARRITO...
$id_producto = isset($_POST['productoAdd']) ? trim($_POST['productoAdd']) : "";
if($id_producto && Producto::getById($id_producto)){
    if(isset($_POST['cantidad']) && $_POST['cantidad']>0){
        $_SESSION['carrito'][$_POST['productoAdd']] = $_POST['cantidad'];   
    }
    elseif(!isset($_SESSION['carrito'][$_POST['productoAdd']])){
        $_SESSION['carrito'][$_POST['productoAdd']] = 1;   
    }
}

//ELIMINAR DEL CARRITO...
$carrito = $_SESSION['carrito'] ?? null;
$id = $_POST['productoDelete'] ?? null;
if($carrito && $id){
   unset($_SESSION['carrito'][$_POST['productoDelete']]);
}

//GUARDAR EN LA BD SI EL USUARIO ESTA LOGUEADO...
$usuarioObjeto = Usuario::getById($_SESSION['usuario_logueado'] ?? null);
if($usuarioObjeto){
    $usuarioObjeto->guardarCarrito();
}

//CANTIDAD DEL CARRITO PARA POSTERALO EN EL HEADER...
$count = null;
if(isset($_SESSION['carrito']) && $_SESSION['carrito']){
    $count = count($_SESSION['carrito']);
}
if($count){
    echo "($count)";
}else{
    echo "";
}