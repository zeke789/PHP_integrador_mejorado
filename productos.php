<?php


$titulo = 'Listado de Productos';

include 'encabezado.php'; 
include 'buscador.php';
?>


   

<h1><?php echo $titulo; ?></h1>

<?php

if (!empty($_GET['accion'])) {
    $tipoDeMensaje = '';
    $mensaje = '';
    switch ($_GET['accion']) {
        case '1':
            $tipoDeMensaje = 'positivo';
            $mensaje = 'El producto fue eliminado';
            break;
        case '-1':
            $tipoDeMensaje = 'negativo';
            $mensaje = 'No se pudo eliminar el producto';
            break;
    }
    ?>
    <div class="mensaje <?= $tipoDeMensaje ?>">
        <?= $mensaje ?>
    </div>
    <?php
}





include 'config.php';
 
require 'conexion.php';



//$desde = 60;
//$cantidad_de_productos_a_traer = 30;
//$rs = mysqli_query($link, 'SELECT * FROM productos LIMIT ' . $desde . ', ' . $cantidad_de_productos_a_traer);

if (isset($_SESSION['usuario']) && $_SESSION['permiso'] == 2 || isset($_SESSION['usuario']) && $_SESSION['permiso'] == 3){ ?>

<a href="catYmarcas" style="font-size: 20px"> Administrar categorias y marcas </a>

<?php
}
$sql3 = "SELECT * from categorias";
$rs2 = mysqli_query($link, $sql3);

 ?>

<div id="nav1">
   <div class="titulonav">
   Categorias
   </div>
   
   <div class="cuerporec">
   <ul>
<?php  if(!empty($_GET['cat'])){ ?>
   <li><a href="productos.php"> Ver todas las categorias </a></li>
<?php } ?>
<?php while($cats = mysqli_fetch_assoc($rs2)) { ?>
    <li><a href="productos.php?cat=<?= $cats['cat_id']?>"><?= $cats['cat_nombre'] ?></a></li>    
<?php    } ?>
   </ul>
   </div>
</div>
<?php


if(isset($_GET['cat'])) {
    $seleccionarCat = $_GET['cat'];

    $sql2 = <<<consulta_sql
    SELECT * FROM productos   INNER JOIN marcas ON productos.mrc_id = marcas.mrc_id     INNER JOIN categorias  ON productos.cat_id = categorias.cat_id 
    WHERE productos.cat_id="$seleccionarCat"
consulta_sql;

$rs = mysqli_query($link,$sql2);
$cantidad_de_filas = mysqli_num_rows($rs);
} else {

    $sql2 = "SELECT * FROM productos   INNER JOIN categorias ON productos.cat_id = categorias.cat_id     INNER JOIN marcas  ON productos.mrc_id = marcas.mrc_id";
$rs = mysqli_query($link, $sql2);
mysqli_close($link);
$cantidad_de_filas = mysqli_num_rows($rs);




        if (!(empty($_GET['producto'])) && $cantidad_de_filas > 0) {
            include 'conexion.php';
            
            $prd_id = $_GET['producto'];

            $sql2 = "SELECT * FROM productos   INNER JOIN categorias ON productos.cat_id = categorias.cat_id  INNER JOIN marcas  ON productos.mrc_id = marcas.mrc_id WHERE prd_id = $prd_id";
            $rs2 = mysqli_query($link, $sql2);
             
            
            mysqli_close($link);

             while ($ids = mysqli_fetch_assoc($rs2)) { 
             $prd_nombre= $ids['prd_nombre']; ?>
 
             <table border="5">
             <tr>
                 <th>Imagen</th>
                 <th>ID</th>
                 <th>Categoria</th>
                 <th>Marca</th>
                 <th>Nombre del producto</th>
                 <th>Precio</th>
                 <th>Envio sin cargo</th>
                 <th>Stock</th>
                 <th>Salida en:</th>
                 <th>Fecha de alta</th>

             </tr>
                  <tr style="border-width: 3px">
            <td style="border-width: 3px"><img src="imagenes/productos/<?=$ids['prd_nombre'] ?>/<?= $ids['prd_foto'] ?>" alt="<?= $ids['prd_nombre'] ?>" width="200"></td>
            <td style="border-width: 3px"><?= $ids['prd_id'] ?></td>
            <td style="border-width: 3px"><?= $ids['cat_nombre'] ?></td>
            <td style="border-width: 3px"><?= $ids['mrc_nombre'] ?></td>
            <td style="border-width: 3px"><?= $ids['prd_nombre'] ?></td>
            
            <td style="border-width: 3px"><?= $ids['prd_precio'] ?></td>
            <td style="border-width: 3px"><?= $ids['prd_envio'] ?></td>
            <td style="border-width: 3px"><?= $ids['prd_stock'] ?></td>
            <td style="border-width: 3px"><?= $ids['prd_salida'] ?></td>
            <td style="border-width: 3px"><?= $ids['prd_alta'] ?></td>            

       <?php             }

 ?>



</tr>
        </table>

  <?php if (isset($_SESSION['usuario']) && $_SESSION['permiso'] == 2 || isset($_SESSION['usuario']) && $_SESSION['permiso'] == 3 ) { ?>   
     
<form method="post" action="" enctype="multipart/form-data">    
<input type="file" name="archivo[]" /> <br>
<input type="file" name="archivo[]" /><br>
<input type="file" name="archivo[]" /><br>
<input type="file" name="archivo[]" /><br>
<input type="file" name="archivo[]" /><br>
<input type="file" name="archivo[]" /><br>
<input type="file" name="archivo[]" /><br><br>

<input type="submit" value="Subir archivos">

</form>
 
        


<?php  // aca se cerraria el de la linbea 204 
    

if (isset($_FILES['archivo'])) {
    
    $cantidadArchivos = count($_FILES['archivo']['name']);
    $ruta = "imagenes/productos/$prd_nombre/galeria/";
    for ($i=0; $i < $cantidadArchivos ; $i++) { 
        $arch_temp = $_FILES['archivo']['tmp_name'][$i];
        $arch = $_FILES['archivo']['name'][$i];
        if ($_FILES['archivo']['error'][$i] == UPLOAD_ERR_OK) {
            move_uploaded_file($arch_temp, $ruta.$arch);
        }
    }
}
            
            

$dp = opendir("imagenes/productos/$prd_nombre/galeria/");
    while ( $archivo = readdir($dp)) {
        $archivo = "imagenes/productos/$prd_nombre/galeria/" . $archivo;
        if (is_dir($archivo)) {
            continue;
        }
        if (!getimagesize($archivo)) {
            continue;
        } 
        echo "<img src=\"$archivo\"width=\"400\" /> <br>";
    }
 } 

}

}

