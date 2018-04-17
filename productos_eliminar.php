<?php

if(empty($_GET['prd_eliminar'])) {
    header('Location: productos.php');
    // Se podría enviar un código de error para que la URL destino pueda mostrar un error en pantalla.
//    header('Location: productos.php?error=1');
    die;
}



include 'config.php';

@ $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);

if(!$link) {
    header('Location: ' . PAGINA_ERROR . '?codigo_error=1');
    die;
}

mysqli_set_charset($link, 'utf8');


$sql = 'DELETE FROM productos WHERE prd_id=' . $_GET['prd_eliminar'];

// En este caso, no se necesitará de la variable $rs, ya que no vamos a solicitar información sobre la consulta
//$rs = mysqli_query($link, $sql);
mysqli_query($link, $sql);
$filasAfectadas = mysqli_affected_rows($link);
mysqli_close($link);

$dirPrd = $_GET['nombre'];
//$dir="imagenes/productos/$dirPrd";

$dp2 = opendir("./imagenes./productos./$dirPrd./galeria");
            while ($files = readdir($dp2)) {
                $pathComplete =  "./imagenes./productos./$dirPrd./galeria./$files";
                if (is_file($pathComplete)) {
                    unlink("./imagenes./productos./$dirPrd./galeria./$files");
                }

            }
closedir($dp2);
 
rmdir("./imagenes./productos./$dirPrd./galeria");

 $dp = opendir("imagenes/productos/$dirPrd");
            while ($file = readdir($dp)) {                         
                    $completePath = "./imagenes./productos./$dirPrd./$file";
                    if (is_file($completePath)) {
                        unlink($completePath);     
                    } 
                    if ($file = '.' || $file = '..'){
                       if (is_dir("imagenes/productos/dirPrd/$file")) {
                           echo 'is dir';
                       } elseif (is_dir("imagenes/productos/dirPrd/$file")) {
                           echo 'is file';
                       }
                    }
            } 
            closedir($dp);
            rmdir("./imagenes./productos./$dirPrd");


if ($filasAfectadas == 1) {
    header('Location: productos.php?accion=1');
} else {
    header('Location: productos.php?accion=-1');
}
