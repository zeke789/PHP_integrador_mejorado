<?php 
$titulo = "iniciar sesion";
include 'encabezado.php'; ?>
<form action="" method="post" id="formlogin">
        <label for="usuario" id="labelusuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" autofocus value="<?= (isset($_COOKIE['usuario_recordado'])) ? $_COOKIE['usuario_recordado'] : '' ?>">
        <label for="contrasena" id="labelcontrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" value="<?= (isset($_COOKIE['contrasena_recordada'])) ? $_COOKIE['contrasena_recordada'] : '' ?>">
    <fieldset id="fieldsetrecordar">
        <input type="radio" name="recordar" id="recordarusuario" value="recordarusuario">
        <label for="recordarusuario">Recordar usuario</label>

        <input type="radio" name="recordar" id="recordarambos" value="recordarambos" style="position:absolute;top:85px;left: 25px">
        <label for="recordarambos" style="position:absolute;top:85px;left: 35px">Mantenerse logeado</label>

<a href="reestablecer.php" style="position:absolute;top:135px;left: 25px">¿Olvido su contraseña?</a>
       
    </fieldset>
    <input type="submit" value="Ingresar" id="enviar">
    <input type="reset" value="Restablecer" id="restablecer">
</form>




<?php 

//$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
//$contrasena = (isset($_POST['contrasena'])) ? $_POST['contrasena'] : '';
include 'config.php';
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
	 $sql= "SELECT * FROM usuarios WHERE usu_usuario='$usuario'";
     $rs= mysqli_query($link, $sql);
     $datos = mysqli_fetch_assoc($rs);
     
     $codificado = $datos['usu_password'];
     $verificado = password_verify($contrasena,$codificado);
    // var_dump($datos['usu_password']) . '<br>';
    // var_dump($contrasena);
   //  die;

     if ($usuario == $datos['usu_usuario'] && $verificado == true) {
            $usuPermisos = $datos['permiso'];
            $email = $datos['usu_email'];
            setcookie('permiso',$usuPermisos,time() + 60*60*24);
            
                if (isset($_POST['recordar'])) {
                    switch ($_POST['recordar']) {
                        case 'recordarusuario':
                        setcookie('usuario_recordado', $_POST['usuario'], time() + 60*60*24);
                        setcookie('contrasena_recordada', '', time());
                        break;
                        case 'recordarambos':
                        setcookie('usuario_recordado', $_POST['usuario'], time() + 60*60*24);
                        setcookie('contrasena_recordada', $_POST['contrasena'], time() + 60*60*24);
                        break;
                        
                    }
                }
                //session_start();
                $_SESSION['usuario'] = $usuario;
                $_SESSION['permiso'] = $usuPermisos;
                $_SESSION['email'] = $email;
                header('Location: index.php');
                
    } else {
        echo 'Usuario o contraseña incorrecto';
    }
}
mysqli_close($link);
include 'pie.php';