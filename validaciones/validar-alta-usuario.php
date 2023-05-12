<?php
$errores=0;
//Validar nombre.
$nombre = (isset($_POST['nombre']) ? trim($_POST['nombre']) : "");
$nombreValido = $nombre;
if($nombre == ""){
    $nombreValido="<p>Ingresa un nombre.</p>";
    $errores++;
}
elseif(strlen($nombre) > 20){
    $nombreValido="<p>El nombre debe contener 20 caracteres como máximo.</p>";
    $errores++;
}

//Validar apellido.
$apellido = (isset($_POST['apellido']) ? trim($_POST['apellido']) : "");
$apellidoValido = $apellido;
if($apellido == ""){
    $apellidoValido="<p>Ingresa un apellido.</p>";
    $errores++;
}
elseif(strlen($apellido) > 20){
    $apellidoValido="<p>El apellido debe contener 20 caracteres como máximo.</p>";
    $errores++;
}

//Validar nombre usuario.
$usuario = (isset($_POST['usuario']) ? trim($_POST['usuario']) : "");
$usuarioValido = $usuario;
if($usuario == ""){
    $usuarioValido="<p>Ingresa un nombre de usuario.</p>";
    $errores++;
}
elseif(strlen($usuario) > 20){
    $usuarioValido="<p>El nombre de usuario debe contener 20 caracteres como máximo.</p>";
    $errores++;
}
elseif(Usuario::getByUsuario($usuario)&&!isset($_SESSION['usuario_logueado'])){
    $usuarioValido="<p>El nombre de usuario ya esta en uso.</p>";
    $errores++;
}
elseif(isset($_SESSION['usuario_logueado'])){
    $user=Usuario::getById($_SESSION['usuario_logueado']);
    if($user->usuario !== $usuario && Usuario::getByUsuario($usuario)){
        $usuarioValido="<p>El nombre de usuario ya esta en uso.</p>";
        $errores++;
    }
}

//Validar e-mail.
$email = (isset($_POST['email']) ? trim($_POST['email']) : "");
$emailValido = $email;
if($email == ""){
    $emailValido="<p>Ingresa un e-mail.</p>";
    $errores++;
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $emailValido="<p>El e-mail no es válido.</p>";
    $errores++;
}
elseif(Usuario::getByUsuario($email)&&!isset($_SESSION['usuario_logueado'])){
    $emailValido="<p>La dirección de e-mail ya esta en uso.</p>";
    $errores++;
}
elseif(isset($_SESSION['usuario_logueado'])){
    $user=Usuario::getById($_SESSION['usuario_logueado']);
    if($user->email !== $email && Usuario::getByUsuario($email)){
        $emailValido="<p>La dirección de e-mail ya esta en uso.</p>";
        $errores++;
    }
}

//Validar password.
$password = $_POST['password'] ?? "";
$passwordValido = $password;
if($password == ""){
    $passwordValido="<p>La contraseña no puede estar vacía.</p>";
    $errores++;
}
elseif(strlen($password) < 6){
    $passwordValido="<p>La contraseña debe contener al menos 6 carácteres.</p>";
    $errores++;
}