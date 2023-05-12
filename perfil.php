<?php
require_once 'header.php';
if (!isset($_SESSION['usuario_logueado'])) {
    echo "
    <script>
        window.location = 'ingresar.php';
    </script>
    ";
    die;
}

require_once 'clases/Usuario.php';
require_once 'clases/Direccion.php';
require_once 'funciones.php';

$usuario = Usuario::getById($_SESSION['usuario_logueado']);
$direcciones =  $usuario->getDirecciones();

if(isset($_POST['dir']) && Direccion::getById($_POST['dir']) && in_array($_POST['dir'],$usuario->getIdDirecciones()) && (!$usuario->getProductos() || count($usuario->getIdDirecciones())>0)){
    $direccion = Direccion::getById($_POST['dir']);
    $direccion->delete();
}

$ocultarEditarPerfilForm = "hide";
$class=null;
$feedback="Ingresá tu contraseña...";
$_SESSION['editar_perfil'] = null;
if(isset($_POST['password'])){
    if($_POST['password']!==$usuario->password){
        $class="invalid";
        $feedback="Contraseña incorrecta!";
        $ocultarEditarPerfilForm = "show";
    }
    else{
        $_SESSION['editar_perfil'] = true;
        echo "
        <script>
            window.location = 'editar-perfil.php';
        </script>
        ";
    }
}
require "templates/perfil-vista.php";
require_once 'footer.php';