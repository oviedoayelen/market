<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none !important; 
  margin: 0 !important; 
}
</style>
<div class="container-fluid m-0 p-0">
    <?php include 'templates/sidebar.php'; ?>
    <div class="row-ml m-0 p-2 pt-4">
        <form enctype="multipart/form-data" action="" method="post" class="card mx-auto" id="alta-producto" style="max-width:750px">   
            <div class="card-header pt-2 pb-1">
                <h5><?=$titulo?></h5>
            </div>
            <div class="row m-0 p-2 pr-4 pl-4">
                <?php feedback($nombre_producto,$nombre_productoValido) ?>
                <div class="col-12 col-sm-8 mb-2 mt-3">
                    <label for="nombre_producto">Nombre (*)</label>
                    <input type="text" maxlength="30" class="form-control bg-light <?="is-$class"?>" name="nombre_producto" id="nombre_producto" value="<?=$nombre_producto?>" autofocus required>
                    <?=$feedback?>
                </div>

                <?php feedback($precio,$precioValido) ?>
                <div class="col-sm-4 mb-2 mt-3">
                    <label for="precio">Precio (*)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control bg-light <?="is-$class"?>" name="precio" id="precio" value="<?=$precio?>" required>
                        <?=$feedback?>
                    </div>
                </div>

                <?php feedback($categoria,$categoriaValida) ?>
                <div class="col-sm-6 mb-2">
                    <label for="categoria">Categoría (*)</label>
                    <select id="categoria" name="categoria" class="form-control bg-light <?="is-$class"?>" required>
                        <option value="">Seleccioná una categoría</option>
                        <?php foreach($categorias as $categoriaObjeto) {?>
                        <option value="<?=$categoriaObjeto->id?>" <?php if($categoria==$categoriaObjeto->id){echo "selected";} ?>><?=$categoriaObjeto->nombre?></option>
                        <?php } ?>
                    </select>
                    <?=$feedback?>
                </div>

                <?php feedback($marca,$marcaValida) ?>
                <div class="col-sm-6 mb-2">
                    <label for="marca">Marca (*)</label>
                    <input type="text" class="form-control bg-light <?="is-$class"?>" name="marca" id="marca" value="<?=$marca?>" required>
                    <?=$feedback?>
                </div> 

                <?php feedback($fotos,$fotosValidas) ?>
                <div class="col-12 mb-2 mt-3">
                    <label for="" class="<?="is-$class"?>">Fotos</label>
                    <?=$feedback?>
                    <input type="file" class="form-control-file" name="fotos[]" id="foto-1">
                </div>
                <div class="col-12 mb-2 mt-3">
                    <input type="file" class="form-control-file" name="fotos[]" id="foto-2">
                </div>
                <div class="col-12 mb-2 mt-3">
                    <input type="file" class="form-control-file" name="fotos[]" id="foto-3">
                </div>
                
                <?php feedback($descripcion,$descripcionValida) ?>
                <div class="col-12 mt-3 mb-2">
                    <label for="descripcion">Descripción</label>
                    <textarea maxlength="500" class="form-control bg-light <?="is-$class"?>" id="descripcion" name="descripcion" rows="8"><?=$descripcion?></textarea>
                    <?=$feedback?>
                </div>

                <?php
                if(!$usuario->getDirecciones()){
                    echo "<h5 class='col-12 pt-4 pb-3'>Ingresa una dirección:</h5>";
                    require_once 'templates/form-alta-direccion.php';
                }
                ?>

                <div class="col-12 mt-2 mb-4">
                    <input type="submit" value="<?=$valueSubmit?>" class="btn btn-color col-12">
                    <p>(*) Campos requeridos.</p>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="js/alta-producto.js"></script>