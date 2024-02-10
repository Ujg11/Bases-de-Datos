<?php
include("db.php");

if(isset($_GET['editar']))
{
	$editar_id =$_GET['editar'];
	$consulta ="SELECT id_hospital, hospital_name, adress, id_county, phone, zip_code, owner_code FROM hospitals WHERE id_hospital ='$editar_id'";
	$executar = mysqli_query($con, $consulta);
	$fila = mysqli_fetch_array($executar);
	$hospital_name = $fila['hospital_name'];
	$adress = $fila['adress'];
	$id_county = $fila['id_county'];
	$phone= $fila['phone'];
	$zip_code= $fila['zip_code'];
	$owner_code = $fila['owner_code'];
}
?>

<h2> Actualitzar Hospital </h2>

<form method="POST" action="">
		<label>Nom Hospital:<span style="color: red;">*</span></label><br>
			<input type= "text" name="hospital_name" value="<?php echo $hospital_name; ?>"><br>
		<label>Adreça:<span style="color: red;">*</span></label><br>
			<input type= "text" name="adress" value="<?php echo $adress; ?>"><br>
		<label>Comtat:<span style="color: red;">*</span></label><br>
			<input type= "text" name="id_county" value="<?php echo $id_county; ?>"><br>
		<label>Numero de Telèfon:</label><br>
			<input type= "text" name="phone" value="<?php echo $phone; ?>"><br>
		<label>Codi Zip:</label><br>
			<input type= "text" name="zip_code" value="<?php echo $zip_code; ?>"><br>
		<label>Propietari:<span style="color: red;">*</span></label><br>
			<input type= "text" name="owner_code" value="<?php echo $owner_code; ?>"><br>

		<input type ="submit" name="actualitzar" value="ACTUALITZAR DADES">		
</form>


<?php
	if (isset($_POST['actualitzar'])){
		$actualitzar_nom = $_POST['hospital_name'];
		$actualitzar_adreça = $_POST['adress'];
		$actualitzar_comtat = $_POST['id_county'];
		$actualitzar_telefon = $_POST['phone'];
		$actualitzar_zip = $_POST['zip_code'];
		$actualitzar_propietari = $_POST['owner_code'];

		$consulta2="SELECT id_owner as id_owner FROM propietaris where id_owner = $actualitzar_propietari;";
		$executar=mysqli_query($con,$consulta2);
		$fila=mysqli_fetch_array($executar);
		if ($fila)
			$owner_prova= $fila['id_owner'];

		$consulta3="SELECT id_county as id_county FROM comtat where id_county = $actualitzar_comtat;";
		$executar=mysqli_query($con,$consulta3);
		$fila=mysqli_fetch_array($executar);
		if ($fila)
			$county_prova= $fila['id_county'];

		if (!$actualitzar_nom || !$actualitzar_adreça || !$actualitzar_comtat || !$actualitzar_propietari) {
			echo '<span style="color: red;">Cal omplir els camps obligatoris</span><br>';
			//header("Location: index.php");
		}
		else if($county_prova == NULL)
		{
			echo"<script>alert('Comtat no vàlid, provi amb un altre');</script>";
			//echo"<script>window.open('index.php', '_self');</script>";
		}
		else if($owner_prova == NULL)
		{
			echo"<script>alert('Propietari no vàlid, provi amb un altre');</script>";
			//echo"<script>window.open('index.php', '_self');</script>";
		}
		else
		{
			$actualitzar = "UPDATE hospitals SET hospital_name = '$actualitzar_nom', adress='$actualitzar_adreça', id_county = '$actualitzar_comtat',
                 phone = '$actualitzar_telefon',  zip_code = '$actualitzar_zip', owner_code = '$actualitzar_propietari' WHERE id_hospital=$editar_id";


			$executar=mysqli_query($con,$actualitzar);
			if ($executar){
				echo"<script>alert('Datos actualizados!');</script>";
        	    echo"<script>window.open('index.php', '_self');</script>";
        	    //header("Location: index.php");//redirecciona a index.php
			}
		}
		
	}
?>


