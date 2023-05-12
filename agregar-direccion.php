<?php
require_once 'header.php';
require_once 'clases/Direccion.php';
require_once 'clases/Usuario.php';
require_once 'funciones.php';
$errores = 0;
require 'validaciones/validar-direccion.php';

if (!isset($_SESSION['usuario_logueado'])) {
    echo "
    <script>
        window.location = 'ingresar.php';
    </script>
    ";
    die;
}
$usuario = Usuario::getById($_SESSION['usuario_logueado']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $errores==0){
    $id_direccion = uniqid();
    $objDireccion = new Direccion(["id"=>$id_direccion,"id_provincia"=>$provincia,"id_localidad"=>$localidad,"calle"=>$calle,"altura"=>$altura,"calle1"=>$calle1,"calle2"=>$calle2,"telefono"=>$telefono,"observaciones"=>$observaciones,"id_usuario"=>$usuario->id,"codigo_postal"=>$cp,"nombre"=>$nombre_direccion,"apellido"=>$apellido]);
    $objDireccion->insert();
    echo "
        <script>
            window.location = 'perfil.php';
        </script>
        ";
}

?>
<div class="container-fluid pt-5 pb-4">
    <form action="" method="post" style="max-width:650px" class="card mx-auto pb-4">   
        <div class="card-header pt-2 pb-1 mb-3">
            <h5>Agregar dirección</h5>
        </div>

        <div class="row pb-1 pl-4 pr-4">

            <?php require 'templates/form-alta-direccion.php'; ?>
        
            <div class="col-12">
                <input type="submit" value="Agregar" class="btn btn-color col-12">
                <p class="p-0 m-0">(*) Campos requeridos.</p>
            </div>

        </div>
    </form>
</div>
<?php
require_once 'footer.php';