<?php

$titulo = 'Salir';

include 'encabezado.php';

?>
    <h1><?php echo $titulo ?></h1>
<?php

if (isset($_COOKIE['usuario_recordado']) && isset($_COOKIE['contrasena_recordada'])) {
	setcookie('usuario_recordado','');
setcookie('contrasena_recordada','');
setcookie('permiso','');
} 





session_unset();
session_destroy();
header('Location: index.php');

include 'pie.php';