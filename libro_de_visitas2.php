<?php


$titulo = 'Libro de visitas';

include 'encabezado.php'; ?>

<h1><?= $titulo; ?> </h1>

<?php   include 'buscador.php';



if (isset($_GET['codigo']) && $_GET['codigo'] == 1) { ?>
	 <div class="mensaje positivo">
        <?= 'El comentario se elimino correctamente' ?>
    </div>
<?php }

if (isset($_GET['comentarioHecho'])) {
	if ($_GET['comentarioHecho'] == 1) { ?>
		<div class="mensaje positivo">
        <?= 'Comentario agregado' ?>
    </div>
<?php	
	}
}


include 'config.php';
include 'conexion.php';

$sql = 'SELECT * FROM comentarios ORDER BY comentario_fecha DESC';
$rs=mysqli_query($link,$sql);
mysqli_close($link);

while ($filas = mysqli_fetch_assoc($rs)) { ?>

		<div class="comentario">
							<p><strong>Fecha: </strong> <?= $filas['comentario_fecha'] ?> </p>
							<p><strong>De: </strong> <?= $filas['usu_nombre'] ?> </p>
							<p><strong>Comentario: </strong> <?= $filas['comentario']?></p>

					<?php if(isset($_SESSION['usuario']) && $_SESSION['permiso'] == 2 || isset($_SESSION['usuario']) && $_SESSION['permiso'] == 3) { ?>
							<a href="libro_de_visitas2.php?eliminar=<?= $filas['comentario_id']; ?>" onclick="return confirm('¿Seguro quiere eliminar este producto?');"> <img src="imagenes/eliminar.png"> </a> <?php } ?>

						</div> 
<?php
							
}




if (isset($_GET['eliminar'])) {
	$prdBorrar = $_GET['eliminar'];
	include 'conexion.php';
$sql = <<<consulta_sql
DELETE FROM comentarios WHERE comentario_id='$prdBorrar'
consulta_sql;

	$rs= mysqli_query($link,$sql);
	mysqli_close($link);
	if ($rs) {
			header('Location: libro_de_visitas2.php?codigo=1');
		}
		
}


