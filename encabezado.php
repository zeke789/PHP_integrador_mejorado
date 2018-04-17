<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?= $titulo ?> :: Proyecto Integrador</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
</head>
<body>
	<div id="header">
		<div id="banner"></div>
	</div>
	<div id="barramenu">
		<div id="menu">
			<ul>
				<li><a href="index.php">Home</a></li>
				
<?php
if (isset($_COOKIE['usuario_recordado']) && isset($_COOKIE['contrasena_recordada'])) {
	session_start();				
	$usuario = $_COOKIE['usuario_recordado'];
    $usuPermisos = $_COOKIE['permiso'];
    $_SESSION['usuario'] = $usuario;
    $_SESSION['permiso'] = $usuPermisos;

} else {
	session_start();
}
				

				if ( isset($_SESSION['usuario']) && $_SESSION['permiso']  == 3 || isset($_SESSION['usuario']) && $_SESSION['permiso']  == 2) { ?>
				
				<li><a href="productos_alta.php">Alta de productos</a></li>
				<li><a href="panel_usuarios.php">Panel de usuarios</a></li>
				<?php } ?>

				<li><a href="productos.php">Listado de productos</a></li>
				<li><a href="comentar.php">Comentar</a></li>
				<li><a href="libro_de_visitas2.php">Libro de visitas</a></li>
				<li><a href="contacto.php">Contacto</a></li>
				<?php if (isset($_SESSION['usuario'])) { ?>
					
				
				<li><a href="salir.php">Salir</a></li>
			<?php
				}  ?>
			</ul>

			<div id="fecha">
				<p><?= date('d/m/Y') ?></p>

			</div>

			
		</div>
	</div>



	<div id="principal">
<?php 
 

 ?>

