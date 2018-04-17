<?php


$titulo = 'Registrarse';
include 'encabezado.php';
 ?>

<h1> <?php echo $titulo; ?> </h1>

<?php 
$nombre='';
$usuario='';
$password1='';
$password2='';
$email='';


    	function limpiarDatos($link, $dato)
{
    return htmlentities(mysqli_real_escape_string($link, trim($dato)));
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include 'validarUsuario.php';
	if (!empty($errores)) { ?>
		<div class="mensaje negativo">
        <?= $errores; ?>
    </div>

    <?php } else {        	
    	
    	$nombre = limpiarDatos($link, $nombre);
    	$usuario = limpiarDatos($link, $usuario);
    	$password1 = limpiarDatos($link, $password1);
    	$password2 = limpiarDatos($link, $password2);
    	$email = limpiarDatos($link, $email);
        $passwordHash = password_hash($password2, PASSWORD_DEFAULT);
        

    	$sql = "INSERT INTO usuarios 
    			SET
    			usu_usuario='$usuario',
    			usu_password='$passwordHash',
    			usu_nombre='$nombre',
    			usu_email='$email',
    			permiso='1'
    		   ";
    	$rs= mysqli_query($link,$sql);
    	mysqli_close($link);
    	if ($rs) { ?>
    		<div class="mensaje positivo">
        <?php echo 'Usuario registrado'; 
        $nombre='';
        $usuario='';
        $email='';

        ?>

    </div> <?php
    	} else {
    		echo 'hubo un error';
    	}
    }


	
}


?>



<form action ="" name="registro" method="post">
		
	Nombre y apellido: <br>
	<input type="text" name="nombre" value="<?= $nombre; ?>" autofocus> <br><br>

	Nombre de usuario:<br>
	<input type="text" name="usuario" value="<?= $usuario; ?>"><br><br>

	Password:<br>
	<input type="password" name="password1"><br><br>
	Repita el Password:<br>
	<input type="password" name="password2" ><br><br>

	Email:<br>
	<input type="email" name="email" value="<?= $email; ?>"></input><br><br>

<input type= "submit" value="Registrarse">
</form>





<?php include 'pie.php'; ?>