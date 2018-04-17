<?php

$titulo = 'Comentar';

include 'encabezado.php'; 
include 'buscador.php';

if (isset($_GET['error']) && $_GET['error'] == 1) { ?>
    <div class="mensaje negativo">
        <?= 'Debe agregar un comentario' ?>
    </div>
<?php
}
if (isset($_SESSION['usuario'])) {
	

?>

    <h1><?php echo $titulo; ?></h1>
    <form action="" method="post" id="formcomentar" name="formcomentar">
          <label for="nombre" id="labelnombre">Usuario:</label>
        <input type="text" name="nombre" id="nombre" value="<?= $_SESSION['usuario']; ?>" readonly />
        <label for="comentario" id="labelcomentario">Comentario:</label>
        <textarea name="comentario" id="comentario" cols="80" rows="5" autofocus></textarea>
        <input type="submit" value="Publicar" id="publicar" />
        <input type="reset" value="Restablecer" id="restablecer" />
    </form>

   <?php 
   function limpiarDatos($link, $dato)
{
    return htmlentities(mysqli_real_escape_string($link, trim($dato)));
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $fecha = date('d-m-Y');
        
        $comentario = (isset($_POST['comentario'])) ? $_POST['comentario'] : '';
        if (!empty($comentario)) {
            include 'config.php';
            include 'conexion.php';
            $nombre = limpiarDatos($link,$_POST['nombre']);
            $comentario = limpiarDatos($link,$comentario);            
            $sql = <<<consulta_sql
INSERT INTO comentarios
SET 
usu_nombre='$nombre',
comentario='$comentario',
comentario_fecha='$fecha'
consulta_sql;

            $rs = mysqli_query($link,$sql);
            mysqli_close($link);
            if ($rs) {
                header('Location: libro_de_visitas2.php?comentarioHecho=1');
            }
        

        } else {
            header('Location: comentar.php?error=1'); 
            } 
    
    }


     ?>


<?php
} else { 
	echo ' <h2> Debe estar registrado para dejar un comentario </h2> <br> '; ?>

	<a href="iniciarSesion.php"> Click aca para iniciar sesion </a> <br><br>
<a href="registrarse.php"> Click aca para registrarse </a>

<?php
}






include 'pie.php';
