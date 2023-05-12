<?php

session_start();

if(isset($_GET['delete']) && isset($_SESSION['usuario_logueado'])){  
    require_once 'clases/Usuario.php';
    $user = Usuario::getById($_SESSION['usuario_logueado']);
    $user->delete();
}

session_unset();
session_destroy();

header('Location: index.php');

