<link rel="stylesheet" href="css/favoritos-vista.css">
<div class="container-fluid p-0 m-0" >
    <?php include 'templates/sidebar.php'; ?>
    <div class="row-ml m-0 p-2 pt-4">
        <div class="card p-0 col-12 m-0 mx-auto" style="max-width:850px">
            <div class="card-header pt-2 pb-1">
                <h5>Mis favoritos</h5>
            </div>
            <ul class="list-group list-group-flush">
                <?php 
                if($productos){
                    foreach($productos as $producto) { 
                        $fotos = explode(",",$producto->foto);
                ?> 
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="producto.php?producto=<?=$producto->id?>" class="d-flex justify-content-center align-items-center content-img">
                            <img src="img-productos/<?=$fotos[0]?>" class="img-fluid">
                        </a>
                        <div class="col-7 col-md-9">
                            <a href="producto.php?producto=<?=$producto->id?>"><?= strlen($producto->nombre) > 22 ? substr($producto->nombre, 0, 22)."..." : $producto->nombre ?></a><br>
                            <small class="text-muted"><?=$producto->categoria?> - <?=$producto->marca?></small>
                            <h5><?=formatPrecio($producto->precio)?></h5>
                        </div>
                        <div class="btn-group dropleft m-3 align-self-start">
                            <i style="font-size:20px;" class="fas fa-ellipsis-v text-dark text-right" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="producto.php?producto=<?=$producto->id?>">Ver producto</a>
                                <label class='deleteFavorito dropdown-item' id="<?=$producto->id?>" for="p<?=$producto->id?>">Eliminar</label>
                            </div>
                        </div>
                    </li>     
                <?php }} else{ ?>
                    <p class="py-2 mt-4 mb-4 text-center">
                        <i style="font-size:20px" class="fas fa-search"></i>
                        <br>
                        No hay nada en tus favoritos... <br>
                        <a href="productos.php">Buscar productos</a>
                    </p>
                <?php } ?>  
            </ul>
        </div>
    </div>
</div>
<script src="js/favoritos.js"></script>