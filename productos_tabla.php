<table id="tablaProductos">
    <tr>
        <th>Imagen</th>
        <th>Id</th>
        <th>Categoría</th>
        <th>Marca</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Envío <br> sin cargo</th>
        <th>Stock</th>
        <th>Salida</th>
        <th>Fecha de alta</th>
        <th></th>
         <?php 
           
            if (isset($_SESSION['usuario']) && $_SESSION['permiso'] == 3 || isset($_SESSION['usuario']) && $_SESSION['permiso'] == 2) { ?>      
         
        <th>Acciones</th>          
           <?php }
          ?>
    </tr>
    <?php
   
    while ($fila = mysqli_fetch_assoc($rs)) {
        ?>
        <tr>
            <td><img src="imagenes/productos/<?=$fila['prd_nombre']?>/<?= $fila['prd_foto'] ?>" alt="<?= $fila['prd_nombre'] ?>"></td>
            <td><?= $fila['prd_id'] ?></td>
            <td><?= $fila['cat_nombre'] ?></td>
            <td><?= $fila['mrc_nombre'] ?></td>
            <td><?= $fila['prd_nombre'] ?></td>            
            <td>$<?= $fila['prd_precio'] ?></td>
            <td><?= $fila['prd_envio'] ?></td>
            <td><?= $fila['prd_stock'] ?></td>
            <td><?= $fila['prd_salida'] ?>hs</td>
            <td><?= $fila['prd_alta'] ?></td>
            <td> <a href="productos.php?producto=<?= $fila['prd_id'] ?>"> Ver producto </a></td>
              <?php 

              if (isset($_SESSION['usuario']) && $_SESSION['permiso'] == 3 || isset($_SESSION['usuario']) && $_SESSION['permiso'] == 2) { ?>
            <td>                                 
                <a href="productos_alta.php?prd_editar=<?= $fila['prd_id'] ?>">
                    <img src="imagenes/editar.png" alt="Editar">
                </a>
                <a href="productos_eliminar.php?prd_eliminar=<?= $fila['prd_id']?>&nombre=<?=$fila['prd_nombre']?>" onclick="return confirm('¿Seguro quiere eliminar este producto?');">
                    <img src="imagenes/eliminar.png" alt="Eliminar">
                </a>
            </td> <?php } ?>
        </tr>
        <?php
             };
         ?>
    <tr>
        <td align="right" colspan="12">Se encontraron <?= $cantidad_de_filas ?> productos.</td>
    </tr>
</table>

<a href="productos.php?pagina=televisores">Ver televisores</a>
<a href="productos.php?pagina=celulares">Ver celulares</a>
