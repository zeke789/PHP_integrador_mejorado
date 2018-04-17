<?php

$titulo = 'Contacto';
include 'encabezado.php';



if(empty($_SESSION['usuario'])){
    header('Location: index.php');
    die;
}

$titulo = 'Contacto';


?>
    <h1><?php echo $titulo; ?></h1>
<?php
if(!empty($_POST['nombre']) AND !empty($_POST['email']) AND !empty($_POST['comentario'])){

    include 'config.php';

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $comentario = $_POST['comentario'];

    $titulo = 'Nuevo contacto desde el sitio web';
    $mensaje = "
			<h1>Nuevo contacto desde el sitio web</h1>
			<p>
				<strong>Nombre:</strong> $nombre<br />
				<strong>Email:</strong> $email<br />
				<strong>Mensaje:</strong> $comentario<br />
			</p>
		";

    $header = "From: $nombre <$email>\r\n"
        ."Reply-To: $email\r\n"
        ."Content-Type: text/html; charset=UTF-8\r\n";

    // Tener en cuenta que para que funcione mail debe tenerse configurado un servidor de mail.
    // Habitualmente los servicios de hosting suelen tener uno activo.
    mail(DESTINATARIO_EMAIL, $titulo, $mensaje, $header);

    ?>
    <div class="mensaje">
        <p>
            El mensaje ha sido enviado.<br />
            Serás contactado a la brevedad posible.
        </p>
    </div>
    <?php

}else{
    ?>
    <form action="" method="post" id="formcontacto">
        <label for="nombre" id="labelnombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" />
        <label for="email" id="labelemail">E-mail:</label>
        <input type="text" name="email" id="email" />
        <label for="comentario" id="labelcomentario">Comentario:</label>
        <textarea name="comentario" id="comentario" cols="80" rows="5"></textarea>
        <input type="submit" value="Enviar" id="enviar" />
        <input type="reset" value="Restablecer" id="restablecer" />
    </form>
    <?php
}

include 'pie.php';