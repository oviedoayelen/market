<?php
require_once 'header.php';
?>
<script>
$(document).ready(function(){
    $('#carrito').load('carrito-load.php');
});
</script>
<div id="carrito"></div>

<?php
require_once 'footer.php';
?>
