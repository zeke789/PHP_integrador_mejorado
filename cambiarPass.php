<?php 
$titulo = 'Reestablecer contraseña';
include 'encabezado.php'; 
 ?>
<h1><?= $titulo ?> </h1>



<?php
$usuario = $_GET['usu'];
if ($_SERVER['REQUEST_METHOD']== 'POST') {
	$codigo = $_POST['codigo'];
	$nuevopass = $_POST['nuevopass'];
	$nuevopass2 = $_POST['nuevopass2'];
	if ($nuevopass !== $nuevopass2) { ?>
		 <div class="mensaje negativo">
            <?= 'Las contraseñas no coinciden' ?>             
    	</div>
    		<?php
	}else{
		include 'config.php';
		include 'conexion.php';
		$sql = "SELECT reestablecer FROM usuarios WHERE usu_usuario='$usuario'";
		$rs = mysqli_query($link,$sql);
		$fila = mysqli_fetch_assoc($rs);
		$hashCodigo = $fila['reestablecer'];
		
			if (password_verify($codigo,$hashCodigo) == TRUE) {
				$codificado = password_hash($nuevopass2, PASSWORD_DEFAULT);
				$sql2 = "UPDATE usuarios SET usu_password = '$codificado' WHERE usu_usuario = '$usuario' ";				
				$rs2 = mysqli_query($link,$sql2);
				
// preguntar if $RS entonces mostrar "contraseña cambiada"..... insertar el password en la base de datos pero con el hash
				if ($rs) {
				?>
				<div class="mensaje positivo">
            		<?= 'Contraseña cambiada con exito' ?>         
    			</div>
    			<?php
    			$codigo = '';
    			}else {
    				echo 'Hubo un error al intentar cambiar la contraseña';
    			}
    	
			} else { ?>
				<div class="mensaje negativo">
            		<?= 'El codigo introducido es incorrecto' ?>         
    			</div>
    	<?php
				}

		}



}

?>
<form action="" method="post">
    Codigo recibido por mail: <br>
	<input type="text" name="codigo" value="<?php echo isset($codigo) ? $codigo : '' ?>" /> <br><br>
	Contraseña nueva: <br>
	<input type="text" name="nuevopass" /> <br><br>
	Repita contraseñea : <br>
	<input type="text" name="nuevopass2" /><br><br>
	<input type="submit" />
</form>




<?php
include 'pie.php';