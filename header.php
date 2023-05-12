<?php
//error_reporting(0);
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
include_once 'session_start.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <script src="js/jquery-3.5.1.min.js"></script>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <meta name="description" content="marketplace">
    <title>Mi tienda</title>
    <script src="https://kit.fontawesome.com/3d27c0fa4f.js"></script>
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/body.css" crossorigin="anonymous">
</head>
<?php $logo = "<span style='font-family: Josefin Sans'><i class='fas fa-store'></i> | MiTienda</span>"; ?>
<body>

<div class="nav-desktop">
    <?php include 'templates/nav-desktop.php'; ?>
</div>
<div class="nav-mobile">
    <?php include 'templates/nav-mobile.php'; ?>
</div>


