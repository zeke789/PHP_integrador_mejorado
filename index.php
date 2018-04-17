<?php
include 'config.php';
$titulo = 'Home';

include 'encabezado.php';

	include 'buscador.php'; ?>
    <h1>Proyecto Integrador</h1>
    <p>
        Cantidad de visitas:
        <?php
            include 'contador.php';
        ?>
    </p>
<?php 

if (isset($_SESSION['usuario'])) {
	echo 'Bienvenido ' . $_SESSION['usuario'] . '<br>';
} else { ?>

<a href="iniciarSesion.php"> Click aca para iniciar sesion </a> <br><br>
<a href="registrarse.php"> Click aca para registrarse </a>

<?php }


include 'pie.php';