<?php 


$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$usuario= (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password1=(isset($_POST['password1'])) ? $_POST['password1'] : '';
$password2=(isset($_POST['password2'])) ? $_POST['password2'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$errores = '';



if (empty($nombre)) {
	$errores .= 'Debe ingresar un nombre<br>';
} else {
	if (strlen($nombre) < 6 || strlen($nombre) > 25) {
		$errores .=  'El nombre debe ser entre 6 y 25 caracteres<br>';
	}
  }

  if (empty($usuario)) {
  	$errores.='Debe introducir un nombre de usuario<br>';
  } elseif (strlen($usuario) < 5 || strlen($usuario) > 16) {
  	$errores .= 'El usuario debe tener entre 5 y 16 caracteres<br>';
  }

  if (empty($password1)) {
  	$errores.='Ingrese la contraseña<br>';
  } elseif (strlen($password1) < 6 || strlen($password1) > 10 ) {
  	$errores .= 'La contraseña debe tener entre 6 y 10 caracteres<br>';
  } else {
  		if (empty($password2)) {
  	$errores.='Debe ingresar dos veces la contraseña<br>';
  }}  

 if (!empty($password1) && !empty($password2)) {
 	if ($password1 !== $password2) {
 		$errores.= 'Las contraseñas no coinciden<br>';
 	}
 }

if (empty($email)) {
	$errores .= 'Debe ingresar un email';
} elseif (strlen($email) > 42) {
	$errores .= 'El email introducido es demasiado largo';
}

include 'config.php';
include 'conexion.php';


$sql2 = "SELECT usu_usuario FROM usuarios WHERE usu_usuario = '$usuario'";
$rs2 = mysqli_query($link,$sql2);
if (mysqli_num_rows($rs2) == 1) {
  $errores .= 'El nombre de usuario se encuentra en uso <br>';
}
$sql3 = "SELECT usu_email FROM usuarios WHERE usu_email = '$email'";
$rs3 = mysqli_query($link,$sql3);
if (mysqli_num_rows($rs3) == 1) {
  $errores .= 'El email seleccionado se encuentra en uso <br>';
}