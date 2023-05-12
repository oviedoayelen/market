<style>
#form-filtros-desktop{
    display:none !important;
}
@media (min-width: 650px) {
    #form-filtros-desktop{
        display: block !important;
    }
}
</style>

<form id="form-filtros-desktop" class="col-sm p-0 mr-3" style="max-width:13.5rem">

    <!--TÍTULO BÚSQUEDA-->
    <h3 style="word-break: break-word"><?=$tituloBusqueda?></h3>
    <p><strong><?=$total_productos?></strong><?=$total_productos>1 ? " resultados" : " resultado"?></p> 
    <!--CATEGORÍAS--> 
    <div class="mb-4">
        <p class="mb-2"><strong>Categoría</strong> </p>
        <?php foreach($categorias as $categoria){ ?>
            <div class="form-check">
                <input class="form-check-input search-desktop" <?php if($categoria_id==$categoria['id']){echo "checked";} ?> value="<?=$categoria['id']?>" type="radio" name="categoria" id="categoria<?=$categoria['id']?>">
                <label class="form-check-label" style="word-break: break-word" for="categoria<?=$categoria['id']?>"> <?=$categoria['categoria']." (".$categoria['countProductos'].")"?></label>
            </div>
        <?php } ?>
    </div>

    <!--MARCAS--> 
    <div class="mb-4">
        <p class="mb-2"><strong>Marca</strong></p>
        <?php foreach($marcas as $marca){ ?>
            <div class="form-check"> 
                <input class="form-check-input search-desktop" <?php checkedMarca($marca['id']); ?> value="<?=$marca['id']?>" name="marcas[]" type="checkbox" id="marca<?=$marca['id']?>">
                <label style="word-break: break-word" class="form-check-label" for="marca<?=$marca['id']?>">
                    <?=$marca['marca']." (".$marca['countProductos'].")"?>
                </label>
            </div>
        <?php } ?>
    </div>
    
    <!-- PROVINCIA -->
    <div class="mb-4">
        <p class="mb-2"><strong>Provincia</strong> </p>
        <?php foreach($provincias as $provincia){ ?>
            <div class="form-check">
                <input class="form-check-input search-desktop" <?php if($provincia_id==$provincia['id']){echo "checked";} ?> value="<?=$provincia['id']?>" type="radio" name="provincia" id="provincia<?=$provincia['id']?>">
                <label class="form-check-label" style="word-break: break-word" for="provincia<?=$provincia['id']?>"> <?=$provincia['provincia']." (".$provincia['countProductos'].")"?></label>
            </div>
        <?php } ?>
    </div>

    <!-- LOCALIDAD -->
    <div class="mb-4">
        <p class="mb-2"><strong>Localidad</strong></p>
        <?php foreach($localidades as $localidad){ ?>
            <div class="form-check"> 
                <input class="form-check-input search-desktop" <?php checkedLocalidad($localidad['id']); ?>  value="<?=$localidad['id']?>" name="localidades[]" type="checkbox" id="localidad<?=$localidad['id']?>">
                <label style="word-break: break-word" class="form-check-label" for="localidad<?=$localidad['id']?>">
                    <?=ucwords(strtolower($localidad['localidad']))." (".$localidad['countProductos'].")"?>
                </label>
            </div>
        <?php } ?>
    </div>

    <!--PRECIO--> 
    <div>
        <p class="mb-2"><strong>Precio</strong></p>
        <div class="d-flex">
            <div class="input-group input-group-sm mb-3" style="box-shadow:none">
                <input type="text" value="<?=$minimo?>" id="mindesk" name="min" class="form-control" style="box-shadow:none;" placeholder="Mín..." aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>  
            <span class="ml-2 mr-2">  – </span> 
            <div class="input-group input-group-sm mb-3">
                <input type="text" value="<?=$maximo?>" id="maxdesk" name="max" class="form-control" style="box-shadow:none;" placeholder="Max..." aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
            <button type="button" class="btn btn-dark btn-sm ml-2 search-desktop" style="height:30px"><i class="fas fa-angle-right"></i></button>
        </div>
    </div>

</form>
