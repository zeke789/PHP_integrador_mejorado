<?php



if (empty($_GET['prd_editar'])) {
    $titulo = 'Alta de Productos';
    $textoBoton = 'Agregar producto';
} else {
    $titulo = 'Edición de Productos';
    $textoBoton = 'Guardar cambios';
}

include 'encabezado.php';
include 'buscador.php';
if (isset($_SESSION['usuario']) && $_SESSION['permiso'] == 2 || isset($_SESSION['usuario']) && $_SESSION['permiso'] == 3) {

    
?>
<h1><?php echo $titulo ?></h1>

<?php

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$precio = '';
$stock = '';
$envio = '';
$categoria = '';
$marca = '';
$salida = '';
$descripcion = '';
$prd_foto = isset($_POST['prd_foto']) ? $_POST['prd_foto'] : '';
$prd_id = '';
$errores = '';

$mensaje = '';
$tipoDeMensaje = '';
$nombrei = isset($_POST['nombrei']) ? $_POST['nombrei'] : '';





function limpiarDatos($link, $dato)
{
    return htmlentities(mysqli_real_escape_string($link, trim($dato)));
}

include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_GET['prd_editar'])) {
    if (empty($_FILES['foto']['tmp_name'])) {
        $errores .= 'Debe seleccionar una foto';
    }
    include 'validar.php';

    if (!empty($errores)) {
        $huboErrores = true;
    } else {
        $huboErrores = false;
    }

    if ($huboErrores) {
        $mensaje = $errores;
        $tipoDeMensaje = 'negativo';
    } else {
            
                     
            include 'conexion.php';


            $nombre = limpiarDatos($link, $nombre);
            $precio = limpiarDatos($link, $precio);
            $stock = limpiarDatos($link, $stock);
            $envio = limpiarDatos($link, $envio);
            $categoria = limpiarDatos($link, $categoria);
            $marca = limpiarDatos($link, $marca);
            $salida = limpiarDatos($link, $salida);
            $descripcion = limpiarDatos($link, $descripcion);

//            Ejemplo de cómo se podrìa implementar...
//            $datosForm = limpiarTodosLosDatos($link, $_POST);


            // Para utilizar LUEGO para el UPDATE...
//            $codigo = $_GET['prd_editar'];
//            $codigo = trim($codigo);

$foto = $_FILES['foto']['name'];
            $sql = <<<consulta_sql
INSERT INTO productos
SET
prd_nombre = '$nombre',
prd_descripcion = '$descripcion',
prd_precio = $precio,
prd_envio = '$envio',
prd_stock = $stock,
prd_salida = $salida,
prd_alta = '2017-06-10',
prd_foto = '$foto',
cat_id = $categoria,
mrc_id = $marca
consulta_sql;

//            echo $sql;
            $rs = mysqli_query($link, $sql);
            mysqli_close($link);

            $mensaje = 'El producto fue agregado exitosamente a la base de datos.';

            $tipoDeMensaje = 'positivo';

            $nombre = '';
            $precio = '';
            $stock = '';
            $envio = '';
            $categoria = '';
            $marca = '';
            $salida = '';
            $descripcion = '';
            //$nombrei = isset($_POST['nombrei']) ? $_POST['nombrei'] : '';
        } }

  

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_GET['prd_editar'])) {    
 
$dir = "imagenes/productos/$nombrei/";
$foto = !empty($_FILES['foto']['name']) ? $_FILES['foto']['name'] : $prd_foto;

include 'validarEdit.php';

if (!empty($errores)) {
        $huboErrores = true;
    } else {
        $huboErrores = false;
    }

    if ($huboErrores) {
        $mensaje = $errores;
        $tipoDeMensaje = 'negativo';
    } else {
        

include 'conexion.php';

    $asd = $nombre;
    if (!is_dir("./imagenes./productos./$asd") && empty($errores)) {   
        mkdir("./imagenes./productos./$asd");
        mkdir("./imagenes./productos./$asd/galeria");
        if ($asd != $nombrei) { 
            copy("imagenes./productos./$nombrei./$foto", "imagenes./productos./$asd./$foto");
            $dp2 = opendir("./imagenes./productos./$nombrei./galeria");
            while ($files = readdir($dp2)) {
                $pathComplete =  "./imagenes./productos./$nombrei./galeria./$files";
                if (is_file($pathComplete)) {
                    copy("./imagenes./productos./$nombrei./galeria./$files", "./imagenes/productos/$asd/galeria/$files");
                    unlink("./imagenes./productos./$nombrei./galeria./$files");
                }

            }
            
           // die;
            $dp2 = opendir("imagenes/productos/$nombrei");
            while ($file = readdir($dp2)) {                         
                    $completePath = "./imagenes./productos./$nombrei./$file";
                    if (is_file($completePath)) {
                        unlink($completePath);                                
                    } 
            } 
            rmdir("./imagenes./productos./$nombrei./galeria");
            rmdir("imagenes/productos/$nombrei");
           
        }
    }
    //die;

    if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) { 
        if (!getimagesize($_FILES['foto']['tmp_name'])) {
            $errores .= 'El archivo subido no es una imagen<br>'; ?>
            <div class="mensaje negativo">
                 <?= $errores ?>
            </div>
    <?php   
        } else {
                if (is_dir("./imagenes./productos./$nombre")) {
                    $dp = opendir("./imagenes./productos./$nombre");
                    while ($file = readdir($dp)) {
                        if ($file != $foto) {  
                            $completePath = "./imagenes./productos./$nombre./$file";
                            if (is_file($completePath)) {
                                unlink($completePath);
                            } 
                        }
                    }
                } 
            }

            if(empty($errores)){
                $ruta_temp = $_FILES['foto']['tmp_name'];
                $ruta ="imagenes/productos/$asd/";
                $nombreFoto = $_FILES['foto']['name'];
                move_uploaded_file($ruta_temp,$ruta.$nombreFoto);
            }
    }
        if (empty($errores)){
            $nombre = limpiarDatos($link, $nombre);
            $precio = limpiarDatos($link, $precio);
            $stock = limpiarDatos($link, $stock);
            $envio = limpiarDatos($link, $envio);
            $categoria = limpiarDatos($link, $categoria);
            $marca = limpiarDatos($link, $marca);
            $salida = limpiarDatos($link, $salida);
            $descripcion = limpiarDatos($link, $descripcion);

            $sql = <<<consulta_sql
UPDATE productos
SET
prd_nombre = '$nombre',
prd_descripcion = '$descripcion',
prd_precio = $precio,
prd_envio = '$envio',
prd_stock = $stock,
prd_salida = $salida,
prd_alta = '2017-06-10',
prd_foto = "$foto",
cat_id = $categoria,
mrc_id = $marca
WHERE prd_id = {$_GET['prd_editar']}
consulta_sql;

    $rs = mysqli_query($link, $sql);
    mysqli_close($link);
    header('Location: productos_alta.php?editado=1'); 
    } 
} 
} 

