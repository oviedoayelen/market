<link rel="stylesheet" href="css/carrito.css">
<div class="container-fluid mx-auto m-0 p-2 pt-4 mb-4" style="max-width:900px">
    <div class="card p-0 col-12 mb-3 m-0">
        <div class="card-header pt-2 pb-1">
            <h5>Carrito</h5>
        </div>
        <ul class="list-group list-group-flush">
            <?php 
            if($productos){
                foreach($productos as $producto) { 
                    $fotos = explode(",",$producto->foto);
                    $total += $producto->precio * $_SESSION['carrito'][$producto->id];
            ?> 
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="producto.php?producto=<?=$producto->id?>" class="d-flex justify-content-center align-items-center content-img-carrito">
                            <img src="img-productos/<?=$fotos[0]?>" class="img-fluid img-carrito">
                        </a>
                        <div class="d-flex flex-wrap justify-content-between align-items-center col-7 col-sm-8 col-lg-9 m-0 p-0">
                            <div class="col-12 col-sm-5 p-0 m-0">
                                <a class="text-dark text-decoration-none" href="producto.php?producto=<?=$producto->id?>"><?= strlen($producto->nombre) > 22 ? substr($producto->nombre, 0, 22)."..." : $producto->nombre ?></a>
                                <h5 class="pt-1"><?=formatPrecio($producto->precio)?></h5>
                            </div>
                            <div class="col-12 col-sm-7 d-flex align-items-center justify-content-between mt-3 p-0 m-0">
                                <input type="number" value="<?=$_SESSION['carrito'][$producto->id]?>" id='<?=$producto->id?>' class="addCarrito form-control input-cant">
                                <h5 class="pl-3 precio-cant"><?=formatPrecio($producto->precio * $_SESSION['carrito'][$producto->id])?></h5>
                            </div>
                        </div>
                        <div class="align-self-start">
                            <p class='deleteProduct' id='<?=$producto->id?>' style='cursor:pointer;'><i class="fas fa-times"></i></p>
                        </div>
                    </li>
                    
            <?php } ?>
            <div class="text-right p-3">
                <strong style="font-size:25px">Total: <?=formatPrecio($total)?></strong>
                <br> 
                <a href="" class="btn mt-2 btn-color">Continuar compra</a>
            </div> <?php }
                else{ ?>
                <p class="py-2 mt-4 mb-4 text-center">
                    <i style="font-size:20px" class="fas fa-search"></i>
                    <br>
                    No hay nada en tu carrito... <br>
                    <a href="productos.php">Buscar productos</a>
                </p>
            <?php } ?>  
        </ul>
    </div>
</div>
<script src="js/carrito.js"></script>