<?php
$localidad = null;
require_once "clases/Direccion.php";
$provincias = Direccion::getProvincias();
$id_provincia = isset($_POST['provincia']) && isset($provincias[$_POST['provincia']]) ? $_POST['provincia'] : null;
$where = $id_provincia ? " WHERE id_provincia = '$id_provincia'" : " WHERE id_provincia = '02'";
$localidades = Direccion::getLocalidades($where);
?>

<option value="">Seleccioná una localidad</option>
<?php foreach($localidades as $localidad_id=>$localidad_nombre) {?>
<option class="option" value="<?=$localidad_id?>" <?php if($localidad==$localidad_id){echo "selected";} ?>><?=$localidad_nombre?></option>
<?php } ?>
