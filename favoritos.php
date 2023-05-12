<?php
require_once 'header.php';
if (!isset($_SESSION['usuario_logueado'])) {
    echo "<script>
        window.location = 'ingresar.php';
    </script>";
    die;
}
?>
<script>
$(document).ready(function(){
    $('#favoritos').load('favoritos-load.php');
});
</script>
<div id="favoritos"></div>

<?php
require_once 'footer.php';