<?php
require 'header.php';

if (isset($_SESSION['usuario_logueado'])) {
    echo "<script>
        window.location = 'perfil.php';
        </script>";
    die;
}

require_once 'clases/Usuario.php';
require 'validaciones/validar-alta-usuario.php';
require_once 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $errores==0) {
    $user = new Usuario(["nombre"=>ucwords(strtolower($nombre)),"password"=>$password,"apellido"=>ucwords(strtolower($apellido)),"usuario"=>$usuario,"email"=>$email]);
    $user->insert();
    $usuarioObjeto = Usuario::getByUsuario($usuario);
    $_SESSION['usuario_logueado'] = $usuarioObjeto->id;
    $usuarioObjeto->guardarFavoritos(true);
    $usuarioObjeto->guardarCarrito(true);
    echo "<script>
            window.location = 'productos.php';
        </script>";
}
$titulo = "Registrarse";
$valueSubmit = "Registrarse";
$link = "<a href='ingresar.php'>Ya tienes cuenta?<br>Iniciar sesión</a>";
require 'templates/form-alta-usuario.php';
require 'footer.php';

