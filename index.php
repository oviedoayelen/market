
<?php
require 'header.php';
require_once 'clases/Usuario.php';
require_once 'clases/Producto.php';
require 'clases/Categoria.php';
require_once 'funciones.php';
$usuario = Usuario::getById($_SESSION['usuario_logueado'] ?? null);
$categorias = Categoria::getAll();
$titulo_owl_productos_1 = "Lo último en celulares";
$titulo_owl_productos_2 = "Renova tu espacios";
$productos_owl_1 = Producto::getAll(" AND p.id_categoria = 18");
$productos_owl_2 = Producto::getAll(" AND p.id_categoria = 15");
?>
<link rel="stylesheet" href="css/index.css" crossorigin="anonymous">
<div class="container-fluid mx-auto p-0 m-0">
    <!-- CAROUSEL PRINCIPAL -->
    <div id="carouselExampleControls" class="carousel slide p-0 m-0" data-ride="carousel">
        <div class="carousel-inner">
            <a class="carousel-item active" href="productos.php?categoria=16">
                <picture>
                    <source srcset="img/carousel-mobile-1.png" media="(max-width:900px)">
                    <img class="d-block" src="img/carousel-desktop-1.png" alt="First slide">
                </picture>
            </a>
            <a class="carousel-item" href="productos.php?categoria=22">
                <picture>
                    <source srcset="img/carousel-mobile-2.png" media="(max-width:900px)">
                <img class="d-block" src="img/carousel-desktop-2.png" alt="Second slide">
                </picture>
            </a>
            <a class="carousel-item" href="alta-producto.php">
                <picture>
                    <source srcset="img/carousel-mobile-3.png" media="(max-width:900px)">
                    <img class="d-block" src="img/carousel-desktop-3.png" alt="Third slide">
                </picture>
            </a>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> 

    <div id="contenido" class="mx-auto">

         <!--  INFORMACIÓN SOBRE MEDIOS DE PAGO, ENVIOS, DEVOLUCIONES... -->
        <div id="info" class="bg-white justify-content-around d-flex p-3 mt-4 mb-3 ml-3 mr-3 rounded">
            <div id="pagos" class="d-flex justify-content-center align-items-center">
                <div class="border p-2" style="border-radius:100px">
                    <img src="img/pagos.png" width="30px" class="img-fluid">
                </div>
                <div class="ml-2">
                    <span>Pagá en hasta 12 cuotas</span><br>
                    <a href="">Ver promociones</a>
                </div>     
            </div>
            <div id="envios" class="d-flex justify-content-center align-items-center ml-3">
                <div class="border p-2" style="border-radius:100px">
                    <img src="img/envios.png" width="30px" class=" img-fluid">
                </div>
                <div class="ml-2">
                    <span>Envíos gratis desde $2500</span><br>
                    <a href="">Saber más</a>
                </div>     
            </div>
            <div id="devoluciones" class="d-flex justify-content-center align-items-center ml-3">
                <div class="border p-2" style="border-radius:100px">
                    <img src="img/cambios.png" width="30px" class="img-fluid">
                </div>
                <div class="ml-2">
                    <span>Cambios y devoluciones gratis</span><br>
                    <a href="">Saber más</a>
                </div>     
            </div>
        </div>

        <!-- OWL CAROUSEL CON LAS CATEGORÍAS -->
        <h4 class="mt-4 ml-2 pl-1">Categorías<small class="ml-2"><a href="">Ver todas</a></small></h4>
        <div id="owl-categorias" class="owl-carousel owl-theme mt-4 pl-2 pr-2">
            <?php
            foreach($categorias as $categoria){
            ?>
                <a class="text-decoration-none" href="productos.php?categoria=<?=$categoria->id?>">
                    <div class="text-center">
                        <img class="item bg-white mb-2" src="img-categorias/<?=$categoria->foto?>" class="img-fluid" alt="">
                        <br>
                        <strong class="text-dark"><?=$categoria->nombre?></strong>
                    </div>
                </a>
            <?php
            }
            ?>
        </div>

        <!-- OWL CAROUSEL CON PRODUCTOS -->
        <h4 class="mt-4 ml-2 pl-1"><?="Productos destacados"?> <small class="ml-2"><a href="">Ver más</a></small></h4>
        <div id="owl-productos-1" class="owl-carousel text-center pl-2 pr-2 owl-productos">
            <?php
            $productos =  $productos_owl_1 && count($productos_owl_1) > 4 ? $productos_owl_1 : Producto::getAll();
            foreach($productos as $producto){
                $fotos = explode(",",$producto->foto);
            ?>
            <a class="text-decoration-none text-dark" href="producto.php?producto=<?=$producto->id?>">
                <div class="m-1 rounded border bg-white">
                    <div class="content-img-owl-producto d-flex justify-content-center align-items-center">
                        <img src="img-productos/<?=$fotos[0]?>" class="img-fluid img-producto">
                        <div class="d-flex m-0 p-0 icon-favorito">
                            <input class="favorito" style="display:none" type="checkbox" <?php $usuario ? $usuario->checkedFavorito($producto->id) : null ?>  id="p<?=$producto->id?>" value="<?=$producto->id?>"></input>
                            <label for="p<?=$producto->id?>" class="d-flex justify-content-center align-items-center label-favorito"><i name="p<?=$producto->id?>" class="far fa-heart"></i></label>
                        </div>   
                    </div>
                    <div class="py-2 border-top">  
                        <div class="pl-2 pr-2 m-0 texto-suspensivo"><?=$producto->nombre?></div>
                        <small><s class="text-muted"><?=formatPrecio($producto->precio)?></s></small>
                        <div class="d-flex justify-content-center">
                            <h5 class="precio" style="padding-top:2px"><?=formatPrecio($producto->precio-$producto->precio*0.1)?></h5>
                            <span class="text-success align-self-start p-1" style="font-size:11px;">10% OFF</span>
                        </div> 
                    </div>
                </div>
            </a>
            <?php } ?>
        </div>

        <!-- OWL CAROUSEL CON PRODUCTOS -->
        <h4 class="mt-4 ml-2 pl-1"> <?="Productos destacados"?> <small class="ml-2"><a href="">Ver más</a></small></h4>
        <div id="owl-productos-2" class="owl-carousel text-center pl-2 pr-2 owl-productos">
            <?php
            $productos = $productos_owl_2 && count($productos_owl_2) > 4? $productos_owl_2 : Producto::getAll();
            foreach($productos as $producto){
                $fotos = explode(",",$producto->foto);
            ?>
            <a class="text-decoration-none text-dark" href="producto.php?producto=<?=$producto->id?>">
                <div class="m-1 rounded border bg-white">
                    <div class="content-img-owl-producto d-flex justify-content-center align-items-center">
                        <img src="img-productos/<?=$fotos[0]?>" class="img-fluid img-producto">
                        <div class="d-flex m-0 p-0 icon-favorito">
                            <input class="favorito" style="display:none" type="checkbox" <?php $usuario ? $usuario->checkedFavorito($producto->id) : null ?>  id="p<?=$producto->id?>" value="<?=$producto->id?>"></input>
                            <label for="p<?=$producto->id?>" class="d-flex justify-content-center align-items-center label-favorito"><i name="p<?=$producto->id?>" class="far fa-heart"></i></label>
                        </div>   
                    </div>
                    <div class="py-2 border-top">  
                        <div class="pl-2 pr-2 m-0 texto-suspensivo"><?=$producto->nombre?></div>
                        <small><s class="text-muted"><?=formatPrecio($producto->precio)?></s></small>
                        <div class="d-flex justify-content-center">
                            <h5 class="precio" style="padding-top:2px"><?=formatPrecio($producto->precio-$producto->precio*0.2)?></h5>
                            <span class="text-success align-self-start p-1" style="font-size:11px;">20% OFF</span>
                        </div> 
                    </div>
                </div>
            </a>
            <?php } ?>
        </div>
  
    </div>
</div>

<?php 
require 'footer.php';
Usuario::loguearParaFavoritos();
?>
<script src="js/index.js"></script>
<script src="js/productos-articulos.js"></script>