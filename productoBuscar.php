<?php
include 'encabezado.php';
include 'config.php';
include 'conexion.php'; ?>

<form  style="position:absolute;top:135px;left: 900px" action="productoBuscar.php" method="post"> 
    <input type="text" style="width: 230px;height: 25px; border-color: #2A80BD" placeholder="Producto o marca a buscar" name="textoAbuscar" /> 
    <input type="submit" value="Buscar" style="width: 100px;height: 25px" />
    </form>

<?php

if (isset($_POST['textoAbuscar'])) {
   
    $texto = $_POST['textoAbuscar'];
    $sql4 = "SELECT a.prd_nombre,a.prd_descripcion,a.prd_precio,a.prd_envio,a.prd_stock,a.prd_foto,a.mrc_id,b.mrc_nombre,b.mrc_id FROM productos AS a INNER JOIN marcas AS b ON a.mrc_id = b.mrc_id WHERE prd_nombre like '%".$texto."%'";
       $rs4 = mysqli_query($link,$sql4);
    while ($filas = mysqli_fetch_assoc($rs4)) {
    	echo $filas['prd_nombre'];
    }
  }

include 'pie.php';
 ?>