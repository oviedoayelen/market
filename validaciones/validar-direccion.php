<?php
$observaciones = $_POST['observaciones'] ?? null;
$calle1 = $_POST['calle1'] ?? null;
$calle2 = $_POST['calle2'] ?? null;

$nombre_direccion = (isset($_POST['nombre_direccion']) ? trim($_POST['nombre_direccion']) : "");
$nombre_direccionValido = $nombre_direccion;

if($nombre_direccion==""){
    $nombre_direccionValido="<p>Ingresa un nombre.</p>"; 
    $errores++;
}

$apellido = (isset($_POST['apellido']) ? trim($_POST['apellido']) : "");
$apellidoValido = $apellido;

if($apellido==""){
    $apellidoValido="<p>Ingresa un apellido.</p>"; 
    $errores++;
}
   
//Validar calle.
$calle = (isset($_POST['calle']) ? trim($_POST['calle']) : "");
$calleValida = $calle;

if($calle==""){
    $calleValida="<p>Ingresa una calle.</p>"; 
    $errores++;
}

//Validar altura.
$altura = (isset($_POST['altura']) ? trim($_POST['altura']) : "");
$alturaValida = $altura;

if($altura=="" || !ctype_digit($altura)){
    $alturaValida="<p>Ingresa una altura válida.</p>"; 
    $errores++;
}

//Validar cp.
$cp = (isset($_POST['cp']) ? trim($_POST['cp']) : "");
$cpValido = $cp;

if($cp=="" || !ctype_digit($cp)){
    $cpValido="<p>Ingresa un código postal válido.</p>"; 
    $errores++;
}
//Validar teléfono.
$telefono = (isset($_POST['telefono']) ? trim($_POST['telefono']) : "");
$telefonoValido = $telefono;

if($telefono=="" || !ctype_digit($telefono)){
    $telefonoValido="<p>Ingresa un número de teléfono válido.</p>";
    $errores++;
}

$provincias = Direccion::getProvincias();
$provincia = $_POST['provincia'] ?? null;
$provinciaValida = $provincia;
if(!$provincia || !isset($provincias[$provincia])){
    $provinciaValida = "Selecciona una provincia.";
    $errores++;
}

$where = $provincia ? " WHERE id_provincia = '$provincia'" :  " WHERE id_provincia = '02'" ;
$localidades = Direccion::getLocalidades($where);
$localidad = $_POST['localidad'] ?? null;
$localidadValida = $localidad;
if(!$localidad || !isset($localidades[$localidad])){
    $localidadValida = "Selecciona una localidad.";
    $errores++;
}