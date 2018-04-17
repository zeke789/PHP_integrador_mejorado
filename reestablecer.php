<?php 
$titulo = 'Reestablecer contraseña';
include 'encabezado.php'; ?>
<h1><?= $titulo ?></h1>
<?php
$errores = '';
if(!isset($_GET['sinerrores'])) { 
if ($_SERVER['REQUEST_METHOD'] ==  'POST') {

	$usuario = $_POST['usuario'];
	$email = $_POST['email'];

	if (empty($usuario)) {
		$errores .= 'Debe ingresar un nombre de usuario<br>';
	} else {
			if (strlen($usuario) < 3) {
    			$errores .= 'El nombre debe ser mayor a 3 caracteres<br>';
			}	elseif (strlen($usuario) > 19) {
					$errores .= 'El nombre de usuario debe ser menor a 20 caracteres<br>';
				}
		}
	if (empty($email)) {
		$errores .= 'Debe ingresar un email<br>';
	}
}

if (!empty($errores)){ ?>
	<div class="mensaje negativo">
          <?= $errores ?>  
    </div>
<?php
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errores)) {

	header('Location: reestablecer.php?sinerrores=1&usu=' .$usuario. '&email=' . $email);
}
?>
<p style="font-size: 14px"> Para reestablecer su contraseña le enviaremos un codigo de verificacion a su email, por favor complete los datos </p>
	<form method="post" action="">
  		Nombre de usuario: <br>
    	<input type="text" name="usuario"><br><br>
		Direccion de email:<br>
		<input type="email" name="email" /> <br> <br>
		<input type="submit" value="Enviar codigo" />
	</form> <br> <br>
<?php
} // aca termina el del !isset $_GET['errores']



if (isset($_GET['sinerrores'])) {
	$usuario = $_GET['usu'];
	$email = $_GET['email'];
	include 'config.php';
	include 'conexion.php';
	$sql = "SELECT usu_usuario, usu_email FROM usuarios WHERE usu_usuario = '$usuario' AND usu_email = '$email'";
	$rs = mysqli_query($link,$sql);
	$fila = mysqli_num_rows($rs);
	//$filas = mysqli_fetch_assoc($rs);
	
	if ($fila == 1) { 
		    	
		$codigo = rand(10000, 99999);
		$hashCodigo = password_hash($codigo, PASSWORD_DEFAULT);
		
		$sql2 = "UPDATE usuarios SET reestablecer = '$hashCodigo' WHERE usu_usuario = '$usuario'";
		mysqli_query($link,$sql2);
		mysqli_close($link);
		$mensaje = "<p style='font-size:15px'>Codigo: $codigo </p> <br> Para reestablecer la contraseña visite la siguiente pagina: <br>" .  "<a href='localhost/integrador/cambiarPass.php?usu=$usuario'>Reestablecer contraseña</a>";		
		$headers = "From: Admin < postmaster@localhost.com >\r\n";
		$headers .= "Content-type: text/html; charset= utf-8\r\n";
		if (mail($email, 'Codigo de reestablecimiento de contraseña', $mensaje, $headers)) { ?>
			<div class="mensaje positivo">
            <?= 'Codigo enviado, verifique su casilla de correo electronico' ?>  
    	</div>
    	<?php
		}
} else { ?>
		<div class="mensaje negativo">
            <?= 'Su email no coincide con ese nombre de usuario' ?>             
    	</div>
    	<a href="reestablecer.php">Volver a intentarlo </a>
    	
<?php     
		}

}
 






	


include 'pie.php';