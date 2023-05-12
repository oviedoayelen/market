<?php
require 'header.php';

if (isset($_SESSION['usuario_logueado'])) {
    echo "<script>
            window.location = 'perfil.php';
        </script>";
    die;
}

require_once 'clases/Usuario.php';
require_once 'funciones.php';

$mnsjError = null;
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!$usuario||!$password){
        $mnsjError = "Ingresa ambos datos!";
    }
    elseif(Usuario::loguearUsuario($usuario,$password)) {
        $usuarioObjeto = Usuario::getByUsuario($usuario);
        $_SESSION['usuario_logueado'] = $usuarioObjeto->id;
        $usuarioObjeto->guardarFavoritos(true);
        if($usuarioObjeto->getFavoritosArray()){
            $_SESSION['favoritos'] = $usuarioObjeto->getFavoritosArray();
        }
        $usuarioObjeto->guardarCarrito(true);
        if($usuarioObjeto->getCarritoArray()){
            $_SESSION['carrito'] = $usuarioObjeto->getCarritoArray();
        }
        echo "<script>
                window.location = 'productos.php';
            </script>";
    }
    else{
        $mnsjError = "Usuario y/o contraseña incorrectos!";
    }
}

require 'templates/form-login.php';
require 'footer.php';


