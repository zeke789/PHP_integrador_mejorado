<?php

include 'config.php';
$titulo = 'Error';
include 'encabezado.php';

if (isset($_GET['codigo_error'])) {
    switch ($_GET['codigo_error']) {
        case '1':
            $detalle_error = 'Se produjo un error al intentar establecer la conexión con el servidor de Bases de Datos.';
            break;
        case '2':
            $detalle_error = 'Se produjo un error al intentar ejecutar la consulta en el servidor de Bases de Datos.';
            break;
        default:
            $detalle_error = 'Error desconocido.';
            break;
    }
} else {
    $detalle_error = 'Se produjo un error no especificado.';
}

?>
<div id="error">
    <h1>Ups...</h1>
    <p>Algo salió mal.</p>
    <p><?= $detalle_error ?></p>
    <p>Si el problema persiste, por favor <a href="contacto.php">contactanos</a>.</p>
    <p>Lamentamos las molestias ocasionadas.</p>
    <p>Gracias por tu comprensión.</p>
</div>
<?php

include 'pie.php';
