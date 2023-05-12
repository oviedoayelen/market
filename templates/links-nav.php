<div class="d-flex">
    <?php if (isset($_SESSION['usuario_logueado'])) { ?>
    <div  class="dropdown">
        <a class="text-decoration-none text-white ml-2" href='perfil.php' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            <i class='fas fa-user'></i>
        </a>
        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdownMenuLink'>
            <a class='dropdown-item' href='alta-producto.php'>Publicar un producto</a>
            <a class='dropdown-item' href='productos-usuario.php'>Mis productos</a>
            <a class='dropdown-item' href='favoritos.php'>Mis favoritos</a>
            <a class='dropdown-item' href='perfil.php'>Mis datos</a>
            <a class='dropdown-item' href='salir.php'>Cerrar sesión</a>
        </div>
    </div>

    <div class="dropdown">
        <a class="text-decoration-none text-white ml-2" id='navbarDropdownMenuLink' href='favoritos.php' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            <i class='fas fa-heart'></i>
        </a>
        <div class='dropdown-menu dropdown-menu-right p-0 m-0' aria-labelledby='navbarDropdownMenuLink'>
            <div style="width:300px;max-height:400px;overflow-y:auto;" class="favoritos-drop-down"></div>
        </div> 
    </div>

    <?php } else { ?>
    <a class="text-decoration-none text-white ml-2" href='ingresar.php'>Ingresar</a>
    <a class="text-decoration-none text-white ml-2" href='registrarse.php'>Registrarse</a>       
    <?php } ?>
    <a class="text-decoration-none text-white ml-2" href='carrito.php'><i class="fas fa-shopping-cart"></i><span class="carrito-count"></span></a>
</div>