<?php 
include ("db.php");
	$id_hospital= NULL;
	$hospital_name= NULL;
	$adress= NULL;
	$id_county= 0;
	$phone= "No especificat";
	$zip_code= "No especificat";
	$ownership = 0;

	$id_prova = NULL;
   
	if (isset($_POST['insert'])){
		$id_hospital= $_POST['id_hospital'];
		$hospital_name= $_POST['hospital_name'];
		$adress= $_POST['adress'];
		$ownership = $_POST['ownership'];
		if ($_POST['id_county'] != NULL)
		{
			$id_county= $_POST['id_county'];
		}

		$phone= $_POST['phone'];
		if ($phone === '' || !is_numeric($phone))
		{
			$phone = "No especificat";
		}

		$zip_code= $_POST['zip_code'];
		if ($zip_code == '' || !is_numeric($zip_code))
		{
			$zip_code = "No especificat";
		}

		if (!$id_hospital || !$hospital_name || !$adress || !$id_county || !$ownership)
		{
			echo '<script>alert("Cal omplir els camps obligatoris");</script>';
			echo"<script>window.open('index.php', '_self');</script>";
			//header("Location: index.php");
		}
		else
		{
			$consulta1="SELECT id_hospital as id FROM hospitals where id_hospital = $id_hospital;";
			$executar=mysqli_query($con,$consulta1);
			$fila=mysqli_fetch_array($executar);
			if ($fila)
				$id_prova= $fila['id'];

			$consulta2="SELECT id_owner as id_owner FROM propietaris where id_owner = $ownership;";
			$executar=mysqli_query($con,$consulta2);
			$fila=mysqli_fetch_array($executar);
			if ($fila)
				$owner_prova= $fila['id_owner'];

			$consulta3="SELECT id_county as id_county FROM comtat where id_county = $id_county;";
			$executar=mysqli_query($con,$consulta3);
			$fila=mysqli_fetch_array($executar);
			if ($fila)
				$county_prova= $fila['id_county'];

			if ($id_prova != NULL)
			{
				echo"<script>alert('ID ja existent a la taula, provi amb un altre');</script>";
            	echo"<script>window.open('index.php', '_self');</script>";
			}
			else if($county_prova == NULL)
			{
				echo"<script>alert('Comtat no vàlid, provi amb un altre');</script>";
				echo"<script>window.open('index.php', '_self');</script>";
			}
			else if($owner_prova == NULL)
			{
				echo"<script>alert('Propietari no vàlid, provi amb un altre');</script>";
				echo"<script>window.open('index.php', '_self');</script>";
			}
			else
			{
				$inserir="INSERT INTO hospitals (id_hospital, hospital_name, adress, id_county, phone, zip_code, owner_code)  
						values ('$id_hospital', '$hospital_name', '$adress', '$id_county', '$phone', '$zip_code', '$ownership')";
    			$executar=mysqli_query($con,$inserir);
    			if($executar)
				{
    				echo"<script>alert('Dades Actualitzades amb Èxit!');</script>";
    				echo"<script>window.open('index.php', '_self');</script>";
    			    // echo "<h3>Grup Inserit Correctament</h3>
    			      //     <p><a href='index.php'> Tornar</a></p>";
    			}
    		else die("Inserció errònia:  ".mysqli_error($con));
			}
    	
		}
		
	}
?>