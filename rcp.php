<?php
include('DB/conexion.php');
date_default_timezone_set('America/Mexico_City');
$fecha_actual = date("Y-m-d H:i:s");


if (isset($_GET['nombre'])) {
	$nombre = $_GET['nombre'];
	$result = mysqli_query($conectar, "SELECT * FROM clinica WHERE nombre LIKE '%" . $nombre . "%' LIMIT 10");
	while ($row = mysqli_fetch_array($result)) {
		echo '<li onClick="fill_info(' . $row['id'] . ');">' . $row['nombre'] . '</li>';
	}
}

if (isset($_GET['idreg'])) {
	$idreg = $_GET['idreg'];
	$result = mysqli_query($conectar, "SELECT * FROM clinica WHERE id='" . $idreg . "'");
	$row = mysqli_fetch_array($result);
?>
	<div id="div_resp">
		<br>
		<label id="titulo" for="namecli"> Clinica:</label>
		<br> <input type="text" name="namecli" id="namecli" value="<?php echo $row['nombre'] ?>">
		<br>
		<br> <label id="titulo" for="namecli">Doctores:</label>
		<br> <input type="text" name="docs" id="docs" value="<?php echo $row['doctores'] ?>">
		<!-- CORDS -->
		<br> <input type="text" name="cords" id="cords" value="<?php echo $row['cords'] ?>">
		<br>
		<div id="datos">

		</div>
		<?php
		$query_visita = mysqli_query($conectar, "SELECT id,tipov FROM tipov ");
		$result_visita = mysqli_num_rows($query_visita);

		?>
		<br>
		<select name="tipov" id="tipov">
			<?php
			if ($result_visita > 0) {
				while ($tipoVisita = mysqli_fetch_array($query_visita)) {
			?>
					<option value="<?php echo $tipoVisita['id']; ?>"> <?php echo $tipoVisita['tipov'];  ?> </option>
			<?php
				}
			}
			?>
		</select>
		<br>
		<label id="titulo" for="namecli">
			Observaciones:
		</label><br>
		<textarea name="obser" id="obser" cols="30" rows="10"></textarea>

		<div class="form-group">
			<input class="form-control" type="hidden" id="fecha" name="fecha" value="<?= $fecha_actual ?>">
		</div>
		

	
<?php
}

?>