if (isset($_GET['editado']) && $_GET['editado'] == '1') {
 $tipoDeMensaje = 'positivo';

            $nombre = '';
            $precio = '';
            $stock = '';
            $envio = '';
            $categoria = '';
            $marca = '';
            $salida = '';
            $descripcion = '';
            $mensaje = 'El producto fue modificado exitosamente.';
}
  
    // Si se ingresó a la página para editar un producto
    if (!empty($_GET['prd_editar'])) {
        // Se buscan los datos en la base de datos

        @ $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
        if (!$link) {
            header('Location: ' . PAGINA_ERROR . '?codigo_error=1&producto_buscado=' . $_GET['prd_editar'] );
            die;
        }

        mysqli_set_charset($link, 'utf8');

        $sql = 'SELECT * FROM productos WHERE prd_id = ' . $_GET['prd_editar'];

        $rs = mysqli_query($link, $sql);

        mysqli_close($link);

        $productoAEditar = mysqli_fetch_assoc($rs);

        $nombre = $productoAEditar['prd_nombre'];
        $precio = $productoAEditar['prd_precio'];
        $stock = $productoAEditar['prd_stock'];
        $envio = $productoAEditar['prd_envio'];
        $salida = $productoAEditar['prd_salida'];
        $descripcion = $productoAEditar['prd_descripcion'];
        $categoria = $productoAEditar['cat_id'];
        $marca = $productoAEditar['mrc_id'];
        $prd_foto = $productoAEditar['prd_foto']; 
 
    } 

if (!empty($mensaje)) {
    ?>
    <div class="mensaje <?= $tipoDeMensaje ?>">
        <?= $mensaje ?>
    </div>
    <?php
     
}

include 'productos_alta_form.php';
} else { ?>
<div class="mensaje negativo">
        <?= 'No tiene permisos para agregar productos' ?>
    </div>
<?php
}

include 'pie.php';