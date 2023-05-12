<?php
require 'header.php';
require_once 'funciones.php';
require_once 'clases/Usuario.php';
if (!isset($_SESSION['usuario_logueado'])) {
    header('Location: ingresar.php');
    die;
}

require 'validaciones/validar-alta-usuario.php';

$user = Usuario::getById($_SESSION['usuario_logueado']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $errores==0) {
    $user->nombre = ucwords(strtolower($nombre));
    $user->apellido = ucwords(strtolower($apellido));
    $user->usuario = $usuario;
    $user->email = $email;
    $user->password = $password;
    $user->update();
    echo "
        <script>
            window.location = 'perfil.php';
        </script>
        ";
}

if(!$_POST){
    $nombre = $user->nombre;
    $apellido = $user->apellido;
    $usuario = $user->usuario;
    $email = $user->email;
    $password = $user->password;
}
if(!isset($_SESSION['editar_perfil'])||(isset($_SESSION['editar_perfil'])&&!$_SESSION['editar_perfil'])){
    echo "
    <script>
        window.location = 'perfil.php';
    </script>
    ";
    die;
}

$titulo = "Editar datos";
$valueSubmit = "Guardar cambios";
$link = "<a class='pt-3 text-right' href='salir.php?delete=1'>Eliminar cuenta</a>";

require 'templates/form-alta-usuario.php';
require 'footer.php';