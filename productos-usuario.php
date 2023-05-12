<?php
require 'header.php';
require_once 'clases/Usuario.php';

require_once 'funciones.php';

if (!isset($_SESSION['usuario_logueado'])) {
  header('Location: ingresar.php');
  die;
}

$usuario = Usuario::getById($_SESSION['usuario_logueado']);
$productos =  $usuario->getProductos();

if(isset($_POST['delete']) && in_array($_POST['delete'],$usuario->getIdProductos())){
  $p = Producto::getById($_POST['delete']);
  if($p){
    $p->delete();
  }
}

require "templates/productos-usuario-vista.php";
require 'footer.php';