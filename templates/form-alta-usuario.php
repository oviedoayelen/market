<link rel="stylesheet" href="css/form-login.css" >
<div class="container-fluid pt-4">
    <form action="" method="post" id="form-login" class="card mx-auto shadow-sm">   
        <div class="card-header pt-2 pb-1">
            <h5><?=$titulo?></h5>
        </div>
        <div id="card-body-login">
            <div class="row p-0 m-0">
                <div class="col-sm-6 mb-2 p-1">
                    <?php feedback($nombre,$nombreValido) ?> 
                    <input type="text" required class="form-control bg-light <?="is-$class"?>" name="nombre" value="<?=$nombre?>"  placeholder="Nombre" autofocus>
                    <?=$feedback?>
                </div>
                <div class="col-sm-6 mb-2 p-1">
                    <?php feedback($apellido,$apellidoValido) ?>
                    <input type="text" required class="form-control bg-light <?="is-$class"?>" name="apellido" value="<?=$apellido?>" placeholder="Apellido">
                    <?=$feedback?>
                </div>
                <div class="col-sm-6 mb-2 p-1">
                    <?php feedback($email,$emailValido) ?>
                    <input type="text" required class="form-control bg-light <?="is-$class"?>" name="email" value="<?=$email?>" placeholder="E-mail">
                    <?=$feedback?>
                </div>
                <div class="col-sm-6 mb-2 p-1">
                    <?php feedback($usuario,$usuarioValido) ?>
                    <input type="text" required class="form-control bg-light <?="is-$class"?>" name="usuario" value="<?=$usuario?>" placeholder="Nombre de usuario">
                    <?=$feedback?>
                </div>
                <div class="p-1 mb-2 input-group">
                    <?php feedback($password,$passwordValido) ?>
                    <input type="password" required class="form-control bg-light <?="is-$class"?>" id="password" name="password" value="<?=$password?>" placeholder="Contraseña">
                    <div class="input-group-append">
                        <span class="input-group-text rounded-right"> 
                            <i id="verpass" class='far fa-eye'></i>
                        </span>
                    </div>
                    <?=$feedback?>
                </div>
                <div class="col-12 p-0 m-0">
                    <input type="submit" value="<?=$valueSubmit?>" class="btn btn-color w-100">
                </div>
            </div>
            <div class="pt-3 pb-4 text-right">
                <?=$link?>
            </div>
        </div>
    </form>
</div>
<script src="js/login.js"></script>