<?php
$class=null;
$feedback=null;
function feedback($valor, $validar){
    global $class, $feedback,$errores;
    $class=null;
    $feedback=null;
    if($valor !== $validar && $_SERVER['REQUEST_METHOD'] === 'POST' && $errores!==0){
        $class="invalid";
        $feedback="<div class='$class-feedback m-0 p-0'>$validar</div>";
    }
}

function modalSuccess($mnsj){   
    echo "<div class='modal fade' id='modalSuccess' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-sm'>
                <div class='modal-content text-center'>
                    <button type='button' class='close text-right m-2' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <i class='fas fa-check-circle' style='color:#00917c;font-size:60px'></i>
                    <span class='mb-5 mt-2'>$mnsj</span>
                </div>
            </div>
        </div>";
    echo "<script>
                $( document ).ready(function() {
                    $('#modalSuccess').modal('toggle')
                });
            </script>"; 
}

function formatPrecio($precio){
    $precioFormateado = $precio - (int)$precio == 0 ? number_format((int)$precio ,0,null, '.') : number_format($precio, 2, ',', '.');
    return "$$precioFormateado";
}
