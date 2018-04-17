<?php

define ('NOMBRE_ARCHIVO', 'visitas.txt');

if (file_exists(NOMBRE_ARCHIVO)) {
    $fh = fopen(NOMBRE_ARCHIVO, 'r');
    $cant = fread($fh, filesize(NOMBRE_ARCHIVO));
    fclose($fh);
} else {
    $cant = 0;
}

$cant++;

$fh = fopen(NOMBRE_ARCHIVO, 'w');
fwrite($fh, $cant);
fclose($fh);
echo  $cant;

?>