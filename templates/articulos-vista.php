<link rel="stylesheet" href="css/productos-articulos.css">
<div id="row" class="container-fluid row m-0 p-3 mx-auto" style="max-width:1350px;">
    <?php
    if(count($links_breadcrumb)>1){
    ?>
        <nav aria-label="breadcrumb" class="col-12 m-0 p-0">
        <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item active m-0 pb-2" aria-current="page">
            <a href="?">Todos los productos</a>
        </li>
        <?php
        for($i=1; $i<count($links_breadcrumb); $i++){
            $link = null;
            for($j=1; $j<=$i; $j++){
                $link .= $links_breadcrumb[$j];
            }
        ?>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="?<?=$link?>"><?=$text_breadcrumb[$i]?></a>
            </li>
        <?php
        } 
        ?>
        </ol>
        </nav>
    <?php
    }
    ?>
    <?php include 'templates/form-filtros-desktop.php' ?>
    <div class="p-0 m-0 col-sm">
        <div class="row m-0 p-0 d-flex justify-content-center">
            <?php
            foreach ($productos as $producto) {
                $fotos = explode(",",$producto->foto);
            ?>
            <div class="rounded card col mb-2 ml-1 mr-1 p-0 card-producto">
                <a class="text-decoration-none text-dark" href="producto.php?producto=<?=$producto->id?>">
                    <div class="content-img-producto d-flex justify-content-center align-items-center">
                        <img src="img-productos/<?=$fotos[0]?>" class="img-fluid">
                    </div>
                    <div class="card-body border-top d-flex justify-content-between p-3 m-0">
                        <div class="">
                            <h4 class="precio"><?=formatPrecio($producto->precio)?></h5>
                            <span class="nombre-producto"><?= strlen($producto->nombre) > 22 ? substr($producto->nombre, 0, 22)."..." : $producto->nombre ?></span>
                            <br>
                            <small class="text-muted">Por <?=$producto->marca?></small>
                        </div>
                    </div>
                    <div class="d-flex m-0 p-0 icon-favorito">
                        <input class="favorito" <?php $usuario ? $usuario->checkedFavorito($producto->id) : null ?> style="display:none" type="checkbox" id="p<?=$producto->id?>" value="<?=$producto->id?>"></input>
                        <label for="p<?=$producto->id?>" class="d-flex justify-content-center align-items-center"><i name="p<?=$producto->id?>" class="far fa-heart"></i></label>
                    </div> 
                </a>
            </div>
            <?php } ?>
        </div>
        <?php if($pages){ ?>
        <nav aria-label="Page navigation" class="mt-5 p-1 m-0 d-flex justify-content-center">
            <ul class="pagination">
                <li class="page-item">
                <a class="page-link text-dark" href="productos.php?<?=$query_string ? "$query_string&page=1" : "page=1"?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
                </li>
                <?php
                for($i = 0; $i < $pages; $i++){
                    $pagina = $i+1;
                ?>
                <li class="page-item"><a class="page-link text-dark" href="productos.php?<?=$query_string ? "$query_string&page=$pagina" : "page=$pagina"?>"><?=$pagina?></a></li>
                <?php } ?>
                <li class="page-item">
                <a class="page-link text-dark" href="productos.php?<?=$query_string ? "$query_string&page=$last_page" : "page=$last_page"?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
                </li>
            </ul>
        </nav>
        <?php } ?>
    </div>
</div>

<script src="js/productos-articulos.js"></script>

