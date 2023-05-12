<?php
require_once 'clases/Producto.php';
require_once 'clases/Usuario.php';
require_once 'funciones.php';
session_start();
$usuario = Usuario::getById($_SESSION['usuario_logueado'] ?? null);
$productos = null;
$total = null;
if($usuario){
  $productos = $usuario->getCarrito();
}
elseif(isset($_SESSION['carrito'])){
    foreach ($_SESSION['carrito'] as $id=>$cant) {
      if(Producto::getById($id)){
        $productos[] = Producto::getById($id);
      }
    }
}
require 'templates/carrito-vista.php';