<?php

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$stock = (isset($_POST['stock'])) ? $_POST['stock'] : '';
$envio = (isset($_POST['envio'])) ? $_POST['envio'] : 'No';
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$salida = (isset($_POST['salida'])) ? $_POST['salida'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';



$errores = '';


if (strlen($nombre) < 3) {
    $errores .= 'El nombre debe ser mayor a 3 caracteres<br>';
} elseif(strlen($nombre) > 20) {
    $errores .= 'El nombre debe ser menor o igual a 20 caracteres<br>';
}

if (is_numeric($precio)) {
    if ($precio <= 0) {
        $errores .= 'El precio debe ser mayor a cero.<br>';
    }
} elseif(strlen($precio) == 0) {
    $errores .= 'El precio es obligatorio.<br>';
} else {
    $errores .= 'El precio debe ser un número.<br>';
}

if (empty($stock)) {
    if ($stock != '0') {
        $errores .= 'El stock es obligatorio.<br>';
    }

}
//if (empty($envio)) {
//    $errores .= 'El envío es obligatorio.<br>';
//}
if (empty($categoria)) {
    $errores .= 'La categoria es obligatoria.<br>';
}
if (empty($marca)) {
    $errores .= 'La marca es obligatoria.<br>';
}
if (empty($salida)) {
    $errores .= 'La salida es obligatoria.<br>';
}
if (empty($descripcion)) {
    $errores .= 'La descripción es obligatoria.<br>';
}




/*
$asd = $nombre;
  if (empty($errores)) {
    


       if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {
   
  
    if (!getimagesize($_FILES['foto']['tmp_name'])) {
        $errores .= 'El archivo subido no es una imagen<br>';
    }


     $ruta_temp = $_FILES['foto']['tmp_name'];
             $ruta ="imagenes/productos/$asd/";
             $nombreFoto = $_FILES['foto']['name'];
             move_uploaded_file($ruta_temp,$ruta.$nombreFoto); }
            
// elseif (is_dir("./imagenes./productos./$asd")) {
// $errores .= 'Ya existe producto con ese nombre, por favor cambielo <br>'; }

             
      } */