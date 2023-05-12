<div class="m-0 p-0 fixed-top">
<nav class="navbar-dark navbar nav-font-size nav-bg-color">
    <div>
        <a id="logo" class="navbar-brand" href="index.php"><?=$logo?></a>
    </div>

    <?php require 'templates/links-nav.php'; ?>

    <div class="form-inline w-100">
        <div class="input-group w-100">
            <input form="form-filtros-mobile" type="text" name="p" value="<?=$_GET['p'] ?? null?>" id="buscarmobile" class="form-control shadow-none border-0" style="height:35px" placeholder="Buscar productos" aria-label="search products" aria-describedby="search">
            <div class="input-group-append">
                <button class="btn buscar-mobile btn-color" style="height:35px" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
</nav>
<?php if(isset($form_filtros_mobile)){ include 'templates/form-filtros-mobile.php'; } ?>
</div>