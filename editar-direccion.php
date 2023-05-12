<?php
require_once 'header.php';
require_once 'clases/Direccion.php';
require_once 'clases/Usuario.php';
require_once 'funciones.php';
$errores = 0;
require 'validaciones/validar-direccion.php';
$id_direccion = $_GET['dir'] ?? null;
if (!isset($_SESSION['usuario_logueado'])) {
    echo "
    <script>
        window.location = 'ingresar.php';
    </script>
    ";
    die;
}
else{
    $usuario = Usuario::getById($_SESSION['usuario_logueado']);
    if(!Direccion::getById($id_direccion) || !in_array($id_direccion,$usuario->getIdDirecciones())){
        echo "
        <script>
            window.location = 'perfil.php';
        </script>
        ";
        die;
    }
}

$direccion = Direccion::getById($id_direccion);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $errores==0){
    $direccion->id_provincia = $provincia;
    $direccion->id_localidad = $localidad;
    $direccion->calle = $calle;
    $direccion->altura = $altura;
    $direccion->calle1 = $calle1;
    $direccion->calle2 = $calle2;
    $direccion->telefono = $telefono;
    $direccion->codigo_postal = $cp;
    $direccion->observaciones = $observaciones;
    $direccion->nombre = $nombre_direccion;
    $direccion->apellido = $apellido;
    $direccion->update();
    echo "
        <script>
            window.location = 'perfil.php';
        </script>
        ";
}
if(!$_POST){
    $provincia = $direccion->id_provincia;
    $localidad = $direccion->id_localidad;
    $calle = $direccion->calle;
    $altura = $direccion->altura;
    $calle1 = $direccion->calle1;
    $calle2 = $direccion->calle2;
    $telefono = $direccion->telefono;
    $cp = $direccion->codigo_postal;
    $observaciones = $direccion->observaciones;
    $nombre_direccion = $direccion->nombre;
    $apellido = $direccion->apellido;
    $localidades = Direccion::getLocalidades(" WHERE id_provincia = '$provincia'");
}

?>
<div class="container-fluid pt-5 pb-4">
    <form action="" method="post" style="max-width:650px" class="card mx-auto pb-4">   
        <div class="card-header pt-2 pb-1 mb-3">
            <h5>Editar dirección</h5>
        </div>

        <div class="row pb-1 pl-4 pr-4">

            <?php require 'templates/form-alta-direccion.php'; ?>
        
            <div class="col-12">
                <input type="submit" value="Guardar cambios" class="btn btn-color col-12">
                <p class="p-0 m-0">(*) Campos requeridos.</p>
            </div>

        </div>
    </form>
</div>
<?php
require_once 'footer.php';
