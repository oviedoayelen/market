<div class="container-fluid p-0 m-0">
<?php include 'templates/sidebar.php'; ?>
    <div class="row-ml m-0 p-2 pt-4">

        <div class="card col-12 col-md-9 col-lg-8 col-xl-7 m-0 p-0 mb-3 mx-auto">
            <div class="card-header navbar pt-2 pb-1">
                <h5> Mis datos</h5>
                <div class="m-0 p-0">
                    <button class="btn m-0 p-0 editarPerfil shadow-none text-primary">Editar</button>
                    <form action="perfil.php" method="POST" id="editarPerfilForm">
                        <div class="input-group-sm d-flex">
                            <input type="password" id="pass" class="is-<?=$class?> form-control bg-white rounded-left" style="border-radius:0;width:180px;" name="password" value="" placeholder="<?=$feedback?>">
                            <button type="input" id="word"  class=" btn btn-dark btn-sm rounded-right" style="border-radius:0"><i class="fas fa-angle-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Usuario: <?=$usuario->usuario?></li>
                <li class="list-group-item">Nombre y apellido: <?=$usuario->nombre." ".$usuario->apellido?></li>
                <li class="list-group-item">E-mail: <?=$usuario->email?></li>
            </ul>
        </div>

        <div class="card col-12 col-md-9 col-lg-8 col-xl-7 p-0 m-0 mx-auto">
            <div class="card-header navbar pt-2 pb-1">
                <h5>Mis direcciones</h5>
                <a href="agregar-direccion.php" title="Agregar dirección" class="text-decoration-none">
                    +
                </a>
            </div>
            <ul class="list-group list-group-flush">
                <?php 
                if($direcciones){
                    for($i=0; $i<count($direcciones); $i++) { 
                        //var_dump($direccion);
                ?> 
                        <li class="list-group-item d-flex justify-content-between">
                            <span>
                                <?=$direcciones[$i]->calle." ".$direcciones[$i]->altura." ".$direcciones[$i]->localidad.", ".$direcciones[$i]->provincia." (".$direcciones[$i]->codigo_postal.")"?> 
                                <?php
                                if($direcciones[$i]->observaciones){
                                ?>
                                <br> 
                                <small class="text-muted"><?=$direcciones[$i]->observaciones?></small>
                                <?php
                                }
                                ?>
                                <br>
                                <?=$direcciones[$i]->telefono?> - <?=$direcciones[$i]->nombre." ".$direcciones[$i]->apellido?> 
                            </span>
                            <div>
                                <a class="btn text-primary" href="editar-direccion.php?dir=<?=$direcciones[$i]->id?>">Editar</a>
                                <?php
                                if(!$usuario->getProductos() || count($direcciones)>1){
                                ?>
                                <br>
                                <button class="btn text-primary deleteDir" id="<?=$direcciones[$i]->id?>">Eliminar</button>
                                <?php
                                }
                                ?>
                            </div>
                        </li>
                <?php } 
                } else{ ?>
                    <p class="py-2 mt-3 text-center">
                        <i style="font-size:20px" class="fas fa-search"></i>
                        <br>
                        No tienes direcciones guardadas...
                        <br>
                        <a href="agregar-direccion.php" title="Agregar dirección" class="text-decoration-none">
                        Agregar una dirección
                        </a>
                    </p>
                <?php } ?>
            </ul>
        </div>

    </div>
</div>

<script>
$('.editarPerfil').on('click', function(){
    $('#editarPerfilForm').show();
});

$('.editarPerfil').on('click', function(){
    $('#editarPerfilForm').show();
});
$('#editarPerfilForm').<?=$ocultarEditarPerfilForm?>();

$('.deleteDir').on('click', function(){
    $.post('',{dir : this.id});
    console.log(this.id);
    window.location.reload();
});
</script>