<?php
session_start();

require_once 'clases/Usuario.php';

$usuario = Usuario::getById($_SESSION['usuario_logueado']);
$productos = $usuario->getFavoritos();

require 'templates/favoritos-drop-down.php';