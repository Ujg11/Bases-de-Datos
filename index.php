<!DOCTYPE html>

<?php include("db.php")?>

<html>
<head>
	<title>CRUD Projecte</title>
	<meta charset="UTF-8">
</head>

<body>

<h1> CRUD dels Hospitals </h1>

<hr/>

<form method="POST" action="Crear_Hospital.php">
		<label>Codi Hospital:<span style="color: red;">*</span></label><br>
			<input type "number" name="id_hospital" placeholder="Codi de l'hospital"><br>
		<label>Nom Hospital:<span style="color: red;">*</span></label><br>
			<input type "text" name="hospital_name" placeholder="Nom de l'hospital"><br>
		<label>Adreça:<span style="color: red;">*</span></label><br>
			<input type "text" name="adress" placeholder="escriu any fundacio grup"><br>
		<label>Comtat:<span style="color: red;">*</span></label><br>
			<input type "text" name="id_county" placeholder="Comtat on es troba (id)"><br>
		<label>Numero de Telèfon:</label><br>
			<input type "number" name="phone" placeholder="Numero de l'hospital"><br>
		<label>Codi Zip:</label><br>
			<input type "text" name="zip_code" placeholder="Codi Zip"><br>
		<label>Id Propietari:<span style="color: red;">*</span></label><br>
			<input type "text" name="ownership" placeholder="Id del propietari"><br>
		<label>	</label><br>
			<input type = "submit" name ="insert" value="INSERIR DADES">
</form>
<br>
<br>

<strong>Quants Hospitals te cada propietari?</strong><br>
<form method="POST" action="Hospitals_propietari.php">
			<input type = "submit" name ="insert" value="Mostrar Propietaris">
</form>
<br>
<br>

<?php 
			$consulta="SELECT min(id_hospital) as id_min, max(id_hospital) as id_max FROM hospitals;";
			$executar=mysqli_query($con,$consulta);

			$fila=mysqli_fetch_array($executar);
			if ($fila){
				$id_min= $fila['id_min'];
				$id_max= $fila['id_max'];
			}
?>

<strong>Escull rang d'hospitals per identificador: (van del <?php echo $id_min . " al " . $id_max ?>)</strong>
<br>
<br>

<form method="POST" action="">
		<label for="rang_min">Desde:</label>
		<input type="number" name="rang_min" min="<?php echo $id_min; ?>" max="<?php echo $id_max; ?>" required>
		<label for="rang_max">Fins:</label>
		<input type="number" name="rang_max" min="<?php echo $id_min; ?>" max="<?php echo $id_max; ?>" required>
		<input type="submit" name="filtrar" value="Filtrar">
</form>
<br>

<?php
$rang_min = $id_min;
$rang_max = $id_max;

if (isset($_POST['filtrar'])) 
{
	$rang_min = intval($_POST['rang_min']);
	$rang_max = intval($_POST['rang_max']);
}
if ($rang_min > $rang_max) {
	$temp = $rang_min;
	$rang_min = $rang_max;
	$rang_max = $temp;
}
if ($rang_min < $id_min || $rang_max > $id_max)
{
	print ("Rang no vàlid\n");
	$rang_min = $id_min;
	$rang_max = $id_max;
}
?>

<table width="500" border="2" style = "background-color=#F9F9F9">
		<tr>
			<th>Codi Hospital</th>
			<th>Nom Hospital</th>
			<th>Adreça</th>
			<th>Id Comtat</th>
			<th>Nom Comtat</th>
			<th>Numero de Telèfon</th>
			<th>Codi Zip</th>
			<th>Propietari</th>
			<th>Editar</th>
			<th>Borrar</th>
		</tr>

		<?php 
			$consulta="SELECT * FROM hospitals where id_hospital between '$rang_min' and '$rang_max';"; 
			$executar=mysqli_query($con,$consulta);
		
			while($fila=mysqli_fetch_array($executar)){
				$id_hospital= $fila['id_hospital'];
				$hospital_name= $fila['hospital_name'];
				$adress= $fila['adress'];
				$county= $fila['id_county'];
				$phone= $fila['phone'];
				$zip_code= $fila['zip_code'];
				$owner_code = $fila['owner_code'];

			$county_name = NULL;
			$consulta2="SELECT county_name FROM comtat where id_county = '$county';"; 
			$executar2=mysqli_query($con,$consulta2);

			if($fila2=mysqli_fetch_array($executar2))
				$county_name = $fila2['county_name'];
		?>

		<tr align="center">
			<td><?php echo $id_hospital; ?></td>
			<td><?php echo $hospital_name; ?></td>
			<td><?php echo $adress; ?></td>
			<td><?php echo $county; ?></td>
			<td><?php echo $county_name; ?></td>
			<td><?php echo $phone; ?></td>
			<td><?php echo $zip_code; ?></td>
			<td><?php echo $owner_code; ?></td>

			<td><a href= "Actualitzar_Hospital.php?editar=<?php echo $id_hospital; ?>">Actualitzar</a></td>
			<td><a href= "Esborrar_Hospital.php?borrar=<?php echo $id_hospital; ?>">Borrar</a></td>

		</tr>
		<?php } ?>

	</table>

</html>
