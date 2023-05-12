<link rel="stylesheet" href="css/producto-vista.css">
<div class="container-fluid m-0 p-0 pt-4 pb-4">
    <div class="row mx-auto m-0 p-0" style="max-width: 1350px;">

        <div class="m-0 mb-3 col-xl-7 col-md-8">
            <div id="carouselExampleControls" class="carousel slide border rounded" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $fotos = explode(",",$producto->foto);
                    for($i=0;$i<count($fotos);$i++){
                    ?>
                        <div class="carousel-item bg-white border rounded <?=$i===0 ? "active" : null?>">
                            <div class="d-flex justify-content-center align-items-center content-img">
                                <img class="d-block" src="img-productos/<?=$fotos[$i]?>" alt="First slide">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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
        </div>

        <div class="m-0 col-md-4 mb-3">
            <h3><?=$producto->nombre?></h3>
            <h5><small class="text-muted"><?="$producto->categoria - $producto->marca"?></small></h5>
            <h3><?=formatPrecio($producto->precio)?></h3>
            <div class="d-flex m-0 p-0 mb-2">
                <input type="number" style="width:80px;height:33px" value="<?=$cantidadProducto?>" class="form-control" id="cantidad">
                <a href='' class="btn btn-color btn-sm ml-2" id="<?=$producto->id?>">Comprar</a>
            </div>
            <button id='<?=$producto->id?>' type="button" class='btn btn-color btn-sm mb-3 addCarrito' style='cursor:pointer;'>Agregar al carrito</button>
            <button type="button" class="btn btn-color btn-sm mb-3 favorito" id="<?=$producto->id?>">Agregar a favoritos</button>
            <div class="card">
                <div class="card-header p-2">
                    <h5>Datos del vendedor</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="mr-2 fas fa-user"></i><?="$vendedor->nombre $vendedor->apellido"?></li>
                    <li class="list-group-item"><i class="mr-2 fas fa-phone-alt"></i><?=$direccion_vendedor->telefono?></li>
                    <li class="list-group-item"><i class="mr-2 fas fa-map-marker-alt"></i><?="$direccion_vendedor->calle $direccion_vendedor->altura $direccion_vendedor->localidad $direccion_vendedor->provincia"?></li>
                </ul>
            </div>
        </div>

        <div class="m-0 col-xl-7 col-md-8">
            <div class="card text-center">
                <div class="card-header pb-0 border-0">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Descripción</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Características</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active text-left" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><?=$producto->descripcion ? $producto->descripcion : "El vendedor no incluyo ninguna descripción"?>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th class="border-0 text-left">Proximamente</th>
                                    <td class="border-0 text-left">Proximamente</td>
                                </tr>
                                <tr>
                                    <th class="border-0 text-left">Proximamente</th>
                                    <td class="border-0 text-left">Proximamente</td>
                                </tr>
                                <tr>
                                    <th class="border-0 text-left">Proximamente</th>
                                    <td class="border-0 text-left">Proximamente</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $('.favorito').on('click', function(){
        $.post('favoritos-ajax.php', {favoritoAdd : this.id});
        console.log("Add: "+this.value);
        $('.favoritos-drop-down').load('favoritos-drop-down-load.php');
        $('.favoritos-drop-down').load('favoritos-drop-down-load.php');
        $('.favoritos-drop-down').load('favoritos-drop-down-load.php');   
    });
    $('.addCarrito').on('click', function(){ 
        $.post('carrito-ajax.php',{productoAdd : this.id, cantidad : cantidad.value});
        $('.carrito-count').load('carrito-ajax.php');
    });
</script>
