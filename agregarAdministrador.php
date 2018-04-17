<?php 
include 'encabezado.php';

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include 'validarUsuario.php';
	if (empty($errores)) {

		$nombre=$_POST['nombre'];
		$usuario=$_POST['usuario'];
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];
		$email=$_POST['email'];
		$codificado = password_hash($password2,PASSWORD_DEFAULT);

		include 'conexion.php';

		$sql = "INSERT INTO usuarios SET
		usu_nombre='$nombre',
		usu_usuario='$usuario',
		usu_password='$codificado',
		usu_email='$email',
		permiso='2'";
		$rs=mysqli_query($link,$sql);
		mysqli_close($link);
		if ($rs) {  
			 header('Location: panel_usuarios.php?agregado=1');
 	} 
	}

		else { ?>
			 <div class="mensaje negativo">
        <?= $errores; ?>
    </div> 
<?php		}

	 
	 
}
?>

<h1>Registrar Administrador</h1>
<form method="POST" action="">
Nombre:<br>
<input type="text" name="nombre" /> <br>
Usuario:<br>
<input type="text" name="usuario" /><br>
Password:<br>
<input type="password" name="password1" /><br>
Repita el password:<br>
<input type="password" name="password2" /><br>
Email:<br>
<input type="email" name="email" /><br>
<input type="submit" value="Registrar admin"></input>
</form>

<?php
include 'pie.php';