if (isset($_POST['textoAbuscar'])) {
    include 'conexion.php';

    $texto = $_POST['textoAbuscar'];
    $sql4 = "SELECT a.prd_id,a.cat_id,a.prd_nombre,a.prd_descripcion,a.prd_precio,a.prd_envio,a.prd_stock,a.prd_foto,a.mrc_id,b.mrc_nombre,b.mrc_id,c.cat_nombre,c.cat_id FROM productos AS a INNER JOIN categorias as c ON a.cat_id = c.cat_id INNER JOIN marcas AS b ON a.mrc_id = b.mrc_id  WHERE prd_nombre like '%".$texto."%'";
   
    $rs4 = mysqli_query($link,$sql4);
    $filais = mysqli_num_rows($rs4);
    if ($filais = 0) { ?>
  <div class="mensaje negativo">
        <?= 'No se encuentra un producto con ese nombre' ?>
    </div>
    <?php
}
   
    if ($filais > 0) { ?>
        <table id="tablaProductos">
    <tr>
        <th>Imagen</th>
        <th>Categoria</th>
        <th>Marca</th>
        <th>Nombre Producto</th>
        <th>Precio</th>
        <th>Envío <br> sin cargo</th>
        <th>Stock</th>
        <th>Acciones</th>
        <?php 
           
            if (isset($_SESSION['usuario']) && $_SESSION['permiso'] == 3 || isset($_SESSION['usuario']) && $_SESSION['permiso'] == 2) { ?>      
         
        <th>Acciones</th>          
           <?php }
          ?>
    </tr>
    <?php
        while ($filas = mysqli_fetch_assoc($rs4)) { ?>
            <tr>
            <td><img src="imagenes/productos/<?=$filas['prd_nombre']?>/<?= $filas['prd_foto'] ?>" alt="<?= $filas['prd_nombre'] ?>"></td>
            
            <td><?= $filas['cat_nombre'] ?></td>
            <td><?= $filas['mrc_nombre'] ?></td>
            <td><?= $filas['prd_nombre'] ?></td>            
            <td>$<?= $filas['prd_precio'] ?></td>
            <td><?= $filas['prd_envio'] ?></td>
            <td><?= $filas['prd_stock'] ?></td>
            <td> <a href="productos.php?producto=<?= $filas['prd_id'] ?>"> Ver producto </a></td>
              <?php 
             
              if (isset($_SESSION['usuario']) && $_SESSION['permiso'] == 3 || isset($_SESSION['usuario']) && $_SESSION['permiso'] == 2) { ?>
            <td>                                 
                <a href="productos_alta.php?prd_editar=<?= $filas['prd_id'] ?>">
                    <img src="imagenes/editar.png" alt="Editar">
                </a>
                <a href="productos_eliminar.php?prd_eliminar=<?= $filas['prd_id']?>&nombre=<?=$filas['prd_nombre']?>" onclick="return confirm('¿Seguro quiere eliminar este producto?');">
                    <img src="imagenes/eliminar.png" alt="Eliminar">
                </a>
            </td> <?php } ?>
        </tr>
        <?php
             }
         ?>
    <tr>
        <td align="right" colspan="12">Se encontraron <?= $filais ?> productos.</td>
    </tr>
</table>

<?php

        }

  

    mysqli_close($link);

      } else {


if ($cantidad_de_filas == 0) {
    ?>
    <p>No se encuentra ningún producto. <a href="productos_alta.php">Agregar nuevos productos</a>.</p>
    <?php

}  elseif (empty($_GET['producto'])) {
    include 'productos_tabla.php';
} 
}

/*
?>
    <a href="productos.php?pagina=1">1</a>
    <a href="productos.php?pagina=2">2</a>
    <a href="productos.php?pagina=3">3</a>
<?php
*/

include 'pie.php';