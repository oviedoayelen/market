<link rel="stylesheet" href="css/productos-usuario.css">
<div class="container-fluid m-0 p-0">
    <?php include 'templates/sidebar.php'; ?>
    
    <div class="row-ml m-0 p-2 pt-4">

        <div class="card p-0 col-12 m-0 mx-auto" style="max-width:850px">
            <div class="card-header pt-2 pb-1">
                <h5>Mis publicaciones</h5>
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
                            <a href="producto.php?producto=<?=$producto->id?>"><?= $producto->nombre ?></a><br>
                            <small class="text-muted"><?=$producto->categoria?> - <?=$producto->marca?></small>
                            <h5><?=formatPrecio($producto->precio)?></h5>
                        </div>
                        <div class="align-self-start">
                            <button class="text-dark btn deleteProduct" id="<?=$producto->id?>"><i class="far fa-trash-alt"></i></button>
                            <br><a class="text-dark btn" href="editar-producto.php?id=<?=$producto->id?>"><i class="fas fa-pencil-alt"></i></a>
                        </div>
                    </li>     
                <?php }} else{ ?>
                    <p class="py-2 mt-4 mb-4 text-center">
                        <i style="font-size:20px" class="fas fa-search"></i>
                        <br>
                        No tienes productos publicados. <br>
                        <a href="alta-producto.php">Publicá tus productos!</a>
                    </p>
                <?php } ?>  
            </ul>
        </div>

    </div>
    
</div>
<script>
$('.deleteProduct').on('click', function(){
    $.post('',{delete : this.id});
    window.location.reload();
});
</script>
