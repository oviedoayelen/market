
<link rel="stylesheet" href="css/form-login.css" >
<div class="container-fluid pt-4">
    <form action="" method="post" id="form-login" class="card shadow-sm mx-auto">   
        <div class="card-header pt-2 pb-1">
            <h5>Ingresar</h5>
        </div>
        <div id="card-body-login">
            <div class="row p-0 m-0">
                <input type="text" class="form-control mb-3 bg-light" name="usuario" value="<?=$usuario?>" placeholder="Tu e-mail o usuario..." autofocus required>
                <div class="mb-3 input-group">
                    <input type="password" id="password" class="form-control bg-light" name="password" value="<?=$password?>" placeholder="Tu contraseña..." required>
                    <div class="input-group-append">
                        <span class="input-group-text rounded-right">
                            <i id="verpass" class='far fa-eye'></i>
                        </span>
                    </div>
                </div>
                <p class="text-danger"><?=$mnsjError?></p>
                <input type="submit" value="Ingresar" class="btn btn-color col-12">
            </div>
            <p class="text-right mt-3">
                <a href="registrarse.php">Registrarse</a><br>
                <a href="">Olvidé mi clave</a>
            </p>
        </div>
    </form>
</div>
<script src="js/login.js"></script>