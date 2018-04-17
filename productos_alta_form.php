	<?php include 'conexion.php'; ?>
	<form action="" method="post" id="formproductos" name="formproductos" enctype="multipart/form-data">
		<fieldset id="fieldsetdatosbasicos">
			<legend>Datos básicos</legend>

			<label for="nombre" id="labelnombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" value="<?= $nombre ?>" autofocus />
	

			<label for="precio" id="labelprecio">Precio:</label>
			<input type="text" name="precio" id="precio" value="<?= $precio ?>" />
	
		
			<label for="stock" id="labelstock">Stock:</label>
			<input type="text" name="stock" id="stock" value="<?= $stock ?>" />
	

			<input type="checkbox" name="envio" id="envio" value="Si" <?php if ($envio == 'Si') { echo 'checked'; } ?> />
			<label for="envio" id="labelenvio">Envío s/c</label>
	
	
			<label for="categoria" id="labelcategoria">Categoría:</label>
			<select name="categoria" id="categoria">
				<option value="">Seleccione una opción</option>

                <?php /* ?>

                <?php
                if (alguna validacion de telefono... o tal esto va en validar.php...) {
                    $selectedCategoriaTelefonos = 'selected';
                } else {
                    $selectedCategoriaTelefonos = '';
                }
                if (alguna validacion de televisores... o tal esto va en validar.php...) {
                    $selectedCategoriaTelefonos = 'selected';
                } else {
                    $selectedCategoriaTelefonos = '';
                }
                ?>

				<option value="1" <?= $selectedCategoriaTelefonos ?>>Teléfonos Celulares</option>
				<option value="2" <?= $selectedCategoriaTelevisores ?>>Televisores</option>

                <?php */ ?>

			<?php  $sql= 'select * from categorias';
$rs = mysqli_query($link,$sql);

while ($opciones = mysqli_fetch_assoc($rs) ) { ?>
	<option value="<?= $opciones['cat_id'] ?>" <?php 	if ($categoria == $opciones['cat_id']) {echo 'selected'; } ?>> <?= $opciones['cat_nombre'] ?> </option>
 <?php } ?>

			</select>
	<?php 
$sql4 = "SELECT prd_nombre FROM productos WHERE prd_nombre = '$nombre'";
$rs4 = mysqli_query($link,$sql4);
$filai = mysqli_fetch_assoc($rs4);
	$nombrei = $filai['prd_nombre'];



	 ?>
<input type="hidden" name="nombrei" value="<?=$filai['prd_nombre'] ?>" />
	
			<label for="marca" id="labelmarca">Marca:</label>
			<select name="marca" id="marca">
			<option value="">Seleccione una opción</option>
				<?php 
				  	$sql2= 'select * from marcas';
				  	$rs2= mysqli_query($link,$sql2); 
				   ?>
				   <?php 
				   	while ($opciones2=mysqli_fetch_assoc($rs2)) { ?>
				   		<option value= "<?= $opciones2['mrc_id']?>" <?php if($marca == $opciones2['mrc_id']) {echo 'selected'; } ?>>
				   			<?= $opciones2['mrc_nombre']; ?>
				   		</option>
				   	<?php }
				    ?>
			</select>
		</fieldset>
<?php mysqli_close($link); ?>
<input type="hidden" name="oldPath" value="imagenes/productos/<?=$nombre?>"; 	/>
		<fieldset id="fieldsetsalida">
			<legend>Salida de depósito</legend>

			<input type="radio" value="1" name="salida" id="salida0" <?php if ($salida == '1') {echo 'checked';}?> />
			<label for="salida0" id="labelsalida0">Salida Inmediata</label>
			
			<input type="radio" value="24" name="salida" id="salida24" <?php if ($salida == '24') {echo 'checked';}?> />
			<label for="salida24" id="labelsalida24">24hs hábiles</label>
			
			<input type="radio" value="48" name="salida" id="salida48" <?php if ($salida == '48') {echo 'checked';}?> />
			<label for="salida48" id="labelsalida48">48hs hábiles</label>
			
			<input type="radio" value="72" name="salida" id="salida72" <?php if ($salida == '72') {echo 'checked';}?> />
			<label for="salida72" id="labelsalida72">72hs hábiles</label>
		</fieldset>


		<fieldset id="fieldsetdescripcionyfoto">
			<legend>Descripción y foto</legend>

			<label for="descripcion" id="labeldescripcion">Descripción:</label>
			<textarea name="descripcion" id="descripcion" cols="80" rows="5"><?= $descripcion ?></textarea>


			<fieldset id="fieldsetfoto">
				<legend>Foto actual:</legend>
				<img src="imagenes/productos/<?=$nombre?>/<?=$prd_foto?>" alt="Foto del producto" />
				<input type="hidden" value="<?=$prd_foto?>" name="prd_foto" />
			</fieldset>


			<label for="foto" id="labelfoto">Nueva foto:</label>
			<input type="file" name="foto" id="foto" />
			
		</fieldset>

		<input type="submit" value="<?= $textoBoton ?>" id="agregar" />
		<input type="reset" value="Restablecer el formulario" id="restablecer" />

	</form>

