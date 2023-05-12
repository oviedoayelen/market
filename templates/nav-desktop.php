<nav class="navbar-dark navbar nav-font-size fixed-top nav-bg-color">
    <div>
        <a id="logo" class="navbar-brand" href="index.php"><?=$logo?></a>
    </div>
    <div class="form-inline w-50" style="max-width:600px;">
        <div class="input-group w-100">
            <input form="form-filtros-desktop" id="buscardesktop" type="text" name="p" value="<?=$_GET['p'] ?? ""?>" class="form-control shadow-none border-0" style="height:35px" placeholder="Buscar productos" aria-label="search products" aria-describedby="search">
            <div class="input-group-append">
                <button class="btn buscar-desktop btn-color" style="height:35px;" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
    <?php require 'templates/links-nav.php'; ?>
</nav>
