<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <title>Error</title>
</head>
<body>
    <?php $error = $_GET['error'] ?? " los datos"; ?>
    <div class="d-flex flex-column justify-content-center align-items-center text-center" style="height:100vh;">
        <img src="img/error.jpg" alt="" width="50%">
        <b style="font-size:30px">Ooopss!</b>
        <span>Ocurrio un error al intentar<br>cargar <?=$error?> :(</span>
        <a href="index.php" class="btn btn-success btn-sm mt-3">Volver al inicio</a>
    </div>
<?php
require 'footer.php';