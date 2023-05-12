<?php feedback($provincia,$provinciaValida) ?>
<div class="col-12 col-sm-6 mb-2">
    <label for="provincia">Provincia (*)</label>
    <select id="provincia" name="provincia" class="form-control bg-light <?="is-$class"?>" required>
        <option value="">Seleccioná una provincia</option>
        <?php foreach($provincias as $provincia_id=>$provincia_nombre) {?>
        <option value="<?=$provincia_id?>" <?php if($provincia==$provincia_id){echo "selected";} ?>><?=$provincia_nombre?></option>
        <?php } ?>
    </select>
    <?=$feedback?>
</div>

<?php feedback($localidad,$localidadValida) ?>
<div class="col-12 col-sm-6 mb-2">
    <label for="localidad">Localidad (*)</label>
    <select id="localidad" name="localidad" class="form-control bg-light <?="is-$class"?>" required>
        <option value="">Seleccioná una localidad</option>
        <?php foreach($localidades as $localidad_id=>$localidad_nombre) {?>
        <option class="option" value="<?=$localidad_id?>" <?php if($localidad==$localidad_id){echo "selected";} ?>><?=$localidad_nombre?></option>
        <?php } ?>
    </select>
    <?=$feedback?>
</div>

<?php feedback($calle,$calleValida) ?>
<div class="col-sm-4 mb-2">
    <label for="calle">Calle (*)</label>
    <input type="text" class="form-control bg-light <?="is-$class"?>" name="calle" id="calle" value="<?=$calle?>" required>
    <?=$feedback?>
</div>

<?php feedback($altura,$alturaValida) ?>
<div class="col-sm-4 col-6 mb-2">
    <label for="altura">Altura (*)</label>
    <input type="number" class="form-control bg-light <?="is-$class"?>" name="altura" id="altura"  value="<?=$altura?>" required>
    <?=$feedback?>
</div> 

<?php feedback($cp,$cpValido) ?>
<div class="col-sm-4 col-6 mb-2">
    <label for="cp" class="text-nowrap">Código postal (*)</label>
    <input type="number" class="form-control bg-light <?="is-$class"?>" name="cp" id="cp"  value="<?=$cp?>" required>
    <?=$feedback?>
</div> 

<div class="col-sm-6 col-6 mb-2">
    <label for="calle1">Entre calle 1</label>
    <input type="text" class="form-control bg-light" name="calle1" id="calle1" value="<?=$calle1?>">
</div>

<div class="col-sm-6 col-6 mb-2">
    <label for="calle2">calle 2</label>
    <input type="text" class="form-control bg-light" name="calle2" id="calle2"  value="<?=$calle2?>">
</div> 

<?php feedback($telefono,$telefonoValido) ?>
<div class="col-12 mb-2">
    <label for="telefono">Teléfono (*)</label>
    <input type="number" class="form-control bg-light <?="is-$class"?>" name="telefono" id="telefono"  value="<?=$telefono?>" required>
    <?=$feedback?>
</div> 

<?php feedback($nombre_direccion,$nombre_direccionValido) ?>
<div class="col-12 col-sm-6 mb-2">
    <label for="nombre_direccion">Nombre (*)</label>
    <input type="text" class="form-control bg-light <?="is-$class"?>" name="nombre_direccion" id="nombre_direccion" value="<?=$nombre_direccion ? $nombre_direccion : $usuario->nombre?>" required>
    <?=$feedback?>
</div>

<?php feedback($apellido,$apellidoValido) ?>
<div class="col-12 col-sm-6 mb-2">
    <label for="apellido">Apellido (*)</label>
    <input type="text" class="form-control bg-light <?="is-$class"?>" name="apellido" id="apellido" value="<?=$apellido ? $apellido : $usuario->apellido?>" required>
    <?=$feedback?>
</div>

<div class="col-12 mb-2">
    <label for="observaciones">Observaciones</label>
    <textarea maxlength="100" class="form-control bg-light" id="observaciones" name="observaciones" rows="5"><?=$observaciones?></textarea>
</div>

<script src="js/form-direccion.js"></script>

