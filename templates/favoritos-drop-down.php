<?php
require_once 'funciones.php';
if($productos){
    foreach($productos as $producto){
        $fotos = explode(",",$producto->foto);
        ?>
        <div class="d-flex align-items-center justify-content-between border-bottom">
            <a class="d-flex justify-content-center align-items-center img p-1" style="width:110px;height:110px" href="producto.php?producto=<?=$producto->id?>">
                <img src="img-productos/<?=$fotos[0]?>" style="max-width:100%;max-height:100%" class="img-fluid pt-1">
            </a>
            <div class="col-7">
                <a href="producto.php?producto=<?=$producto->id?>"><?= strlen($producto->nombre) > 22 ? substr($producto->nombre, 0, 22)."..." : $producto->nombre ?></a><br>
                <h5><?=formatPrecio($producto->precio)?></h5>
            </div>
            <div class="align-self-start p-0 m-0">
                <label class='deleteFavorito p-0 m-0 pr-2 text-dark' id="<?=$producto->id?>" for="p<?=$producto->id?>" style='cursor:pointer;'><i class="fas fa-times"></i></label>
            </div>
        </div>
        <?php } ?>
        <div class='py-2 m-0 text-center bg-light'>
            <a href='favoritos.php' class='text-decoration-none text-dark'>Ir a favoritos</a>
        </div>
<?php }
else{
    ?>
    <p class="py-2 mt-3 text-center">
        <i style="font-size:20px" class="fas fa-search"></i>
        <br>
        No hay nada en tus favoritos... <br>
        <a href="productos.php">Buscar productos</a>
    </p>
<?php }
?>
<script src="js/favoritos.js"></script>
