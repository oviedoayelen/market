<?php
require_once 'clases/Usuario.php';
require_once 'clases/Producto.php';
session_start();
$usuarioObjeto = Usuario::getById($_SESSION['usuario_logueado'] ?? null);

//AGREGAR A FAVORITOS
$id_favorito = isset($_POST['favoritoAdd']) ? trim($_POST['favoritoAdd']) : "";
if($id_favorito && Producto::getById($id_favorito)){
    $_SESSION['favoritos'][$id_favorito] = $id_favorito;
}

//ELIMINAR DE FAVORITOS
$favoritos = $_SESSION['favoritos'] ?? null;
$favoritoDelete = $_POST['favoritoDelete'] ?? null;
if($favoritos && $favoritoDelete){
    unset($_SESSION['favoritos'][$favoritoDelete]);
}

$usuarioObjeto->guardarFavoritos();

