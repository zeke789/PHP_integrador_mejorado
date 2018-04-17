<?php 

@ $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
if (!$link) {
    $codigo_de_error_de_conexion = mysqli_connect_errno();
    $detalle_de_error_de_conexion = mysqli_connect_error();
   	header('Location: pagina_error.php?codigo_error=1');
   	}

mysqli_set_charset($link, 'utf8');


/*

 $texto_die = 'Se produjo un error al intentar establecer '
        . 'la conexión con el servidor de bases de datos.<br>'
        . 'Detalles del error:<br>'
        . 'Código: ' . $codigo_de_error_de_conexion . '<br>'
        . 'Detalle: ' . $detalle_de_error_de_conexion . '.';
    die ($texto_die);

} 


*/