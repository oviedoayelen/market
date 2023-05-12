<link rel="stylesheet" href="css/form-filtros-mobile.css">
<form id="form-filtros-mobile"></form>
<div id="accordion" class="shadow-sm rounded form-mobile">
    
    <div class="card border-0" id="accordion-filtros">
        
        <div class="card-header bg-white m-0 py-1" id="filtros-header">
            <h5 class="mb-0">
                <button class="btn btn-link decoration-none text-left text-dark w-100" data-toggle="collapse" data-target="#filtros-body" aria-expanded="false" aria-controls="filtros-body">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
            </h5>
        </div>

        <div id="filtros-body" class="collapse border-0" aria-labelledby="filtros-header" data-parent="">
            
            <!-- CARD CATEGORÍAS -->
            <div class="card border-0">
                <div class="card-header bg-white m-0 py-1 border-bottom" id="categorias-header">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed decoration-none text-left text-dark w-100 d-flex justify-content-between btn-rotate-icon" data-toggle="collapse" data-target="#categorias-body" aria-expanded="false" aria-controls="categorias-body">
                            Categorías<i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="categorias-body" class="collapse border-0" aria-labelledby="categorias-header" data-parent="">
                    <div class="card-body bg-light border-bottom">
                        <?php foreach($categorias as $categoria){ ?>
                        <div class="form-check">
                            <input form="form-filtros-mobile" class="form-check-input search-mobile" <?php if($categoria_id==$categoria['id']){echo "checked";} ?> value="<?=$categoria['id']?>" type="radio" name="categoria" id="c<?=$categoria['id']?>">
                            <label class="form-check-label" style="word-break: break-word" for="c<?=$categoria['id']?>"> <?=$categoria['categoria']." (".$categoria['countProductos'].")"?></label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- CARD MARCAS -->
            <div class="card border-0">
                <div class="card-header bg-white m-0 py-1 border-bottom" id="marcas-header">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed decoration-none text-left text-dark w-100 d-flex justify-content-between btn-rotate-icon" data-toggle="collapse" data-target="#marcas-body" aria-expanded="false" aria-controls="marcas-body">
                            Marcas<i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="marcas-body" class="collapse border-0" aria-labelledby="marcas-header" data-parent="">
                    <div class="card-body bg-light border-bottom">
                        <?php foreach($marcas as $marca){ ?>
                        <div class="form-check"> 
                            <input form="form-filtros-mobile" <?php checkedMarca($marca['id']); ?> class="form-check-input search-mobile" value="<?=$marca['id']?>" name="marcas[]" type="checkbox" id="m<?=$marca['id']?>">
                            <label style="word-break: break-word" class="form-check-label" for="m<?=$marca['id']?>">
                            <?=$marca['marca']." (".$marca['countProductos'].")"?>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- CARD PROVINCIAS -->
            <div class="card border-0">
                <div class="card-header bg-white m-0 py-1 border-bottom" id="provincias-header">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed decoration-none text-left text-dark w-100 d-flex justify-content-between btn-rotate-icon" data-toggle="collapse" data-target="#provincias-body" aria-expanded="false" aria-controls="provincias-body">
                            Provincias<i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="provincias-body" class="collapse border-0" aria-labelledby="provincias-header" data-parent="">
                    <div class="card-body bg-light border-bottom">
                        <?php foreach($provincias as $provincia){ ?>
                        <div class="form-check">
                            <input form="form-filtros-mobile" class="form-check-input search-mobile" <?php if($provincia_id==$provincia['id']){echo "checked";} ?> value="<?=$provincia['id']?>" type="radio" name="provincia" id="pro<?=$provincia['id']?>">
                            <label class="form-check-label" style="word-break: break-word" for="pro<?=$provincia['id']?>"> <?=$provincia['provincia']." (".$provincia['countProductos'].")"?></label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
    
            <!-- CARD LOCALIDADES -->
            <div class="card border-0">
                <div class="card-header bg-white m-0 py-1 border-bottom" id="localidades-header">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed decoration-none text-left text-dark w-100 d-flex justify-content-between btn-rotate-icon" data-toggle="collapse" data-target="#localidades-body" aria-expanded="false" aria-controls="localidades-body">
                            Localidades<i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="localidades-body" class="collapse border-0" aria-labelledby="localidades-header" data-parent="">
                    <div class="card-body bg-light border-bottom">
                        <?php foreach($localidades as $localidad){ ?>
                        <div class="form-check"> 
                            <input form="form-filtros-mobile" <?php checkedLocalidad($localidad['id']); ?> class="form-check-input search-mobile" value="<?=$localidad['id']?>" name="localidades[]" type="checkbox" id="l<?=$localidad['id']?>">
                            <label style="word-break: break-word" class="form-check-label" for="l<?=$localidad['id']?>">
                            <?=ucwords(strtolower($localidad['localidad']))." (".$localidad['countProductos'].")"?>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- CARD PRECIO -->
            <div class="card border-0">
                <div class="card-header bg-white m-0 py-1 border-bottom" id="precio-header">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed decoration-none text-left text-dark w-100 d-flex justify-content-between btn-rotate-icon" data-toggle="collapse" data-target="#precio-body" aria-expanded="false" aria-controls="precio-body">
                            Precio<i class="fas fa-chevron-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="precio-body" class="collapse border-0" aria-labelledby="precio-header" data-parent="">
                    <div class="card-body bg-light border-bottom">
                        <div class="d-flex" style="max-width:400px">
                            <div class="input-group input-group-sm" style="box-shadow:none">
                                <input form="form-filtros-mobile" type="text" id="minmobile" value="<?=$minimo?>" name="min" class="form-control" style="box-shadow:none;" placeholder="Mín..." aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>  
                            <span class="ml-2 mr-2">  – </span> 
                            <div class="input-group input-group-sm">
                                <input form="form-filtros-mobile" type="text" id="maxmobile" value="<?=$maximo?>" name="max" class="form-control" style="box-shadow:none;" placeholder="Max..." aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <button type="button" class="btn btn-dark btn-sm ml-2 search-mobile" style="height:30px"><i class="fas fa-angle-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- cierre de card-body acordion filtros -->

    </div><!-- cierre de card acordion filtros -->

</div><!-- cierre del accordion -->

<script>
    $('.btn-rotate-icon').on('click',function(){
        $(this).children('i').toggleClass("rotate-icon");
    });
</script>
