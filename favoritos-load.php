<?php
session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header('Location: ingresar.php');
    die;
}
require_once 'clases/Usuario.php';
require_once 'funciones.php';
$productos = null;
$usuario = Usuario::getById($_SESSION['usuario_logueado']);
$productos = $usuario->getFavoritos();
require "templates/favoritos-vista.php";