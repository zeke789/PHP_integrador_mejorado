<?php 
$titulo = 'Panel de usuarios';
include 'encabezado.php';
 if (isset($_SESSION['usuario']) && $_SESSION['permiso'] == 3 || isset($_SESSION['usuario']) && $_SESSION['permiso'] == 2) {  
include 'config.php';

if (isset($_GET['agregado'])) {
	switch ($_GET['agregado']) {
		case '1': ?>
			 <div class="mensaje positivo">
			 <?= 'Usuario agregado'; ?>
			 </div>
<?php			break;
		
		case '-1' ?>
			<div class="mensaje negativo">
			 <?= 'No se pudo agregar el usuario'; ?>
			 </div>
<?php		break;
	}
}


if (isset($_GET['eliminar'])) {
	include 'conexion.php';
	$sql= "DELETE FROM usuarios WHERE usu_id=" . $_GET['eliminar'];
	$rs= mysqli_query($link,$sql);
	$filasAfectadas = mysqli_affected_rows($link);

	if ($filasAfectadas == 1) {
		header("Location: panel_usuarios.php?accion=1");
	} else {
		 header("Location: panel_usuarios.php?accion=-1");
		} 
}

if (isset($_GET['accion'])) {
	if ($_GET['accion'] == 1) {
		$tipoDeMensaje = 'positivo';
        $mensaje = 'El usuario fue eliminado';
	} elseif ($_GET['accion'] == '-1') {
		$tipoDeMensaje = 'negativo';
        $mensaje = 'El usuario no pudo eliminarse';
	} ?>
	 <div class="mensaje <?= $tipoDeMensaje ?>">
        <?= $mensaje ?>
    </div>    
<?php
} 

if ( isset($_SESSION['usuario']) && $_SESSION['permiso']  == 3) {
	include 'conexion.php';
	$sql = "SELECT * FROM usuarios"; ?>
	<a href="agregarAdministrador.php"> Agregar administrador </a>
<?php
 } elseif (isset($_SESSION['usuario']) && $_SESSION['permiso']  == 2) {
 		include 'conexion.php';
		$sql = "SELECT * FROM usuarios WHERE permiso='1'"; 
	 }

$rs = mysqli_query($link,$sql);
mysqli_close($link); ?>

<table border="5">
    <tr>
        <th>ID</th>
		<th>Usuario</th>
		<th>Nombre</th>
		<th>Email</th>
		<th>Acciones</th>
	</tr>       
   

    <?php   
    while ($filas = mysqli_fetch_assoc($rs)) {
        ?>
        <tr>
        <td><?= $filas['usu_id'] ?></td> 
		<td><?= $filas['usu_usuario'] ?></td>
		<td><?= $filas['usu_nombre'] ?></td> 
		<td><?= $filas['usu_email'] ?></td>
		<td><a href="panel_usuarios.php?eliminar=<?= $filas['usu_id'] ?>" onclick="return confirm('¿Seguro quiere eliminar este producto?');">
		<img src="imagenes/eliminar.png" alt="Editar"></td>
		</a>
		</tr>
 

<?php }  ?>
</table>

<?php

 



} else {

	echo ' no tiene permisos para administrar usuarios';
}

include 'pie.php';
